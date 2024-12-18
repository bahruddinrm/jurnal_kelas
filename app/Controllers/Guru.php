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
}
