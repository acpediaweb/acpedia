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
                session()->set(['user_id' => $user->id, 'user' => $user]);
                return redirect()->to('/dashboard');
            }

            return redirect()->back()->with('error', 'Invalid email or password');
        }

        return view('auth/login');
    }

    public function register()
    {
        if ($this->request->getMethod() === 'post') {
            $data = [
                'fullname' => $this->request->getPost('fullname'),
                'email' => $this->request->getPost('email'),
                'password_hash' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
                'role_id' => 2, // Default to User role
                'is_active' => true,
            ];

            if ($this->userModel->insert($data)) {
                return redirect()->to('/auth/login')->with('success', 'Registration successful. Please log in.');
            }

            return redirect()->back()->withInput()->with('errors', $this->userModel->errors());
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
