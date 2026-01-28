<?php

namespace App\Models\Inventory;

use CodeIgniter\Model;

class InventoryLogModel extends Model
{
    protected $table = 'inventory_logs';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['inventory_id', 'action_title', 'action_description', 'action_timestamp', 'action_actor'];

    protected $useTimestamps = false;
    protected $createdField = null;
    protected $updatedField = null;
    protected $deletedField = null;

    protected $validationRules = [
        'inventory_id' => 'required|integer',
        'action_title' => 'required|min_length[1]|max_length[100]',
        'action_description' => 'permit_empty|string',
        'action_timestamp' => 'permit_empty|valid_date',
        'action_actor' => 'permit_empty|integer',
    ];

    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    protected $casts = [];

    public function getByInventoryId(int $inventoryId)
    {
        return $this->where('inventory_id', $inventoryId)->orderBy('action_timestamp', 'DESC')->findAll();
    }

    public function getByActor(int $actorId)
    {
        return $this->where('action_actor', $actorId)->orderBy('action_timestamp', 'DESC')->findAll();
    }
}
