<?php

namespace App\Controllers\IAM;

use App\Controllers\BaseController;
use App\Models\IAM\RoleModel;

class RoleController extends BaseController
{
    protected $roleModel;

    public function __construct()
    {
        $this->roleModel = new RoleModel();
    }

    public function index()
    {
        $roles = $this->roleModel->findAll();
        return view('iam/roles/index', ['roles' => $roles]);
    }

    public function create()
    {
        return view('iam/roles/create');
    }

    public function store()
    {
        $data = [
            'role_name' => $this->request->getPost('role_name'),
            'role_color' => $this->request->getPost('role_color'),
            'role_description' => $this->request->getPost('role_description'),
        ];

        if ($this->roleModel->insert($data)) {
            return redirect()->to('/roles')->with('success', 'Role created successfully');
        }

        return redirect()->back()->with('error', 'Failed to create role');
    }

    public function edit($id)
    {
        $role = $this->roleModel->find($id);
        return view('iam/roles/edit', ['role' => $role]);
    }

    public function update($id)
    {
        $data = [
            'role_name' => $this->request->getPost('role_name'),
            'role_color' => $this->request->getPost('role_color'),
            'role_description' => $this->request->getPost('role_description'),
        ];

        if ($this->roleModel->update($id, $data)) {
            return redirect()->to('/roles')->with('success', 'Role updated successfully');
        }

        return redirect()->back()->with('error', 'Failed to update role');
    }

    public function delete($id)
    {
        if ($this->roleModel->delete($id)) {
            return redirect()->to('/roles')->with('success', 'Role deleted successfully');
        }

        return redirect()->back()->with('error', 'Failed to delete role');
    }
}
