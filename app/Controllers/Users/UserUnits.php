<?php

namespace App\Controllers\Users;

use App\Controllers\BaseController;
use App\Models\UserInventoryModel;

class UserUnits extends BaseController
{
    protected $inventoryModel;

    public function __construct()
    {
        $this->inventoryModel = new UserInventoryModel();
    }

    /**
     * List user's AC units (inventory)
     */
    public function list()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('login')->with('error', 'Please login first');
        }

        $userId = session()->get('user_id');

        // Fetch user's inventory
        $units = $this->inventoryModel->getUserInventory($userId);

        $data = [
            'title' => 'My AC Units',
            'units' => $units
        ];

        return view('users/units/list', $data);
    }

    /**
     * Show unit detail with timeline
     */
    public function detail($id)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('login');
        }

        $userId = session()->get('user_id');
        
        // Fetch unit and verify ownership
        $unit = $this->inventoryModel
            ->where('id', $id)
            ->where('bound_to_user_id', $userId)
            ->first();

        if (!$unit) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // Get product info
        $db = \Config\Database::connect();
        $product = $db->table('products')
            ->select('products.*, brands.brand_name')
            ->join('brands', 'brands.id = products.brand_id', 'left')
            ->where('products.id', $unit->product_id)
            ->first();

        // Get timeline logs
        $logs = $this->inventoryModel->getInventoryLogs($id);

        $data = [
            'title'   => 'Unit Details',
            'unit'    => $unit,
            'product' => $product,
            'logs'    => $logs
        ];

        return view('users/units/detail', $data);
    }
}
