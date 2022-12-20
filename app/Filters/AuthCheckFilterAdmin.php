<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthCheckFilterAdmin implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Do something here
        if (!session()->get('isLogin')) {
            return redirect()->to('/')->with('fail', "Login Terlebih Dahulu");
        }
        if (session()->get('level') == 'klien')
            return redirect()->to("/pages/klienberanda");
        if (session()->get('level') ==  'pegawai')
            return redirect()->to('/pages');
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
