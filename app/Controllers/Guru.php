<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Helpers\DateHelper;
use App\Models\JurnalKelas;
use CodeIgniter\HTTP\Exceptions\RedirectException;
use CodeIgniter\Model;
use PhpParser\Node\Expr\FuncCall;
use Symfony\Contracts\Service\ServiceProviderInterface;

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

    // foreach ($jurnal as &$j){
    //     $englishDay = date('l', strtotime($j['hari_tanggal']));
    //     $j['hari_tanggal'] = DateHelper::hariIndonesia($englishDay) . ',' . date(' d/m/Y', strtotime($j['hari_tanggal']));
    // }

    public function jurnal_kelas()
    {
        $ModelJurnal = new \App\Models\JurnalKelas();
        $ModelKelas = new \App\Models\Kelas();

        $user = session()->get('user');
        $pilih_kelas = $this->request->getPost('pilih_kelas');
        session()->set('pilih_kelas', $pilih_kelas);
        $jurnal = $ModelJurnal->where('kelas', $pilih_kelas)->findAll();
        $kelas = $ModelKelas->findAll();

        foreach ($jurnal as &$j){
            $englishDay = date('l', strtotime($j['hari_tanggal']));
            $j['hari_tanggal'] = DateHelper::hariIndonesia($englishDay) . ',' . date(' d/m/Y', strtotime($j['hari_tanggal']));
        }

        $data = [
            'user' => $user['nama_lengkap'],
            'user_status' => $user['status'],

            'pilih_kelas' => $pilih_kelas,
            'jurnal' => $jurnal,
            'kelas' => $kelas,
        ];

        return view('guru/jurnal_kelas', $data);
    }

    public function tambah_jurnal()
    {
        $ModelMapel = new \App\Models\Mapel();
        $ModelKelas = new \App\Models\Kelas();

        $user = session()->get('user');
        $pilih_kelas = session()->get('pilih_kelas');

        $kelas['nama_kelas'] = $ModelKelas->findAll();
        $mapel['id_mapel'] = $ModelMapel->findAll();

        $data = [
            'user' => $user['nama_lengkap'],
            'user_status' => $user['status'],

            'kelas' => $kelas['nama_kelas'],
            'id_mapel' => $mapel['id_mapel'],
            'pilih_kelas' => $pilih_kelas,

            'user_mapel' => $user['mapel'],
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
            'user_status' => $user['status'],

            'kelas' => $this->request->getVar('kelas'),
            'hari_tanggal' => $this->request->getVar('hari_tanggal'),
            'jam_ke' => $this->request->getVar('jam_ke'),
            'mapel' => $this->request->getVar('mapel'),
            'uraian_materi' => $this->request->getVar('uraian_materi'),
            'media_pembelajaran' => $this->request->getVar('media_pembelajaran'),
            'hadir' => $this->request->getVar('hadir'),
            'sakit' => $this->request->getVar('sakit'),
            'ijin' => $this->request->getVar('ijin'),
            'alpa' => $this->request->getVar('alpa'),
            'jumlah' => $this->request->getVar('jumlah'),
            'nama_siswa_tidak_hadir' => $this->request->getVar('nama_siswa_tidak_hadir'),

            'jurnal' => $jurnal
        ];
        $ModelJurnal->insert($data);

        return redirect()->to('guru/jurnal_kelas');
        // return view('/guru/jurnal_kelas.php', $data);
    }

    public function hapus_jurnal($jurnal_id)
    {
        $ModelJurnal = new \App\Models\JurnalKelas();
        $ModelJurnal->delete($jurnal_id);
        session()->setFlashdata('delete', 'jurnal berhasil dihapus');
        return redirect()->to('guru/jurnal_kelas');
    }
}
