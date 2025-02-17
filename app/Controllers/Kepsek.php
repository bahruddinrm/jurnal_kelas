<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Helpers\DateHelper;

class Kepsek extends BaseController
{
    public function index()
    {
        $ModelPengguna = new \App\Models\Pengguna();
        $ModelKelas = new \App\Models\Kelas();
        $ModelMapel = new \App\Models\Mapel();
        $ModelSiswa = new \App\Models\Siswa();

        $user = session()->get('user');
        $user_pengguna = $ModelPengguna->findAll();

        $data = [
            'user_pengguna' => $user_pengguna,
            'user' => $user['nama_lengkap'],
            'user_jabatan' => $user['jabatan'],

            'jumlah_pengguna' => $ModelPengguna->countAll(),
            'jumlah_kelas' => $ModelKelas->countAll(),
            'jumlah_mapel' => $ModelMapel->countAll(),
            'jumlah_siswa' => $ModelSiswa->countAll(),
        ];

        return view('kepsek/dashboard_kepsek_view', $data);
    }

    public function lihat_jurnal_guru()
    {
        $ModelPengguna = new \App\Models\Pengguna();
        $ModelBulan = new \App\Models\Bulan();
        $ModelJurnal = new \App\Models\Jurnal();

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

        $pengguna = $ModelPengguna->penggunaAdminGuru();
        $bulan = $ModelBulan->findAll();

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

        return view('/kepsek/lihat_jurnal_guru', $data);
    }

    public function lihat_jurnal_kelas()
    {
        $ModelKelas = new \App\Models\Kelas();
        $ModelBulan = new \App\Models\Bulan();
        $ModelJurnal = new \App\Models\Jurnal();

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
        $kelas = $ModelKelas->kelasUrutAbjad();
        $bulan = $ModelBulan->findAll();

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

        return view('/kepsek/lihat_jurnal_kelas', $data);
    }
}
