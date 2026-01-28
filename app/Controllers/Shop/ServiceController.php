<?php

namespace App\Controllers\Shop;

use App\Controllers\BaseController;
use App\Models\ServiceModel;

class ServiceController extends BaseController
{
    public function index()
    {
        $serviceModel = new ServiceModel();
        
        $data = [
            'title'    => 'Our Services - HVACPRO',
            'services' => $serviceModel->findAll(),
            'addons'   => $this->getAddons(),
        ];

        return view('shop/services', $data);
    }

    private function getAddons()
    {
        $db = \Config\Database::connect();
        return $db->table('addons')->get()->getResult();
    }
}