<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class AuthController extends BaseController
{
    public function index()
    {
        if (session()->get('isLoggedIn')) {
            return redirect()->to(session()->get('role') . '/dashboard');
        }
        return view('auth/login');
    }

    public function login()
    {
        $model = new UserModel();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $model->where('username', $username)->first();

        if ($user) {
            if (password_verify($password, $user['password'])) {
                $sessData = [
                    'id' => $user['id'],
                    'username' => $user['username'],
                    'fullname' => $user['fullname'],
                    'role' => $user['role'],
                    'isLoggedIn' => true,
                ];
                session()->set($sessData);
                return redirect()->to($user['role'] . '/dashboard');
            }
        }
        return redirect()->back()->with('error', 'Username atau Password salah');
    }

    public function logout()
    {
        // dd(session()->get());
        session()->destroy();
        return redirect()->to('/');
        // return view('auth/login');
    }
}
