<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class NoAuth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Do something here
        if (session()->get('isLogin')) {
            if (session()->get('level') == 'klien')
                return redirect()->to("/pages/klienberanda");
            if (session()->get('level') == 'admin' || 'pegawai')
                return redirect()->to('/pages');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
