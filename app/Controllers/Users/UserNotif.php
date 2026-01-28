<?php

namespace App\Controllers\Users;

use App\Controllers\BaseController;
use App\Models\UserNotificationModel;

class UserNotif extends BaseController
{
    protected $notifModel;

    public function __construct()
    {
        $this->notifModel = new UserNotificationModel();
    }

    /**
     * List all notifications
     */
    public function index()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('login')->with('error', 'Please login first');
        }

        $userId = session()->get('user_id');

        // Fetch notifications (including read and pushed)
        $notifications = $this->notifModel
            ->where('user_id', $userId)
            ->orderBy('created_at', 'DESC')
            ->paginate(20);

        $data = [
            'title'           => 'Notifications',
            'notifications'   => $notifications,
            'pager'           => $this->notifModel->pager
        ];

        return view('users/notification/index', $data);
    }

    /**
     * Mark notification as read
     */
    public function markAsRead($id)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('login');
        }

        $userId = session()->get('user_id');
        $notif = $this->notifModel
            ->where('id', $id)
            ->where('user_id', $userId)
            ->first();

        if (!$notif) {
            return redirect()->back()->with('error', 'Notification not found');
        }

        $this->notifModel->markAsRead($id);

        return redirect()->back()->with('success', 'Notification marked as read');
    }
}
