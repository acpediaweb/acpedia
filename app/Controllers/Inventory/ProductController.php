<?php

namespace App\Controllers\Inventory;

use App\Controllers\BaseController;
use App\Models\Inventory\ProductModel;
use App\Models\Catalog\CategoryModel;
use App\Models\Catalog\BrandModel;
use App\Models\Catalog\TypeModel;
use App\Models\Catalog\PKCategoryModel;

class ProductController extends BaseController
{
    protected $productModel;
    protected $categoryModel;
    protected $brandModel;
    protected $typeModel;
    protected $pkCategoryModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
        $this->categoryModel = new CategoryModel();
        $this->brandModel = new BrandModel();
        $this->typeModel = new TypeModel();
        $this->pkCategoryModel = new PKCategoryModel();
    }

    public function index()
    {
        $products = $this->productModel->findAll();
        return view('inventory/products/index', ['products' => $products]);
    }

    public function create()
    {
        $categories = $this->categoryModel->findAll();
        $brands = $this->brandModel->findAll();
        $types = $this->typeModel->findAll();
        $pkCategories = $this->pkCategoryModel->findAll();
        return view('inventory/products/create', [
            'categories' => $categories,
            'brands' => $brands,
            'types' => $types,
            'pkCategories' => $pkCategories,
        ]);
    }

    public function store()
    {
        $mainImage = $this->request->getFile('main_image');
        $mainImageName = '';

        if ($mainImage && $mainImage->isValid() && !$mainImage->hasMoved()) {
            $mainImageName = $mainImage->getRandomName();
            $mainImage->move('uploads/products', $mainImageName);
        }

        $data = [
            'product_name' => $this->request->getPost('product_name'),
            'product_description' => $this->request->getPost('product_description'),
            'slug' => url_title($this->request->getPost('product_name'), '-', true),
            'base_price' => $this->request->getPost('base_price'),
            'sale_price' => $this->request->getPost('sale_price'),
            'category_id' => $this->request->getPost('category_id'),
            'type_id' => $this->request->getPost('type_id'),
            'brand_id' => $this->request->getPost('brand_id'),
            'pk_category_id' => $this->request->getPost('pk_category_id'),
            'main_image' => $mainImageName,
        ];

        if ($this->productModel->insert($data)) {
            return redirect()->to('/products')->with('success', 'Product created successfully');
        }

        return redirect()->back()->with('error', 'Failed to create product');
    }

    public function edit($id)
    {
        $product = $this->productModel->find($id);
        $categories = $this->categoryModel->findAll();
        $brands = $this->brandModel->findAll();
        $types = $this->typeModel->findAll();
        $pkCategories = $this->pkCategoryModel->findAll();
        return view('inventory/products/edit', [
            'product' => $product,
            'categories' => $categories,
            'brands' => $brands,
            'types' => $types,
            'pkCategories' => $pkCategories,
        ]);
    }

    public function update($id)
    {
        $data = [
            'product_name' => $this->request->getPost('product_name'),
            'product_description' => $this->request->getPost('product_description'),
            'base_price' => $this->request->getPost('base_price'),
            'sale_price' => $this->request->getPost('sale_price'),
            'category_id' => $this->request->getPost('category_id'),
            'type_id' => $this->request->getPost('type_id'),
            'brand_id' => $this->request->getPost('brand_id'),
            'pk_category_id' => $this->request->getPost('pk_category_id'),
        ];

        if ($this->productModel->update($id, $data)) {
            return redirect()->to('/products')->with('success', 'Product updated successfully');
        }

        return redirect()->back()->with('error', 'Failed to update product');
    }

    public function delete($id)
    {
        if ($this->productModel->delete($id)) {
            return redirect()->to('/products')->with('success', 'Product deleted successfully');
        }

        return redirect()->back()->with('error', 'Failed to delete product');
    }

    public function show($id)
    {
        $product = $this->productModel->find($id);
        return view('inventory/products/show', ['product' => $product]);
    }
}
