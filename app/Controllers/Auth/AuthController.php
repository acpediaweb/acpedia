<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\UserModel;

class AuthController extends BaseController
{
    public function login()
    {
        return view('auth/login', ['title' => 'Login - HVACPRO']);
    }

    public function attemptLogin()
    {
        $session = session();
        $model = new UserModel();
        
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $model->where('email', $email)->first();

        if ($user && password_verify($password, $user->password_hash)) {
            $session->set([
                'user_id'    => $user->id,
                'fullname'   => $user->fullname,
                'role_id'    => $user->role_id,
                'isLoggedIn' => true
            ]);
            return redirect()->to('shop')->with('success', 'Welcome back, ' . $user->fullname);
        }

        return redirect()->back()->with('error', 'Invalid email or password.');
    }

    public function register()
    {
        return view('auth/register', ['title' => 'Create Account - HVACPRO']);
    }

    public function attemptRegister()
    {
        $model = new UserModel();

        $data = [
            'fullname'      => $this->request->getPost('fullname'),
            'email'         => $this->request->getPost('email'),
            'password_hash' => $this->request->getPost('password'),
            'role_id'       => 2, // Default to 'User' role from your seed
        ];

        if ($model->insert($data)) {
            return redirect()->to('login')->with('success', 'Registration successful. Please login.');
        }

        return redirect()->back()->with('error', 'Registration failed. Email might be taken.');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}