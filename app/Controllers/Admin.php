<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Predis\Command\Redis\EXISTS;

use function PHPUnit\Framework\fileExists;

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

            'ttd' => $this->request->getVar('signature'),
        ];
        $ModelUser->insert($data);

        $file_name = strtolower(str_replace(' ', '_', $data['nama_lengkap'])) . '.png';
        $file_path = 'ttd/' . $file_name;
        $image_data = str_replace('data:image/png;base64,', '', $data['ttd']);
        $image_data = str_replace(' ', '+', $image_data);
        $image_decode = base64_decode($image_data);
        file_put_contents($file_path, $image_decode);

        return redirect()->to('admin/pengguna');
    }

    public function detail_pengguna($nik)
    {
        $ModelUser = new \App\Models\User();
        $user = session()->get('user');
        $detail = $ModelUser->where(['nik' => $nik])->first();

        $file_name = str_replace(' ', '_', $detail['nama_lengkap']);

        $data = [
            'user' => $user['nama_lengkap'],
            'user_status' => $user['status'],

            'detail' => $detail,
            'file_name' => $file_name,
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
        $file_name = str_replace(' ', '_', $detail['nama_lengkap']);

        $data = [
            'user' => $user['nama_lengkap'],
            'user_status' => $user['status'],

            'id_mapel' => $mapel['id_mapel'],
            'status' => $status['status'],

            'detail' => $detail,
            'file_name' => $file_name,
        ];
        return view('/admin/edit_admin_view', $data);
    }

    public function update()
    {
        $ModelUser = new \App\Models\User();
        $user_pengguna = $ModelUser->find();
        $user = session()->get('user');

        $file = $this->request->getVar('signature');
        $new_file = $this->request->getVar('nama_lengkap');
        $file_name = str_replace(' ', '_', $new_file);
        $file_path = 'ttd/' . $file_name . '.png';

        if (file_exists($file_path)) {
            unlink($file_path);
        }

        $image_data = str_replace('data:image/png;base64,', '', $file);
        $image_data = str_replace(' ', '+', $image_data);
        $image_decode = base64_decode($image_data);
        file_put_contents($file_path, $image_decode);

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

            'ttd' => $this->request->getVar('signature'),
        ];
        $ModelUser->save($data);

        return redirect()->to('admin/pengguna');
    }

    public function delete_pengguna($nik)
    {
        $ModelUser = new \App\Models\User();

        $ttd = $ModelUser->find($nik);
        // $file_name = strtolower(str_replace(' ', '_', $data['nama_lengkap'])) . '.png';

        $ttd_name = str_replace(' ','_', $ttd['nama_lengkap']);
        $file_path = 'ttd/' . $ttd_name . '.png';

        if (file_exists($file_path)) {
            unlink($file_path);
        }

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
