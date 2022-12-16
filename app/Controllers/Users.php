<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\JadwalModel;
use App\Models\PagesModel;
use App\Models\ProsesModel;
use App\Models\UsersModel;

class Users extends BaseController
{
    protected $usersModel;
    public function __construct()
    {
        $this->usersModel = new UsersModel();
        $this->pagesModel = new PagesModel();
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
    public function create()
    {
        $data =
            [
                'title' => 'Form Tambah Data',
                'validation' => \Config\Services::validation(),
                'css' => 'add-user-style'
            ];

        return view('users/create', $data);
    }

    public function save()
    {

        // // validasi input
        // if (!$this->validate(
        //     [
        //         'username' => [
        //             'rules' => 'required|is_unique[user.username]',
        //             'errors' => [
        //                 'required' => '{field} pengguna harus diisi.',
        //                 'is_unique' => '{field} pengguna sudah ada'

        //             ]
        //         ],
        //         'nama' => [
        //             'rules' => 'required',
        //             'errors' => [
        //                 'required' => '{field} pengguna harus diisi.',


        //             ]
        //         ],
        //         'password' => [
        //             'rules' => 'required',
        //             'errors' => [
        //                 'required' => '{field} pengguna harus diisi.',

        //             ]
        //         ]
        //     ]
        // )) {
        //     $validation = \Config\Services::validation();
        //     return redirect()->to(base_url() . '/users/create')->withInput();
        // }
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $nama = $this->request->getPost('nama');
        $level = $this->request->getPost('level');
        $notelp = $this->request->getPost('notelp');
        // dd($username);
        // dd($username, $password, $nama, $level, $notelp);
        // dd($nama);
        // dd($level);
        // dd($notelp);
        if ((empty($username))) {
            // randome username
            $usernamebaru = $username->getRandomName();
        }
        if ((empty($password))) {
            // random password
            $passwordbaru = $password->getRandomName();
        }
        if ((empty($username))) {
            // randome username
            $usernamebaru = $username->getRandomName();
        }
        // $level = "pegawai";
        $this->usersModel->save([
            'nama' => $this->request->getPost('nama'),
            'username' => $username,
            'password' => $password,
            'level' => $this->request->getPost('level'),
            'notelp' => $this->request->getPost('notelp')
        ]);
        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');
        return redirect()->to(base_url() . '/users');
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
        // if (!$this->validate(
        //     [
        //         'wajibpajak' => [
        //             'rules' => $rule_wp,
        //             'errors' => [
        //                 'required' => '{field} user harus diisi.',
        //                 'is_unique' => '{field} user sudah ada.'
        //             ]
        //         ],
        //         'password' => [
        //             'rules' => 'required',
        //             'errors' => [
        //                 'required' => '{field} user harus diisi.'
        //             ]
        //         ]

        //     ]
        // )) {
        //     // validasi
        //     $validation = \Config\Services::validation();
        //     // redirect kembali tanpa index.php
        //     return redirect()->to(base_url() . '/users/edit/' .  $this->request->getVar('id'))->withInput('validation', $validation);
        // }

        $model = new UsersModel();
        $modeljadwal = new ProsesModel();
        $id = $this->request->getPost('id');
        $data = array(
            'nama'        => $this->request->getPost('nama'),
            'username'  => $this->request->getPost('username'),
            'password'     => $this->request->getPost('password'),
            'notelp'     => $this->request->getPost('notelp'),
            'level'      => $this->request->getPost('level'),
        );
        $dataupdate = array(
            'nama'        => $this->request->getPost('nama'),

        );
        $model->updateUsers($data, $id);
        $modeljadwal->updatenamaJad($dataupdate, $id);
        return redirect()->to('/users');


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
        $model = new UsersModel();
        $id = $this->request->getPost('id');
        $model->deleteAkun($id);
        return redirect()->to('users');
    }

    // Akhir bagian users

    // Awal Bagian profil
    public function editprofil($id)
    {
        $profil = $this->pagesModel->viewProfil();
        $data = [
            'title' => 'Edit Pengguna',
            'validation' => \Config\Services::validation(),
            'user' => $this->usersModel->getUser(($id)),
            'css' => 'change-client-data-style',
            'profil' => $profil->getRowArray()
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
