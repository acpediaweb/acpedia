<?php 
namespace App\Controllers;
use App\Models\ProductModel

class Toko extends BaseController
{
    public function index()
    {
        $model = new ProductModel();
        $data['products'] = $model->findAll();
        return view('frontpage/toko-kami', $data);
    }
}