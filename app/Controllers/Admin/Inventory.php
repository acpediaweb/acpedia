<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\InventoryModel;
use App\Models\ProductModel;
use App\Models\BrandModel;
use App\Models\ProductTypeModel;

class Inventory extends BaseController
{
    protected $inventoryModel;
    protected $productModel;
    protected $brandModel;
    protected $typeModel;
    protected $perPage = 20;

    public function __construct()
    {
        $this->inventoryModel = new InventoryModel();
        $this->productModel = new ProductModel();
        $this->brandModel = new BrandModel();
        $this->typeModel = new ProductTypeModel();
    }

    /**
     * List all inventory items with filters
     */
    public function index()
    {
        $page = $this->request->getVar('page') ?? 1;
        $product = $this->request->getVar('product') ?? '';
        $brand = $this->request->getVar('brand') ?? '';
        $type = $this->request->getVar('type') ?? '';
        $itemsPerPage = $this->request->getVar('items_per_page') ?? 20;

        $query = $this->inventoryModel
            ->select('inventory.*, products.name as product_name, brands.name as brand_name, product_types.name as type_name')
            ->join('products', 'products.id = inventory.product_id', 'left')
            ->join('brands', 'brands.id = products.brand_id', 'left')
            ->join('product_types', 'product_types.id = products.product_type_id', 'left');

        // Apply filters
        if (!empty($product)) {
            $query = $query->where('inventory.product_id', $product);
        }

        if (!empty($brand)) {
            $query = $query->where('brands.id', $brand);
        }

        if (!empty($type)) {
            $query = $query->where('product_types.id', $type);
        }

        $items = $query->orderBy('inventory.created_at', 'DESC')
            ->paginate((int)$itemsPerPage, 'inventory');

        return view('admin/inventory/index', [
            'items' => $items,
            'pager' => $this->inventoryModel->pager,
            'selectedProduct' => $product,
            'selectedBrand' => $brand,
            'selectedType' => $type,
            'itemsPerPage' => $itemsPerPage,
            'products' => $this->productModel->findAll(),
            'brands' => $this->brandModel->findAll(),
            'types' => $this->typeModel->findAll(),
        ]);
    }

    /**
     * Show inventory item details
     */
    public function show($id)
    {
        $item = $this->inventoryModel
            ->select('inventory.*, products.name as product_name, products.price, products.unit, brands.name as brand_name')
            ->join('products', 'products.id = inventory.product_id', 'left')
            ->join('brands', 'brands.id = products.brand_id', 'left')
            ->where('inventory.id', $id)
            ->first();

        if (!$item) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('admin/inventory/detail', [
            'item' => $item,
        ]);
    }

    /**
     * Bind inventory item to user and address (install)
     */
    public function bind($id)
    {
        $item = $this->inventoryModel->find($id);
        if (!$item) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Item not found'
            ])->setStatusCode(404);
        }

        $userId = $this->request->getPost('user_id');
        $addressId = $this->request->getPost('address_id');

        $this->inventoryModel->update($id, [
            'assigned_to_user_id' => $userId,
            'assigned_to_address_id' => $addressId,
            'assigned_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to('admin/inventory/' . $id)
            ->with('success', 'Item assigned successfully');
    }

    /**
     * Unbind inventory item from user (uninstall)
     */
    public function unbind($id)
    {
        $item = $this->inventoryModel->find($id);
        if (!$item) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Item not found'
            ])->setStatusCode(404);
        }

        $this->inventoryModel->update($id, [
            'assigned_to_user_id' => null,
            'assigned_to_address_id' => null,
            'unassigned_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to('admin/inventory/' . $id)
            ->with('success', 'Item unassigned successfully');
    }
}
