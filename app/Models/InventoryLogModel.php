<?php

namespace App\Models;

use CodeIgniter\Model;

class InventoryLogModel extends Model
{
    protected $table            = 'inventory_logs';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $allowedFields    = [
        'inventory_id', 'action_title', 'action_description', 
        'action_timestamp', 'action_actor'
    ];

    protected $useTimestamps = false;

    /**
     * Get logs for an inventory item with actor details
     */
    public function getWithActor($inventoryId)
    {
        return $this->select('inventory_logs.*, users.fullname as actor_name')
            ->join('users', 'users.id = inventory_logs.action_actor', 'left')
            ->where('inventory_logs.inventory_id', $inventoryId)
            ->orderBy('inventory_logs.action_timestamp', 'DESC')
            ->findAll();
    }
}
