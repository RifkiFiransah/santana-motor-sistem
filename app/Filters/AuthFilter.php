<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthFilter implements FilterInterface
{
  public function before(RequestInterface $request, $arguments = null)
  {
    // 1. Cek apakah sudah login
    if (!session()->get('isLoggedIn')) {
      return redirect()->to('/');
    }

    // 2. Cek Role (jika argumen filter diberikan di Routes)
    if ($arguments && !in_array(session()->get('role'), $arguments)) {
      // Jika role tidak cocok, lempar balik ke dashboard masing-masing atau error 403
      return redirect()->to(session()->get('role') . '/dashboard')->with('error', 'Akses Ditolak');
    }
  }

  public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
  {
    // Do nothing here
  }
}
