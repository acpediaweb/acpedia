<?php

namespace App\Models\Order;

use CodeIgniter\Model;

class OrderItemModel extends Model
{
    protected $table = 'order_items';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['order_id', 'product_id', 'quantity', 'base_price_snapshot', 'sale_price_snapshot'];

    protected $useTimestamps = false;
    protected $createdField = null;
    protected $updatedField = null;
    protected $deletedField = null;

    protected $validationRules = [
        'order_id' => 'required|integer',
        'product_id' => 'permit_empty|integer',
        'quantity' => 'required|integer',
        'base_price_snapshot' => 'required|decimal',
        'sale_price_snapshot' => 'permit_empty|decimal',
    ];

    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    protected $casts = [
        'quantity' => 'integer',
        'base_price_snapshot' => 'float',
        'sale_price_snapshot' => 'float',
    ];

    public function getByOrderId(int $orderId)
    {
        return $this->where('order_id', $orderId)->findAll();
    }
}
