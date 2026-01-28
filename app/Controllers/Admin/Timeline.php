<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\InventoryLogModel;
use App\Models\InventoryModel;

class Timeline extends BaseController
{
    protected $logModel;
    protected $inventoryModel;
    protected $perPage = 25;

    public function __construct()
    {
        $this->logModel = new InventoryLogModel();
        $this->inventoryModel = new InventoryModel();
    }

    /**
     * List all inventory logs with filters
     */
    public function index()
    {
        $page = $this->request->getVar('page') ?? 1;
        $inventory = $this->request->getVar('inventory') ?? '';
        $action = $this->request->getVar('action') ?? '';

        $query = $this->logModel;

        if (!empty($inventory)) {
            $query = $query->where('inventory_id', $inventory);
        }

        if (!empty($action)) {
            $query = $query->where('action', $action);
        }

        $logs = $query->orderBy('created_at', 'DESC')
            ->paginate($this->perPage, 'timeline');

        return view('admin/timeline/index', [
            'logs' => $logs,
            'pager' => $this->logModel->pager,
            'selectedInventory' => $inventory,
            'selectedAction' => $action,
        ]);
    }

    /**
     * Show timeline for specific inventory item
     */
    public function show($id)
    {
        $item = $this->inventoryModel
            ->select('inventory.*, products.name as product_name')
            ->join('products', 'products.id = inventory.product_id', 'left')
            ->where('inventory.id', $id)
            ->first();

        if (!$item) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $logs = $this->logModel
            ->where('inventory_id', $id)
            ->orderBy('created_at', 'DESC')
            ->findAll();

        return view('admin/timeline/detail', [
            'item' => $item,
            'logs' => $logs,
        ]);
    }
}
