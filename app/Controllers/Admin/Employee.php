<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Employee extends BaseController
{
    protected $userModel;
    protected $perPage = 15;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    /**
     * List all employees (Technician role_id = 3, Staff role_id = 4)
     */
    public function index()
    {
        $page = $this->request->getVar('page') ?? 1;
        $search = $this->request->getVar('search') ?? '';
        $role = $this->request->getVar('role') ?? '';

        $query = $this->userModel->whereIn('role_id', [3, 4]);

        if (!empty($search)) {
            $query = $query->like('fullname', $search);
        }

        if (!empty($role) && in_array((int)$role, [3, 4])) {
            $query = $query->where('role_id', (int)$role);
        }

        $employees = $query->orderBy('fullname', 'ASC')
            ->paginate($this->perPage, 'employees');

        return view('admin/employee/index', [
            'employees' => $employees,
            'pager' => $this->userModel->pager,
            'searchQuery' => $search,
            'selectedRole' => $role,
            'roles' => [
                3 => 'Technician',
                4 => 'Staff',
            ],
        ]);
    }

    /**
     * Show employee details
     */
    public function show($id)
    {
        $employee = $this->userModel->find($id);

        if (!$employee || !in_array($employee->role_id, [3, 4])) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('admin/employee/detail', [
            'employee' => $employee,
            'roleMap' => [
                3 => 'Technician',
                4 => 'Staff',
            ],
        ]);
    }
}
