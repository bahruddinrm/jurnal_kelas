<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Guru extends BaseController
{
    public function index()
    {
        $ModelUser = new \App\Models\User();
        $user = session()->get('user');

        $data = [

            'user' => $user['nama_lengkap'],
            'user_status' => $user['status'],
        ];

        return view('guru/dashboard_guru_view', $data);
    }

    public function input_administrasi()
    {
        $ModelUser = new \App\Models\User();
        $user = session()->get('user');

        $data = [


            'user' => $user['nama_lengkap'],
            'user_status' => $user['status'],
        ];

        return view('guru/input_administrasi_view', $data);
    }

    public function jurnal_kelas()
    {
        $ModelUser = new \App\Models\User();
        $ModelMapel = new \App\Models\Mapel();
        $ModelKelas = new \App\Models\Kelas();
        
        $kelas['nama_kelas'] = $ModelKelas->findAll(); 

        $user = session()->get('user');

        $mapel['id_mapel'] = $ModelMapel->findAll();

        $data = [
            'kelas' => $kelas['nama_kelas'],

            'id_mapel' => $mapel['id_mapel'],

            'user' => $user['nama_lengkap'],
            'user_status' => $user['status'],
        ];

        return view('guru/jurnal_kelas', $data);
    }

    public function input_jurnal_kelas()
    {
        $ModelUser = new \App\Models\User();
        $ModelMapel = new \App\Models\Mapel();
        $ModelKelas = new \App\Models\Kelas();

        $kelas['nama_kelas'] = $ModelKelas->findAll();

        $user = session()->get('user');

        $data = [
            'kelas' => $kelas['nama_kelas'],

            'user' => $user['nama_lengkap'],
            'user_status' => $user['status'],
        ];
    }
}
