<?php

namespace App\Controllers\Inventory;

use App\Controllers\BaseController;
use App\Models\Inventory\InventoryModel;
use App\Models\Inventory\ProductModel;

class InventoryController extends BaseController
{
    protected $inventoryModel;
    protected $productModel;

    public function __construct()
    {
        $this->inventoryModel = new InventoryModel();
        $this->productModel = new ProductModel();
    }

    public function index()
    {
        $inventory = $this->inventoryModel->findAll();
        return view('inventory/inventory/index', ['inventory' => $inventory]);
    }

    public function create()
    {
        $products = $this->productModel->findAll();
        return view('inventory/inventory/create', ['products' => $products]);
    }

    public function store()
    {
        $data = [
            'product_id' => $this->request->getPost('product_id'),
            'item_type' => $this->request->getPost('item_type'),
            'item_serial_number' => $this->request->getPost('item_serial_number'),
            'item_barcode' => $this->request->getPost('item_barcode'),
            'item_notes' => $this->request->getPost('item_notes'),
        ];

        if ($this->inventoryModel->insert($data)) {
            return redirect()->to('/inventory')->with('success', 'Inventory item created successfully');
        }

        return redirect()->back()->with('error', 'Failed to create inventory item');
    }

    public function edit($id)
    {
        $item = $this->inventoryModel->find($id);
        $products = $this->productModel->findAll();
        return view('inventory/inventory/edit', ['item' => $item, 'products' => $products]);
    }

    public function update($id)
    {
        $data = [
            'product_id' => $this->request->getPost('product_id'),
            'item_type' => $this->request->getPost('item_type'),
            'item_serial_number' => $this->request->getPost('item_serial_number'),
            'item_barcode' => $this->request->getPost('item_barcode'),
            'item_notes' => $this->request->getPost('item_notes'),
        ];

        if ($this->inventoryModel->update($id, $data)) {
            return redirect()->to('/inventory')->with('success', 'Inventory item updated successfully');
        }

        return redirect()->back()->with('error', 'Failed to update inventory item');
    }

    public function delete($id)
    {
        if ($this->inventoryModel->delete($id)) {
            return redirect()->to('/inventory')->with('success', 'Inventory item deleted successfully');
        }

        return redirect()->back()->with('error', 'Failed to delete inventory item');
    }

    public function show($id)
    {
        $item = $this->inventoryModel->find($id);
        return view('inventory/inventory/show', ['item' => $item]);
    }
}
