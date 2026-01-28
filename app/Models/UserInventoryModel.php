<?php

namespace App\Models;

use CodeIgniter\Model;

class UserInventoryModel extends Model
{
    protected $table            = 'inventory';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $allowedFields    = [
        'product_id', 'item_type', 'item_serial_number', 'item_barcode',
        'item_notes', 'bound_to_user_id', 'bound_to_user_address_id'
    ];

    protected $useTimestamps = false;

    /**
     * Get user's inventory with product and timeline
     */
    public function getUserInventory($userId)
    {
        $db = \Config\Database::connect();

        return $db->table('inventory as i')
            ->select('i.*, p.product_name, p.main_image, p.brand_id, b.brand_name')
            ->join('products as p', 'p.id = i.product_id')
            ->join('brands as b', 'b.id = p.brand_id', 'left')
            ->where('i.bound_to_user_id', $userId)
            ->get()
            ->getResult();
    }

    /**
     * Get inventory timeline/logs
     */
    public function getInventoryLogs($inventoryId)
    {
        $db = \Config\Database::connect();

        return $db->table('inventory_logs as il')
            ->select('il.*, u.fullname')
            ->join('users as u', 'u.id = il.action_actor', 'left')
            ->where('il.inventory_id', $inventoryId)
            ->orderBy('il.action_timestamp', 'DESC')
            ->get()
            ->getResult();
    }
}
