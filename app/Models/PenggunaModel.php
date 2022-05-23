<?php

namespace App\Models;

use CodeIgniter\Model;

class PenggunaModel extends Model
{
    protected $table = 'user';
    protected $allowedFields = ['nama', 'username', 'password', 'notelp', 'level'];

    public function getUser()
    {
        return $this->findAll();
    }
}
