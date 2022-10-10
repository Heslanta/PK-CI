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
    // public function getJumlahBulan()
    // {
    //     $jumlahdata = $this->db->table('konsultasi')->where();
    // }
    public function viewProfil()
    {
        $session = session();
        $query =  $this->db->table('user')
            ->where('user.id', $session->get('id'))
            ->get();
        return $query;
    }
}
