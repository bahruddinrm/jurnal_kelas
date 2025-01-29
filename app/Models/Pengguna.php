<?php

namespace App\Models;

use CodeIgniter\Model;

class Pengguna extends Model
{
    protected $table            = 'pengguna';
    protected $primaryKey       = 'id_pengguna';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_pengguna','nip_nik','nama_lengkap','username','password','jabatan','ttd'];

    public function getPengguna($nama_lengkap)
    {
        return $this->select('pengguna.nama_lengkap, pengguna.id_pengguna')
        ->where('pengguna.nama_lengkap', $nama_lengkap)
        ->findAll();
    }

    public function getIdPengguna($nama_string)
    {
        return $this->select('id_pengguna')
        ->where('nama_lengkap', $nama_string)
        ->findAll();
    }

    public function penggunaUrutAbjad()
    {
        return $this->orderBy('nama_lengkap','ASC')->findAll();
    }

    public function penggunaAdminGuru()
    {
        return $this->select('pengguna.*')
        ->where('pengguna.jabatan', 'Guru')
        ->orderBy('nama_lengkap', 'ASC')
        ->findAll();
    }

    public function getKepalaSekolah()
    {
        return $this->select('pengguna.*')
        ->where('pengguna.jabatan', 'Kepala Sekolah')
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
