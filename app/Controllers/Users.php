<?php

namespace App\Controllers;


use App\Models\UsersModel;

class Users extends BaseController
{
    protected $usersModel;
    public function __construct()
    {
        $this->usersModel = new UsersModel();
    }

    public function index()
    {
        $users = $this->usersModel->findAll();

        $data = [
            'title' => 'Daftar Pengguna | HLP',
            'users' => $users,
            'css' => 'preview-client-style'
        ];

        return view('users/index', $data);
    }
    public function create()
    {
        $data =
            [
                'title' => 'Form Tambah Data',
                'validation' => \Config\Services::validation(),
                'css' => 'preview-client-style'
            ];

        return view('users/create', $data);
    }

    public function save()
    {

        // validasi input
        if (!$this->validate(
            [
                'username' => [
                    'rules' => 'required|is_unique[user.username]',
                    'errors' => [
                        'required' => '{field} pengguna harus diisi.',
                        'is_unique' => '{field} pengguna sudah ada'

                    ]
                ],
                'nama' => [
                    'rules' => 'required|is_unique[user.username]',
                    'errors' => [
                        'required' => '{field} pengguna harus diisi.',
                        'is_unique' => '{field} pengguna sudah ada'

                    ]
                ],
                'password' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} pengguna harus diisi.',

                    ]
                ]
            ]
        )) {
            $validation = \Config\Services::validation();
            return redirect()->to(base_url() . '/users/create')->withInput();
        }

        $level = "pegawai";
        $this->usersModel->save([
            'nama' => $this->request->getVar('nama'),
            'username' => $this->request->getVar('username'),
            'password' => $this->request->getVar('password'),
            'level' => $level,
            'notelp' => $this->request->getVar('notelp')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');
        return redirect()->to(base_url() . '/users');
    }
}
