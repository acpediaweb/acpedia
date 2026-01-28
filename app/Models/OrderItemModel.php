<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderItemModel extends Model
{
    protected $table = 'order_items';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $useSoftDeletes = false;
    protected $allowedFields = [
        'order_id', 'product_id', 'quantity', 
        'base_price_snapshot', 'sale_price_snapshot'
    ];
    protected $useTimestamps = false;
}
