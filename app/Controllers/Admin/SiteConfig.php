<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class SiteConfig extends BaseController
{
    /**
     * Display site configuration (placeholder)
     */
    public function index()
    {
        return view('admin/config/index', [
            'configs' => [],
        ]);
    }

    /**
     * Save site configuration
     */
    public function save()
    {
        return redirect()->to('admin/config')
            ->with('success', 'Configuration saved successfully');
    }
}
