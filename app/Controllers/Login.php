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

        $listJabatan['jabatan'] = $ModelJabatan->findAll(); // Data jabatan dari database
        $err = null; // Inisialisasi error
        $sign_in = $this->request->getPost('sign_in');

        if ($sign_in) {
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');
            $inputJabatan = $this->request->getPost('jabatan');

            // Validasi username
            $user = $ModelUser->where('username', $username)->first();
            if (!$user) {
                $err = "Username tidak terdaftar";
            }

            // Validasi password
            if (empty($err) && $user['password'] != $password) {
                $err = "Password salah";
            }

            // Validasi jabatan
            if (empty($err) && $user['jabatan'] != $inputJabatan) {
                $err = "Anda bukan sebagai {$inputJabatan}";
            }

            // Jika tidak ada error, set session
            if (empty($err)) {
                $datasesi = [
                    'nip_nik' => $user['nip_nik'],
                    'username' => $user['username'],
                    'password' => $user['password'],
                    'nama_lengkap' => $user['nama_lengkap'],
                    'jabatan' => $user['jabatan'],
                ];
                session()->set('user', $datasesi);

                // Redirect berdasarkan jabatan
                if ($datasesi['jabatan'] == 'Admin') {
                    return redirect()->to('/admin');
                } elseif ($datasesi['jabatan'] == 'Guru') {
                    return redirect()->to('/guru');
                } elseif ($datasesi['jabatan'] == 'Kepala Sekolah') {
                    return redirect()->to('/kepsek');
                }
            }

            // Jika ada error, redirect dengan flashdata
            // if ($err) {
            //     return redirect()->to('/login')->with('error', $err)->with('username', $username)->with('password', $password);
            // }
            if ($err) {
                return redirect()->to('/')->with('error', $err)->withInput();
            }
        }

        // Load view dengan data jabatan
        return view('login_view', [
            'jabatan' => $listJabatan['jabatan'],
            'username' => session()->getFlashdata('username'),
            'password' => session()->getFlashdata('password'),
            'error' => session()->getFlashdata('error')
        ]);
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}
