<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\ProductModel;
use App\Models\UserOrderModel;
use App\Models\UserInventoryModel;

class Dashboard extends BaseController
{
    /**
     * Admin dashboard with KPIs
     */
    public function index()
    {
        $db = \Config\Database::connect();

        // Total users (excluding admin)
        $totalUsers = $db->table('users')
            ->where('role_id !=', 1)
            ->countAllResults();

        // Total products
        $totalProducts = $db->table('products')
            ->countAllResults();

        // Total inventory items
        $totalInventory = $db->table('inventory')
            ->countAllResults();

        // Total orders
        $totalOrders = $db->table('orders')
            ->countAllResults();

        // Pending orders
        $pendingOrders = $db->table('orders')
            ->where('order_status', 'Pending')
            ->countAllResults();

        // Revenue (sum of total_amount_snapshot for completed orders)
        $revenueResult = $db->table('orders')
            ->where('order_status', 'Completed')
            ->selectSum('total_amount_snapshot')
            ->get()
            ->getRow();
        $totalRevenue = $revenueResult->total_amount_snapshot ?? 0;

        // Recent orders
        $recentOrders = $db->table('orders as o')
            ->select('o.id, o.user_id, o.total_amount_snapshot, o.order_status, o.created_at, u.fullname')
            ->join('users as u', 'u.id = o.user_id', 'left')
            ->orderBy('o.created_at', 'DESC')
            ->limit(5)
            ->get()
            ->getResult();

        // Low stock products
        $lowStockProducts = $db->table('inventory')
            ->select('products.id, products.product_name, COUNT(inventory.id) as stock_count')
            ->join('products', 'products.id = inventory.product_id')
            ->where('inventory.bound_to_user_id IS NULL')
            ->groupBy('products.id')
            ->having('stock_count <', 5)
            ->get()
            ->getResult();

        $data = [
            'title'              => 'Dashboard',
            'totalUsers'         => $totalUsers,
            'totalProducts'      => $totalProducts,
            'totalInventory'     => $totalInventory,
            'totalOrders'        => $totalOrders,
            'pendingOrders'      => $pendingOrders,
            'totalRevenue'       => $totalRevenue,
            'recentOrders'       => $recentOrders,
            'lowStockProducts'   => $lowStockProducts
        ];

        return view('admin/dashboard/index', $data);
    }
}
