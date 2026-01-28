<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\StaffClockLogModel;

class Employee extends BaseController
{
    protected $userModel;
    protected $clockLogModel;
    protected $perPage = 15;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->clockLogModel = new StaffClockLogModel();
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
     * Show employee details with clock logs
     */
    public function show($id)
    {
        $employee = $this->userModel->find($id);

        if (!$employee || !in_array($employee->role_id, [3, 4])) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // Get recent clock logs
        $clockLogs = $this->clockLogModel
            ->where('user_id', $id)
            ->orderBy('clock_in_time', 'DESC')
            ->limit(50)
            ->findAll();

        // Calculate today's stats
        $today = date('Y-m-d');
        $todayLogs = $this->clockLogModel
            ->where('user_id', $id)
            ->where('DATE(clock_in_time)', $today)
            ->findAll();

        $hoursWorked = 0;
        foreach ($todayLogs as $log) {
            if (!empty($log->clock_out_time)) {
                $inTime = strtotime($log->clock_in_time);
                $outTime = strtotime($log->clock_out_time);
                $hoursWorked += ($outTime - $inTime) / 3600;
            }
        }

        return view('admin/employee/detail', [
            'employee' => $employee,
            'clockLogs' => $clockLogs,
            'todayLogs' => $todayLogs,
            'hoursWorked' => $hoursWorked,
            'roleMap' => [
                3 => 'Technician',
                4 => 'Staff',
            ],
        ]);
    }
}
