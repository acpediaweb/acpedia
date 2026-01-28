<?php

namespace App\Models;

use CodeIgniter\Model;

class UserNotificationModel extends Model
{
    protected $table            = 'user_notifications';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $allowedFields    = [
        'user_id', 'notification_title', 'notification_message', 
        'is_read', 'is_pushed'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Mark notification as read
     */
    public function markAsRead($notifId)
    {
        return $this->update($notifId, ['is_read' => true]);
    }

    /**
     * Get unread count for user
     */
    public function getUnreadCount($userId)
    {
        return $this->where('user_id', $userId)
            ->where('is_read', false)
            ->countAllResults();
    }
}
