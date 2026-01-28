<?php

namespace App\Models\Order;

use CodeIgniter\Model;

class UserCartItemModel extends Model
{
    protected $table = 'user_cart_items';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['cart_id', 'product_id', 'service_id', 'quantity'];

    protected $useTimestamps = false;
    protected $createdField = null;
    protected $updatedField = null;
    protected $deletedField = null;

    protected $validationRules = [
        'cart_id' => 'required|integer',
        'product_id' => 'permit_empty|integer',
        'service_id' => 'permit_empty|integer',
        'quantity' => 'required|integer',
    ];

    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    protected array $casts = [
        'quantity' => 'integer',
    ];

    public function getByCartId(int $cartId)
    {
        return $this->where('cart_id', $cartId)->findAll();
    }
}
