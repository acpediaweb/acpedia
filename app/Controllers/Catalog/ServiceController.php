<?php

namespace App\Controllers\Catalog;

use App\Controllers\BaseController;
use App\Models\Catalog\ServiceModel;
use App\Models\Catalog\TypeModel;
use App\Models\Catalog\ServicePriceModel;

class ServiceController extends BaseController
{
    protected $serviceModel;
    protected $typeModel;
    protected $servicePriceModel;

    public function __construct()
    {
        $this->serviceModel = new ServiceModel();
        $this->typeModel = new TypeModel();
        $this->servicePriceModel = new ServicePriceModel();
    }

    public function index()
    {
        $services = $this->serviceModel->findAll();
        return view('catalog/services/index', ['services' => $services]);
    }

    public function create()
    {
        $types = $this->typeModel->findAll();
        return view('catalog/services/create', ['types' => $types]);
    }

    public function store()
    {
        $data = [
            'service_title' => $this->request->getPost('service_title'),
            'service_description' => $this->request->getPost('service_description'),
            'base_price' => $this->request->getPost('base_price'),
        ];

        if ($this->serviceModel->insert($data)) {
            return redirect()->to('/services')->with('success', 'Service created successfully');
        }

        return redirect()->back()->with('error', 'Failed to create service');
    }

    public function edit($id)
    {
        $service = $this->serviceModel->find($id);
        $types = $this->typeModel->findAll();
        $prices = $this->servicePriceModel->getByServiceId($id);
        return view('catalog/services/edit', ['service' => $service, 'types' => $types, 'prices' => $prices]);
    }

    public function update($id)
    {
        $data = [
            'service_title' => $this->request->getPost('service_title'),
            'service_description' => $this->request->getPost('service_description'),
            'base_price' => $this->request->getPost('base_price'),
        ];

        if ($this->serviceModel->update($id, $data)) {
            return redirect()->to('/services')->with('success', 'Service updated successfully');
        }

        return redirect()->back()->with('error', 'Failed to update service');
    }

    public function delete($id)
    {
        if ($this->serviceModel->delete($id)) {
            return redirect()->to('/services')->with('success', 'Service deleted successfully');
        }

        return redirect()->back()->with('error', 'Failed to delete service');
    }
}
