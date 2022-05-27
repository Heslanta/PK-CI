<?php

namespace App\Controllers;

use App\Controllers\BaseController;
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
                'css' => 'add-user-style'
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

    public function login()
    {
        $data = [];

        if ($this->request->getMethod() == 'post') {

            $rules = [
                'email' => 'required|min_length[6]|max_length[50]|valid_email',
                'password' => 'required|min_length[8]|max_length[255]|validateUser[email,password]',
            ];

            $errors = [
                'password' => [
                    'validateUser' => "Email or Password didn't match",
                ],
            ];

            if (!$this->validate($rules, $errors)) {

                return view('login', [
                    "validation" => $this->validator,
                ]);
            } else {
                $model = new UsersModel();

                $user = $model->where('email', $this->request->getVar('email'))
                    ->first();

                // Stroing session values
                $this->setUserSession($user);

                // Redirecting to dashboard after login
                if ($user['role'] == "admin") {

                    return redirect()->to(base_url('admin'));
                } elseif ($user['role'] == "pegawai") {

                    return redirect()->to(base_url('pegawai'));
                }
            }
        }
        return view('login');
    }

    private function setUserSession($user)
    {
        $data = [
            'id' => $user['id'],
            'name' => $user['name'],
            'phone_no' => $user['phone_no'],
            'email' => $user['email'],
            'isLoggedIn' => true,
            "level" => $user['level'],
        ];

        session()->set($data);
        return true;
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('login');
    }
}
