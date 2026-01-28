<?php

namespace App\Models\Inventory;

use CodeIgniter\Model;

class InventoryModel extends Model
{
    protected $table = 'inventory';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['product_id', 'item_type', 'item_serial_number', 'item_barcode', 'item_notes', 'bound_to_user_id', 'bound_to_user_address_id'];

    protected $useTimestamps = false;
    protected $createdField = null;
    protected $updatedField = null;
    protected $deletedField = null;

    protected $validationRules = [
        'product_id' => 'required|integer',
        'item_type' => 'required|in_list[Indoor,Outdoor]',
        'item_serial_number' => 'required|min_length[1]|max_length[100]|is_unique[inventory.item_serial_number]',
        'item_barcode' => 'required|min_length[1]|max_length[100]|is_unique[inventory.item_barcode]',
        'item_notes' => 'permit_empty|string',
        'bound_to_user_id' => 'permit_empty|integer',
        'bound_to_user_address_id' => 'permit_empty|integer',
    ];

    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    protected $casts = [];
    protected $castHandlers = [];

    public function getByProductId(int $productId)
    {
        return $this->where('product_id', $productId)->findAll();
    }

    public function getBySerialNumber(string $serialNumber)
    {
        return $this->where('item_serial_number', $serialNumber)->first();
    }

    public function getByBarcode(string $barcode)
    {
        return $this->where('item_barcode', $barcode)->first();
    }

    public function getBoundToUser(int $userId)
    {
        return $this->where('bound_to_user_id', $userId)->findAll();
    }
}
