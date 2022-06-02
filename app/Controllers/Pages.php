<?php

namespace App\Controllers;

use App\Models\PagesModel;
use App\Models\JadwalModel;

class Pages extends BaseController
{

    // public function __construct()
    // {
    //     $this->klienModel = new  KlienModel();
    // }
    // protected $pagesModel;
    // public function __construct()
    // {
    //     // cek session login
    //     // if (session()->get('level') != "admin" || "pegawai") {
    //     //     echo 'Access denied';
    //     //     exit;
    //     // }
    //   
    // }
    protected $session;



    protected $pagesModel;
    public function __construct()
    {
        $this->pagesModel = new  PagesModel();
        $this->session = \Config\Services::session();
        $this->session->start();
    }
    public function index()
    {

        $data = [
            'title' => 'Beranda | HLP',
            'css' => 'preview-client-style',
            'jmlklien' => $this->pagesModel->getJumlahKlien(),
            'jmlkonsul' => $this->pagesModel->getJumlahKonsul()
        ];

        return view('pages/beranda', $data);
    }
    public function profil()
    {
        $profil = $this->pagesModel->viewProfil();
        // dd($profil);
        $data = [
            'title' => 'Profil | HLP',
            'css' => 'preview-client-style',
            'profil' => $profil->getRowArray()
        ];
        // dd($data);
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
