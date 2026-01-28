<?php

namespace App\Models\Order;

use CodeIgniter\Model;

class UserCartItemAddonModel extends Model
{
    protected $table = 'user_cart_item_addons';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['cart_item_id', 'pipe_id', 'addon_id', 'extra_data_json', 'quantity'];

    protected $useTimestamps = false;
    protected $createdField = null;
    protected $updatedField = null;
    protected $deletedField = null;

    protected $validationRules = [
        'cart_item_id' => 'required|integer',
        'pipe_id' => 'permit_empty|integer',
        'addon_id' => 'permit_empty|integer',
        'extra_data_json' => 'permit_empty|string',
        'quantity' => 'required|integer',
    ];

    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    protected array $casts = [
        'quantity' => 'integer',
        'extra_data_json' => 'json',
    ];

    public function getByCartItemId(int $cartItemId)
    {
        return $this->where('cart_item_id', $cartItemId)->findAll();
    }
}
