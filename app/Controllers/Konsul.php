<?php

namespace App\Controllers;

use App\Models\KonsulModel;
use App\Models\KlienModel;

class Konsul extends BaseController
{
    protected $konsulModel;
    protected $klienModel;
    public function __construct()
    {
        $this->konsulModel = new  KonsulModel();
        $this->klienModel = new  KlienModel();
    }

    public function detail($id_konsul)
    {
        $data = [
            'title' => 'Detail Konsultasi',
            'konsul' => $this->konsulModel->viewKonsul($id_konsul),
            'css' => 'preview-consul-style'
        ];
        //jika konsultasi tidak ada di tabel
        if (empty($data['konsul'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data tidak ditemukan');
        }
        return view('konsul/detail', $data);
    }
    public function create($id)
    {
        $data_konsul =  $this->klienModel->getKonsul($id)->getResult();
        dd($data_konsul);
        $data = [
            'title' => 'Tambah Konsultasi',
            'validation' => \Config\Services::validation(),
            'klien' => $this->klienModel->getKlien($id),
            'css' => 'add-consul-style',
            'konsultasi' => $data_konsul
        ];

        return view('konsul/create', $data);
    }
    public function save()
    {
        // validasi input
        if (!$this->validate(
            [
                'konsul_ke' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tidak boleh kosong!'
                    ]
                ]

            ]
        )) {
            // validasi
            $validation = \Config\Services::validation();
            // redirect kembali tanpa index.php
            return redirect()->to(base_url() . '/konsul/create')->withInput();
        }
        // masukan ke database
        // $id = url_title($this->request->getVar('wajibpajak'), '-', true);
        $id = $this->request->getVar('id_klien');
        $this->konsulModel->save([
            'konsul_ke' => $this->request->getVar('konsul_ke'),
            'hari_tanggal' => $this->request->getVar('hari_tanggal'),
            'tujuan' => $this->request->getVar('tujuan'),
            'hasil_konsul' => $this->request->getVar('hasil_konsul'),
            'catatan_konsul' => $this->request->getVar('catatan_konsul'),
            'id_klien' => $id
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
        // redirect kembali tanpa index.php
        return redirect()->to(base_url() . '/klien/' . $id);
    }

    public function delete($id_konsul)
    {

        $this->konsulModel->deleteKonsul(($id_konsul));

        session()->setFlashdata('pesan-hapus', 'Data berhasil dihapus');
        return redirect()->to(base_url() . '/klien');
    }

    public function edit($id_konsul)
    {

        $data_konsul =  $this->konsulModel->editKonsul($id_konsul);
        // dd($data_konsul);
        $data = [
            'title' => 'Form Ubah Data Konsultasi',
            'validation' => \Config\Services::validation(),
            // 'klien' => $this->konsulModel->editKonsul($id_konsul),
            'css' => 'add-consul-style',
            'konsultasi' => $data_konsul
        ];
        return view('konsul/edit', $data);
    }

    public function update($id_konsul)
    {
        // $data_konsul =  $this->konsulModel->editKonsul($id_konsul);
        // cek validasi
        // validasi input
        // if (!$this->validate(
        //     [
        //         'konsul_ke' => [
        //             'rules' => 'required',
        //             'errors' => [
        //                 'required' => '{field} konsultasi harus diisi.'
        //                 // 'is_unique' => '{field} klien sudah ada.'
        //             ]
        //         ]
        //         // 'npwp' => [
        //         //     'rules' => 'required',
        //         //     'errors' => [
        //         //         'required' => '{field} klien harus diisi.'
        //         //     ]
        //         // ]
        //     ]
        // )) {
        // validasi
        //     $validation = \Config\Services::validation();
        //     // redirect kembali tanpa index.php
        //     return redirect()->to(base_url() . '/konsul/edit/' .  $this->request->getVar('id_konsul'))->withInput('validation', $validation);
        // }
        // dd($this->request->getVar());
        // $tujuan = $this->request->getVar('tujuan');

        $this->konsulModel->save([
            'id_konsul' => $id_konsul,
            'konsul_ke' => $this->request->getVar('konsul_ke'),
            'hari_tanggal' => $this->request->getVar('hari_tanggal'),
            'tujuan' => $this->request->getVar('tujuan'),
            'hasil_konsul' => $this->request->getVar('hasil_konsul'),
            'catatan_konsul' => $this->request->getVar('catatan_konsul'),
        ]);
        // dd($tujuan);
        session()->setFlashdata('pesan', 'Data berhasil diubah');
        // redirect kembali tanpa index.php
        return redirect()->to(base_url() . '/klien/' . $this->request->getVar('id_klien'));
    }
}
