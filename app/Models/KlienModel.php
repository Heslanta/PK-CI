<?php

namespace App\Models;

use CodeIgniter\Model;

class KlienModel extends Model
{
    protected $table = 'klien';
    protected $allowedFields = ['wajibpajak', 'npwp', 'notelp', 'catatan', 'filedata'];

    public function getKlien($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }
        return $this->where(['id' => $id])->first();
    }
    public function getKonsul($id)
    {
        $query =  $this->db->table('konsultasi')
            ->join('klien', 'konsultasi.id_klien = klien.id')
            ->where('konsultasi.id_klien', $id)
            ->get();
        return $query;
    }
    public function getJumlah()
    {
        $jumlah = $this->db->table('klien')->countAllResults();
        return $jumlah;
    }
}
