<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductModel;
use App\Models\BrandModel;
use App\Models\PkCategoryModel;
use App\Models\TypeModel;     // Ensure you have created this model
use App\Models\CategoryModel; // Ensure you have created this model

class Toko extends BaseController
{
    protected $productModel;
    protected $brandModel;
    protected $pkCategoryModel;
    protected $typeModel;
    protected $categoryModel;

    public function __construct()
    {
        // Initialize Models
        $this->productModel    = new ProductModel();
        $this->brandModel      = new BrandModel();
        $this->pkCategoryModel = new PkCategoryModel();
        
        // Note: Ensure TypeModel and CategoryModel files exist in app/Models/
        // If they don't exist yet, run: php spark make:model TypeModel
        $this->typeModel       = new TypeModel(); 
        $this->categoryModel   = new CategoryModel();
    }

    /**
     * Displays the main shop page with dynamic filters
     */
    public function index()
    {
        // Fetch Master Data for Filters using Models
        $data = [
            'brands'        => $this->brandModel->findAll(),
            'pk_categories' => $this->pkCategoryModel->findAll(),
            'types'         => $this->typeModel->findAll(),
            'categories'    => $this->categoryModel->findAll(),
        ];

        return view('frontpage/toko-kami', $data);
    }

    /**
     * API Endpoint called by public/dodijs.js
     * Returns JSON data for the product grid
     */
    public function apiList()
    {
        $request = service('request');

        // Collect filters from GET request (sent by JS)
        $filters = [
            'brands'   => $request->getGet('brands'),
            'pk'       => $request->getGet('pk'),
            'type'     => $request->getGet('type'),
            'category' => $request->getGet('category'),
            'search'   => $request->getGet('search'),
            'sort'     => $request->getGet('sort'),
        ];

        // Call the filter logic in ProductModel
        $data = $this->productModel->getFilteredProducts($filters);

        return $this->response->setJSON($data);
    }
}