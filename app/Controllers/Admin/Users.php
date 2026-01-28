<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\RoleModel;

class Users extends BaseController
{
    protected $userModel;
    protected $roleModel;
    protected $perPage = 20;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->roleModel = new RoleModel();
    }

    /**
     * List all users
     */
    public function index()
    {
        $page = $this->request->getVar('page') ?? 1;
        $role = $this->request->getVar('role') ?? '';
        $search = $this->request->getVar('search') ?? '';

        $query = $this->userModel;

        if (!empty($role)) {
            $query = $query->where('role_id', (int)$role);
        }

        if (!empty($search)) {
            $query = $query->groupStart()
                ->like('fullname', $search)
                ->orLike('email', $search)
                ->groupEnd();
        }

        $users = $query->orderBy('created_at', 'DESC')
            ->paginate($this->perPage, 'users');

        return view('admin/users/index', [
            'users' => $users,
            'pager' => $this->userModel->pager,
            'selectedRole' => $role,
            'searchQuery' => $search,
            'roles' => $this->roleModel->findAll(),
        ]);
    }

    /**
     * Show edit form for user (also used for create)
     */
    public function edit($id = null)
    {
        $user = null;
        if ($id) {
            $user = $this->userModel->find($id);
            if (!$user) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        }

        return view('admin/users/form', [
            'user' => $user,
            'roles' => $this->roleModel->findAll(),
        ]);
    }

    /**
     * Save user (create or update)
     */
    public function save()
    {
        $id = $this->request->getPost('id');
        
        $rules = [
            'fullname' => 'required|min_length[3]|max_length[50]',
            'email' => 'required|valid_email|max_length[100]',
            'role_id' => 'required|numeric',
        ];

        // Add password requirement only for new users
        if (!$id) {
            $rules['password'] = 'required|min_length[6]';
        }

        // Check email uniqueness
        $email = $this->request->getPost('email');
        $existingUser = $this->userModel->where('email', $email);
        if ($id) {
            $existingUser = $existingUser->where('id !=', $id);
        }
        if ($existingUser->first()) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Email already in use');
        }

        // Check fullname uniqueness
        $fullname = $this->request->getPost('fullname');
        $existingName = $this->userModel->where('fullname', $fullname);
        if ($id) {
            $existingName = $existingName->where('id !=', $id);
        }
        if ($existingName->first()) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Fullname already in use');
        }

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $data = [
            'fullname' => $fullname,
            'email' => $email,
            'role_id' => $this->request->getPost('role_id'),
            'is_active' => $this->request->getPost('is_active') ? 1 : 0,
        ];

        if ($this->request->getPost('password')) {
            $data['password_hash'] = password_hash(
                $this->request->getPost('password'),
                PASSWORD_DEFAULT
            );
        }

        if ($id) {
            $this->userModel->update($id, $data);
            $message = 'User updated successfully';
        } else {
            $id = $this->userModel->insert($data);
            $message = 'User created successfully';
        }

        return redirect()->to('admin/users')
            ->with('success', $message);
    }

    /**
     * Delete a user
     */
    public function delete($id)
    {
        $user = $this->userModel->find($id);
        if (!$user) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'User not found'
            ])->setStatusCode(404);
        }

        // Prevent deleting admin users
        if ($user->role_id === 1) {
            return redirect()->to('admin/users')
                ->with('error', 'Cannot delete admin users');
        }

        $this->userModel->delete($id);

        return redirect()->to('admin/users')
            ->with('success', 'User deleted successfully');
    }
}
