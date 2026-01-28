<?php

namespace App\Models\System;

use CodeIgniter\Model;

class AdminDashboardLogModel extends Model
{
    protected $table = 'admin_dashboard_logs';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['admin_actor_id', 'action_title', 'action_description', 'action_timestamp'];

    protected $useTimestamps = false;
    protected $createdField = null;
    protected $updatedField = null;
    protected $deletedField = null;

    protected $validationRules = [
        'admin_actor_id' => 'permit_empty|integer',
        'action_title' => 'required|min_length[1]|max_length[100]',
        'action_description' => 'permit_empty|string',
        'action_timestamp' => 'permit_empty|valid_date',
    ];

    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    protected array $casts = [];

    public function getByAdminId(int $adminId)
    {
        return $this->where('admin_actor_id', $adminId)->orderBy('action_timestamp', 'DESC')->findAll();
    }

    public function getRecentLogs(int $limit = 50)
    {
        return $this->orderBy('action_timestamp', 'DESC')->limit($limit)->findAll();
    }
}
