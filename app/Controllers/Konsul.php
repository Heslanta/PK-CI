<?php

namespace App\Controllers;

use App\Models\KonsulModel;

class Konsul extends BaseController
{
    protected $konsulModel;
    public function __construct()
    {
        $this->konsulModel = new  KonsulModel();
    }

    public function detail($id_konsul)
    {


        $data = [
            'title' => 'Detail Konsultasi',
            'konsul' => $this->konsulModel->viewKonsul($id_konsul),
            'css' => 'preview-consul-style'

        ];
        //jika klien tidak ada di tabel
        if (empty($data['konsul'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data tidak ditemukan');
        }


        return view('konsul/detail', $data);
    }
    public function create()
    {
        $data = [
            'title' => 'Tambah Konsultasi',
            'validation' => \Config\Services::validation(),
            'css' => 'add-consul-style'
        ];

        return view('konsul/create', $data);
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
            'catatan' => $this->request->getVar('catatan'),
            'slug' => null
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
