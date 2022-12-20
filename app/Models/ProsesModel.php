<?php

namespace App\Models;

use CodeIgniter\Model;

class ProsesModel extends Model
{
    protected $table = 'proses';
    protected $allowedFields = ['tujuan_jdw', 'tanggal', 'status', 'nama', 'id_user', 'proses', 'alasan', 'id_jadwal'];

    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    public function getProsesJadwal($id = false)
    {
        if ($id == false) {
            return $this->orderBy('tanggal', "ASC")->findAll();
        }
        return $this->where(['id_jadwal' => $id])->first();

        // $query =  $this->db->table('jadwal')
        //     ->orderBy('tanggal', 'ASC')
        //     ->get();

        // return $query;
    }
    // untuk menghapus proses jadwal
    public function deleteProsesJadwal($id)
    {
        $query = $this->db->table('proses')->delete(array('id_jadwal' => $id));
        return $query;
    }
    // untuk update proses persetujuan jadwal dari klien
    public function updateProsesJadwal($data, $id)
    {
        $query = $this->db->table('proses')->update($data, array('id_jadwal' => $id));

        return $query;
    }

    // untuk otomatis meupdate nama saat ada perubahan edit pada bagian user
    public function updatenamaJad($data, $id)
    {
        $query = $this->db->table('proses')
            ->update($data, array('id_user' => $id));
        return $query;
    }


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
    //view jadwal klienberanda
    public function viewJadwal()
    {
        $session = session();
        $query =  $this->db->table('proses')->orderBy('tanggal', "ASC")
            ->where('proses.id_user', $session->get('id'))

            ->get();
        return $query;
    }
    // public function viewKonsul()
    // {
    //     $session = session();
    //     $query =  $this->db->table('jadwal')
    //         ->join('user', 'jadwal.id_user = user.id')
    //         ->where('jadwal.id_user', $session->get('id'))
    //         ->join('klien', 'user.id_klien = klien.id')
    //         ->join('konsultasi', 'klien.id = konsultasi.id_klien')
    //         ->get();
    //     return $query;
    // }
}
