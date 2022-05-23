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
            'title' => 'Beranda | HLP',
            'css' => 'style'
        ];

        return view('pages/beranda', $data);
    }
    public function profil()
    {
        $data = [
            'title' => 'Profil | HLP',
            'css' => 'preview-client-style'
        ];

        return view('pages/profil', $data);
    }

    public function login()
    {
        $data = [
            'title' => 'Login | HLP',
            'css' => 'style'
        ];

        return view('auth/login', $data);
    }
}
