<?php

namespace App\Models;

use CodeIgniter\Model;

class KonsultanModel extends Model
{
    public function getKonsultan($id = false)
    {
        if ($id == false) {
            return $this->orderBy('tanggal', "ASC")->findAll();
        }
        return $this->where(['id_jadwal' => $id])->first();
    }
}
