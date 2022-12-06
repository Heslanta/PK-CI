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
    // public function riwayatkonsul()
    // {
    //     // $keyword = $this->request->getVar('keyword');
    //     // if ($keyword) {
    //     //     $user = $this->usersModel->search($keyword);
    //     // } else {
    //     //     $user = $this->usersModel;
    //     // }
    //     // // $users = $this->usersModel->findAll();
    //     // $currentPage = $this->request->getVar('page_user') ? $this->request->getVar('page_user') :
    //     //     1;
    //     // // jumlah data per halaman
    //     // $jmldata = 10;
    //     $jadwal = $this->jadwalModel->viewKonsul()->getResultArray();
    //     // dd($jadwal);
    //     $data = [
    //         'title' => 'Daftar Pengguna | HLP',
    //         'riwayat' => $jadwal,
    //         'css' => 'data-client-style',

    //     ];
    //     // dd($data);

    //     return view('jadwal/riwayatkonsul', $data);
    // }

    public function save()
    {
        $model = new JadwalModel();

        $this->jadwalModel->save([
            'nama'        => $this->request->getPost('nama'),
            'tujuan_jdw'  => $this->request->getPost('tujuan_jdw'),
            'tanggal'     => $this->request->getPost('tanggal'),
            'status'      => $this->request->getPost('status'),
        ]);
        // $data = array(
        // 'nama'        => $this->request->getPost('nama'),
        // 'tujuan_jdw'  => $this->request->getPost('tujuan_jdw'),
        // 'tanggal'     => $this->request->getPost('tanggal'),
        // 'status'      => $this->request->getPost('status'),
        // );
        // dd($data);
        // $model->saveJadwal($data);
        return redirect()->to('pages/index');
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
        $data = array(
            'nama'        => $this->request->getPost('nama'),
            'tujuan_jdw'  => $this->request->getPost('tujuan_jdw'),
            'tanggal'     => $this->request->getPost('tanggal'),
            'status'      => $this->request->getPost('status'),
        );
        $model->updateJadwal($data, $id);
        return redirect()->to('pages/index');
    }



    public function delete()
    {
        $model = new JadwalModel();
        $id = $this->request->getPost('id_jadwal');
        $model->deleteJadwal($id);
        return redirect()->to('pages/index');
    }
}
