<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table = 'orders';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $useSoftDeletes = false;
    protected $allowedFields = [
        'user_id', 'payment_proof_url', 'require_technician', 
        'technician_scheduled_at', 'technician_user_id', 'location_manager_id',
        'sub_district_snapshot', 'district_snapshot', 'city_snapshot', 
        'province_snapshot', 'postal_code_snapshot', 'street_snapshot',
        'total_amount_snapshot', 'order_status', 'faktur_requested', 'invoice_status'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
}
