<?php

namespace App\Models;

use CodeIgniter\Model;

class UserOrderModel extends Model
{
    protected $table            = 'orders';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $allowedFields    = [
        'user_id', 'payment_proof_url', 'require_technician', 'technician_scheduled_at',
        'technician_user_id', 'location_manager_id', 'sub_district_snapshot',
        'district_snapshot', 'city_snapshot', 'province_snapshot', 'postal_code_snapshot',
        'street_snapshot', 'total_amount_snapshot', 'order_status', 'faktur_requested',
        'invoice_status'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Get orders with related items and addons
     */
    public function getWithDetails($orderId)
    {
        $db = \Config\Database::connect();
        
        $order = $this->where('id', $orderId)->first();
        if (!$order) return null;

        // Fetch order items
        $order->items = $db->table('order_items as oi')
            ->select('oi.*, p.product_name, p.main_image')
            ->join('products as p', 'p.id = oi.product_id', 'left')
            ->where('oi.order_id', $orderId)
            ->get()
            ->getResult();

        // Fetch addons for each item
        foreach ($order->items as $item) {
            $item->addons = $db->table('order_items_addons as oia')
                ->select('oia.*, s.service_title, p.pipe_type, a.addon_name')
                ->join('services as s', 's.id = oia.service_id', 'left')
                ->join('pipes as p', 'p.id = oia.pipe_id', 'left')
                ->join('addons as a', 'a.id = oia.addon_id', 'left')
                ->where('oia.order_item_id', $item->id)
                ->get()
                ->getResult();
        }

        return $order;
    }
}
