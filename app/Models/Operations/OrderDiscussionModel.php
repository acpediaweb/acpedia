<?php

namespace App\Models\Operations;

use CodeIgniter\Model;

class OrderDiscussionModel extends Model
{
    protected $table = 'order_discussion';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $useSoftDeletes = false;
    protected array $allowedFields = ['order_id', 'actor_user_id', 'message_text', 'is_system_message', 'message_timestamp'];

    protected $useTimestamps = false;
    protected $createdField = null;
    protected $updatedField = null;
    protected $deletedField = null;

    protected $validationRules = [
        'order_id' => 'required|integer',
        'actor_user_id' => 'permit_empty|integer',
        'message_text' => 'required|string',
        'is_system_message' => 'permit_empty|in_list[0,1]',
        'message_timestamp' => 'permit_empty|valid_date',
    ];

    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    protected array $casts = [
        'is_system_message' => 'boolean',
    ];

    public function getByOrderId(int $orderId)
    {
        return $this->where('order_id', $orderId)->orderBy('message_timestamp', 'ASC')->findAll();
    }

    public function getUserMessages(int $orderId, int $userId)
    {
        return $this->where('order_id', $orderId)->where('actor_user_id', $userId)->findAll();
    }
}
