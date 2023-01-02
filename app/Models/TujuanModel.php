<?php

namespace App\Models;

use CodeIgniter\Model;

class TujuanModel extends Model
{
    protected $table = 'tujuan_konsul';
    protected $allowedFields = ['tujuan_konsul'];
    protected $useTimestamps = false;
    public function getTujuan($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }
    }
    public function updateTujuan($dataupdate, $id)
    {
        $query = $this->db->table('tujuan_konsul')->update($dataupdate, array('id' => $id));
        return $query;
    }
    public function deleteTujuan($id)
    {
        $query = $this->db->table('tujuan_konsul')->delete(array('id' => $id));
        return $query;
    }
    public function getNama()
    {
        $nama = $this->findColumn('tujuan_konsul');
        return $nama;
    }
}
