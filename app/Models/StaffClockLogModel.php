<?php

namespace App\Models;

use CodeIgniter\Model;

class StaffClockLogModel extends Model
{
    protected $table            = 'staff_clock_logs';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $allowedFields    = [
        'staff_user_id', 'clockin_timestamp', 'clockin_latitude', 
        'clockin_longitude', 'clockin_selfie_url', 'clockout_timestamp',
        'clockout_latitude', 'clockout_longitude', 'clockout_selfie_url'
    ];

    protected $useTimestamps = false;

    /**
     * Get staff member with their recent clock logs
     */
    public function getStaffWithLogs($staffUserId, $limit = 10)
    {
        return $this->where('staff_user_id', $staffUserId)
            ->orderBy('clockin_timestamp', 'DESC')
            ->paginate($limit);
    }
}
