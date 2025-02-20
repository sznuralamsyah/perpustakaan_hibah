<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class UpdateProfileController extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();

        $userId = session()->get('user_id');

        if ($userId) {
            $user = $userModel->select('id, username, email')->find($userId);

            if ($user) {
                return view('user/profile/index', ['user' => $user]);
            } else {

                session()->setFlashdata('error', 'Data pengguna tidak ditemukan.');
                return view('user/profile/index', ['user' => null]);
            }
        }

        return view('user/profile/index', ['user' => null]);
    }

    public function update()
    {
        $userModel = new UserModel();

        $validationRules = [
            'username' => 'permit_empty|min_length[3]',
            'email'    => 'permit_empty|valid_email',
            'password' => 'permit_empty|min_length[6]',
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->to('/profile')->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'username' => $this->request->getPost('username'),
            'email'    => $this->request->getPost('email'),
        ];

        if (!empty($this->request->getPost('password'))) {
            $data['password'] = $this->request->getPost('password');
        }

        $userModel->update(session()->get('user_id'), $data);

        return redirect()->to('/user/profile')->with('success', 'Profil berhasil diperbarui');
    }
}
