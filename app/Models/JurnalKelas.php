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
    protected $allowedFields    = ['jurnal_id', 'nama_kelas', 'hari_tanggal', 'jam_ke', 'nama_lengkap', 'mapel', 'uraian_materi', 'media_pembelajaran', 'keterangan'];

    public function getJurnalJoinKelasMapel($pilih_kelas)
    {
        return $this->select('jurnal_kelas.* , kelas.nama_kelas, mapel.nama_mapel')
            ->join('kelas', 'jurnal_kelas.nama_kelas = kelas.id_kelas')
            ->join('mapel', 'jurnal_kelas.mapel = mapel.id_mapel')
            ->where('jurnal_kelas.nama_kelas', $pilih_kelas)
            ->orderBy('jurnal_kelas.hari_tanggal', 'DESC')
            ->orderBy('jurnal_kelas.jam_ke', 'ASC')
            ->findAll();
    }

    public function getCetakJurnalGuru($pilih_pengguna, $pilih_bulan, $pilih_tahun)
    {
        return $this->select('jurnal_kelas.hari_tanggal, jurnal_kelas.jam_ke, kelas.nama_kelas, 
                          COUNT(CASE WHEN daftar_hadir.keterangan = "Hadir" THEN 1 END) AS jumlah_hadir,
                          COUNT(CASE WHEN daftar_hadir.keterangan = "Ijin" THEN 1 END) AS jumlah_ijin,
                          COUNT(CASE WHEN daftar_hadir.keterangan = "Alpa" THEN 1 END) AS jumlah_alpa,
                          GROUP_CONCAT(siswa.nama_siswa SEPARATOR ", ") AS nama_siswa_absen,
                          jurnal_kelas.uraian_materi, jurnal_kelas.keterangan, jurnal_kelas.media_pembelajaran')
            ->join('kelas', 'jurnal_kelas.nama_kelas = kelas.id_kelas')
            ->join('daftar_hadir', 'jurnal_kelas.nama_kelas = daftar_hadir.nama_kelas AND jurnal_kelas.hari_tanggal = daftar_hadir.hari_tanggal', 'left')
            ->join('siswa', 'daftar_hadir.nama_siswa = siswa.id_siswa', 'left')
            ->where('jurnal_kelas.nama_lengkap', $pilih_pengguna)
            ->where('MONTH(jurnal_kelas.hari_tanggal)', $pilih_bulan)
            ->where('YEAR(jurnal_kelas.hari_tanggal)', $pilih_tahun)
            ->groupBy('jurnal_kelas.hari_tanggal, jurnal_kelas.jam_ke')
            ->orderBy('jurnal_kelas.hari_tanggal', 'DESC')
            ->orderBy('jurnal_kelas.jam_ke', 'ASC')
            ->findAll();
    }

    public function getCetakJurnalKelas($pilih_kelas, $pilih_bulan, $pilih_tahun)
    {
        return $this->select('jurnal_kelas.*, kelas.nama_kelas, mapel.nama_mapel, 
                          COUNT(CASE WHEN daftar_hadir.keterangan = "Hadir" THEN 1 END) AS jumlah_hadir,
                          COUNT(CASE WHEN daftar_hadir.keterangan = "Ijin" THEN 1 END) AS jumlah_ijin,
                          COUNT(CASE WHEN daftar_hadir.keterangan = "Alpa" THEN 1 END) AS jumlah_alpa,
                          GROUP_CONCAT(siswa.nama_siswa SEPARATOR ", ") AS nama_siswa_absen,
                          pengguna.nama_lengkap')
            ->join('pengguna', 'jurnal_kelas.nama_lengkap = pengguna.id_pengguna')
            ->join('mapel', 'jurnal_kelas.mapel = mapel.id_mapel')
            ->join('kelas', 'jurnal_kelas.nama_kelas = kelas.id_kelas')
            ->join('daftar_hadir', 'jurnal_kelas.nama_kelas = daftar_hadir.nama_kelas AND jurnal_kelas.hari_tanggal = daftar_hadir.hari_tanggal', 'left')
            ->join('siswa', 'daftar_hadir.nama_siswa = siswa.id_siswa', 'left')
            ->where('jurnal_kelas.nama_kelas', $pilih_kelas)
            ->where('MONTH(jurnal_kelas.hari_tanggal)', $pilih_bulan)
            ->where('YEAR(jurnal_kelas.hari_tanggal)', $pilih_tahun)
            ->groupBy('jurnal_kelas.hari_tanggal, jurnal_kelas.jam_ke')
            ->orderBy('jurnal_kelas.hari_tanggal', 'DESC')
            ->orderBy('jurnal_kelas.jam_ke', 'ASC')
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
