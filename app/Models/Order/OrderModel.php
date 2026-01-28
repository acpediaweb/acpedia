<?php

namespace App\Models\Order;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table = 'orders';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['user_id', 'payment_proof_url', 'require_technician', 'technician_scheduled_at', 'technician_user_id', 'location_manager_id', 'sub_district_snapshot', 'district_snapshot', 'city_snapshot', 'province_snapshot', 'postal_code_snapshot', 'street_snapshot', 'total_amount_snapshot', 'order_status', 'faktur_requested', 'invoice_status'];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = null;
    protected $deletedField = null;

    protected $validationRules = [
        'user_id' => 'permit_empty|integer',
        'payment_proof_url' => 'permit_empty|string|max_length[255]',
        'require_technician' => 'permit_empty|in_list[0,1]',
        'technician_scheduled_at' => 'permit_empty|valid_date',
        'technician_user_id' => 'permit_empty|integer',
        'location_manager_id' => 'permit_empty|integer',
        'sub_district_snapshot' => 'required|min_length[1]|max_length[100]',
        'district_snapshot' => 'required|min_length[1]|max_length[100]',
        'city_snapshot' => 'required|min_length[1]|max_length[100]',
        'province_snapshot' => 'required|min_length[1]|max_length[100]',
        'postal_code_snapshot' => 'required|min_length[1]|max_length[20]',
        'street_snapshot' => 'required|min_length[1]|max_length[255]',
        'total_amount_snapshot' => 'required|decimal',
        'order_status' => 'required|in_list[Pending,Confirmed,Technician Assigned,In Progress,Completed,Cancelled]',
        'faktur_requested' => 'permit_empty|in_list[0,1]',
        'invoice_status' => 'permit_empty|in_list[Proforma,Finalized]',
    ];

    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    protected $casts = [
        'require_technician' => 'boolean',
        'total_amount_snapshot' => 'float',
        'faktur_requested' => 'boolean',
    ];

    public function getByUserId(int $userId)
    {
        return $this->where('user_id', $userId)->orderBy('created_at', 'DESC')->findAll();
    }

    public function getByStatus(string $status)
    {
        return $this->where('order_status', $status)->findAll();
    }

    public function getByTechnicianId(int $technicianId)
    {
        return $this->where('technician_user_id', $technicianId)->findAll();
    }

    public function getPendingOrders()
    {
        return $this->where('order_status', 'Pending')->findAll();
    }
}
