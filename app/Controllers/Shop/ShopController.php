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
            'products' => $model->getWithRelations() 
        ];

        return view('shop/list', $data);
    }

    public function detail($slug)
{
    $model = new \App\Models\ProductModel();
    
    // Fetch product with relations (Brand, Category, PK)
    $product = $model->getWithRelations(['products.slug' => $slug]);

    if (!$product) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Product with slug $slug not found.");
    }

    $data = [
        'title'   => $product[0]->product_name . ' - HVACPRO',
        'product' => $product[0], // getWithRelations returns an array
    ];

    return view('shop/detail', $data);
}
}