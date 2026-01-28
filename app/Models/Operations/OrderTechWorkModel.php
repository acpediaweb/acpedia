<?php

namespace App\Models\Operations;

use CodeIgniter\Model;

class OrderTechWorkModel extends Model
{
    protected $table = 'order_tech_work';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['order_id', 'technician_actor_id', 'clockin_timestamp', 'clockin_latitude', 'clockin_longitude', 'clockin_selfie_url', 'clockout_timestamp', 'clockout_latitude', 'clockout_longitude', 'clockout_selfie_url', 'completion_notes', 'proof_of_completion_urls'];

    protected $useTimestamps = false;
    protected $createdField = null;
    protected $updatedField = null;
    protected $deletedField = null;

    protected $validationRules = [
        'order_id' => 'required|integer',
        'technician_actor_id' => 'permit_empty|integer',
        'clockin_timestamp' => 'required|valid_date',
        'clockin_latitude' => 'required|decimal',
        'clockin_longitude' => 'required|decimal',
        'clockin_selfie_url' => 'required|min_length[1]|max_length[255]',
        'clockout_timestamp' => 'permit_empty|valid_date',
        'clockout_latitude' => 'permit_empty|decimal',
        'clockout_longitude' => 'permit_empty|decimal',
        'clockout_selfie_url' => 'permit_empty|string|max_length[255]',
        'completion_notes' => 'permit_empty|string',
        'proof_of_completion_urls' => 'permit_empty|string',
    ];

    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    protected array $casts = [
        'clockin_latitude' => 'float',
        'clockin_longitude' => 'float',
        'clockout_latitude' => 'float',
        'clockout_longitude' => 'float',
        'proof_of_completion_urls' => 'json',
    ];

    public function getByOrderId(int $orderId)
    {
        return $this->where('order_id', $orderId)->first();
    }

    public function getByTechnicianId(int $technicianId)
    {
        return $this->where('technician_actor_id', $technicianId)->findAll();
    }

    public function getIncompleteJobs(int $technicianId)
    {
        return $this->where('technician_actor_id', $technicianId)->whereNull('clockout_timestamp')->findAll();
    }
}
