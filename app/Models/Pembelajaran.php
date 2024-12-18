<?php

namespace App\Models;

use CodeIgniter\Model;
use PhpCsFixer\Fixer\WhitespacesAwareFixerInterface;

class Pembelajaran extends Model
{
    protected $table            = 'pembelajaran';
    protected $primaryKey       = 'id_pembelajaran';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_pembelajaran','pengguna','mapel','kelas'];

    public function pembelajaranJoin()
    {
        return $this->select('pembelajaran.*, pengguna.nama_lengkap, mapel.nama_mapel, kelas.nama_kelas')
        ->join('pengguna', 'pengguna.id_pengguna = pembelajaran.pengguna')
        ->join('mapel', 'mapel.id_mapel = pembelajaran.mapel')
        ->join('kelas', 'kelas.id_kelas = pembelajaran.kelas')
        ->orderBy('kelas.nama_kelas', 'ASC')
        ->findAll();
    }

    public function pembelajaranJoinKelas($nama_lengkap)
    {
        return $this->select('pembelajaran.*, pengguna.nama_lengkap, kelas.nama_kelas , kelas.id_kelas, mapel.nama_mapel')
        ->join('pengguna', 'pengguna.id_pengguna = pembelajaran.pengguna')
        ->join('kelas', 'kelas.id_kelas = pembelajaran.kelas')
        ->join('mapel', 'mapel.id_mapel = pembelajaran.mapel')
        ->where('pengguna.nama_lengkap', $nama_lengkap)
        ->orderBy('kelas.nama_kelas', 'ASC')
        ->findAll();
    }

    public function getMapel($nama_lengkap, $nama_kelas)
    {
        return $this->select('mapel.nama_mapel')
        ->join('pengguna','pengguna.id_pengguna = pembelajaran.pengguna')
        ->join('mapel','mapel.id_mapel = pembelajaran.mapel')
        ->join('kelas','kelas.id_kelas = pembelajaran.kelas')
        ->where('pengguna.nama_lengkap', $nama_lengkap)
        ->where('kelas.nama_kelas', $nama_kelas)
        ->get()
        ->getResultArray();
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
