<?php

namespace App\Controllers\Home;

use App\Controllers\BaseController;

class HomeController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'HVACPRO | Engineering Perfect Climates',
            'hero_title' => 'Beyond Installation. Persistent Care.',
            'hero_subtitle' => 'The only HVAC provider that tracks your unit’s lifetime history from the moment it leaves our warehouse.'
        ];

        return view('Home/index', $data);
    }
}