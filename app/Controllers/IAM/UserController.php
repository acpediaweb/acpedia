<?php

namespace App\Controllers\IAM;

use App\Controllers\BaseController;
use App\Models\IAM\UserModel;
use App\Models\IAM\RoleModel;
use App\Models\IAM\UserAddressModel;

class UserController extends BaseController
{
    protected $userModel;
    protected $roleModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->roleModel = new RoleModel();
    }

    public function index()
    {
        $users = $this->userModel->findAll();
        return view('iam/users/index', ['users' => $users]);
    }

    public function create()
    {
        $roles = $this->roleModel->findAll();
        return view('iam/users/create', ['roles' => $roles]);
    }

    public function store()
    {
        $data = [
            'fullname' => $this->request->getPost('fullname'),
            'email' => $this->request->getPost('email'),
            'password_hash' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
            'role_id' => $this->request->getPost('role_id'),
            'is_active' => $this->request->getPost('is_active') ? 1 : 0,
        ];

        if ($this->userModel->insert($data)) {
            return redirect()->to('/users')->with('success', 'User created successfully');
        }

        return redirect()->back()->with('error', 'Failed to create user');
    }

    public function edit($id)
    {
        $user = $this->userModel->find($id);
        $roles = $this->roleModel->findAll();
        return view('iam/users/edit', ['user' => $user, 'roles' => $roles]);
    }

    public function update($id)
    {
        $data = [
            'fullname' => $this->request->getPost('fullname'),
            'email' => $this->request->getPost('email'),
            'role_id' => $this->request->getPost('role_id'),
            'is_active' => $this->request->getPost('is_active') ? 1 : 0,
        ];

        if ($this->userModel->update($id, $data)) {
            return redirect()->to('/users')->with('success', 'User updated successfully');
        }

        return redirect()->back()->with('error', 'Failed to update user');
    }

    public function show($id)
    {
        $user = $this->userModel->find($id);
        return view('iam/users/show', ['user' => $user]);
    }

    public function delete($id)
    {
        if ($this->userModel->delete($id)) {
            return redirect()->to('/users')->with('success', 'User deleted successfully');
        }

        return redirect()->back()->with('error', 'Failed to delete user');
    }
}
