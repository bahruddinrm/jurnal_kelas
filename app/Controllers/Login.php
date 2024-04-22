<?php

namespace App\Controllers;

use App\Controllers\BaseController;
// use PhpParser\Node\Stmt\ElseIf_;

// use function PHPUnit\Framework\returnSelf;

class Login extends BaseController
{
    public function index()
    {
        $ModelUser = new \App\Models\User();
        $sign_in = $this->request->getPost('sign_in');

        if ($sign_in) {
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');
            $status = $this->request->getPost('status');

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

            // error ketika status salah
            if (empty($err)) {
                $data = $ModelUser->where('username', $username)->first();
                if ($data['status'] != $status) {
                    $err = "Anda bukan sebagai {$status}";
                }
            }

            if (empty($err)) {
                $datasesi = [
                    'nik' => $data['nik'],
                    'nip' => $data['nip'],
                    'username' => $data['username'],
                    'password' => $data['password'],
                    'nama_lengkap' => $data['nama_lengkap'],
                    'mapel' => $data['mapel'],
                    'status' => $data['status'],
                ];
                session()->set('user', $datasesi);
                if ($datasesi['status'] == 'Admin'){
                    return redirect()->to('/admin');
                } elseif($datasesi['status'] == 'Guru'){
                    return redirect()->to('/guru');
                } elseif($datasesi['status'] == 'Kepala Sekolah'){
                    return redirect()->to('/kepsek');
                }
                // return redirect()->to('/user');
            }

            if ($err) {
                $error = session()->setFlashdata('error', $err);
            }
        }
        return view('login_view');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
