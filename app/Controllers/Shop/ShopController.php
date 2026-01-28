<?php

namespace App\Controllers\Shop;

use App\Controllers\BaseController;
use App\Models\ProductModel;

class ShopController extends BaseController
{
    public function index()
    {
        $model = new ProductModel();
        
        $data = [
            'title'    => 'Shop AC Units - HVACPRO',
            // Fetching all products with brand and category names
            'products' => $model->getWithRelations() 
        ];

        return view('Shop/index', $data);
    }
}