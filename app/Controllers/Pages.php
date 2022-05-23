<?php

namespace App\Controllers;

class Pages extends BaseController
{

    // public function __construct()
    // {
    //     $this->klienModel = new  KlienModel();
    // }
    public function index()
    {

        $data = [
            'title' => 'Login | HLP',
            'css' => 'style'
        ];

        return view('auth/login', $data);
    }
    public function profil()
    {
        $data = [
            'title' => 'Profil | HLP',
            'css' => 'preview-client-style'
        ];

        return view('pages/profil', $data);
    }

    public function pengguna()
    {
        $data = [
            'title' => 'Pengguna | HLP',
            'user' => $this->klienModel->getUser()
        ];

        return view('pages/pengguna', $data);
    }
}
