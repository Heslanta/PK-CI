<?php

namespace App\Controllers;

use App\Models\KlienModel;

class Klien extends BaseController
{
    protected $klienModel;
    public function __construct()
    {
        $this->klienModel = new  KlienModel();
    }

    public function index()
    {
        // $klien = $this->klienModel->findAll();
        $data = [
            'title' => 'Klien | HLP',
            'klien' => $this->klienModel->getKlien(),
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
        $data = [
            'title' => 'Detail Klien',
            'klien' => $this->klienModel->getKlien($id),
            'css' => 'preview-client-style',
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
                        'required' => '{field} klien harus diisi.'
                    ]
                ],
                'npwp' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} klien harus diisi.'
                    ]
                ],
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
        }


        $this->klienModel->save([
            'wajibpajak' => $this->request->getVar('wajibpajak'),
            'npwp' => $this->request->getVar('npwp'),
            'notelp' => $notelp,
            'catatan' => $this->request->getVar('catatan')
        ]);

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

        // cek judul
        $klienLama = $this->klienModel->getKlien($this->request->getVar('id'));
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
        $this->klienModel->save([
            'id' => $id,
            'wajibpajak' => $this->request->getVar('wajibpajak'),
            'npwp' => $this->request->getVar('npwp'),
            'notelp' => $notelp,
            'catatan' => $this->request->getVar('catatan')
            // 'slug' => $id
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
        // redirect kembali tanpa index.php
        return redirect()->to(base_url() . '/klien');
    }
}
