<?php

namespace App\Controllers;

class Pages extends BaseController
{

    // public function __construct()
    // {
    //     $this->klienModel = new  KlienModel();
    // }
    public function __construct()
    {
        if (session()->get('level') != "admin" || "pegawai") {
            echo 'Access denied';
            exit;
        }
    }
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
