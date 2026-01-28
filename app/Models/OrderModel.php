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
        'user_id', 'customer_name', 'fullname', 'email', 'phone',
        'delivery_address_display', 'customer_notes', 'total_amount_snapshot',
        'discount_amount', 'tax_amount', 'shipping_cost', 'order_status'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
}
