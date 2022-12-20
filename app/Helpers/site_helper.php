<?php
if (!function_exists('tgl_indo')) {
    function tgl_indo($tanggal)
    {
        $bulan = array(
            1 =>   'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );
        // variabel pecahkan 0 = tanggal
        // variabel pecahkan 1 = bulan
        // variabel pecahkan 2 = tahun
        if ($tanggal == '0000-00-00') {
            $tanggal = 'Kosong';
        } else {
            $pecahkan = explode('-', $tanggal);
            return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
        }
    }
}
if (!function_exists('tglwaktu_indo')) {

    function tglwaktu_indo($tanggal)
    {
        $bulan = array(
            1 =>   'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );
        // variabel pecahkan 0 = tanggal
        // variabel pecahkan 1 = bulan
        // variabel pecahkan 2 = tahun
        if ($tanggal == '0000-00-00') {
            $tanggal = 'Kosong';
        } else {
            $pecahkan = explode('-', $tanggal);
            $pecahkan1 = explode(' ', $pecahkan[2]);
            return $pecahkan1[0] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0] . ', ' . $pecahkan1[1];
        }
    }
}
