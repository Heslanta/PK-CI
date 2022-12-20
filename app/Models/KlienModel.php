<?php

namespace App\Models;

use App\Controllers\Klien;
use CodeIgniter\Model;

class KlienModel extends Model
{
    protected $table = 'klien';
    protected $allowedFields =
    [
        'wajibpajak', 'npwp', 'status', 'notelp', 'catatan', 'filegambar', 'filedata', 'efin', 'bidang_usaha', 'email', 'email_pass',
        'notelp_per', 'pkp', 'enofa'
    ];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getKlien($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }
        return $this->where(['id' => $id])->first();
    }
    public function getNama()
    {
        $nama = $this->findColumn('wajibpajak');
        return $nama;
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

    public function search($keyword)
    {
        return $this->table('klien')->like('wajibpajak', $keyword);
    }

    public function getData()
    {
        // Contoh di MYSQL
        // select date_format(hari_tanggal, '%M'),COUNT(id_konsul)
        // from konsultasi
        // group by date_format(hari_tanggal, '%M');

        // $builder = $this->db->table("konsultasi");
        // $databulan = $this->db->table('konsultasi')
        //     ->selectCount('id_konsul')
        //     ->select('DATE_FORMAT(hari_tanggal, "%M ")')
        //     ->groupBy('DATE_FORMAT(hari_tanggal, "%M ")')
        //     ->get();

        // return $databulan;
    }
}
