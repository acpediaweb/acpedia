<?php

namespace App\Models;

use CodeIgniter\Model;

class InventoryModel extends Model
{
    protected $table = 'inventory';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $useSoftDeletes = false;
    protected $allowedFields = [
        'product_id', 'item_type', 'item_serial_number', 'item_barcode',
        'item_notes', 'bound_to_user_id', 'bound_to_user_address_id'
    ];
    protected $useTimestamps = false;
    protected $updatedField = 'updated_at';
}
