<?php

namespace App\Models;

use CodeIgniter\Model;

class DaftarHadir extends Model
{
    protected $table            = 'daftar_hadir';
    protected $primaryKey       = 'id_daftar_hadir';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_daftar_hadir', 'hari_tanggal', 'nama_siswa', 'nama_kelas', 'keterangan'];

    public function getDaftarHadir($tanggal_dh)
    {
        return $this->select('daftar_hadir.* , siswa.nama_siswa , kelas.nama_kelas')
            ->join('kelas', 'daftar_hadir.nama_kelas = kelas.id_kelas')
            ->join('siswa', 'daftar_hadir.nama_siswa = siswa.id_siswa')
            ->where('daftar_hadir.hari_tanggal', $tanggal_dh)
            ->findAll();
    }

    public function jumlahHadir($tanggal_dh)
    {
        return $this->select("kelas.id_kelas, kelas.nama_kelas, daftar_hadir.id_daftar_hadir, daftar_hadir.hari_tanggal,
                SUM(CASE WHEN daftar_hadir.keterangan = 'Hadir' THEN 1 ELSE 0 END) as hadir,
                SUM(CASE WHEN daftar_hadir.keterangan = 'Ijin' THEN 1 ELSE 0 END) as ijin,
                SUM(CASE WHEN daftar_hadir.keterangan = 'Sakit' THEN 1 ELSE 0 END) as sakit,
                SUM(CASE WHEN daftar_hadir.keterangan = 'Alpa' THEN 1 ELSE 0 END) as alpa")
            ->join('kelas','kelas.id_kelas = daftar_hadir.nama_kelas')
            ->where('daftar_hadir.hari_tanggal', $tanggal_dh)
            ->groupBy('kelas.nama_kelas')
            ->orderBy('kelas.nama_kelas', 'ASC')
            ->findAll();
    }

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'hari_tanggal' => 'required|valid_date[Y-m-d]'
    ];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}
