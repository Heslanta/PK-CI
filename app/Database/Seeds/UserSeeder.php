<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\UsersModel;

class UserSeeder extends Seeder
{
    public function run()
    {
        $user_object = new UsersModel();

        $user_object->insertBatch([
            [
                "nama" => "Charvia Cipta Wijaya",
                "username" => "admin",
                "password" => password_hash("12345678", PASSWORD_DEFAULT),
                "notelp" => "123456789123",
                "level" => "admin",
            ],
            [
                "nama" => "USER",
                "username" => "user",
                "password" => password_hash("12345678", PASSWORD_DEFAULT),
                "notelp" => "123456789123",
                "level" => "user",
            ]
        ]);
    }
}
