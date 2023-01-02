<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\JadwalModel;

class Jadwal extends BaseController
{
    protected $jadwalModel;
    public function __construct()
    {
        $this->jadwalModel = new JadwalModel();
    }



    // public function index()
    // {
    //     $jadwal = $this->jadwalModel;
    //     // $currentPage = $this->request->getVar('page_user') ? $this->request->getVar('page_user') :
    //     1;
    //     // jumlah data per halaman
    //     $jmldata = 10;


    //     $data = [
    //         'title' => 'Daftar Pengguna | HLP',
    //         // 'jadwal' => $jadwal->paginate($jmldata, 'user'),
    //         // 'pager' => $this->usersModel->pager,
    //         'css' => 'user',
    //         // 'currentPage' => $currentPage,
    //         // 'jmldata' => $jmldata
    //     ];

    //     return view('jadwal/index', $data);
    // }
    public function riwayatkonsul()
    {
        // $keyword = $this->request->getVar('keyword');
        // if ($keyword) {
        //     $user = $this->usersModel->search($keyword);
        // } else {
        //     $user = $this->usersModel;
        // }
        // // $users = $this->usersModel->findAll();
        // $currentPage = $this->request->getVar('page_user') ? $this->request->getVar('page_user') :
        //     1;
        // // jumlah data per halaman
        // $jmldata = 10;
        $jadwal = $this->jadwalModel->viewKonsul()->getResultArray();
        // dd($jadwal);
        $data = [
            'title' => 'Daftar Pengguna | HLP',
            'riwayat' => $jadwal,
            'css' => 'data-client-style',

        ];
        // dd($data);

        return view('jadwal/riwayatkonsul', $data);
    }

    public function save()
    {
        if (!$this->validate(
            [
                'tanggal' => [
                    'rules' => 'tanggal_nanti',
                    'errors' => [
                        'tanggal_nanti' => 'Tidak bisa memasukkan tanggal sebelumnya',
                    ]
                ],

            ]
        )) {
            // validasi
            $validation = \Config\Services::validation();
            // redirect kembali tanpa index.php
            session()->setFlashdata('errors', 'Tidak bisa memasukkan tanggal sebelumnya');

            return redirect()->to(base_url() . '/pages')->withInput();
        }
        $model = new JadwalModel();
        // dd($this->request->getPost('search'));
        $cektujuan = $this->request->getPost('tujuan_jdw');
        if ($cektujuan == 1) {
            $tujuan = $this->request->getPost('tujuan_dll');
        } else {
            $tujuan = $this->request->getPost('tujuan_jdw');
        }
        $this->jadwalModel->save([
            'nama'        => $this->request->getPost('nama'),
            'tujuan_jdw'  => $tujuan,
            'tanggal'     => $this->request->getPost('tanggal'),
            'jam'     => $this->request->getPost('jam'),
            'status'      => $this->request->getPost('status'),
        ]);
        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');

        return redirect()->to('pages');
        // $data = array(
        //     'nama'        => $this->request->getPost('nama'),
        //     'tujuan_jdw'  => $tujuan,
        //     'tanggal'     => $this->request->getPost('tanggal'),
        //     'jam'     => $this->request->getPost('jam'),
        //     'status'      => $this->request->getPost('status'),
        // );
        // // dd($data);
        // $model->saveJadwal($data);
        // return redirect()->to('pages');
    }

    // Jadwal permintaan konsultasi dari klien
    public function saveklien()
    {
        if (!$this->validate(
            [
                'tanggal' => [
                    'rules' => 'required|tanggal_nanti',
                    'errors' => [
                        'tanggal_nanti' => 'Tidak bisa memasukkan tanggal sebelumnya',
                        'required' => 'Tidak boleh kosong'
                    ]
                ],
                'tujuan_jdw' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tidak boleh kosong'
                    ]
                ]
            ]
        )) {
            // validasi
            $validation = \Config\Services::validation();
            // redirect kembali tanpa index.php
            session()->setFlashdata('errors', 'Tidak bisa memasukkan tanggal sebelumnya');

            return redirect()->to(base_url() . '/pages/klienberanda')->withInput();
        }
        $model = new JadwalModel();
        $proses = 'menunggu';
        $test = $this->jadwalModel->save([
            'nama'        => $this->request->getPost('nama'),
            'tujuan_jdw'  => $this->request->getPost('tujuan_jdw'),
            'tanggal'     => $this->request->getPost('tanggal'),
            'status'      => $this->request->getPost('status'),
            'id_user'      => $this->request->getPost('id'),
            'proses'      => $proses,
        ]);

        // dd($test);
        // $data = array(
        //     'nama'        => $this->request->getPost('nama'),
        //     'id_user'        => $this->request->getPost('id'),
        //     'tujuan_jdw'  => $this->request->getPost('tujuan_jdw'),
        //     'tanggal'     => $this->request->getPost('tanggal'),
        //     'status'      => $this->request->getPost('status'),
        // );
        // dd($data);
        // $model->saveJadwal($data);
        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');

        return redirect()->to('pages/klienberanda');
    }
    // public function edit($id)
    // {
    //     $data = [
    //         'title' => 'Edit Pengguna',
    //         'validation' => \Config\Services::validation(),
    //         'user' => $this->usersModel->getUser(($id)),
    //         'css' => 'change-client-data-style'
    //     ];

    //     return view('users/edit', $data);
    // }
    public function update()
    {
        $model = new JadwalModel();
        $id = $this->request->getPost('id_jadwal');
        $cektujuan = $this->request->getPost('tujuan_jdw');
        if ($cektujuan == 1) {
            $tujuan = $this->request->getPost('tujuan_dll');
        } else {
            $tujuan = $this->request->getPost('tujuan_jdw');
        }
        $data = array(
            'nama'        => $this->request->getPost('nama'),
            'tujuan_jdw'  => $tujuan,
            'tanggal'     => $this->request->getPost('tanggal'),
            'status'      => $this->request->getPost('status'),
            'jam'      => $this->request->getPost('jam'),
        );
        $model->updateJadwal($data, $id);
        session()->setFlashdata('pesan', 'Data berhasil diubah');

        return redirect()->to('pages');
    }
    public function upjadwalklien()
    {
        $model = new JadwalModel();
        $id = $this->request->getPost('id_jadwal');
        $data = array(
            'tujuan_jdw'  => $this->request->getPost('tujuan_jdw'),
            'tanggal'     => $this->request->getPost('tanggal'),
            'status'      => $this->request->getPost('status'),
        );
        $model->updateJadwal($data, $id);
        return redirect()->to('pages/klienberanda');
    }



    public function delete()
    {
        $model = new JadwalModel();
        $id = $this->request->getPost('id_jadwal');
        $model->deleteJadwal($id);
        session()->setFlashdata('pesan-hapus', 'Data berhasil dihapus!');

        return redirect()->to('pages');
    }
}
