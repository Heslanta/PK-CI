<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table = 'user';
    protected $allowedFields = ['nama', 'username', 'password', 'notelp', 'level', 'id_klien'];
    protected $useTimestamps = false;

    public function search($keyword)
    {
        return $this->table('user')->like('nama', $keyword);
    }
    public function getUser($id)
    {
        $query =  $this->db->table('user')
            ->join('klien', 'user.id_klien = klien.id')
            ->where('user.id_klien', $id)
            ->get();
        return $query;
    }
    public function cekUser($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }
        return $this->where(['id' => $id])->first();
    }
    public function updateUsers($data, $id)
    {
        $query = $this->db->table('user')

            ->update($data, array('id' => $id));
        return $query;
    }
    public function deleteAkun($id)
    {
        $query = $this->db->table('user')->delete(array('id' => $id));
        return $query;
    }
}
