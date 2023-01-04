<?= $this->extend('layout/template'); ?>
<?php $session = session() ?>

<?= $this->section('content'); ?>
<style>
    .accordion {
        background-color: #eee;
        color: #444;
        cursor: pointer;
        padding: 18px;
        width: 100%;
        border: none;
        text-align: left;
        outline: none;
        font-size: 15px;
        transition: 0.8s;
        font-weight: bold;
    }

    .active,
    .accordion:hover {
        background-color: #ccc;
    }

    .panel {
        padding: 0 18px;
        display: none;
        background-color: white;
        overflow: hidden;
        border-style: ridge;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col">
            <div class="mt-4">


                <div class="card">
                    <div class="card-header">
                        Halaman Bantuan Penggunaan Sistem
                    </div>
                    <div class="card-body">
                        <div class="panduan"></div>
                        <?php if ($session->get('level') == 'admin') : ?>

                            <h5>Admin</h5>
                            <button class="accordion"> Cara menambah data klien</button>
                            <div class="panel">
                                <ol>
                                    <li>Pada bagian sidebar tekan klien </li>
                                    <li>Pada bagian klien, Tekan tombol tambah </li>
                                    <li>Pada bagian tambah data klien, masukkan data-data klien yang mau ditambahkan
                                        kemudian tekan tomboh tambah pada bagian bawah </li>
                                </ol>
                            </div>

                            <button class="accordion"> Cara mengubah data klien</button>
                            <div class="panel">
                                <ol>
                                    <li>Cari klien yang datanya mau diubah pada bagian klien, kemudian pilih klien tersebut </li>
                                    <li>Pada bagian detail klien, tekan tombol edit</li>
                                    <li>Pada bagian edit data klien, masukkan data-data klien yang mau diedit
                                        kemudian tekan tomboh edit pada bagian bawah </li>
                                </ol>
                            </div>

                            <button class="accordion">Cara menghapus data klien</button>
                            <div class="panel">
                                <ol>
                                    <li>Cari klien yang datanya mau hapus, kemudian pilih klien tersebut </li>
                                    <li>Pada bagian detail klien, tekan tombol hapus</li>
                                </ol>
                            </div>
                            <button class="accordion">Cara menambah data konsultasi</button>
                            <div class="panel">
                                <ol>
                                    <li>Cari klien yang mau ditambah data konsultasinya, kemudian pilih klien tersebut </li>
                                    <li>Jika tidak ada muncul, maka tambahkan terlebih dahulu data klien </li>
                                    <li>Pada bagian detail klien, tekan tombol tambah pada bagian bawah</li>
                                    <li>Pada bagian tambah data konsul, masukkan data-data konsultasi yang mau ditambahkan
                                        kemudian tekan tomboh tambah pada bagian bawah </li>
                                </ol>
                            </div>
                            <button class="accordion">Cara mengubah data konsultasi</button>
                            <div class="panel">
                                <ol>
                                    <li>Cari klien yang mau diubah data konsultasinya, kemudian pilih klien tersebut </li>
                                    <li>Pada bagian detail klien, cari data konsultasi yang mau diubah</li>
                                    <li>Pada bagian edit data konsultasi, masukkan data-data konsultasi yang mau diedit
                                        kemudian tekan tomboh edit pada bagian bawah </li>
                                </ol>
                            </div>
                            <button class="accordion">Cara menghapus data konsultasi</button>
                            <div class="panel">
                                <ol>
                                    <li>Cari konsultasi yang datanya mau diubah, kemudian pilih konsultasi tersebut </li>
                                    <li>Pada bagian detail konsultasi, tekan tombol hapus</li>
                                </ol>
                            </div>
                            <button class="accordion">Cara mengubah data profil(username & password)</button>
                            <div class="panel">
                                <ol>
                                    <li>Pada bagian sidebar tekan Profil </li>
                                    <li>Pada bagian profil, Tekan tombol edit </li>
                                    <li>Pada bagian ubah data profil, ubah data profil yang mau diubah </li>
                                </ol>

                            </div>
                            <button class="accordion"> Cara menambah jadwal konsultasi</button>
                            <div class="panel">
                                <ol>
                                    <li>Pada bagian sidebar tekan Beranda </li>
                                    <li>Pada bagian Beranda, Tekan tombol tambah dibawah tulisan jadwal konsultasi klien</li>
                                    <li>Pada bagian tambah jadwal, masukkan data-data jadwal yang mau ditambahkan
                                        kemudian tekan tomboh simpan pada bagian bawah </li>
                                </ol>
                            </div>
                            <button class="accordion"> Cara mengubah data jadwal konsultasi</button>
                            <div class="panel">
                                <ol>
                                    <li>Pada bagian Beranda, tekan tombol edit disebelah data yang mau diubah</li>
                                    <li>Pada bagian edit data jadwal, masukkan data-data jadwal yang mau diedit
                                        kemudian tekan tomboh ubah pada bagian bawah </li>
                                </ol>
                            </div>
                            <button class="accordion"> Cara Terima/Tolak permintaan jadwal klien</button>
                            <div class="panel">
                                <ol>
                                    <li>Pada bagian Beranda, cari bagian permintaan jadwal klien</li>
                                    <li>Kemudian tekan tombol Terima untuk menerima permintaan jadwal konsultasi klien
                                        atau tombol Tolak untuk menolak permintaan jadwal, jika menekan tolak akan muncul alasan
                                        penolakkan permintaan jadwal
                                    </li>
                                </ol>
                            </div>
                            <button class="accordion"> Cara melihat jumlah konsultasi yang ada</button>
                            <div class="panel">
                                <ol>
                                    <li>Pada bagian Beranda, cari bagian grafik jumlah konsultasi</li>
                                    <li>Kemudian pilih tahun yang diinginkan, kemudian tekan tombol tampil
                                    </li>
                                </ol>
                            </div>
                            <button class="accordion"> Cara menambah data pengguna</button>
                            <div class="panel">
                                <ol>
                                    <li>Pada bagian sidebar tekan pengguna </li>
                                    <li>Pada bagian pengguna, Tekan tombol tambah </li>
                                    <li>Pada bagian tambah data pengguna, masukkan data-data pengguna yang mau ditambahkan
                                        kemudian tekan tomboh simpan pada bagian bawah </li>
                                </ol>
                            </div>

                            <button class="accordion"> Cara mengubah data pengguna</button>
                            <div class="panel">
                                <ol>
                                    <li>Pada bagian pengguna, tekan tombol edit disebelah data yang mau diubah</li>
                                    <li>Pada bagian edit data pengguna, masukkan data-data pengguna yang mau diedit
                                        kemudian tekan tomboh ubah pada bagian bawah </li>
                                </ol>
                            </div>

                            <button class="accordion">Cara menghapus data pengguna</button>
                            <div class="panel">
                                <ol>
                                    <li>Cari pengguna yang datanya mau hapus </li>
                                    <li>Kemudian tekan tombol hapus yang ada disamping kanan
                                        pada data yang mau dihapus</li>
                                </ol>
                            </div>
                            <button class="accordion"> Cara menambah tujuan konsultasi</button>
                            <div class="panel">
                                <ol>
                                    <li>Pada bagian sidebar tekan tujuan konsul </li>
                                    <li>Pada bagian tujuan konsultasi, Tekan tombol tambah tujuan konsultasi </li>
                                    <li>Pada bagian tambah data tujuan, masukkan keterangan konsultasi yang ditambahkan
                                        kemudian tekan tomboh simpan pada bagian bawah </li>
                                </ol>
                            </div>
                            <button class="accordion"> Cara mengubah tujuan konsultasi</button>
                            <div class="panel">
                                <ol>
                                    <li>Pada bagian tujuan konsultasi, tekan tombol edit disebelah data yang mau diubah</li>
                                    <li>Pada bagian edit tujuan konsultasi, masukkan keterangan konsultasi yang mau diedit
                                        kemudian tekan tomboh ubah pada bagian bawah </li>
                                </ol>
                            </div>

                            <button class="accordion">Cara menghapus tujuan konsultasi</button>
                            <div class="panel">
                                <ol>
                                    <li>Cari tujuan konsultasi yang datanya mau hapus </li>
                                    <li>Kemudian tekan tombol hapus yang ada disamping kanan
                                        pada data yang mau dihapus</li>
                                </ol>
                            </div>
                        <?php endif; ?>
                        <?php if ($session->get('level') == 'pegawai') : ?>

                            <h5>Pegawai</h5>
                            <button class="accordion"> Cara menambah data klien</button>
                            <div class="panel">
                                <ol>
                                    <li>Pada bagian sidebar tekan klien </li>
                                    <li>Pada bagian klien, Tekan tombol tambah </li>
                                    <li>Pada bagian tambah data klien, masukkan data-data klien yang mau ditambahkan
                                        kemudian tekan tomboh tambah pada bagian bawah </li>
                                </ol>
                            </div>

                            <button class="accordion"> Cara mengubah data klien</button>
                            <div class="panel">
                                <ol>
                                    <li>Cari klien yang datanya mau diubah pada bagian klien, kemudian pilih klien tersebut </li>
                                    <li>Pada bagian detail klien, tekan tombol edit</li>
                                    <li>Pada bagian edit data klien, masukkan data-data klien yang mau diedit
                                        kemudian tekan tomboh edit pada bagian bawah </li>
                                </ol>
                            </div>


                            <button class="accordion">Cara menambah data konsultasi</button>
                            <div class="panel">
                                <ol>
                                    <li>Cari klien yang mau ditambah data konsultasinya, kemudian pilih klien tersebut </li>
                                    <li>Jika tidak ada muncul, maka tambahkan terlebih dahulu data klien </li>
                                    <li>Pada bagian detail klien, tekan tombol tambah pada bagian bawah</li>
                                    <li>Pada bagian tambah data konsul, masukkan data-data konsultasi yang mau ditambahkan
                                        kemudian tekan tomboh tambah pada bagian bawah </li>
                                </ol>
                            </div>

                            <button class="accordion">Cara mengubah data profil(username & password)</button>
                            <div class="panel">
                                <ol>
                                    <li>Pada bagian sidebar tekan Profil </li>
                                    <li>Pada bagian profil, Tekan tombol edit </li>
                                    <li>Pada bagian ubah data profil, ubah data profil yang mau diubah </li>
                                </ol>

                            </div>
                            <button class="accordion"> Cara menambah jadwal konsultasi</button>
                            <div class="panel">
                                <ol>
                                    <li>Pada bagian sidebar tekan Beranda </li>
                                    <li>Pada bagian Beranda, Tekan tombol tambah dibawah tulisan jadwal konsultasi klien</li>
                                    <li>Pada bagian tambah jadwal, masukkan data-data jadwal yang mau ditambahkan
                                        kemudian tekan tomboh simpan pada bagian bawah </li>
                                </ol>
                            </div>


                            <button class="accordion"> Cara melihat jumlah konsultasi yang ada</button>
                            <div class="panel">
                                <ol>
                                    <li>Pada bagian Beranda, cari bagian grafik jumlah konsultasi</li>
                                    <li>Kemudian pilih tahun yang diinginkan, kemudian tekan tombol tampil
                                    </li>
                                </ol>
                            </div>

                        <?php endif; ?>

                        <?php if ($session->get('level') == 'klien') : ?>

                            <h5>Klien</h5>

                            <button class="accordion"> Cara menambah jadwal konsultasi</button>
                            <div class="panel">
                                <ol>
                                    <li>Pada bagian sidebar tekan Beranda </li>
                                    <li>Pada bagian Beranda, Tekan tombol tambah dibawah tulisan jadwal konsultasi </li>
                                    <li>Pada bagian tambah jadwal, masukkan data-data jadwal yang mau ditambahkan
                                        kemudian tekan tomboh simpan pada bagian bawah </li>
                                </ol>
                            </div>
                            <button class="accordion"> Cara melihat jumlah konsultasi yang ada</button>
                            <div class="panel">
                                <ol>
                                    <li>Pada bagian Beranda, cari bagian grafik jumlah konsultasi</li>
                                    <li>Kemudian pilih tahun yang diinginkan, kemudian tekan tombol tampil
                                    </li>
                                </ol>
                            </div>
                            <button class="accordion"> Cara mengubah data jadwal konsultasi</button>
                            <div class="panel">
                                <ol>
                                    <li>Pada bagian Beranda, tekan tombol edit disebelah data yang mau diubah, jika masih status menunggu</li>
                                    <li>Pada bagian edit data jadwal, masukkan data-data jadwal yang mau diedit
                                        kemudian tekan tomboh ubah pada bagian bawah </li>
                                </ol>
                            </div>
                            <button class="accordion"> Cara menghapus data jadwal konsultasi</button>
                            <div class="panel">
                                <ol>
                                    <li>Pada bagian Beranda, tekan tombol hapus disebelah data yang mau diubah, jika status menunggu/ditolak</li>
                                </ol>
                            </div>
                            <button class="accordion">Cara mengubah data profil(username & password)</button>
                            <div class="panel">
                                <ol>
                                    <li>Pada bagian sidebar tekan Profil </li>
                                    <li>Pada bagian profil, Tekan tombol edit </li>
                                    <li>Pada bagian ubah data profil, ubah data profil yang mau diubah </li>
                                </ol>

                            </div>

                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script>
    var acc = document.getElementsByClassName("accordion");
    var i;

    for (i = 0; i < acc.length; i++) {
        acc[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var panel = this.nextElementSibling;
            if (panel.style.display === "block") {
                panel.style.display = "none";
            } else {
                panel.style.display = "block";
            }
        });
    }
</script>
<?= $this->endSection(); ?>