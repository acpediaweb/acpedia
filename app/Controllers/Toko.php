<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductModel;

class Toko extends BaseController
{
    protected $productModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
    }

    // Displays the main shop page
    public function index()
    {
        return view('frontpage/toko-kami');
    }

    // API Endpoint called by dodijs.js
    public function apiList()
    {
        $request = service('request');

        // Collect filters from GET request (sent by JS)
        $filters = [
            'brands'   => $request->getGet('brands'), // Expecting array or string
            'pk'       => $request->getGet('pk'),
            'type'     => $request->getGet('type'),
            'category' => $request->getGet('category'),
            'search'   => $request->getGet('search'),
            'sort'     => $request->getGet('sort'),
        ];

        $data = $this->productModel->getFilteredProducts($filters);

        return $this->response->setJSON($data);
    }
}