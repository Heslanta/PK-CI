<?php

namespace App\Validation;

use App\Models\UsersModel;

class Userrules
{
    // public function custom_rule(): bool
    // {
    //     return true;
    // }
    public function validateUser(string $str, string $fields, array $data)
    {
        $model = new UsersModel();
        $user = $model->where('email', $data['email'])
            ->first();

        if (!$user) {
            return false;
        }

        return password_verify($data['password'], $user['password']);
    }
}
