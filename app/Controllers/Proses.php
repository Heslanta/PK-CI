<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\JadwalModel;
use App\Models\ProsesModel;

class Proses extends BaseController
{
    protected $prosesModel;
    public function __construct()
    {
        $this->prosesModel = new ProsesModel();
        $this->jadwalModel = new JadwalModel();
    }

    public function terima()
    {
        // update di proses jadwal klien
        $model = new ProsesModel();
        $id = $this->request->getPost('id_jadwal');

        $proses = 'diterima';
        $data = array(
            'proses'      => $proses
        );
        $model->updateProsesJadwal($data, $id);

        // $tes = [
        //     'nama'        => $this->request->getPost('nama'),
        //     'id_jadwal'        => $this->request->getPost('id_jadwal'),
        //     'id_user'        => $this->request->getPost('id_user'),
        //     'tujuan_jdw'  => $this->request->getPost('tujuan_jdw'),
        //     'tanggal'     => $this->request->getPost('tanggal'),
        //     'jam'      => $this->request->getPost('jam'),
        //     'status'      => $this->request->getPost('status'),
        //     'proses'      => $proses,
        // ];
        // // sesudah diterima, akan disimpan pada tabel jadwal sehingga muncul pada admin dan pegawai
        // dd($tes);
        $data = $this->jadwalModel->save([
            'nama'        => $this->request->getPost('nama'),
            'id_user'        => $this->request->getPost('id_user'),
            'id_jadwal'        => $this->request->getPost('id_jadwal'),
            'tujuan_jdw'  => $this->request->getPost('tujuan_jdw'),
            'tanggal'     => $this->request->getPost('tanggal'),
            'jam'      => $this->request->getPost('jam'),
            'status'      => $this->request->getPost('status'),
            'proses'      => $proses,
        ]);
        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');

        return redirect()->to('pages/index');
    }
    public function tolak()
    {
        // update di proses jadwal klien
        $model = new ProsesModel();
        $id = $this->request->getPost('id_jadwal');
        $proses = 'ditolak';
        $alasan = $this->request->getPost('alasan');
        if (empty($alasan)) {
            $alasan = 'Tidak ada alasan';
        }
        $data = array(
            'proses'      => $proses,
            'alasan'      => $alasan
        );
        $model->updateProsesJadwal($data, $id);

        // sesudah diterima, akan disimpan pada tabel jadwal sehingga muncul pada admin dan pegawai

        session()->setFlashdata('pesan', 'Data berhasil diperbaharui');

        return redirect()->to('pages/index');
    }




    // function untuk menyimpan jadwal pada page klien
    public function saveklien()
    {
        if (!$this->validate(
            [
                'tanggal' => [
                    'rules' => 'tanggal_nanti',
                    'errors' => [
                        'tanggal_nanti' => 'Tidak bisa memasukkan tanggal sebelum hari ini!'
                    ]
                ]
            ]
        )) {
            // validasi
            $validation = \Config\Services::validation();
            // redirect kembali tanpa index.php
            session()->setFlashdata('errors', 'Tidak bisa memasukkan tanggal sebelumnya');

            return redirect()->to(base_url() . '/pages/klienberanda')->withInput();
        }
        $model = new ProsesModel();
        $proses = 'menunggu';
        $cektujuan = $this->request->getPost('tujuan_jdw');
        if ($cektujuan == 1) {
            $tujuan = $this->request->getPost('tujuan_dll');
        } else {
            $tujuan = $this->request->getPost('tujuan_jdw');
        }
        $this->prosesModel->save([
            'nama'        => $this->request->getPost('nama'),
            'tujuan_jdw'  => $tujuan,
            'tanggal'     => $this->request->getPost('tanggal'),
            'jam'      => $this->request->getPost('jam'),
            'status'      => $this->request->getPost('status'),
            'id_user'      => $this->request->getPost('id'),
            'proses'      => $proses,
        ]);
        // dd($test);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');

        return redirect()->to('pages/klienberanda');
    }
    // public function edit($id)
    // {
    //     $data = [
    //         'title' => 'Edit Pengguna',
    //         'validation' => \Config\Services::validation(),
    //         'user' => $this->usersModel->getUser(($id)),
    //         'css' => 'change-client-data-style'
    //     ];

    //     return view('users/edit', $data);
    // }



    // function untuk meupdate jadwal pada beranda klien
    public function upjadwalklien()
    {
        $model = new ProsesModel();
        $id = $this->request->getPost('id_jadwal');
        $cektujuan = $this->request->getPost('tujuan_jdw');
        if ($cektujuan == 1) {
            $tujuan = $this->request->getPost('tujuan_dll');
        } else {
            $tujuan = $this->request->getPost('tujuan_jdw');
        }
        $data = array(
            'tujuan_jdw'  => $tujuan,
            'tanggal'     => $this->request->getPost('tanggal'),
            'jam'      => $this->request->getPost('jam'),
            'status'      => $this->request->getPost('status'),
        );

        $model->updateProsesJadwal($data, $id);
        session()->setFlashdata('pesan', 'Data berhasil diperbaharui');

        return redirect()->to('pages/klienberanda');
    }



    public function delete()
    {
        $model = new ProsesModel();
        $id = $this->request->getPost('id_jadwal');
        $model->deleteProsesJadwal($id);
        return redirect()->to('pages/klienberanda');
        session()->setFlashdata('pesan-hapus', 'Data berhasil dihapus');
    }
}
