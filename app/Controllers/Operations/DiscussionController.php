<?php

namespace App\Controllers\Operations;

use App\Controllers\BaseController;
use App\Models\Operations\OrderDiscussionModel;
use App\Models\Order\OrderModel;

class DiscussionController extends BaseController
{
    protected $discussionModel;
    protected $orderModel;

    public function __construct()
    {
        $this->discussionModel = new OrderDiscussionModel();
        $this->orderModel = new OrderModel();
    }

    public function index($orderId)
    {
        $order = $this->orderModel->find($orderId);
        $messages = $this->discussionModel->getByOrderId($orderId);
        return view('operations/discussion/index', ['order' => $order, 'messages' => $messages]);
    }

    public function addMessage($orderId)
    {
        if (!session()->has('user_id')) {
            return redirect()->to('/auth/login');
        }

        $data = [
            'order_id' => $orderId,
            'actor_user_id' => session()->get('user_id'),
            'message_text' => $this->request->getPost('message_text'),
            'message_timestamp' => date('Y-m-d H:i:s'),
        ];

        if ($this->discussionModel->insert($data)) {
            return redirect()->back()->with('success', 'Message sent successfully');
        }

        return redirect()->back()->with('error', 'Failed to send message');
    }
}
