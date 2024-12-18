<?php

namespace App\Controllers;

use App\Controllers\BaseController;
// use PhpParser\Node\Stmt\ElseIf_;

// use function PHPUnit\Framework\returnSelf;

class Login extends BaseController
{
    public function index()
    {
        $ModelUser = new \App\Models\Pengguna();
        $ModelJabatan = new \App\Models\Jabatan();

        $jabatan['jabatan'] = $ModelJabatan->findAll();
        $sign_in = $this->request->getPost('sign_in');

        if ($sign_in) {
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');
            $jabatan = $this->request->getPost('jabatan');

            // error ketika username tidak terdaftar
            $user = $ModelUser->where('username', $username)->first();
            if (!$user) {
                $err = "Username tidak terdaftar";
            }

            // error ketika password salah
            if (empty($err)) {
                $data = $ModelUser->where('username', $username)->first();
                if ($data['password'] != $password) {
                    $err = "Password salah";
                }
            }

            // error ketika jabatan salah
            if (empty($err)) {
                $data = $ModelUser->where('username', $username)->first();
                if ($data['jabatan'] != $jabatan) {
                    $err = "Anda bukan sebagai {$jabatan}";
                }
            }

            if (empty($err)) {
                $datasesi = [
                    // 'id_pengguna' => $data['id_pengguna'],
                    'nip_nik' => $data['nip_nik'],
                    'username' => $data['username'],
                    'password' => $data['password'],
                    'nama_lengkap' => $data['nama_lengkap'],
                    'jabatan' => $data['jabatan'],
                ];
                session()->set('user', $datasesi);
                if ($datasesi['jabatan'] == 'Admin'){
                    return redirect()->to('/admin');
                } elseif($datasesi['jabatan'] == 'Guru'){
                    return redirect()->to('/guru');
                } elseif($datasesi['jabatan'] == 'Kepala Sekolah'){
                    return redirect()->to('/kepsek');
                }
                // return redirect()->to('/user');
            }

            if ($err) {
                $error = session()->setFlashdata('error', $err);
            }
        }
        

        
        return view('login_view', $jabatan);
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
