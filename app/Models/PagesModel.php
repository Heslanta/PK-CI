<?php

namespace App\Models;

use CodeIgniter\Model;

class PagesModel extends Model
{



    public function getJumlahKlien()
    {
        $jumlahklien = $this->db->table('klien')->countAllResults();
        return $jumlahklien;
    }
    public function getJumlahKonsul()
    {
        $jumlahkonsultasi = $this->db->table('konsultasi')->countAllResults();
        return $jumlahkonsultasi;
    }
}
