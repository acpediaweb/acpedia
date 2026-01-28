<?php

namespace App\Models\Order;

use CodeIgniter\Model;

class UserCartModel extends Model
{
    protected $table = 'user_cart';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['user_id', 'faktur_requested', 'scheduled_datetime'];

    protected $useTimestamps = false;
    protected $createdField = null;
    protected $updatedField = null;
    protected $deletedField = null;

    protected $validationRules = [
        'user_id' => 'required|integer',
        'faktur_requested' => 'permit_empty|in_list[0,1]',
        'scheduled_datetime' => 'permit_empty|valid_date',
    ];

    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    protected $casts = [
        'faktur_requested' => 'boolean',
    ];
    protected $castHandlers = [];

    public function getByUserId(int $userId)
    {
        return $this->where('user_id', $userId)->first();
    }
}
