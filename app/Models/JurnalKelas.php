<?php

namespace App\Models;

use CodeIgniter\Model;

class JurnalKelas extends Model
{
    protected $table            = 'jurnal_kelas';
    protected $primaryKey       = 'jurnal_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['jurnal_id','nama_kelas','hari_tanggal','jam_ke','nama_lengkap','mapel','uraian_materi','media_pembelajaran'];

    public function getJurnalJoinKelasMapel($pilih_kelas)
    {
        return $this->select('jurnal_kelas.* , kelas.nama_kelas, mapel.nama_mapel')
        ->join('kelas','jurnal_kelas.nama_kelas = kelas.id_kelas')
        ->join('mapel','jurnal_kelas.mapel = mapel.id_mapel')
        ->where('jurnal_kelas.nama_kelas', $pilih_kelas)
        // ->groupBy('kelas.nama_kelas')
        // ->orderBy('kelas.nama_kelas', 'ASC')
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
