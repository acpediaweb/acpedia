<?php

namespace App\Controllers\System;

use App\Controllers\BaseController;
use App\Models\System\SiteConfigurationModel;

class ConfigurationController extends BaseController
{
    protected $configModel;

    public function __construct()
    {
        $this->configModel = new SiteConfigurationModel();
    }

    public function index()
    {
        $configs = $this->configModel->getAllConfigs();
        return view('system/configuration/index', ['configs' => $configs]);
    }

    public function edit($id)
    {
        $config = $this->configModel->find($id);
        return view('system/configuration/edit', ['config' => $config]);
    }

    public function update($id)
    {
        $data = [
            'config_value' => $this->request->getPost('config_value'),
        ];

        if ($this->configModel->update($id, $data)) {
            return redirect()->to('/configuration')->with('success', 'Configuration updated successfully');
        }

        return redirect()->back()->with('error', 'Failed to update configuration');
    }
}
