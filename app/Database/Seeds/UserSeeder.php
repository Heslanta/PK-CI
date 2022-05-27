<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\UsersModel;

class UserSeeder extends Seeder
{
    public function run()
    {
        //     $user_object = new UsersModel();

        //     $user_object->insertBatch([
        //         [
        //             "nama" => "Charvia Cipta Wijaya",
        //             "username" => "admin",
        //             "password" => password_hash("12345678", PASSWORD_DEFAULT),
        //             "notelp" => "123456789123",
        //             "level" => "admin",
        //         ],
        //         [
        //             "nama" => "USER",
        //             "username" => "user",
        //             "password" => password_hash("12345678", PASSWORD_DEFAULT),
        //             "notelp" => "123456789123",
        //             "level" => "user",
        //         ]
        //     ]);  
        $faker = \Faker\Factory::create('id_ID');
        for ($i = 0; $i < 100; $i++) {
            $data = [
                'wajibpajak' => $faker->company(),
                'catatan' => $faker->text($maxNbChars = 200),
                'npwp' => $faker->numberBetween($min = 100000000000000, $max = 999999999999999),
                'notelp' => $faker->phoneNumber(14)
            ];
            $this->db->table('klien')->insert($data);
        }
    }
}
