<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\OrderModel;
use App\Models\OrderItemModel;

class Orders extends BaseController
{
    protected $orderModel;
    protected $orderItemModel;
    protected $perPage = 15;

    public function __construct()
    {
        $this->orderModel = new OrderModel();
        $this->orderItemModel = new OrderItemModel();
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
            $query = $query->groupStart()
                ->like('id', $search)
                ->orLike('customer_notes', $search)
                ->groupEnd();
        }

        $orders = $query->orderBy('created_at', 'DESC')
            ->paginate($this->perPage, 'orders');

        return view('admin/orders/index', [
            'orders' => $orders,
            'pager' => $this->orderModel->pager,
            'currentStatus' => $status,
            'searchQuery' => $search,
            'statuses' => ['Pending', 'In Progress', 'Completed', 'Cancelled'],
        ]);
    }

    /**
     * Display detailed order information with items and addons
     */
    public function show($id)
    {
        $order = $this->orderModel->find($id);

        if (!$order) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // Get order items with addons
        $items = $this->orderItemModel
            ->select('order_items.*, products.name as product_name, products.price, products.unit')
            ->join('products', 'products.id = order_items.product_id')
            ->where('order_items.order_id', $id)
            ->findAll();

        // Parse addons for each item
        foreach ($items as $item) {
            $item->addons = !empty($item->order_items_addons) ? json_decode($item->order_items_addons, true) : [];
        }

        return view('admin/orders/detail', [
            'order' => $order,
            'items' => $items,
            'statuses' => ['Pending', 'In Progress', 'Completed', 'Cancelled'],
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
        $validStatuses = ['Pending', 'In Progress', 'Completed', 'Cancelled'];

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
