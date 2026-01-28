<?php

namespace App\Controllers\Order;

use App\Controllers\BaseController;
use App\Models\Order\OrderModel;
use App\Models\Order\OrderItemModel;
use App\Models\Order\UserCartModel;

class OrderController extends BaseController
{
    protected $orderModel;
    protected $orderItemModel;
    protected $cartModel;

    public function __construct()
    {
        $this->orderModel = new OrderModel();
        $this->orderItemModel = new OrderItemModel();
        $this->cartModel = new UserCartModel();
    }

    public function index()
    {
        if (!session()->has('user_id')) {
            return redirect()->to('/auth/login');
        }

        $userId = session()->get('user_id');
        $orders = $this->orderModel->getByUserId($userId);
        return view('order/orders/index', ['orders' => $orders]);
    }

    public function store()
    {
        if (!session()->has('user_id')) {
            return redirect()->to('/auth/login');
        }

        $userId = session()->get('user_id');
        $data = [
            'user_id' => $userId,
            'sub_district_snapshot' => $this->request->getPost('sub_district'),
            'district_snapshot' => $this->request->getPost('district'),
            'city_snapshot' => $this->request->getPost('city'),
            'province_snapshot' => $this->request->getPost('province'),
            'postal_code_snapshot' => $this->request->getPost('postal_code'),
            'street_snapshot' => $this->request->getPost('street'),
            'total_amount_snapshot' => $this->request->getPost('total_amount'),
            'order_status' => 'Pending',
            'require_technician' => $this->request->getPost('require_technician') ? 1 : 0,
        ];

        $orderId = $this->orderModel->insert($data);
        if ($orderId) {
            return redirect()->to('/orders/' . $orderId)->with('success', 'Order created successfully');
        }

        return redirect()->back()->with('error', 'Failed to create order');
    }

    public function show($id)
    {
        $order = $this->orderModel->find($id);
        $items = $this->orderItemModel->getByOrderId($id);
        return view('order/orders/show', ['order' => $order, 'items' => $items]);
    }

    public function cancel($id)
    {
        if ($this->orderModel->update($id, ['order_status' => 'Cancelled'])) {
            return redirect()->back()->with('success', 'Order cancelled successfully');
        }

        return redirect()->back()->with('error', 'Failed to cancel order');
    }
}
