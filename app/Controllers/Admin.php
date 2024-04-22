<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Admin extends BaseController
{
    public function index()
    {
        $ModelUser = new \App\Models\User();
        $user = session()->get('user');
        $user_pengguna = $ModelUser->findAll();

        $data = [
            'user_pengguna' => $user_pengguna,
            'user' => $user['nama_lengkap'],
            'user_status' => $user['status'],
        ];

        return view('admin/dashboard_admin_view', $data);
    }

    public function pengguna()
    {
        $ModelUser = new \App\Models\User();
        $user = session()->get('user');
        $user_pengguna = $ModelUser->findAll();

        $data = [
            'user_pengguna' => $user_pengguna,
            'user' => $user['nama_lengkap'],
            'user_status' => $user['status'],

            'user_pagination' => $ModelUser->paginate(10, 'user_pagination'),
            'pager' => $ModelUser->pager
        ];

        return view('admin/pengguna_admin_view', $data);
    }

    public function tambah_pengguna()
    {
        $ModelUser = new \App\Models\User();
        $ModelMapel = new \App\Models\Mapel();

        $mapel['id_mapel'] = $ModelMapel->findAll();
        // $status['status'] = $ModelUser->findAll();
        $user = session()->get('user');
        $user_pengguna = $ModelUser->findAll();


        $data = [
            'user' => $user['nama_lengkap'],
            'user_status' => $user['status'],

            'id_mapel' => $mapel['id_mapel'],
            // 'status' => $status['status'],
        ];

        return view('/admin/input_pengguna_admin_view', $data);
    }

    public function simpan_pengguna()
    {
        $ModelUser = new \App\Models\User();
        $user_pengguna = $ModelUser->findAll();
        $user = session()->get('user');

        $data = [
            'user' => $user['nama_lengkap'],
            'user_status' => $user['status'],


            'nik' => $this->request->getVar('nik'),
            'nip' => $this->request->getVar('nip'),
            'username' => $this->request->getVar('username'),
            'password' => $this->request->getVar('password'),
            'nama_lengkap' => $this->request->getVar('nama_lengkap'),
            'mapel' => $this->request->getVar('mapel'),
            'status' => $this->request->getVar('status'),
        ];
        $ModelUser->insert($data);
        return redirect()->to('admin/pengguna');
    }

    public function detail_pengguna($nik)
    {
        $ModelUser = new \App\Models\User();
        $user = session()->get('user');
        $detail = $ModelUser->where(['nik' => $nik])->first();

        $data = [
            'user' => $user['nama_lengkap'],
            'user_status' => $user['status'],

            'detail' => $detail,
        ];
        return view('/admin/detail_admin_view', $data);
    }

    public function edit_pengguna($nik)
    {
        $ModelUser = new \App\Models\User();
        $ModelMapel = new \App\Models\Mapel();

        $mapel['id_mapel'] = $ModelMapel->findAll();
        $user = session()->get('user');
        $status['status'] = $ModelUser->findAll();

        $detail = $ModelUser->find($nik);

        $data = [
            'user' => $user['nama_lengkap'],
            'user_status' => $user['status'],

            'id_mapel' => $mapel['id_mapel'],
            'status' => $status['status'],

            'detail' => $detail,
        ];
        return view('/admin/edit_admin_view', $data);
    }

    public function update()
    {
        $ModelUser = new \App\Models\User();
        $user_pengguna = $ModelUser->findAll();
        $user = session()->get('user');

        $data = [
            'user' => $user['nama_lengkap'],
            'user_status' => $user['status'],


            'nik' => $this->request->getVar('nik'),
            'nip' => $this->request->getVar('nip'),
            'username' => $this->request->getVar('username'),
            'password' => $this->request->getVar('password'),
            'nama_lengkap' => $this->request->getVar('nama_lengkap'),
            'mapel' => $this->request->getVar('mapel'),
            'status' => $this->request->getVar('status'),
        ];
        $ModelUser->save($data);
        return redirect()->to('admin/pengguna');
    }

    public function delete_pengguna($nik)
    {
        $ModelUser = new \App\Models\User();
        $ModelUser->delete($nik);
        session()->setFlashdata('delete', "$nik berhasil dihapus");
        return redirect()->to('admin/pengguna');
    }

    public function mapel()
    {
        $ModelMapel = new \App\Models\Mapel();
        $ModelUser = new \App\Models\User();
        $user = session()->get('user');
        $mapel = $ModelMapel->findAll();
        $user_pengguna = $ModelUser->findAll();

        $data = [
            'user_pengguna' => $user_pengguna,
            'user' => $user['nama_lengkap'],
            'user_status' => $user['status'],

            'mapel' => $mapel,
        ];

        return view('/admin/mapel_admin_view', $data);
    }

    public function tambah_mapel()
    {
        $ModelUser = new \App\Models\User();
        $ModelMapel = new \App\Models\Mapel();

        $mapel['id_mapel'] = $ModelMapel->findAll();
        $user = session()->get('user');
        $user_pengguna = $ModelUser->findAll();

        $data = [
            'user' => $user['nama_lengkap'],
            'user_status' => $user['status'],

            'id_mapel' => $mapel['id_mapel'],
        ];

        return view('/admin/input_mapel_admin_view', $data);
    }

    public function simpan_mapel()
    {
        $ModelUser = new \App\Models\User();
        $ModelMapel = new \App\Models\Mapel();
        $user_pengguna = $ModelUser->findAll();
        $user = session()->get('user');

        $data = [
            'user' => $user['nama_lengkap'],
            'user_status' => $user['status'],


            'id_mapel' => $this->request->getVar('id_mapel'),
            'nama_mapel' => $this->request->getVar('nama_mapel'),
        ];
        $ModelMapel->insert($data);
        return redirect()->to('admin/mapel');
    }

    public function delete_mapel($id_mapel)
    {
        $ModelMapel = new \App\Models\Mapel();
        $ModelMapel->delete($id_mapel);
        session()->setFlashdata('delete', "$id_mapel berhasil dihapus");
        return redirect()->to('admin/mapel');
    }
}
