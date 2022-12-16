<?php

namespace App\Controllers;

use App\Models\UsersModel;

class Auth extends BaseController
{
    public function __construct()
    {
        //membuat user model untuk konek ke database 
        $this->usersModel = new UsersModel();

        //meload validation
        $this->validation = \Config\Services::validation();

        //meload session
        $this->session = \Config\Services::session();
    }

    public function login()
    {
        //menampilkan halaman login
        return view('/');
    }

    // public function register()
    // {
    //     //menampilkan halaman register
    //     return view('users/create');
    // }

    // public function valid_register()
    // {
    //     //tangkap data dari form 
    //     $data = $this->request->getPost();

    //     //jalankan validasi
    //     $this->validation->run($data, 'register');

    //     //cek errornya
    //     $errors = $this->validation->getErrors();

    //     //jika ada error kembalikan ke halaman register
    //     if ($errors) {
    //         session()->setFlashdata('error', $errors);
    //         return redirect()->to('/users/create');
    //     }

    //     //jika tdk ada error 

    //     // //buat salt
    //     // $salt = uniqid('', true);

    //     //hash password 

    //     $level = 'pegawai';
    //     //masukan data ke database
    //     $this->userModel->save([
    //         'username' => $data['username'],
    //         'password' => $data['username'],
    //         'nama' => $data['nama'],
    //         'notelp' => $data['notelp'],
    //         'role' => $level
    //     ]);

    //     //arahkan ke halaman login
    //     session()->setFlashdata('login', 'Anda berhasil mendaftar, silahkan login');
    //     return redirect()->to('/auth/login');
    // }

    public function valid_login()
    {
        //ambil data dari form
        $data = $this->request->getPost();
        // dd($data);
        //ambil data user di database yang usernamenya sama 
        $user = $this->usersModel->where('username', $data['username'])->first();
        // dd($user);

        //cek apakah username ditemukan
        if ($user) {
            //cek password
            //jika salah arahkan lagi ke halaman login
            if ($user['password'] != $data['password']) {
                session()->setFlashdata('password', 'Password Salah, silahkan masukkan lagi');
                return redirect()->to('/');
            } else {
                //jika benar, arahkan user masuk ke aplikasi 
                $sessLogin = [
                    'isLogin' => true,
                    'id' => $user['id'],
                    'nama' => $user['nama'],
                    'username' => $user['username'],
                    'password' => $user['password'],
                    'notelp' => $user['notelp'],
                    'level' => $user['level'],
                ];
                $this->session->set($sessLogin);
                // dd($sessLogin);
                if ($user['level'] == 'klien') {
                    return redirect()->to('/pages/klienberanda');
                } else {
                    return redirect()->to('/pages');
                }
            }
        } else {
            //jika username tidak ditemukan, balikkan ke halaman login
            session()->setFlashdata('username', 'Username tidak ditemukan, silahkan masukkan lagi');
            return redirect()->to('/');
        }
    }

    public function logout()
    {
        //hancurkan session 
        //balikan ke halaman login
        $this->session->destroy();
        return redirect()->to('/');
    }
}
