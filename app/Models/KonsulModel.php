<?php

namespace App\Models;

use CodeIgniter\Model;

class KonsulModel extends Model
{
    protected $table = 'konsultasi';
    protected $allowedFields =
    ['konsul_ke', 'hari_tanggal', 'tujuan', 'hasil_konsul', 'catatan_konsul', 'id_klien', 'id_konsul'];
    protected $useTimestamps      = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $primaryKey     = 'id_konsul';

    // protected $deletedField  = 'deleted_at';
    // public function getKonsul($id)
    // {

    //     $query =  $this->db->table('konsultasi')
    //         ->join('klien', 'konsultasi.id_klien = klien.id')
    //         ->where('konsultasi.id_klien', $id)
    //         ->get();
    //     return $query;
    // }
    public function editKonsul($id_konsul)
    {

        return $this->where(['id_konsul' => $id_konsul])->first();
    }
    public function viewKonsul($id_konsul)
    {
        return $this->where(['id_konsul' => $id_konsul])->first();
    }
    public function deleteKonsul($id_konsul)
    {
        $this->db->table('konsultasi')
            ->delete(['id_konsul' => $id_konsul]);
    }
}
