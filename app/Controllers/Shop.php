<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Shop extends BaseController
{
    protected $productModel;
    protected $categoryModel;
    protected $brandModel;

    public function __construct()
    {
        $this->productModel = new \App\Models\Inventory\ProductModel();
        $this->categoryModel = new \App\Models\Catalog\CategoryModel();
        $this->brandModel = new \App\Models\Catalog\BrandModel();
    }

    /**
     * Display shop/e-commerce storefront
     * Route: /toko-kami
     */
    public function index()
    {
        // 1. Get Filter Inputs
        $page = (int)($this->request->getGet('page') ?? 1);
        $perPage = 12;
        
        $search = $this->request->getGet('search');
        $categorySlug = $this->request->getGet('category'); // Assuming slug or ID passed
        $brandId = $this->request->getGet('brand');
        $minPrice = $this->request->getGet('min_price');
        $maxPrice = $this->request->getGet('max_price');

        // 2. Prepare Base Query with Inventory Count
        // We select product data AND a subquery for the stock count
        $this->productModel->select('products.*, brands.brand_name, categories.category_name, (
            SELECT COUNT(*) 
            FROM inventory 
            WHERE inventory.product_id = products.id 
            AND inventory.bound_to_user_id IS NULL
        ) as available_stock');

        // Join with brands and categories for display/filtering names if needed
        $this->productModel->join('brands', 'brands.id = products.brand_id', 'left');
        $this->productModel->join('categories', 'categories.id = products.category_id', 'left');

        // 3. Apply Filters
        
        // Filter by Search (Name)
        if ($search) {
            $this->productModel->groupStart()
                ->like('products.product_name', $search)
                ->orLike('products.product_description', $search)
                ->groupEnd();
        }

        // Filter by Category
        if ($categorySlug) {
            // If passing ID directly:
            if (is_numeric($categorySlug)) {
                $this->productModel->where('products.category_id', $categorySlug);
            } else {
                // If passing slug, presumably joined table or lookup needed. 
                // Using join for simpler filtering:
                $this->productModel->where('categories.category_name', $categorySlug); 
            }
        }

        // Filter by Brand
        if ($brandId) {
            $this->productModel->where('products.brand_id', $brandId);
        }

        // Filter by Price Range
        if ($minPrice) {
            $this->productModel->where('products.base_price >=', $minPrice);
        }
        if ($maxPrice) {
            $this->productModel->where('products.base_price <=', $maxPrice);
        }

        // 4. Custom Pagination Logic
        // paginate() automatically uses the 'page' query param
        $products = $this->productModel->paginate($perPage, 'shop');
        $pager = $this->productModel->pager;

        // Fetch filter data for sidebar
        $categories = $this->categoryModel->findAll();
        $brands = $this->brandModel->findAll();

        $data = [
            'title' => 'ACPedia - Toko Kami',
            'page' => 'shop',
            'products' => $products,
            'pager' => $pager,
            'categories' => $categories,
            'brands' => $brands,
            // Pass back current filters to view to keep inputs filled
            'filters' => [
                'search' => $search,
                'category' => $categorySlug,
                'brand' => $brandId,
                'min_price' => $minPrice,
                'max_price' => $maxPrice,
            ]
        ];

        return view('shop/index', $data);
    }
}