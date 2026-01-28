<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\OrderModel;
use App\Models\OrderItemModel;
use App\Models\UserModel;

class Orders extends BaseController
{
    protected $orderModel;
    protected $orderItemModel;
    protected $userModel;
    protected $perPage = 15;

    public function __construct()
    {
        $this->orderModel = new OrderModel();
        $this->orderItemModel = new OrderItemModel();
        $this->userModel = new UserModel();
    }

    /**
     * Display list of all orders with pagination and filters
     */
    public function index()
    {
        $page = $this->request->getVar('page') ?? 1;
        $status = $this->request->getVar('status') ?? '';
        $search = $this->request->getVar('search') ?? '';

        $query = $this->orderModel;

        // Apply filters
        if (!empty($status) && $status !== 'all') {
            $query = $query->where('order_status', $status);
        }

        if (!empty($search)) {
            $query = $query->where('id', $search);
        }

        $orders = $query->orderBy('created_at', 'DESC')
            ->paginate($this->perPage, 'orders');

        return view('admin/orders/index', [
            'orders' => $orders,
            'pager' => $this->orderModel->pager,
            'currentStatus' => $status,
            'searchQuery' => $search,
            'statuses' => ['Pending', 'Confirmed', 'Technician Assigned', 'In Progress', 'Completed', 'Cancelled'],
        ]);
    }

    /**
     * Display detailed order information with items
     */
    public function show($id)
    {
        $order = $this->orderModel->find($id);

        if (!$order) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // Get order items
        $items = $this->orderItemModel
            ->select('order_items.*, products.product_name')
            ->join('products', 'products.id = order_items.product_id', 'left')
            ->where('order_items.order_id', $id)
            ->findAll();

        $customer = null;
        if (!empty($order->user_id)) {
            $customer = $this->userModel->find($order->user_id);
        }

        return view('admin/orders/detail', [
            'order' => $order,
            'items' => $items,
            'customer' => $customer,
            'statuses' => ['Pending', 'Confirmed', 'Technician Assigned', 'In Progress', 'Completed', 'Cancelled'],
        ]);
    }

    /**
     * Update order status
     */
    public function updateStatus($id)
    {
        $order = $this->orderModel->find($id);

        if (!$order) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Order not found'
            ])->setStatusCode(404);
        }

        $status = $this->request->getPost('status');
        $validStatuses = ['Pending', 'Confirmed', 'Technician Assigned', 'In Progress', 'Completed', 'Cancelled'];

        if (!in_array($status, $validStatuses)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Invalid status'
            ])->setStatusCode(400);
        }

        $this->orderModel->update($id, ['order_status' => $status]);

        return redirect()->to('admin/orders/' . $id)
            ->with('success', 'Order status updated successfully');
    }
}
