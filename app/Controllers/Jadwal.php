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

    public function index()
    {
        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $user = $this->usersModel->search($keyword);
        } else {
            $user = $this->usersModel;
        }
        // $users = $this->usersModel->findAll();
        $currentPage = $this->request->getVar('page_user') ? $this->request->getVar('page_user') :
            1;
        // jumlah data per halaman
        $jmldata = 10;
        $data = [
            'title' => 'Daftar Pengguna | HLP',
            'users' => $user->paginate($jmldata, 'user'),
            'pager' => $this->usersModel->pager,
            'css' => 'user',
            'currentPage' => $currentPage,
            'jmldata' => $jmldata
        ];

        return view('users/index', $data);
    }
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
    public function create()
    {
        $data =
            [
                'title' => 'Form Tambah Data',
                'validation' => \Config\Services::validation(),
                'css' => 'add-user-style'
            ];

        return view('jadwal/create', $data);
    }

    public function save()
    {

        // validasi input
        if (!$this->validate(
            [
                'tujuan_jdw' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tidak Boleh Kosong!.',

                    ]
                ],
                'tanggal' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tidak Boleh Kosong!',


                    ]
                ],

            ]
        )) {
            $validation = \Config\Services::validation();
            return redirect()->to(base_url() . '/jadwal/create')->withInput();
        }

        $status = 'Menunggu';
        $data = $this->request->getVar();
        $this->jadwalModel->save([
            'tujuan_jdw' => $this->request->getVar('tujuan_jdw'),
            'tanggal' => $this->request->getVar('tanggal'),
            'status' => $status,
            'nama' => $this->request->getVar('nama'),
            'id_user' => $this->request->getVar('id_user'),
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');
        return redirect()->to(base_url() . '/pages/beranda');
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


    public function update($id)
    {

        // cek klien
        $userlama = $this->usersModel->getUser($this->request->getVar('id'));
        // dd($klienLama);
        if ($userlama['username'] == $this->request->getVar('username')) {
            $rule_wp = 'required';
        } else {
            $rule_wp = 'required|is_unique[user.username]';
        }

        // validasi input
        if (!$this->validate(
            [
                'wajibpajak' => [
                    'rules' => $rule_wp,
                    'errors' => [
                        'required' => '{field} user harus diisi.',
                        'is_unique' => '{field} user sudah ada.'
                    ]
                ],
                'password' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} user harus diisi.'
                    ]
                ]

            ]
        )) {
            // validasi
            $validation = \Config\Services::validation();
            // redirect kembali tanpa index.php
            return redirect()->to(base_url() . '/users/edit/' .  $this->request->getVar('id'))->withInput('validation', $validation);
        }


        $this->usersModel->save([
            'id' => $id,
            'nama' => $this->request->getVar('nama'),
            'username' => $this->request->getVar('username'),
            'password' => $this->request->getVar('password'),
            'notelp' => $this->request->getVar('notelp'),

        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah');
        // redirect kembali tanpa index.php
        return redirect()->to(base_url() . '/users');
    }

    public function editprofil($id)
    {
        $data = [
            'title' => 'Edit Pengguna',
            'validation' => \Config\Services::validation(),
            'user' => $this->usersModel->getUser(($id)),
            'css' => 'change-client-data-style'
        ];

        return view('users/editprofil', $data);
    }


    public function updateprofil($id)
    {

        // cek klien
        $tes = $this->request->getVar('id');
        // dd($tes);
        $userlama = $this->usersModel->cekUser($tes);
        // dd($userlama['username']);
        if ($userlama['username'] == $this->request->getVar('username')) {
            $rule_wp = 'required';
        } else {
            $rule_wp = 'required|is_unique[user.username]';
        }

        // validasi input
        if (!$this->validate(
            [
                'username' => [
                    'rules' => $rule_wp,
                    'errors' => [
                        'required' => '{field} user harus diisi.',
                        'is_unique' => '{field} user sudah ada.'
                    ]
                ],
                'password' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} user harus diisi.'
                    ]
                ]

            ]
        )) {
            // validasi
            $validation = \Config\Services::validation();
            // dd($validation);
            // redirect kembali tanpa index.php
            return redirect()->to(base_url() . '/users/editprofil/' .  $this->request->getVar('id'))->withInput('validation', $validation);
        }

        $data = $this->request->getVar();
        // dd($data);
        $this->usersModel->save([
            'id' => $id,
            'nama' => $this->request->getVar('nama'),
            'username' => $this->request->getVar('username'),
            'password' => $this->request->getVar('password'),
            'notelp' => $this->request->getVar('notelp'),

        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah!');
        // redirect kembali tanpa index.php
        return redirect()->to(base_url() . '/pages/profil');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('login');
    }
}
