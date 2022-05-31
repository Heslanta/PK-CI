<?php

namespace App\Controllers;

use App\Models\KlienModel;
use App\Models\UsersModel;

class Klien extends BaseController
{
    protected $klienModel;
    protected $usersModel;
    public function __construct()
    {
        $this->klienModel = new  KlienModel();
        $this->usersModel = new  UsersModel();
    }

    public function index()
    {
        // $klien = $this->klienModel->findAll();
        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $klien = $this->klienModel->search($keyword);
        } else {
            $klien = $this->klienModel;
        }

        $data = [
            'title' => 'Klien | HLP',
            'klien' => $klien->paginate(12, 'klien'),
            'pager' => $this->klienModel->pager,
            'css' => 'data-client-style',
            'jumlah' => $this->klienModel->getJumlah()
        ];


        // $klienModel = new  KlienModel();


        return view('klien/index', $data);
    }

    public function detail($id)
    {
        // $klien = $this->klienModel->getKlien($id);
        // dd($klien);
        // $id_k = $this->klienModel->getKlien($id);

        $data_konsul =  $this->klienModel->getKonsul($id)->getResult();
        $data_akun = $this->usersModel->getUser($id)->getResultArray();
        // dd($data_akun);
        $data = [
            'title' => 'Detail Klien',
            'klien' => $this->klienModel->getKlien($id),
            'css' => 'preview-client-style',
            'user' => $data_akun,
            'konsultasi' => $data_konsul
        ];
        //jika klien tidak ada di tabel
        if (empty($data['klien'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Nama Klien ' . $id . ' tidak ditemukan.');
        }


        return view('klien/detail', $data);
    }
    public function create()
    {
        $data = [
            'title' => 'Tambah Klien',
            'validation' => \Config\Services::validation(),
            'css' => 'add-client-style'
        ];

        return view('klien/create', $data);
    }

    public function save()
    {

        // validasi input
        if (!$this->validate(
            [
                'wajibpajak' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama klien harus diisi!'
                    ]
                ],
                'npwp' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'NPWP klien harus diisi!'
                    ]
                ],
                // $notelp => [
                //     'rules' => 'numeric',
                //     'errors' => [
                //         'numeric' => 'Nomor HP klien harus berupa angka.'
                //     ]
                // ],
                'filedata' => [
                    'rules' => 'max_size[filedata,3072]|is_image[filedata]|mime_in[filedata,image/jpg,image/jpeg,image/png]',
                    'errors' => [
                        'max_size' => 'Ukuran gambar terlalu besar',
                        'is_image' => 'Yang anda pilih bukan gambar, pilihlah gambar berupa jpg/jpeg/png',
                        'mime_in' => 'Yang anda pilih bukan gambar, pilihlah gambar berupa jpg/jpeg/png'
                    ]
                ]

            ]
        )) {
            // validasi
            $validation = \Config\Services::validation();
            // redirect kembali tanpa index.php
            return redirect()->to(base_url() . '/klien/create')->withInput();
        }
        // masukan ke database
        // $id = url_title($this->request->getVar('wajibpajak'), '-', true);
        $notelp = $this->request->getVar('notelp');
        if (empty($notelp)) {
            $notelp = '-';
        } else {
            $notelp = url_title($this->request->getVar('notelp'), '-', true);
        }
        $catatan = $this->request->getVar('catatan');
        if (empty($catatan)) {
            $catatan = "Tidak ada catatan mengenai klien ini!";
        }
        // dd($catatan);
        // $this->klienModel->save([
        //     'wajibpajak' => $this->request->getVar('wajibpajak'),
        //     'npwp' => $this->request->getVar('npwp'),
        //     'notelp' => $notelp,
        //     'catatan' => $catatan
        // ]);

        $data = [
            'wajibpajak' => $this->request->getVar('wajibpajak'),
            'npwp' => $this->request->getVar('npwp'),
            'efin' => $this->request->getVar('efin'),
            'notelp' => $notelp,
            'catatan' => $catatan
        ];
        // dd($data);
        $this->klienModel->insert($data);
        $level = "klien";
        $data_user = [
            'nama' => $this->request->getVar('wajibpajak'),
            'username' => $this->request->getVar('npwp'),
            'password' => $this->request->getVar('efin'),
            'level' => $level,
            'notelp' => $notelp
        ];
        $this->usersModel->insert($data_user);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');

        // redirect kembali tanpa index.php
        return redirect()->to(base_url() . '/klien');
    }

    public function delete($id)
    {
        $this->klienModel->delete(($id));
        session()->setFlashdata('pesan-hapus', 'Data berhasil dihapus');
        return redirect()->to(base_url() . '/klien');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Klien',
            'validation' => \Config\Services::validation(),
            'klien' => $this->klienModel->getKlien(($id)),
            'css' => 'change-client-data-style'
        ];

        return view('klien/edit', $data);
    }


    public function update($id)
    {

        // cek klien
        $klienLama = $this->klienModel->getKlien($this->request->getVar('id'));
        // dd($klienLama);
        if ($klienLama['wajibpajak'] == $this->request->getVar('wajibpajak')) {
            $rule_wp = 'required';
        } else {
            $rule_wp = 'required|is_unique[klien.wajibpajak]';
        }

        // validasi input
        if (!$this->validate(
            [
                'wajibpajak' => [
                    'rules' => $rule_wp,
                    'errors' => [
                        'required' => '{field} klien harus diisi.',
                        'is_unique' => '{field} klien sudah ada.'
                    ]
                ],
                'npwp' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} klien harus diisi.'
                    ]
                ]

            ]
        )) {
            // validasi
            $validation = \Config\Services::validation();
            // redirect kembali tanpa index.php
            return redirect()->to(base_url() . '/klien/edit/' .  $this->request->getVar('id'))->withInput('validation', $validation);
        }
        $notelp = $this->request->getVar('notelp');
        if (empty($notelp)) {
            $notelp = '-';
        }
        // $id = url_title($this->request->getVar('wajibpajak'), '-', true);
        // dd($this->request->getVar());
        $this->klienModel->save([
            'id' => $id,
            'wajibpajak' => $this->request->getVar('wajibpajak'),
            'npwp' => $this->request->getVar('npwp'),
            'efin' => $this->request->getVar('efin'),
            'notelp' => $notelp,
            'catatan' => $this->request->getVar('catatan')
            // 'slug' => $id
        ]);
        // $data = [
        //     'wajibpajak' => $this->request->getVar('wajibpajak'),
        //     'npwp' => $this->request->getVar('npwp'),
        //     'notelp' => $notelp,
        //     'catatan' => $this->request->getVar('catatan')
        // ];
        // $this->klienModel->replace($data);
        session()->setFlashdata('pesan', 'Data berhasil diubah');
        // redirect kembali tanpa index.php
        return redirect()->to(base_url() . '/klien');
    }
}
