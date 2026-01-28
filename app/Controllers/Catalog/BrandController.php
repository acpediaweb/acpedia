<?php

namespace App\Controllers\Catalog;

use App\Controllers\BaseController;
use App\Models\Catalog\BrandModel;

class BrandController extends BaseController
{
    protected $brandModel;

    public function __construct()
    {
        $this->brandModel = new BrandModel();
    }

    public function index()
    {
        $brands = $this->brandModel->findAll();
        return view('catalog/brands/index', ['brands' => $brands]);
    }

    public function create()
    {
        return view('catalog/brands/create');
    }

    public function store()
    {
        $data = [
            'brand_name' => $this->request->getPost('brand_name'),
            'brand_description' => $this->request->getPost('brand_description'),
            'logo' => $this->request->getPost('logo'),
        ];

        if ($this->brandModel->insert($data)) {
            return redirect()->to('/brands')->with('success', 'Brand created successfully');
        }

        return redirect()->back()->with('error', 'Failed to create brand');
    }

    public function edit($id)
    {
        $brand = $this->brandModel->find($id);
        return view('catalog/brands/edit', ['brand' => $brand]);
    }

    public function update($id)
    {
        $data = [
            'brand_name' => $this->request->getPost('brand_name'),
            'brand_description' => $this->request->getPost('brand_description'),
            'logo' => $this->request->getPost('logo'),
        ];

        if ($this->brandModel->update($id, $data)) {
            return redirect()->to('/brands')->with('success', 'Brand updated successfully');
        }

        return redirect()->back()->with('error', 'Failed to update brand');
    }

    public function delete($id)
    {
        if ($this->brandModel->delete($id)) {
            return redirect()->to('/brands')->with('success', 'Brand deleted successfully');
        }

        return redirect()->back()->with('error', 'Failed to delete brand');
    }
}
