<?php

namespace App\Controllers\Catalog;

use App\Controllers\BaseController;
use App\Models\Catalog\CategoryModel;

class CategoryController extends BaseController
{
    protected $categoryModel;

    public function __construct()
    {
        $this->categoryModel = new CategoryModel();
    }

    public function index()
    {
        $categories = $this->categoryModel->findAll();
        return view('catalog/categories/index', ['categories' => $categories]);
    }

    public function create()
    {
        return view('catalog/categories/create');
    }

    public function store()
    {
        $data = [
            'category_name' => $this->request->getPost('category_name'),
            'category_description' => $this->request->getPost('category_description'),
            'icon' => $this->request->getPost('icon'),
        ];

        if ($this->categoryModel->insert($data)) {
            return redirect()->to('/categories')->with('success', 'Category created successfully');
        }

        return redirect()->back()->with('error', 'Failed to create category');
    }

    public function edit($id)
    {
        $category = $this->categoryModel->find($id);
        return view('catalog/categories/edit', ['category' => $category]);
    }

    public function update($id)
    {
        $data = [
            'category_name' => $this->request->getPost('category_name'),
            'category_description' => $this->request->getPost('category_description'),
            'icon' => $this->request->getPost('icon'),
        ];

        if ($this->categoryModel->update($id, $data)) {
            return redirect()->to('/categories')->with('success', 'Category updated successfully');
        }

        return redirect()->back()->with('error', 'Failed to update category');
    }

    public function delete($id)
    {
        if ($this->categoryModel->delete($id)) {
            return redirect()->to('/categories')->with('success', 'Category deleted successfully');
        }

        return redirect()->back()->with('error', 'Failed to delete category');
    }
}
