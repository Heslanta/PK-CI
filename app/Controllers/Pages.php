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
    protected $jadwalModel;
    public function __construct()
    {
        $this->pagesModel = new  PagesModel();
        $this->session = \Config\Services::session();
        $this->session->start();
        $this->jadwalModel = new  JadwalModel();
    }
    public function index()
    {
        $jadwal = $this->jadwalModel;
        $currentPage = $this->request->getVar('page_user') ? $this->request->getVar('page_user') :
            1;
        // jumlah data per halaman
        $jmldata = 10;
        $data = [
            'title' => 'Daftar Pengguna | HLP',
            'jadwal' => $jadwal->paginate($jmldata, 'jadwal'),
            'pager' => $this->jadwalModel->pager,
            'css' => 'user',
            'currentPage' => $currentPage,
            'jmldata' => $jmldata,
            'jmlklien' => $this->pagesModel->getJumlahKlien(),
            'jmlkonsul' => $this->pagesModel->getJumlahKonsul(),

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
    public function klienberanda()
    {

        $jadwal = $this->jadwalModel->viewJadwal()->getResultArray();
        // dd($jadwal);
        $data = [
            'title' => 'Beranda | HLP',
            'css' => 'preview-client-style',
            'jadwal' => $jadwal,

        ];


        return view('pages/klienberanda', $data);
    }
}
