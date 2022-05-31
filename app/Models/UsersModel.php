<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table = 'user';
    protected $allowedFields = ['nama', 'username', 'password', 'notelp', 'level'];

    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;
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
}
