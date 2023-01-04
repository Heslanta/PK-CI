<?php

namespace App\Controllers;

use App\Models\PagesModel;
use App\Models\JadwalModel;
use App\Models\KlienModel;
use App\Models\KonsulModel;
use App\Models\ProsesModel;
use App\Models\TujuanModel;

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
    protected $prosesModel;
    public function __construct()
    {
        $this->pagesModel = new  PagesModel();
        $this->prosesModel = new  ProsesModel();
        $this->session = \Config\Services::session();
        $this->session->start();
        $this->jadwalModel = new  JadwalModel();
        $this->klienModel = new  KlienModel();
        $this->tujuanModel = new  TujuanModel();
    }
    public function ambildata()
    {
        if ($this->request->isAJAX()) {
            $jadwal = new JadwalModel();
            $data = [
                'tampildata' => $jadwal->getJadwal(),
                'css' => 'user',
            ];
            $msg = [
                'data' => view('jadwal/datajadwal', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('gg gaming');
        }
    }
    public function formtambah()
    {
        $nama = $this->klienModel;
        if ($this->request->isAJAX()) {
            $data = [
                'nama' => $nama->getNama(),
                'tujuan' => $this->tujuanModel->getNama(),
            ];
            $msg = [

                'data' => view('jadwal/modaltambah', $data),



            ];
            echo json_encode($msg);
        } else {
            exit('gg gaming');
        }
    }
    public function formedit()
    {
        if ($this->request->isAJAX()) {
            $nama = $this->klienModel;
            $id_jadwal = $this->request->getVar('id_jadwal');
            $row = $this->jadwalModel->getJadwalInti($id_jadwal);
            $data = [
                'id_jadwal' => $row['id_jadwal'],
                'nama' => $row['nama'],
                'tujuan_jdw' => $row['tujuan_jdw'],
                'tanggal' => $row['tanggal'],
                'jam' => $row['jam'],
                'status' => $row['status'],
                'proses' => $row['proses'],
                'id_user' => $row['id_user'],
                // 'nama' => $nama->getNama(),
                'tujuan' => $this->tujuanModel->getNama(),
            ];
            // dd($data);
            $msg = [
                'sukses' => view('jadwal/modaledit', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('gg gaming');
        }
    }
    public function index()
    {
        $jadwal = $this->jadwalModel;
        $prosesjadwal = $this->prosesModel;
        $nama = $this->klienModel;
        $currentPage = $this->request->getVar('page_user') ? $this->request->getVar('page_user') :
            1;
        // jumlah data per halaman
        $jmldata = 10;
        // ambil jadwal sebelum hari ini
        $jadwalbefore = $jadwal->getJadwalBefore();
        // dd($jadwalbefore);
        if (!empty($jadwalbefore)) {
            $jadwal->hapusJadwalBefore();
        }
        $data = [
            'title' => 'Beranda | HLP',
            'jadwalbefore' => $jadwal->getJadwalBefore(),
            'jadwal' => $jadwal->getJadwal(),
            'proses' => $prosesjadwal->getProsesJadwal(),
            'nama' => $nama->getNama(),
            'tujuan' => $this->tujuanModel->getNama(),
            'pager' => $this->prosesModel->pager,
            'css' => 'user',
            'currentPage' => $currentPage,
            'jmldata' => $jmldata,
            'jmlklien' => $this->pagesModel->getJumlahKlien(),
            'jmlkonsul' => $this->pagesModel->getJumlahKonsul(),
            'totalkonsul' => $this->klienModel->getData(),
        ];
        // dd($data);


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
        $jadwal = $this->prosesModel->viewJadwal()->getResultArray();
        // dd($jadwal);

        $data = [
            'title' => 'Beranda | HLP',
            'css' => 'preview-client-style',
            'jadwal' => $jadwal,
            'tujuan' => $this->tujuanModel->getNama(),


        ];
        return view('pages/klienberanda', $data);
    }

    public function bantuan()
    {
        $data = [
            'title' => 'Halaman Bantuan | HLP',
            'css' => 'preview-client-style'

        ];
        return view('pages/bantuan', $data);
    }

    // public function regis()
    // {
    //     $data = [
    //         'title' => 'Tes | HLP',
    //         'css' => 'preview-client-style',
    //     ];
    //     return view('auth/register', $data);
    // }

    public function tampilGrafikKonsul()
    {
        $tahun = $this->request->getPost('tahun');

        $db = \Config\Database::connect();

        $query = $db->query("SELECT date_format(hari_tanggal, '%Y') AS Tahun,date_format(hari_tanggal, '%M') AS Bulan, COUNT(id_konsul) 
        AS Jumlah_Konsul FROM konsultasi WHERE DATE_FORMAT(hari_tanggal, '%Y') = '$tahun' 
        group by date_format(hari_tanggal, '%m-%Y')")->getResult();


        $data = [
            'grafik' => $query
        ];

        $json = [
            'data' => view('pages/grafikkonsul', $data)
        ];

        echo json_encode($json);
    }
}
