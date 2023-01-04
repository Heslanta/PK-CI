<?php

namespace App\Models;

use CodeIgniter\Model;

class JadwalModel extends Model
{
    protected $table = 'jadwal';
    protected $allowedFields = ['tujuan_jdw', 'tanggal', 'status', 'nama', 'id_user', 'proses', 'jam'];

    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;


    // Function menampilkan jadwal pada pages admin dan pegawai
    public function getJadwal($id = false)
    {
        if ($id == false) {
            return $this->where('tanggal >= CURDATE()')->orderBy('tanggal', "ASC")->findAll();
        }
        return $this->where(['id_jadwal' => $id])->first();

        // $query =  $this->db->table('jadwal')
        //     ->orderBy('tanggal', 'ASC')
        //     ->get();

        // return $query;
    }
    public function getJadwalInti($id_jadwal = false)
    {
        if ($id_jadwal == false) {
            return $this->findAll();
        }
        return $this->where(['id_jadwal' => $id_jadwal])->first();
    }
    public function getJadwalBefore($id = false)
    {
        if ($id == false) {
            $query = $this->where('tanggal BETWEEN (NOW() - INTERVAL 1 DAY) - INTERVAL 2 YEAR AND (NOW() - INTERVAL 1 DAY)', "", false)->orderBy('tanggal', "ASC")->findAll();
            // $this->db->table('jadwal')->delete(array($query));
            return $query;
        }
        return $this->where(['id_jadwal' => $id])->first();

        // $query =  $this->db->table('jadwal')
        //     ->orderBy('tanggal', 'ASC')
        //     ->get();

        // return $query;
    }

    public function hapusJadwalBefore($id = false)
    {
        if ($id == false) {
            $query = $this->where('tanggal BETWEEN (NOW() - INTERVAL 1 DAY) - INTERVAL 2 YEAR AND (NOW() - INTERVAL 1 DAY)', "", false)->orderBy('tanggal', "ASC")->delete();
            // $this->db->table('jadwal')->delete(array($query));
            return $query;
        }
        return $this->where(['id_jadwal' => $id])->first();
    }
    // public function getJadwalToday($id = false)
    // {
    //     if ($id == false) {
    //         return $this->where('date(tanggal)', date('Y-m-d'))->orderBy('tanggal', "ASC")->findAll();
    //     }
    //     return $this->where(['id_jadwal' => $id])->first();

    //     // $query =  $this->db->table('jadwal')
    //     //     ->orderBy('tanggal', 'ASC')
    //     //     ->get();

    //     // return $query;
    // }
    // menampilkan jadwal pada pages klien

    public function viewJadwal()
    {
        $session = session();
        $query =  $this->db->table('proses')
            ->where('proses.id_user', $session->get('id'))
            ->get();
        return $query;
    }
    public function deleteJadwal($id)
    {
        $query = $this->db->table('jadwal')->delete(array('id_jadwal' => $id));
        return $query;
    }

    // untuk update jadwal
    public function updateJadwal($data, $id)
    {
        $query = $this->db->table('jadwal')->update($data, array('id_jadwal' => $id));
        return $query;
    }
    // untuk otomatis update nama saat meupdate nama pada user
    public function updatenamaJad($data, $id)
    {
        $query = $this->db->table('jadwal')
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

    public function viewKonsul()
    {
        $session = session();
        $query =  $this->db->table('konsultasi')
            ->join('user', 'konsultasi.id_klien = user.id_klien')
            ->where('user.id', $session->get('id'))
            ->join('klien', 'user.id_klien = klien.id')
            ->get();
        return $query;


        // SQL nya
        // SELECT * FROM `konsultasi` JOIN `user` ON `konsultasi`.`id_klien` = `user`.`id_klien` JOIN `klien` ON `user`.`id_klien` = `klien`.`id` WHERE `user`.`id` = '11';

        // $query =  $this->db->table('jadwal')
        //     ->join('user', 'jadwal.id_user = user.id')
        //     ->where('jadwal.id_user', $session->get('id'))
        //     ->join('klien', 'user.id_klien = klien.id')
        //     ->join('konsultasi', 'klien.id = konsultasi.id_klien')
        //     ->get();
        // return $query;
    }
}
