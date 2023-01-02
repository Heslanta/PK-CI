<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TujuanModel;


class Tujuan extends BaseController
{
    protected $tujuanModel;
    public function __construct()
    {
        $this->tujuanModel = new TujuanModel();
    }

    public function index()
    {

        $data = [
            'title' => 'Tujuan Konsultasi | HLP',
            'tujuan' => $this->tujuanModel->findAll(),
            'css' => 'user',
        ];


        return view('tujuan/tujuan_konsul', $data);
    }
    public function create()
    {
        $data =
            [
                'title' => 'Form Tambah Data',
                'validation' => \Config\Services::validation(),
                'css' => 'add-user-style'
            ];

        return view('tujuan/tujuan_konsul', $data);
    }

    public function save()
    {

        if (!$this->validate(
            [
                'tujuan_konsul' => [
                    'rules' => 'is_unique[tujuan_konsul.tujuan_konsul]',
                    'errors' => [
                        'is_unique' => 'Tidak boleh kosong'
                    ]
                ],

            ]

        )) {
            // validasi
            $validation = \Config\Services::validation();
            // redirect kembali tanpa index.php
            session()->setFlashdata('errors', 'Data tidak boleh sama dengan sebelumnya!.');

            return redirect()->to(base_url() . '/tujuan-konsul')->withInput();
        }
        $test = $this->tujuanModel->save([
            'tujuan_konsul' => $this->request->getPost('tujuan_konsul'),

        ]);
        // dd($test);
        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');
        return redirect()->to(base_url() . '/tujuan-konsul');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Pengguna',
            'validation' => \Config\Services::validation(),
            'user' => $this->usersModel->getUser(($id)),
            'css' => 'change-client-data-style'
        ];

        return view('users/edit', $data);
    }


    public function update()
    {

        // cek klien
        // $userlama = $this->usersModel->getUser($this->request->getVar('id'));
        // dd($userlama);
        // if ($userlama['username'] == $this->request->getVar('username')) {
        //     $rule_wp = 'required';
        // } else {
        //     $rule_wp = 'required|is_unique[user.username]';
        // }

        // validasi input
        if (!$this->validate(
            [
                'tujuan_konsul' => [
                    'rules' => 'is_unique[tujuan_konsul.tujuan_konsul]',
                    'errors' => [
                        'is_unique' => 'Tidak boleh kosong'
                    ]
                ],

            ]

        )) {
            // validasi
            $validation = \Config\Services::validation();
            // redirect kembali tanpa index.php
            session()->setFlashdata('errors', 'Data tidak boleh sama dengan sebelumnya!.');

            return redirect()->to(base_url() . '/tujuan-konsul')->withInput();
        }

        $model = new TujuanModel();
        $id = $this->request->getPost('id');
        // dd($id);
        $dataupdate = array(
            'tujuan_konsul'        => $this->request->getPost('tujuan_konsul'),

        );
        // dd($dataupdate);
        $model->updateTujuan($dataupdate, $id);
        return redirect()->to('/tujuan-konsul');


        // $this->usersModel->save([
        //     'id' => $id,
        //     'nama' => $this->request->getVar('nama'),
        //     'username' => $this->request->getVar('username'),
        //     'password' => $this->request->getVar('password'),
        //     'notelp' => $this->request->getVar('notelp'),

        // ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah');
        // redirect kembali tanpa index.php
        return redirect()->to(base_url() . '/users');
    }

    public function delete()
    {
        $model = new TujuanModel();
        $id = $this->request->getPost('id');
        $model->deleteTujuan($id);
        return redirect()->to('tujuan-konsul');
        session()->setFlashdata('pesan-hapus', 'Data berhasil diubah');
        // redirect kembali tanpa index.php
        return redirect()->to(base_url() . '/tujuan-konsul');
    }
}
