<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\JadwalModel;
use App\Models\PagesModel;
use App\Models\ProsesModel;
use App\Models\UsersModel;
use Myth\Auth\Models\UserModel;

class Users extends BaseController
{
    protected $usersModel;
    public function __construct()
    {
        $this->usersModel = new UsersModel();
        $this->pagesModel = new PagesModel();
    }
    public function ambildata()
    {
        if ($this->request->isAJAX()) {
            $user = new UsersModel();
            $data = [
                'tampildata' => $user->findAll(),
                'css' => 'user',
            ];
            $msg = [
                'data' => view('users/datauser', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('gg gaming');
        }
    }
    public function formtambah()
    {
        if ($this->request->isAJAX()) {
            $msg = [
                'data' => view('users/modaltambah')
            ];
            echo json_encode($msg);
        } else {
            exit('gg gaming');
        }
    }
    public function formedit()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $row = $this->usersModel->find($id);
            $data = [
                'id' => $row['id'],
                'nama' => $row['nama'],
                'username' => $row['username'],
                'password' => $row['password'],
                'notelp' => $row['notelp'],
                'level' => $row['level'],
            ];
            $msg = [
                'sukses' => view('users/modaledit', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('gg gaming');
        }
    }

    public function simpandata()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate(
                [
                    'username' => [
                        'rules' => 'required|is_unique[user.username]|min_length[8]|max_length[20]',
                        'errors' => [
                            'required' => 'Username pengguna harus diisi.',
                            'is_unique' => 'Username pengguna sudah ada, silahkan pilih yang lain!',
                            'min_length' => 'Username minimal mempunyai 8 karakter',
                            'max_length' => 'Username maksimal mempunyai 20 karakter',
                        ]
                    ],
                    'nama' => [
                        'rules' => 'required|max_length[40]',
                        'errors' => [
                            'required' => 'Nama pengguna harus diisi.',
                            'max_length' => 'Nama maksimal mempunyai 40 karakter',
                        ]
                    ],
                    'notelp' => [
                        'rules' => 'permit_empty|numeric_dash|min_length[10]|max_length[16]',
                        'errors' => [
                            'numeric_dash' => 'No Hp harus berupa angka!.',
                            'min_length' => 'No Hp  minimal mempunyai 10 angka',
                            'max_length' => 'No Hp  maksimal mempunyai 16 angka',
                        ]
                    ],
                    'password' => [
                        'rules' => 'required|min_length[8]|max_length[15]',
                        'errors' => [
                            'required' => 'Password pengguna harus diisi.',
                            'min_length' => 'Password minimal mempunyai 8 karakter',
                            'max_length' => 'Password maksimal mempunyai 15 karakter',
                        ]
                    ]
                ]
            );
            if (!$valid) {
                $msg = [
                    'error' => [
                        'username' => $validation->getError('username'),
                        'password' => $validation->getError('password'),
                        'nama' => $validation->getError('nama'),
                        'notelp' => $validation->getError('notelp'),
                    ]
                ];
            } else {
                $this->usersModel->save([
                    'nama' => $this->request->getPost('nama'),
                    'username' => $this->request->getPost('username'),
                    'password' => $this->request->getPost('password'),
                    'level' => $this->request->getPost('level'),
                    'notelp' => $this->request->getPost('notelp')
                ]);
                $msg = [
                    'sukses' => 'Data akun berhasil tersimpan'
                ];
            }
            echo json_encode($msg);
        }
    }
    public function updatedata()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $usernamelama = $this->usersModel->getAkun($this->request->getVar('id'));
            // dd($klienLama);
            if ($usernamelama['username'] == $this->request->getVar('username')) {
                $rule_wp = 'required|min_length[8]|max_length[20]';
            } else {
                $rule_wp = 'required|is_unique[user.username]|min_length[8]|max_length[20]';
            }
            $valid = $this->validate(
                [
                    'username' => [
                        'rules' => $rule_wp,
                        'errors' => [
                            'required' => 'Username pengguna harus diisi.',
                            'is_unique' => 'Username pengguna sudah ada, silahkan pilih yang lain!',
                            'min_length' => 'Username minimal mempunyai 8 karakter',
                            'max_length' => 'Username maksimal mempunyai 20 karakter',
                        ]
                    ],
                    'nama' => [
                        'rules' => 'required|max_length[40]',
                        'errors' => [
                            'required' => 'Nama pengguna harus diisi.',
                            'max_length' => 'Nama maksimal mempunyai 40 karakter',
                        ]
                    ],
                    'notelp' => [
                        'rules' => 'permit_empty|numeric_dash|min_length[10]|max_length[16]',
                        'errors' => [
                            'numeric_dash' => 'No Hp harus berupa angka!.',
                            'min_length' => 'No Hp  minimal mempunyai 10 angka',
                            'max_length' => 'No Hp  maksimal mempunyai 16 angka',
                        ]
                    ],
                    'password' => [
                        'rules' => 'required|min_length[8]|max_length[15]',
                        'errors' => [
                            'required' => 'Password pengguna harus diisi.',
                            'min_length' => 'Password minimal mempunyai 8 karakter',
                            'max_length' => 'Password maksimal mempunyai 15 karakter',
                        ]
                    ]
                ]
            );
            if (!$valid) {
                $msg = [
                    'error' => [
                        'username' => $validation->getError('username'),
                        'password' => $validation->getError('password'),
                        'nama' => $validation->getError('nama'),
                        'notelp' => $validation->getError('notelp'),
                    ]
                ];
            } else {

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
                $msg = [
                    'sukses' => 'Data akun berhasil diubah'
                ];
            }
            echo json_encode($msg);
        }
    }
    public function delete()
    {
        if ($this->request->isAJAX()) {
            $model = new UsersModel();
            $id = $this->request->getPost('id');
            $model->deleteAkun($id);
            $msg = [
                'sukses' => 'Data akun berhasil dihapus'
            ];
            echo json_encode($msg);
        }
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

        // validasi input yang masuk
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
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} pengguna harus diisi.',


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



    // Akhir bagian users

    // Awal Bagian profil
    public function editprofil($id)
    {
        // cek klien

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
        $validation = \Config\Services::validation();
        $usernamelama = $this->usersModel->getAkun($this->request->getVar('id'));
        // dd($klienLama);
        if ($usernamelama['username'] == $this->request->getVar('username')) {
            $rule_wp = 'required|min_length[8]|max_length[20]';
        } else {
            $rule_wp = 'required|is_unique[user.username]|min_length[8]|max_length[20]';
        }

        // validasi input
        if (!$this->validate(
            [
                'username' => [
                    'rules' => $rule_wp,
                    'errors' => [
                        'required' => 'Username pengguna harus diisi.',
                        'is_unique' => 'Username pengguna sudah ada, silahkan pilih yang lain!',
                        'min_length' => 'Username minimal mempunyai 8 karakter',
                        'max_length' => 'Username maksimal mempunyai 20 karakter',
                    ]
                ],

                'notelp' => [
                    'rules' => 'permit_empty|numeric_dash|min_length[10]|max_length[16]',
                    'errors' => [
                        'numeric_dash' => 'No Hp harus berupa angka!.',
                        'min_length' => 'No Hp  minimal mempunyai 10 angka',
                        'max_length' => 'No Hp  maksimal mempunyai 16 angka',
                    ]
                ],
                'password' => [
                    'rules' => 'required|min_length[8]|max_length[15]',
                    'errors' => [
                        'required' => 'Password pengguna harus diisi.',
                        'min_length' => 'Password minimal mempunyai 8 karakter',
                        'max_length' => 'Password maksimal mempunyai 15 karakter',
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
