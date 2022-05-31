<?php

namespace App\Models;

use CodeIgniter\Model;

class JadwalModel extends Model
{
    protected $table = 'jadwal';
    protected $allowedFields = ['tujuan_jdw', 'tanggal', 'status', 'perusahaan'];

    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    public function viewTunggu($id)
    {

        $query =  $this->db->table('konsultasi')
            ->join('klien', 'konsultasi.id_klien = klien.id')
            ->where('konsultasi.id_klien', $id)
            ->get();
        return $query;
    }
    public function viewTerima($id_konsul)
    {
        return $this->where(['id_konsul' => $id_konsul])->first();
    }
    public function viewTolak($id_konsul)
    {
        return $this->where(['id_konsul' => $id_konsul])->first();
    }
}
