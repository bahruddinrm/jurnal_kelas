<?php

namespace App\Models;

use CodeIgniter\Model;

class Siswa extends Model
{
    protected $table            = 'siswa';
    protected $primaryKey       = 'id_siswa';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_siswa', 'nisn', 'nis', 'nama_siswa', 'kelas'];

    public function siswaJoinKelas()
    {
        return $this->select('siswa.* , kelas.nama_kelas')
                    ->join('kelas', 'siswa.kelas = kelas.id_kelas')
                    ->findAll();
    }

    public function getDH($dh_kelas)
    {
        return $this->select('siswa.* , kelas.nama_kelas')
                    ->join('kelas', 'siswa.kelas = kelas.id_kelas')
                    ->where('siswa.kelas',$dh_kelas)
                    ->findAll();
    }

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
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
