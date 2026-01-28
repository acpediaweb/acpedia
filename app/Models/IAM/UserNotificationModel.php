<?php

namespace App\Models\IAM;

use CodeIgniter\Model;

class UserNotificationModel extends Model
{
    protected $table = 'user_notifications';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $useSoftDeletes = false;
    protected array $allowedFields = ['user_id', 'notification_title', 'notification_message', 'is_read', 'is_pushed'];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = null;
    protected $deletedField = null;

    protected $validationRules = [
        'user_id' => 'required|integer',
        'notification_title' => 'required|min_length[1]|max_length[100]',
        'notification_message' => 'permit_empty|string',
        'is_read' => 'permit_empty|in_list[0,1]',
        'is_pushed' => 'permit_empty|in_list[0,1]',
    ];

    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    protected array $casts = [
        'is_read' => 'boolean',
        'is_pushed' => 'boolean',
    ];

    public function getByUserId(int $userId)
    {
        return $this->where('user_id', $userId)->orderBy('created_at', 'DESC')->findAll();
    }

    public function getUnreadByUserId(int $userId)
    {
        return $this->where('user_id', $userId)->where('is_read', false)->findAll();
    }

    public function markAsRead(int $notificationId)
    {
        return $this->update($notificationId, ['is_read' => true]);
    }
}
