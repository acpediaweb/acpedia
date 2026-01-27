<?php

namespace App\Models;

use CodeIgniter\Model;

class InventoryModel extends Model
{
    protected $table            = 'inventory';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'product_name', 'product_id', 'item_type', 'item_serial_number', 
        'item_barcode', 'item_notes', 'bound_to_user_id', 'bound_to_user_address_id'
    ];

    /**
     * Get stock count grouped by product and type
     */
    public function getStockSummary($productId)
    {
        return $this->select('item_type, COUNT(id) as total')
                    ->where('product_id', $productId)
                    ->where('bound_to_user_id', null) // Only unsold items
                    ->groupBy('item_type')
                    ->findAll();
    }

    /**
     * Generate a unique barcode automatically before inserting
     */
    public function createItem(array $data)
    {
        if (empty($data['item_barcode'])) {
            // Generate a barcode: AC-PROD-TYPE-RANDOM
            $data['item_barcode'] = 'AC-' . ($data['product_id'] ?? '0') . '-' . strtoupper(substr($data['item_type'], 0, 3)) . '-' . strtoupper(bin2hex(random_bytes(3)));
        }
        
        if (empty($data['item_serial_number'])) {
            $data['item_serial_number'] = 'SN-' . strtoupper(bin2hex(random_bytes(5)));
        }

        return $this->insert($data);
    }
}