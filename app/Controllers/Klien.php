<?php

namespace App\Controllers;

use App\Models\KlienModel;
use App\Models\UsersModel;
use Dompdf\Dompdf;

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
            $data = [
                'title' => 'Klien | HLP',
                'klien' => $klien->paginate(50, 'klien'),
                'pager' => $this->klienModel->pager,
                'css' => 'data-client-style',
                'jumlah' => $this->klienModel->getJumlah()
            ];
        } else {
            $klien = $this->klienModel;
            $data = [
                'title' => 'Klien | HLP',
                'klien' => $klien->paginate(12, 'klien'),
                'pager' => $this->klienModel->pager,
                'css' => 'data-client-style',
                'jumlah' => $this->klienModel->getJumlah()
            ];
        }
        // dd($data);
        // $klienModel = new  KlienModel();
        return view('klien/index', $data);
    }

    public function detail($id)
    {
        // $klien = $this->klienModel->getKlien($id);
        // dd($klien);
        // $id_k = $this->klienModel->getKlien($id);

        $data_konsul =  $this->klienModel->getKonsul($id)->getResult();
        // $data_akun = $this->usersModel->getUser($id)->getResult();
        // dd($data_akun);
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

    function laporan($id)
    {
        $data_konsul =  $this->klienModel->getKonsul($id)->getResult();

        // instantiate and use the dompdf class
        $dompdf = new Dompdf();
        $data = [
            'title' => 'Detail Klien',
            'klien' => $this->klienModel->getKlien($id),
            'konsultasi' => $data_konsul
        ];
        return view('klien/laporan', $data);
    }
    public function generate($id)
    {

        $filename = date('y-m-d') . '-qadr-labs-report';
        $data_konsul =  $this->klienModel->getKonsul($id)->getResult();

        // instantiate and use the dompdf class
        $dompdf = new Dompdf();
        $data = [
            'title' => 'Detail Klien',
            'klien' => $this->klienModel->getKlien($id),
            'konsultasi' => $data_konsul
        ];
        // dd($data);
        // load HTML content
        $dompdf->loadHtml(view('klien/laporan', $data));

        // (optional) setup the paper size and orientation
        $dompdf->setPaper('A4', 'potrait');

        // render html as PDF
        $dompdf->render();

        // output the generated pdf
        $dompdf->stream($filename);
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

    // Untuk Menyimpan bagian create
    public function save()
    {
        // validasi input tambah klien
        if (!$this->validate(
            [
                'wajibpajak' => [
                    'rules' => 'required|max_length[60]',
                    'errors' => [
                        'required' => 'Nama klien harus diisi!',
                        'max_length' => 'Nama klien tidak boleh terlalu panjang'
                    ]
                ],
                'npwp' => [
                    'rules' => 'permit_empty|is_unique[klien.npwp]|npwp',
                    'errors' => [
                        'npwp' => 'NPWP harus berupa angka , - , dan .',
                        'is_unique' => 'NPWP klien sudah ada.'
                    ]
                ],
                'notelp' => [
                    'rules' => 'permit_empty|numeric_dash',
                    'errors' => [
                        'numeric_dash' => 'Nomor HP klien harus berupa angka.'
                    ]
                ],
                'notelp_per' => [
                    'rules' => 'permit_empty|numeric_dash',
                    'errors' => [
                        'numeric_dash' => 'Nomor HP klien harus berupa angka.'
                    ]
                ],
                'efin' => [
                    'rules' => 'permit_empty|numeric',
                    'errors' => [
                        'numeric' => 'EFIN klien harus berupa angka.'
                    ]
                ],
                'email' => [
                    'rules' => 'permit_empty|valid_email',
                    'errors' => [
                        'valid_email' => 'Masukkan Email yang benar!.'
                    ]
                ],
                'filegambar' => [
                    'rules' => 'max_size[filegambar,3072]|is_image[filegambar]|mime_in[filegambar,image/jpg,image/jpeg,image/png]',
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
        $file = $this->request->getFile('filegambar');
        if ($file->getError() == 4) {
            $namaGambar = 'default.png';
        } else {
            //generate nama file random
            $namaGambar = $file->getRandomName();
            // pindahkan gambar ke folder img di public
            $file->move('img', $namaGambar);
        }

        // Buat random password untuk klien
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $password = array();
        $alpha_length = strlen($alphabet) - 1;
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alpha_length);
            $password[] = $alphabet[$n];
        }
        $password =  implode($password);
        // dd($password);

        // Buat random username untuk klien jika npwpnya kosong
        $npwp = $this->request->getPost('npwp');
        if (empty($npwp)) {
            $npwp = '-';
        }
        $username = $this->request->getPost('npwp');
        if (empty($username)) {
            $angka = '1234567890';
            $username = array();
            $alpha_length = strlen($angka) - 1;
            for ($i = 0; $i < 4; $i++) {
                $n = rand(0, $alpha_length);
                $username[] = $angka[$n];
            }
            $username =  implode($username);
            $username = "user" . $username;
        }

        $data = [
            'wajibpajak' => $this->request->getVar('wajibpajak'),
            'npwp' => $npwp,
            'efin' => $this->request->getVar('efin'),
            'bidang_usaha' => $this->request->getVar('bidang_usaha'),
            'email' => $this->request->getVar('email'),
            'email_pass' => $this->request->getVar('email_pass'),
            'notelp_per' => $this->request->getVar('notelp_per'),
            'pkp' => $this->request->getVar('pkp'),
            'enofa' => $this->request->getVar('enofa'),
            'notelp' => $notelp,
            'catatan' => $catatan,
            'filegambar' => $namaGambar
        ];
        $this->klienModel->insert($data);
        $id_klien = $this->klienModel->insertID();
        // dd($id_klien);

        $level = "klien";
        $this->usersModel->save([
            'nama' => $this->request->getVar('wajibpajak'),
            'username' => $username,
            'password' => $password,
            'level' => $level,
            'notelp' => $notelp,
            'id_klien' => $id_klien
        ]);


        // Memunculkan session flash data hijau
        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');

        // redirect kembali tanpa index.php
        return redirect()->to(base_url() . '/klien');
    }

    public function delete($id)
    {
        //cari gambar berdasarkan id
        $gambar = $this->klienModel->find($id);
        $gambarfile = $gambar['filegambar'];
        // pekondisian jika filegambar tidak empty AND filegambar bukan default
        if ((!empty($klien['filegambar']))  && ($klien['filegambar'] != 'default.png')) {
            //hapus gambar
            unlink('img/' . $gambarfile);
        }

        //menghapus data berdasarkan id klien
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
                    'rules' => 'required|max_length[60]',
                    'errors' => [
                        'required' => 'Nama klien harus diisi!',
                        'max_length' => 'Nama klien tidak boleh terlalu panjang'
                    ]
                ],
                'npwp' => [
                    'rules' => 'permit_empty|required|npwp',
                    'errors' => [
                        'npwp' => 'NPWP harus berupa angka , - , dan .',
                        'required' => 'NPWP klien harus diisi.'
                    ]
                ],
                'notelp' => [
                    'rules' => 'permit_empty|numeric_dash',
                    'errors' => [
                        'numeric_dash' => 'Nomor HP klien harus berupa angka.'
                    ]
                ],
                'notelp_per' => [
                    'rules' => 'permit_empty|numeric_dash',
                    'errors' => [
                        'numeric_dash' => 'Nomor HP klien harus berupa angka.'
                    ]
                ],
                'efin' => [
                    'rules' => 'permit_empty|numeric',
                    'errors' => [
                        'numeric' => 'EFIN klien harus berupa angka.'
                    ]
                ],
                'email' => [
                    'rules' => 'permit_empty|valid_email',
                    'errors' => [
                        'valid_email' => 'Masukkan Email yang benar!.'
                    ]
                ],
                'filegambar' => [
                    'rules' => 'mime_in[filegambar,image/jpg,image/jpeg,image/png]|max_size[filegambar,3072]|is_image[filegambar]',
                    'errors' => [
                        'max_size' => 'Ukuran gambar terlalu besar',
                        'is_image' => 'Yang anda pilih bukan gambar, pilihlah gambar berupa jpg/jpeg/png',
                        'mime_in' => 'Yang anda pilih bukan gambar, pilihlah gambar berupa jpg/jpeg/png'
                    ]
                ]

            ]
        )) {

            // redirect kembali tanpa index.php
            return redirect()->to(base_url() . '/klien/edit/' .  $this->request->getVar('id'))->withInput();
        }

        $notelp = $this->request->getVar('notelp');
        if (empty($notelp)) {
            $notelp = '-';
        }
        $fileGambar = $this->request->getFile('filegambar');
        //cek gambar, apakah tetap gambar lama
        if ($fileGambar->getError() == 4) {
            $namaGambar = $this->request->getVar('gambarLama');
        } else {
            //generate nama file random
            $namaGambar = $fileGambar->getRandomName();
            // pindahkan gambar ke folder img di public
            $fileGambar->move('img', $namaGambar);

            //hapus file yang lama
            unlink('img/' . $this->request->getVar('gambarLama'));
        }

        // $id = url_title($this->request->getVar('wajibpajak'), '-', true);
        // dd($this->request->getVar());
        $this->klienModel->save([
            'id' => $id,
            'wajibpajak' => $this->request->getVar('wajibpajak'),
            'npwp' => $this->request->getVar('npwp'),
            'status' => $this->request->getVar('status'),
            'efin' => $this->request->getVar('efin'),
            'bidang_usaha' => $this->request->getVar('bidang_usaha'),
            'email' => $this->request->getVar('email'),
            'email_pass' => $this->request->getVar('email_pass'),
            'notelp_per' => $this->request->getVar('notelp_per'),
            'pkp' => $this->request->getVar('pkp'),
            'enofa' => $this->request->getVar('enofa'),
            'notelp' => $notelp,
            'catatan' => $this->request->getVar('catatan'),
            'filegambar' => $namaGambar
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah');
        // redirect kembali tanpa index.php
        return redirect()->to(base_url() . '/klien/detail/' .  $this->request->getVar('id'));
    }
}
