<?php

namespace App\Controllers\Pemilik;

use App\Controllers\BaseController;
use App\Models\UserModel;

class UserController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $data['users'] = $this->userModel->findAll();
        return view('pemilik/user/index', $data);
    }

    public function new()
    {
        return view('pemilik/user/create');
    }

    public function create()
    {
        // Validasi
        $validation = \Config\Services::validation();
        $validation->setRules([
            'username' => 'required|min_length[3]|is_unique[users.username]',
            'password' => 'required|min_length[6]',
            'fullname' => 'required',
            'role'     => 'required|in_list[pemilik,gudang,kasir]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $this->userModel->save([
            'username' => $this->request->getPost('username'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'fullname' => $this->request->getPost('fullname'),
            'role'     => $this->request->getPost('role'),
        ]);

        return redirect()->to('pemilik/users')->with('success', 'User berhasil dibuat');
    }

    public function show($id)
    {
        $data['user'] = $this->userModel->find($id);
        
        if (!$data['user']) {
            return redirect()->to('pemilik/users')->with('error', 'User tidak ditemukan');
        }

        return view('pemilik/user/show', $data);
    }

    public function edit($id)
    {
        $data['user'] = $this->userModel->find($id);
        
        if (!$data['user']) {
            return redirect()->to('pemilik/users')->with('error', 'User tidak ditemukan');
        }

        return view('pemilik/user/edit', $data);
    }

    public function update($id)
    {
        $user = $this->userModel->find($id);
        
        if (!$user) {
            return redirect()->to('pemilik/users')->with('error', 'User tidak ditemukan');
        }

        // Validasi
        $validation = \Config\Services::validation();
        
        $rules = [
            'username' => "required|min_length[3]|is_unique[users.username,id,{$id}]",
            'fullname' => 'required',
            'role'     => 'required|in_list[pemilik,gudang,kasir]',
        ];

        // Password optional saat update
        if ($this->request->getPost('password')) {
            $rules['password'] = 'min_length[6]';
        }

        $validation->setRules($rules);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $updateData = [
            'username' => $this->request->getPost('username'),
            'fullname' => $this->request->getPost('fullname'),
            'role'     => $this->request->getPost('role'),
        ];

        // Update password jika diisi
        if ($this->request->getPost('password')) {
            $updateData['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }

        $this->userModel->update($id, $updateData);

        return redirect()->to('pemilik/users')->with('success', 'User berhasil diupdate');
    }

    public function delete($id)
    {
        $user = $this->userModel->find($id);
        
        if (!$user) {
            return redirect()->to('pemilik/users')->with('error', 'User tidak ditemukan');
        }

        // Cek agar tidak menghapus diri sendiri
        if ($id == session()->get('id')) {
            return redirect()->to('pemilik/users')->with('error', 'Tidak dapat menghapus akun sendiri');
        }

        $this->userModel->delete($id);

        return redirect()->to('pemilik/users')->with('success', 'User berhasil dihapus');
    }
}
