<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\IAM\UserModel;

class AuthController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function login()
    {
        if ($this->request->getMethod() === 'post') {
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            $user = $this->userModel->getByEmail($email);

            if ($user && password_verify($password, $user->password_hash)) {
                session()->set([
                    'user_id' => $user->id,
                    'user_email' => $user->email,
                    'user_fullname' => $user->fullname
                ]);
                session()->setFlashdata('success', 'Login berhasil! Selamat datang ' . $user->fullname);
                return redirect()->to('/toko-kami');
            }

            return redirect()->back()->withInput()->with('error', 'Email atau password salah');
        }

        return view('auth/login');
    }

    public function register()
    {
        if ($this->request->getMethod() === 'post') {
            $password = $this->request->getPost('password');
            $confirmPassword = $this->request->getPost('confirm_password');

            // Check if passwords match
            if ($password !== $confirmPassword) {
                return redirect()->back()->withInput()->with('error', 'Password dan konfirmasi password tidak cocok');
            }

            // Validate form
            $validationRules = [
                'fullname' => 'required|min_length[3]|max_length[100]',
                'email' => 'required|valid_email|is_unique[users.email]',
                'password' => 'required|min_length[6]',
            ];

            if (!$this->validate($validationRules)) {
                return redirect()->back()->withInput()->with('error', $this->validator->listErrors());
            }

            $data = [
                'fullname' => $this->request->getPost('fullname'),
                'email' => $this->request->getPost('email'),
                'password_hash' => password_hash($password, PASSWORD_BCRYPT),
                'role_id' => 2, // Default to User role
                'is_active' => true,
            ];

            if ($this->userModel->insert($data)) {
                session()->setFlashdata('success', 'Registrasi berhasil! Silakan login dengan akun Anda.');
                return redirect()->to('/auth/login');
            }

            return redirect()->back()->withInput()->with('error', 'Gagal membuat akun. Silakan coba lagi.');
        }

        return view('auth/register');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }

    public function profile()
    {
        if (!session()->has('user_id')) {
            return redirect()->to('/auth/login');
        }

        $userId = session()->get('user_id');
        $user = $this->userModel->find($userId);

        return view('auth/profile', ['user' => $user]);
    }

    public function updateProfile()
    {
        if (!session()->has('user_id')) {
            return redirect()->to('/auth/login');
        }

        $userId = session()->get('user_id');
        $data = [
            'fullname' => $this->request->getPost('fullname'),
            'email' => $this->request->getPost('email'),
        ];

        if ($this->request->getFile('profile_picture')) {
            $file = $this->request->getFile('profile_picture');
            if ($file->isValid() && !$file->hasMoved()) {
                $newName = $file->getRandomName();
                $file->move('uploads', $newName);
                $data['profile_picture'] = 'uploads/' . $newName;
            }
        }

        if ($this->userModel->update($userId, $data)) {
            return redirect()->back()->with('success', 'Profile updated successfully');
        }

        return redirect()->back()->with('error', 'Failed to update profile');
    }
}
