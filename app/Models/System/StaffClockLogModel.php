<?php

namespace App\Models\System;

use CodeIgniter\Model;

class StaffClockLogModel extends Model
{
    protected $table = 'staff_clock_logs';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['staff_user_id', 'clockin_timestamp', 'clockin_latitude', 'clockin_longitude', 'clockin_selfie_url', 'clockout_timestamp', 'clockout_latitude', 'clockout_longitude', 'clockout_selfie_url'];

    protected $useTimestamps = false;
    protected $createdField = null;
    protected $updatedField = null;
    protected $deletedField = null;

    protected $validationRules = [
        'staff_user_id' => 'permit_empty|integer',
        'clockin_timestamp' => 'required|valid_date',
        'clockin_latitude' => 'required|decimal',
        'clockin_longitude' => 'required|decimal',
        'clockin_selfie_url' => 'required|min_length[1]|max_length[255]',
        'clockout_timestamp' => 'permit_empty|valid_date',
        'clockout_latitude' => 'permit_empty|decimal',
        'clockout_longitude' => 'permit_empty|decimal',
        'clockout_selfie_url' => 'permit_empty|string|max_length[255]',
    ];

    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    protected array $casts = [
        'clockin_latitude' => 'float',
        'clockin_longitude' => 'float',
        'clockout_latitude' => 'float',
        'clockout_longitude' => 'float',
    ];

    public function getByStaffId(int $staffId)
    {
        return $this->where('staff_user_id', $staffId)->orderBy('clockin_timestamp', 'DESC')->findAll();
    }

    public function getActiveSessions(int $staffId)
    {
        return $this->where('staff_user_id', $staffId)->whereNull('clockout_timestamp')->findAll();
    }

    public function getTodayClocks(int $staffId, string $date)
    {
        return $this->where('staff_user_id', $staffId)
                    ->where('DATE(clockin_timestamp)', $date)
                    ->findAll();
    }
}
