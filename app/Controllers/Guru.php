<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Helpers\DateHelper;
use App\Models\JurnalKelas;
use App\Models\Kelas;
use CodeIgniter\HTTP\Exceptions\RedirectException;
use CodeIgniter\Model;
use Config\App;
use PhpParser\Node\Expr\FuncCall;
use Symfony\Contracts\Service\ServiceProviderInterface;
use Dompdf\Dompdf;
use Dompdf\Options;

class Guru extends BaseController
{
    public function index()
    {
        $user = session()->get('user');

        $data = [

            'user' => $user['nama_lengkap'],
            'user_jabatan' => $user['jabatan'],
        ];

        return view('guru/dashboard_guru_view', $data);
    }

    public function daftar_hadir()
    {
        $ModelDH = new \App\Models\DaftarHadir();
        $ModelPembelajaran = new \App\Models\Pembelajaran();

        $user = session()->get('user');

        $tanggal_dh = $this->request->getPost('tanggal_dh');
        session()->set('tanggal_dh', $tanggal_dh);

        $jumlah_hadir = $ModelDH->jumlahHadir($tanggal_dh);
        session()->set('jumlah_presensi', $jumlah_hadir);

        $data = [
            'user' => $user['nama_lengkap'],
            'user_jabatan' => $user['jabatan'],

            'tanggal_dh' => $tanggal_dh,
            'jumlah_hadir' => $jumlah_hadir,

            // 'kelas' => $ModelPembelajaran['nama_kelas'],
        ];

        return view('guru/daftar_hadir', $data);
    }

    public function isi_dh()
    {
        $ModelPembelajaran = new \App\Models\Pembelajaran();
        $ModelSiswa = new \App\Models\Siswa();

        $user = session()->get('user');

        $dh_kelas = $this->request->getPost('dh_kelas');
        session()->set('dh_kelas', $dh_kelas);
        //mengambil data relasi tabel
        $dh_siswa = $ModelSiswa->getDH($dh_kelas);
        //kelas untuk pilih kelas
        $nama_lengkap = $user['nama_lengkap'];
        $pembelajaran['nama_kelas'] = $ModelPembelajaran->pembelajaranJoinKelas($nama_lengkap);


        $data = [
            'user' => $user['nama_lengkap'],
            'user_jabatan' => $user['jabatan'],

            'dh_kelas' => $dh_kelas,
            'dh_siswa' => $dh_siswa,
            'kelas' => $pembelajaran['nama_kelas'],

            // 'validation' => \Config\Services::validation(),
        ];

        return view('guru/isi_dh', $data);
    }

    public function simpan_dh()
    {
        $ModelDH = new \App\Models\DaftarHadir();

        $tanggal = $this->request->getVar('hari_tanggal');
        $kehadiranSiswa = $this->request->getVar('siswa');
        $kelas = $this->request->getVar('kelas');

        if (empty($tanggal) || empty($kehadiranSiswa)) {
            return redirect()->back()->with('error', 'Harap lengkapi data yang dibutuhkan.');
        }

        $tanggal = date('Y-m-d', strtotime($tanggal));

        // validasi
        $cekData = $ModelDH->where('hari_tanggal', $tanggal)
            ->where('nama_kelas', $kelas)
            ->first();

        if ($cekData) {
            return redirect()->back()->with('error', 'Daftar hadir sudah diisi');
        }

        $data = [];

        foreach ($kehadiranSiswa as $nama_siswa => $status) {
            $data[] = [
                'nama_siswa' => $nama_siswa,
                'hari_tanggal' => $tanggal,
                'keterangan' => $status,
                'nama_kelas' => $kelas,
            ];
        }

        if ($ModelDH->insertBatch($data)) {
            return redirect()->to('guru/daftar_hadir')->with('success', 'Daftar hadir berhasil disimpan');
        } else {
            return redirect()->back()->with('error', 'Gagal menyimpan data daftar hadir');
        }
    }

    // public function hapus_dh($id_daftar_hadir)
    // {
    //     $ModelDH = new \App\Models\DaftarHadir();
    //     $ModelDH->delete($id_daftar_hadir);
    //     session()->setFlashdata('delete', 'Daftar Hadir Berhasil Dihapus');
    //     return redirect()->to('guru/daftar_hadir');
    // }

    // Jurnal kelas
    public function jurnal_kelas()
    {
        $ModelKelas = new \App\Models\Kelas();
        $ModelPembelajaran = new \App\Models\Pembelajaran();
        $ModelJurnal = new \App\Models\JurnalKelas();

        $user = session()->get('user');
        $pilih_kelas = $this->request->getPost('pilih_kelas');
        $nama_kelas = $ModelKelas->getNamaKelas($pilih_kelas);

        $kelas = array_column($nama_kelas, 'nama_kelas');
        $kelas_string = implode(",", $kelas);

        session()->set('nama_kelas', $kelas_string);
        session()->set('kelas', $pilih_kelas);

        $jumlah_presensi = session()->get('jumlah_presensi');

        //*
        $nama_lengkap = $user['nama_lengkap'];
        $pembelajaran['nama_kelas'] = $ModelPembelajaran->pembelajaranJoinKelas($nama_lengkap);
        //*

        $jurnal = $ModelJurnal->getJurnalJoinKelasMapel($pilih_kelas);

        foreach ($jurnal as &$j) {
            $englishDay = date('l', strtotime($j['hari_tanggal']));
            $j['hari_tanggal'] = DateHelper::hariIndonesia($englishDay) . ',' . date(' d/m/Y', strtotime($j['hari_tanggal']));
        }

        $data = [
            'user' => $user['nama_lengkap'],
            'user_jabatan' => $user['jabatan'],

            'jumlah_presensi' => $jumlah_presensi,
            'jurnal' => $jurnal,

            'nama_kelas' => $kelas_string,

            'kelas' => $pembelajaran['nama_kelas'],
            'pilih_kelas' => $pilih_kelas,
        ];

        return view('guru/jurnal_kelas', $data);
    }

    public function tambah_jurnal()
    {
        $ModelPembelajaran = new \App\Models\Pembelajaran();
        $ModelMapel = new \App\Models\Mapel();
        $ModelPengguna = new \App\Models\Pengguna();

        $user = session()->get('user');
        $nama_kelas = session()->get('nama_kelas');
        $kelas = session()->get('kelas');

        $nama_lengkap = $user['nama_lengkap'];
        $pembelajaran = $ModelPembelajaran->getMapel($nama_lengkap, $nama_kelas);
        $pengguna = $ModelPengguna->getPengguna($nama_lengkap);

        $id_pengguna = array_column($pengguna, 'id_pengguna');
        $id_pengguna_string = implode(",", $id_pengguna);

        $mapel = array_column($pembelajaran, 'nama_mapel');
        $mapel_string = implode(",", $mapel);

        $idMapel = $ModelMapel->getIdMapel($mapel_string);
        $mapel_id = array_column($idMapel, 'id_mapel');
        $mapel_string_id = implode(",", $mapel_id);

        $data = [
            'user' => $user['nama_lengkap'],
            'user_jabatan' => $user['jabatan'],

            'nama_kelas' => $nama_kelas,
            'kelas' => $kelas,

            'nama_lengkap' => $nama_lengkap,
            'idNama' => $id_pengguna_string,

            'idMapel' => $mapel_string_id,
            'mapel' => $mapel_string,
        ];

        return view('/guru/input_jurnal_kelas', $data);
    }

    public function simpan_jurnal()
    {
        $ModelJurnal = new \App\Models\JurnalKelas();
        $jurnal = $ModelJurnal->findAll();

        $user = session()->get('user');

        $data = [
            'user' => $user['nama_lengkap'],
            'user_jabatan' => $user['jabatan'],

            'nama_kelas' => $this->request->getVar('nama_kelas'),
            'hari_tanggal' => $this->request->getVar('hari_tanggal'),
            'jam_ke' => $this->request->getVar('jam_ke'),
            'nama_lengkap' => $this->request->getVar('nama_lengkap'),
            'mapel' => $this->request->getVar('mapel'),
            'uraian_materi' => $this->request->getVar('uraian_materi'),
            'media_pembelajaran' => $this->request->getVar('media_pembelajaran'),
            'keterangan' => $this->request->getVar('keterangan'),

            'jurnal' => $jurnal
        ];
        // $ModelJurnal->insert($data);

        try {
            $ModelJurnal->insert($data);
            session()->setFlashdata('success', 'Jurnal kelas berhasil disimpan.');
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Terjadi kesalahan saat menyimpan jurnal kelas: ' . $e->getMessage());
        }

        return redirect()->to('guru/jurnal_kelas');
        // return view('/guru/jurnal_kelas.php', $data);
    }

    public function hapus_jurnal($jurnal_id)
    {
        $ModelJurnal = new \App\Models\JurnalKelas();

        try {
            $ModelJurnal->delete($jurnal_id);
            session()->setFlashdata('delete', 'Data jurnal berhasil dihapus.');
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Gagal menghapus data jurnal: ' . $e->getMessage());
        }

        return redirect()->to('guru/jurnal_kelas');
    }

    public function cetak_jurnal_guru()
    {
        $ModelPengguna = new \App\Models\Pengguna();
        $ModelBulan = new \App\Models\Bulan();
        $ModelJurnal = new \App\Models\JurnalKelas();

        $user = session()->get('user');

        $pilih_pengguna = $this->request->getPost('pilih_pengguna');
        $pilih_bulan = $this->request->getPost('pilih_bulan');
        $pilih_tahun = $this->request->getPost('pilih_tahun');

        $nama_pengguna = $ModelPengguna->findAll();
        $nama_bulan = $ModelBulan->getNamaBulan($pilih_bulan);

        $pengguna = array_column($nama_pengguna, 'nama_lengkap');
        $nama_string = implode(",", $pengguna);
        $bulan = array_column($nama_bulan, 'nama_bulan');
        $bulan_string = implode(",", $bulan);

        session()->set('pilih_bulan', $pilih_bulan);
        session()->set('pilih_pengguna', $pilih_pengguna);
        session()->set('pilih_tahun', $pilih_tahun);
        session()->set('bulan_string', $bulan_string);
        session()->set('tahun_string', $pilih_tahun);

        $nama_lengkap = $user['nama_lengkap'];
        $pengguna = $ModelPengguna->getPengguna($nama_lengkap);
        $bulan = $ModelBulan->findAll();

        // $jurnal = $ModelJurnal->getJurnalJoinKelasMapel($pilih_kelas);
        $jurnal = $ModelJurnal->getCetakJurnalGuru($pilih_pengguna, $pilih_bulan, $pilih_tahun);
        session()->set('jurnal', $jurnal);

        foreach ($jurnal as &$j) {
            $englishDay = date('l', strtotime($j['hari_tanggal']));
            $j['hari_tanggal'] = DateHelper::hariIndonesia($englishDay) . ',' . date(' d/m/Y', strtotime($j['hari_tanggal']));
        }

        $data = [
            'user' => $user['nama_lengkap'],
            'user_jabatan' => $user['jabatan'],

            'pengguna' => $pengguna,
            'nama_pengguna' => $pengguna,
            'nama_bulan' => $bulan_string,
            'bulan' => $bulan,

            'jurnal' => $jurnal,
        ];

        return view('/guru/cetak_jurnal_guru', $data);
    }

    public function downloadJurnalGuru()
    {
        $ModelSekolah = new \App\Models\Sekolah();

        $kepala_sekolah = $ModelSekolah->findAll();

        $user = session()->get('user');
        $bulan = session()->get('bulan_string');
        $tahun = session()->get('tahun_string');

        $nama_lengkap = $user['nama_lengkap'];
        $nip = $user['nip_nik'];
        $namaKS = array_column($kepala_sekolah, 'kepala_sekolah');
        $namaKSString = implode(",", $namaKS);
        $nipKS = array_column($kepala_sekolah, 'nip');
        $nip_string = implode(",", $nipKS);

        $getJurnal = session()->get('jurnal');

        $data = [
            'wali_kelas' => $nama_lengkap,
            'kepala_sekolah' => $namaKSString,
            'nip_ks' => $nip_string,
            'nip' => $nip,
            'jurnal' => $getJurnal,
            'bulan' => $bulan,
            'tahun' => $tahun,
        ];

        $html = view('/guru/pdf_jurnal_guru', $data);

        // Konfigurasi Dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        // Unduh file PDF
        $dompdf->stream("jurnal_guru.pdf", ["Attachment" => 1]);
    }

    public function cetak_jurnal_kelas()
    {
        $ModelKelas = new \App\Models\Kelas();
        $ModelBulan = new \App\Models\Bulan();
        $ModelJurnal = new \App\Models\JurnalKelas();

        $user = session()->get('user');

        $pilih_kelas = $this->request->getPost('pilih_kelas');
        $pilih_bulan = $this->request->getPost('pilih_bulan');
        $pilih_tahun = $this->request->getPost('pilih_tahun');

        $nama_kelas = $ModelKelas->getNamaKelas($pilih_kelas);
        $nama_bulan = $ModelBulan->getNamaBulan($pilih_bulan);

        $kelas = array_column($nama_kelas, 'nama_kelas');
        $kelas_string = implode(",", $kelas);
        $bulan = array_column($nama_bulan, 'nama_bulan');
        $bulan_string = implode(",", $bulan);

        session()->set('pilih_bulan', $pilih_bulan);
        session()->set('pilih_kelas', $pilih_kelas);
        session()->set('pilih_tahun', $pilih_tahun);

        $nama_lengkap = $user['nama_lengkap'];
        $kelas = $ModelKelas->getKelasByWaliKelas($nama_lengkap);
        $bulan = $ModelBulan->findAll();

        // $jurnal = $ModelJurnal->getJurnalJoinKelasMapel($pilih_kelas);
        $jurnal = $ModelJurnal->getCetakJurnalKelas($pilih_kelas, $pilih_bulan, $pilih_tahun);
        session()->set('jurnal_kelas', $jurnal);

        foreach ($jurnal as &$j) {
            $englishDay = date('l', strtotime($j['hari_tanggal']));
            $j['hari_tanggal'] = DateHelper::hariIndonesia($englishDay) . ',' . date(' d/m/Y', strtotime($j['hari_tanggal']));
        }

        $data = [
            'user' => $user['nama_lengkap'],
            'user_jabatan' => $user['jabatan'],

            'kelas' => $kelas,
            'nama_kelas' => $kelas_string,
            'nama_bulan' => $bulan_string,
            'bulan' => $bulan,

            'jurnal' => $jurnal,
        ];

        return view('/guru/cetak_jurnal_kelas', $data);
    }

    public function downloadJurnalKelas()
    {
        $ModelSekolah = new \App\Models\Sekolah();

        $kepala_sekolah = $ModelSekolah->findAll();

        $user = session()->get('user');
        $kelas = session()->get('pilih_kelas');
        $bulan = session()->get('pilih_bulan');
        
        $nama_lengkap = $user['nama_lengkap'];
        $nip = $user['nip_nik'];
        $namaKS = array_column($kepala_sekolah, 'kepala_sekolah');
        $namaKSString = implode(",", $namaKS);
        $nipKS = array_column($kepala_sekolah, 'nip');
        $nip_string = implode(",", $nipKS);
        
        $getJurnal = session()->get('jurnal_kelas');
        
        $data = [
            'bulan' => $bulan,
            'kelas' => $kelas,
            'kepala_sekolah' => $namaKSString,
            'nip_ks' => $nip_string,
            'jurnal' => $getJurnal,
            'wali_kelas' => $nama_lengkap,
            'nip' => $nip,
        ];

        $html = view('/guru/pdf_jurnal_kelas', $data);

        // Konfigurasi Dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        // Unduh file PDF
        $dompdf->stream("jurnal_kelas.pdf", ["Attachment" => 1]);
    }
}
