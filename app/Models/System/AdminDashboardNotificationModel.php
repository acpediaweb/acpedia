<?php

namespace App\Models\System;

use CodeIgniter\Model;

class AdminDashboardNotificationModel extends Model
{
    protected $table = 'admin_dashboard_notifications';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['notification_title', 'notification_message', 'is_read', 'is_pushed'];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = null;
    protected $deletedField = null;

    protected $validationRules = [
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

    public function getUnread()
    {
        return $this->where('is_read', false)->orderBy('created_at', 'DESC')->findAll();
    }

    public function markAsRead(int $notificationId)
    {
        return $this->update($notificationId, ['is_read' => true]);
    }

    public function getRecentNotifications(int $limit = 20)
    {
        return $this->orderBy('created_at', 'DESC')->limit($limit)->findAll();
    }
}
