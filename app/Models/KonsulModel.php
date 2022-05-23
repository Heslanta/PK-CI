<?php

namespace App\Models;

use CodeIgniter\Model;

class KonsulModel extends Model
{
    protected $table = 'konsultasi';
    protected $allowedFields = ['konsul_ke', 'hari_tanggal', 'Tujuan', 'hasil_konsul', 'catatan_konsul'];
    public function getKonsul($id)
    {

        $query =  $this->db->table('konsultasi')
            ->join('klien', 'konsultasi.id_klien = klien.id')
            ->where('konsultasi.id_klien', $id)
            ->get();
        return $query;
    }
    public function viewKonsul($id_konsul)
    {
        return $this->where(['id_konsul' => $id_konsul])->first();
    }
}
