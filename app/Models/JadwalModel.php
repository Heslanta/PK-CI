<?php

namespace App\Models;

use CodeIgniter\Model;

class JadwalModel extends Model
{
    protected $table = 'jadwal';
    protected $allowedFields = ['tujuan_jdw', 'tanggal', 'status', 'nama', 'id_user'];

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
    public function viewJadwal()
    {
        $session = session();
        $query =  $this->db->table('jadwal')
            ->where('jadwal.id_user', $session->get('id'))
            ->get();
        return $query;
    }
    public function viewKonsul()
    {
        $session = session();
        $query =  $this->db->table('jadwal')
            ->join('user', 'jadwal.id_user = user.id')
            ->where('jadwal.id_user', $session->get('id'))
            ->join('klien', 'user.id_klien = klien.id')
            ->join('konsultasi', 'klien.id = konsultasi.id_klien')
            ->get();
        return $query;
    }
}
