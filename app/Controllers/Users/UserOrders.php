<?php

namespace App\Controllers\Users;

use App\Controllers\BaseController;
use App\Models\UserOrderModel;

class UserOrders extends BaseController
{
    protected $orderModel;

    public function __construct()
    {
        $this->orderModel = new UserOrderModel();
    }

    /**
     * List user orders
     */
    public function list()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('login')->with('error', 'Please login first');
        }

        $userId = session()->get('user_id');

        // Fetch orders
        $orders = $this->orderModel
            ->where('user_id', $userId)
            ->orderBy('created_at', 'DESC')
            ->paginate(10);

        $data = [
            'title'      => 'My Orders',
            'orders'     => $orders,
            'pager'      => $this->orderModel->pager
        ];

        return view('users/orders/list', $data);
    }

    /**
     * Show order detail
     */
    public function detail($id)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('login');
        }

        $userId = session()->get('user_id');
        
        // Fetch order and verify ownership
        $order = $this->orderModel
            ->where('id', $id)
            ->where('user_id', $userId)
            ->first();

        if (!$order) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // Get detailed order info
        $orderWithDetails = $this->orderModel->getWithDetails($id);

        $data = [
            'title' => 'Order #' . $order->id,
            'order' => $orderWithDetails
        ];

        return view('users/orders/detail', $data);
    }
}
