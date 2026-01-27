<?php

namespace App\Models;

use CodeIgniter\Model;

class InventoryLogModel extends Model
{
    protected $table            = 'inventory_logs';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['inventory_id', 'action_title', 'action_description', 'action_actor'];
    protected $useTimestamps    = false; // We use action_timestamp from SQL default

    /**
     * Fetch the "Discussion/Timeline" for a specific unit
     */
    public function getUnitHistory($inventoryId)
    {
        return $this->select('inventory_logs.*, users.fullname as actor_name, users.profile_picture')
                    ->join('users', 'users.id = inventory_logs.action_actor', 'left')
                    ->where('inventory_id', $inventoryId)
                    ->orderBy('action_timestamp', 'DESC')
                    ->findAll();
    }
}