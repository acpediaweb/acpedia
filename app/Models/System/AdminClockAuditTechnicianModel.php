<?php

namespace App\Models\System;

use CodeIgniter\Model;

class AdminClockAuditTechnicianModel extends Model
{
    protected $table = 'admin_clock_audit_technician';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $useSoftDeletes = false;
    protected array $allowedFields = ['tech_clock_log_id', 'admin_actor_id', 'audit_action', 'audit_timestamp', 'audit_notes'];

    protected $useTimestamps = false;
    protected $createdField = null;
    protected $updatedField = null;
    protected $deletedField = null;

    protected $validationRules = [
        'tech_clock_log_id' => 'required|integer',
        'admin_actor_id' => 'permit_empty|integer',
        'audit_action' => 'required|in_list[Clock-In Verified,Clock-Out Verified,Clock-In Rejected,Clock-Out Rejected]',
        'audit_timestamp' => 'permit_empty|valid_date',
        'audit_notes' => 'permit_empty|string',
    ];

    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    protected array $casts = [];

    public function getByTechClockLogId(int $techClockLogId)
    {
        return $this->where('tech_clock_log_id', $techClockLogId)->findAll();
    }

    public function getByAdminId(int $adminId)
    {
        return $this->where('admin_actor_id', $adminId)->orderBy('audit_timestamp', 'DESC')->findAll();
    }
}
