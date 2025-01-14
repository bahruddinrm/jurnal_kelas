<?php

namespace App\Models;

use CodeIgniter\Model;

class Kelas extends Model
{
    protected $table            = 'kelas';
    protected $primaryKey       = 'id_kelas';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_kelas', 'nama_kelas', 'wali_kelas'];

    public function getNamaKelas($pilih_kelas)
    {
        return $this->select('nama_kelas')
        ->where('id_kelas', $pilih_kelas)
        ->findAll();
    }

    public function kelasJoinPengguna()
    {
        return $this->select('kelas.*, pengguna.nama_lengkap')
        ->join('pengguna', 'kelas.wali_kelas = pengguna.id_pengguna')
        ->findAll();
    }

    public function kelasUrutAbjad()
    {
        return $this->orderBy('nama_kelas', 'ASC')->findAll();
    }

    public function getKelasByWaliKelas($nama_lengkap)
    {
        return $this->select('kelas.*')
        ->join('pengguna', 'pengguna.id_pengguna = kelas.wali_kelas')
        ->where('pengguna.nama_lengkap', $nama_lengkap)
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
