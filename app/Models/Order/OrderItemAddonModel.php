<?php

namespace App\Models\Order;

use CodeIgniter\Model;

class OrderItemAddonModel extends Model
{
    protected $table = 'order_items_addons';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['order_item_id', 'service_id', 'pipe_id', 'addon_id', 'extra_data_json', 'quantity', 'price_snapshot'];

    protected $useTimestamps = false;
    protected $createdField = null;
    protected $updatedField = null;
    protected $deletedField = null;

    protected $validationRules = [
        'order_item_id' => 'required|integer',
        'service_id' => 'permit_empty|integer',
        'pipe_id' => 'permit_empty|integer',
        'addon_id' => 'permit_empty|integer',
        'extra_data_json' => 'permit_empty|string',
        'quantity' => 'required|integer',
        'price_snapshot' => 'required|decimal',
    ];

    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    protected array $casts = [
        'quantity' => 'integer',
        'price_snapshot' => 'float',
        'extra_data_json' => 'json',
    ];

    public function getByOrderItemId(int $orderItemId)
    {
        return $this->where('order_item_id', $orderItemId)->findAll();
    }
}
