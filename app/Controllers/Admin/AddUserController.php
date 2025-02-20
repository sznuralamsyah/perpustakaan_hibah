<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class AddUserController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $userModel = new UserModel();
        $users = $userModel->getUserWithRoles();

        $roles = $userModel->getRoles();

        return view('admin/users/index', ['users' => $users, 'roles' => $roles]);
    }

    public function store()
    {
        $rules = [
            'username' => 'required|min_length[3]|max_length[255]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[8]',
            'role_id' => 'required|numeric',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'role_id' => $this->request->getPost('role_id'),
        ];

        $this->userModel->insert($data);

        return redirect()->to('/admin/users')->with('success', 'Pengguna berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data = [
            'user' => $this->userModel->find($id),
            'roles' => $this->userModel->getRoles(),
        ];

        return view('admin/users/edit', $data);
    }

    public function update($id)
    {
        $rules = [
            'username' => 'required|min_length[3]|max_length[255]',
            'email' => "required|valid_email|is_unique[users.email,id,{$id}]",
            'role_id' => 'required|numeric',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'role_id' => $this->request->getPost('role_id'),
        ];

        if ($this->request->getPost('password')) {
            $data['password'] = $this->request->getPost('password');
        }

        $this->userModel->update($id, $data);

        return redirect()->to('/admin/users')->with('success', 'Pengguna berhasil diperbarui');
    }

    public function delete($id)
    {
        $this->userModel->delete($id);

        return redirect()->to('/admin/users')->with('success', 'Pengguna berhasil dihapus');
    }
}
