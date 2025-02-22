<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Pembelajaran;
use App\Models\Pengguna;
use Config\App;
use Predis\Command\Redis\EXISTS;

use function PHPUnit\Framework\fileExists;

class Admin extends BaseController
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

        return view('admin/dashboard_admin_view', $data);
    }

    //Pengguna//
    public function pengguna()
    {
        $ModelPengguna = new \App\Models\Pengguna();
        $user = session()->get('user');
        $user_pengguna = $ModelPengguna->findAll();

        $data = [
            'user_pengguna' => $user_pengguna,
            'user' => $user['nama_lengkap'],
            'user_jabatan' => $user['jabatan'],

            'pengguna_pagination' => $ModelPengguna->paginate(1, 'pengguna_pagination'),
            'pager' => $ModelPengguna->pager
        ];

        return view('admin/pengguna', $data);
    }

    public function tambah_pengguna()
    {
        $ModelPengguna = new \App\Models\Pengguna();
        $ModelJabatan = new \App\Models\Jabatan();

        $jabatan['jabatan'] = $ModelJabatan->findAll();

        $user = session()->get('user');

        $data = [
            'user' => $user['nama_lengkap'],
            'user_jabatan' => $user['jabatan'],

            'jabatan' => $jabatan['jabatan'],
        ];

        return view('/admin/tambah_pengguna', $data);
    }

    public function simpan_pengguna()
    {
        $ModelPengguna = new \App\Models\Pengguna();

        // Ambil data dari input form
        $nip_nik = $this->request->getVar('nip_nik');
        $nama_lengkap = $this->request->getVar('nama_lengkap');
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $jabatan = $this->request->getVar('jabatan');

        // Tangani file upload
        $signatureFile = $this->request->getFile('signature_file');
        $signatureFileName = '';

        if ($signatureFile && $signatureFile->isValid() && !$signatureFile->hasMoved()) {
            // Buat nama file baru berdasarkan nama pengguna
            $signatureFileName = strtolower(str_replace(' ', '_', $nama_lengkap)) . '.png';

            // Pindahkan file ke direktori `public/ttd`
            $signatureFile->move('ttd', $signatureFileName);
        }

        // Data untuk disimpan ke database
        $data = [
            'nip_nik' => $nip_nik,
            'nama_lengkap' => $nama_lengkap,
            'username' => $username,
            'password' => $password,
            'jabatan' => $jabatan,
            'ttd' => $signatureFileName, // Simpan nama file di database
        ];

        // Simpan ke database
        $ModelPengguna->insert($data);

        // Set pesan sukses
        session()->setFlashdata('success', 'Pengguna berhasil ditambahkan.');

        // Redirect ke halaman pengguna
        return redirect()->to('admin/pengguna');
    }

    public function detail_pengguna($id_pengguna)
    {
        $ModelPengguna = new \App\Models\Pengguna();
        $user = session()->get('user');
        $detail = $ModelPengguna->where(['id_pengguna' => $id_pengguna])->first();

        $file_name = str_replace(' ', '_', $detail['nama_lengkap']);

        $data = [
            'user' => $user['nama_lengkap'],
            'user_jabatan' => $user['jabatan'],

            'detail' => $detail,
            'file_name' => $file_name,
        ];
        return view('/admin/detail_pengguna', $data);
    }

    public function edit_pengguna($id_pengguna)
    {
        $ModelPengguna = new \App\Models\Pengguna();
        $ModelJabatan = new \App\Models\Jabatan();

        $user = session()->get('user');
        $jabatan['jabatan'] = $ModelPengguna->findAll();

        $jenis_jabatan = $ModelJabatan->findAll();

        $detail = $ModelPengguna->find($id_pengguna);
        $file_name = str_replace(' ', '_', $detail['nama_lengkap']);

        $data = [
            'user' => $user['nama_lengkap'],
            'user_jabatan' => $user['jabatan'],

            'jabatan' => $jabatan['jabatan'],
            'jenis_jabatan' => $jenis_jabatan,

            'detail' => $detail,
            'file_name' => $file_name,
        ];
        return view('/admin/edit_pengguna', $data);
    }

    public function update_pengguna($id_pengguna)
    {
        $ModelPengguna = new \App\Models\Pengguna();
        $pengguna_lama = $ModelPengguna->find($id_pengguna);

        // Ambil data inputan form
        $nama_lengkap = $this->request->getVar('nama_lengkap');
        $nip_nik = $this->request->getVar('nip_nik');
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $jabatan = $this->request->getVar('jabatan');

        // Cek jika file tanda tangan baru diunggah
        $file = $this->request->getFile('signature_file');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            // Hapus file tanda tangan lama jika ada
            $old_file_path = 'ttd/' . $pengguna_lama['ttd'];
            if (file_exists($old_file_path)) {
                unlink($old_file_path);
            }

            // Simpan file tanda tangan baru
            $new_file_name = strtolower(str_replace(' ', '_', $nama_lengkap)) . '.png';
            $file->move('ttd', $new_file_name);
            $signature_path = $new_file_name;
        } else {
            // Jika tidak ada file baru, gunakan file tanda tangan lama
            $signature_path = $pengguna_lama['ttd'];
        }

        // Update data pengguna
        $data = [
            'nip_nik' => $nip_nik,
            'nama_lengkap' => $nama_lengkap,
            'username' => $username,
            'password' => $password,
            'jabatan' => $jabatan,
            'ttd' => $signature_path, // Gunakan file lama atau baru
        ];

        $ModelPengguna->update($id_pengguna, $data);

        session()->setFlashdata('success', 'Data pengguna berhasil diperbarui.');
        return redirect()->to('admin/pengguna');
    }

    public function delete_pengguna($id_pengguna)
    {
        $ModelPengguna = new \App\Models\Pengguna();

        $ttd = $ModelPengguna->find($id_pengguna);

        $ttd_name = str_replace(' ', '_', $ttd['nama_lengkap']);
        $file_path = 'ttd/' . $ttd_name . '.png';

        if (file_exists($file_path)) {
            unlink($file_path);
        }

        $ModelPengguna->delete($id_pengguna);

        session()->setFlashdata('success', 'Pengguna berhasil dihapus');
        return redirect()->to('admin/pengguna');
    }

    //mapel//
    public function mapel()
    {
        $ModelMapel = new \App\Models\Mapel();
        $ModelPengguna = new \App\Models\Pengguna();
        $user = session()->get('user');
        $mapel = $ModelMapel->findAll();
        $user_pengguna = $ModelPengguna->findAll();

        $data = [
            'user_pengguna' => $user_pengguna,
            'user' => $user['nama_lengkap'],
            'user_jabatan' => $user['jabatan'],

            'mapel' => $mapel,
        ];

        return view('/admin/mapel', $data);
    }

    public function tambah_mapel()
    {
        $ModelMapel = new \App\Models\Mapel();

        $mapel['id_mapel'] = $ModelMapel->findAll();
        $user = session()->get('user');

        $data = [
            'user' => $user['nama_lengkap'],
            'user_jabatan' => $user['jabatan'],

            'id_mapel' => $mapel['id_mapel'],
        ];

        return view('/admin/tambah_mapel', $data);
    }

    public function simpan_mapel()
    {
        $ModelMapel = new \App\Models\Mapel();

        $data = [
            'id_mapel' => $this->request->getVar('id_mapel'),
            'nama_mapel' => $this->request->getVar('nama_mapel'),
        ];
        $ModelMapel->insert($data);

        session()->setFlashdata('success', 'Mapel berhasil ditambahkan.');

        return redirect()->to('admin/mapel');
    }

    public function delete_mapel($id_mapel)
    {
        $ModelMapel = new \App\Models\Mapel();
        $ModelMapel->delete($id_mapel);
        session()->setFlashdata('success', 'Mapel berhasil dihapus');
        return redirect()->to('admin/mapel');
    }

    //kelas//
    public function kelas()
    {
        $ModelKelas = new \App\Models\Kelas();
        $ModelPengguna = new \App\Models\Pengguna();

        $user = session()->get('user');
        $pengguna = $ModelPengguna->findAll();

        $kelas = $ModelKelas->kelasJoinPengguna();

        $data = [
            'user' => $user['nama_lengkap'],
            'user_jabatan' => $user['jabatan'],

            'kelas' => $kelas,

            'pengguna' => $pengguna,
        ];
        return view('/admin/kelas', $data);
    }

    public function tambah_kelas()
    {
        $ModelKelas = new \App\Models\Kelas();
        $ModelPengguna = new \App\Models\Pengguna();

        $guru = $ModelPengguna->where(['jabatan' => 'Guru'])->findAll();
        $wali_kelas['nama_lengkap'] = $guru;
        $user = session()->get('user');

        $data = [
            'user' => $user['nama_lengkap'],
            'user_jabatan' => $user['jabatan'],

            'wali_kelas' => $wali_kelas['nama_lengkap']
        ];
        return view('/admin/tambah_kelas', $data);
    }

    public function simpan_kelas()
    {
        $ModelKelas = new \App\Models\Kelas();

        $data = [
            'nama_kelas' => $this->request->getVar('nama_kelas'),
            'wali_kelas' => $this->request->getVar('wali_kelas'),
        ];
        $ModelKelas->insert($data);

        session()->setFlashdata('success', 'Kelas berhasil ditambahkan.');

        return redirect()->to('admin/kelas');
    }

    public function delete_kelas($id_kelas)
    {
        $ModelKelas = new \App\Models\Kelas();
        $ModelKelas->delete($id_kelas);
        session()->setFlashdata('success', 'Kelas berhasil dihapus');
        return redirect()->to('admin/kelas');
    }

    //siswa//
    public function siswa()
    {
        $ModelSiswa = new \App\Models\Siswa();
        $ModelKelas = new \App\Models\Kelas();

        $kelas = $ModelKelas->findAll();

        $user = session()->get('user');
        $siswa = $ModelSiswa->siswaJoinKelas();

        $data = [
            'user' => $user['nama_lengkap'],
            'user_jabatan' => $user['jabatan'],

            'kelas' => $kelas,

            'siswa' => $siswa,
            // 'siswa_pagination' => $ModelSiswa->paginate(2, 'siswa_pagination'),
            // 'pager' => $ModelSiswa->pager
        ];

        return view('/admin/siswa', $data);
    }

    public function tambah_siswa()
    {
        $ModelSiswa = new \App\Models\Siswa();
        $ModelKelas = new \App\Models\Kelas();

        $siswa = $ModelSiswa->findAll();
        $kelas = $ModelKelas->kelasUrutAbjad();

        $user = session()->get('user');

        $data = [
            'user' => $user['nama_lengkap'],
            'user_jabatan' => $user['jabatan'],

            'kelas' => $kelas,
        ];

        return view('/admin/tambah_siswa', $data);
    }

    public function simpan_siswa()
    {
        $ModelSiswa = new \App\Models\Siswa();

        $data = [
            'nisn' => $this->request->getVar('nisn'),
            'nis' => $this->request->getVar('nis'),
            'nama_siswa' => $this->request->getVar('nama_siswa'),
            'kelas' => $this->request->getVar('kelas'),
        ];

        $ModelSiswa->insert($data);
        session()->setFlashdata('success', 'Siswa berhasil ditambahkan.');
        return redirect()->to('admin/siswa');
    }

    public function delete_siswa($id_siswa)
    {
        $ModelSiswa = new \App\Models\Siswa();
        $ModelSiswa->delete($id_siswa);
        session()->setFlashdata('success', 'Siswa berhasil dihapus');
        return redirect()->to('admin/siswa');
    }

    //Pembelajaran
    public function pembelajaran()
    {
        $ModelPembelajaran = new \App\Models\Pembelajaran();

        $user = session()->get('user');

        $pembelajaran = $ModelPembelajaran->pembelajaranJoin();

        $data = [
            'user' => $user['nama_lengkap'],
            'user_jabatan' => $user['jabatan'],

            'pembelajaran' => $pembelajaran,
        ];

        return view('/admin/pembelajaran.php', $data);
    }

    public function tambah_pembelajaran()
    {
        $ModelPembelajaran = new \App\Models\Pembelajaran();
        $ModelPengguna = new \App\Models\Pengguna();
        $ModelMapel = new \App\Models\Mapel();
        $ModelKelas = new \App\Models\Kelas();

        $user = session()->get('user');

        $pembelajaran = $ModelPembelajaran->findAll();
        $pengguna = $ModelPengguna->penggunaUrutAbjad();
        $mapel = $ModelMapel->mapelUrutAbjad();
        $kelas = $ModelKelas->kelasUrutAbjad();

        $data = [
            'user' => $user['nama_lengkap'],
            'user_jabatan' => $user['jabatan'],

            'pembelajaran' => $pembelajaran,
            'pengguna' => $pengguna,
            'mapel' => $mapel,
            'kelas' => $kelas,
        ];

        return view('/admin/tambah_pembelajaran.php', $data);
    }

    public function simpan_pembelajaran()
    {
        $ModelPembelajaran = new \App\Models\Pembelajaran();

        $data = [
            'pengguna' => $this->request->getVar('pengguna'),
            'mapel' => $this->request->getVar('mapel'),
            'kelas' => $this->request->getVar('kelas'),
        ];

        $ModelPembelajaran->insert($data);
        session()->setFlashdata('success', 'Pembelajaran berhasil ditambahkan.');
        return redirect()->to('admin/pembelajaran');
    }

    public function delete_pembelajaran($id_pembelajaran)
    {
        $ModelPembelajaran = new \App\Models\Pembelajaran();
        $ModelPembelajaran->delete($id_pembelajaran);
        session()->setFlashdata('success', 'Pembelajaran berhasil dihapus');
        return redirect()->to('admin/pembelajaran');
    }

    public function data_sekolah()
    {
        $ModelSekolah = new \App\Models\Sekolah();
        $ModelPengguna = new \App\Models\Pengguna();

        $user = session()->get('user');
        $data_ks = $ModelPengguna->getKepalaSekolah();

        $nama_ks = array_column($data_ks, 'nama_lengkap');
        $nama_ks_string = implode(",", $nama_ks);

        $nip_ks = array_column($data_ks, 'nip_nik');
        $nip_ks_string = implode(",", $nip_ks);

        $ttd_ks = str_replace(' ', '_', $nama_ks_string);

        $detail = $ModelSekolah->findAll();

        $data = [
            'user' => $user['nama_lengkap'],
            'user_jabatan' => $user['jabatan'],

            'detail' => $detail,
            'nama_ks' => $nama_ks_string,
            'nip_ks' => $nip_ks_string,
            'ttd_ks' => $ttd_ks,
        ];

        return view('/admin/data_sekolah', $data);
    }

    public function simpan_data_sekolah()
    {
        $ModelSekolah = new \App\Models\Sekolah();

        $id = $this->request->getVar('id');

        $data = [
            'nama_sekolah' => $this->request->getVar('nama_sekolah'),
            'alamat_sekolah' => $this->request->getVar('alamat_sekolah'),
            'kepala_sekolah' => $this->request->getVar('kepala_sekolah'),
            'nip' => $this->request->getVar('nip'),
        ];

        if ($ModelSekolah->update($id, $data)) { // Pastikan ID di parameter pertama
            return redirect()->to('/admin/data_sekolah')->with('success', 'Data sekolah berhasil diperbarui.');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal memperbarui data sekolah.');
        }
    }
}
