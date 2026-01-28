<?php

namespace App\Models\Operations;

use CodeIgniter\Model;

class OrderTechAdjustmentModel extends Model
{
    protected $table = 'order_tech_adjustment';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['order_id', 'technician_actor_id', 'adjustment_title', 'adjustment_description', 'adjustment_amount', 'admin_actor_id', 'adjustment_status', 'is_admin_adjustment'];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = null;
    protected $deletedField = null;

    protected $validationRules = [
        'order_id' => 'required|integer',
        'technician_actor_id' => 'permit_empty|integer',
        'adjustment_title' => 'required|min_length[1]|max_length[100]',
        'adjustment_description' => 'permit_empty|string',
        'adjustment_amount' => 'required|decimal',
        'admin_actor_id' => 'permit_empty|integer',
        'adjustment_status' => 'permit_empty|in_list[Pending,Approved,Rejected]',
        'is_admin_adjustment' => 'permit_empty|in_list[0,1]',
    ];

    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    protected $casts = [
        'adjustment_amount' => 'float',
        'is_admin_adjustment' => 'boolean',
    ];
    protected $castHandlers = [];

    public function getByOrderId(int $orderId)
    {
        return $this->where('order_id', $orderId)->findAll();
    }

    public function getByStatus(string $status)
    {
        return $this->where('adjustment_status', $status)->findAll();
    }

    public function getPendingAdjustments()
    {
        return $this->where('adjustment_status', 'Pending')->findAll();
    }
}
