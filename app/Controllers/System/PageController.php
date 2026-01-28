<?php

namespace App\Controllers\System;

use App\Controllers\BaseController;
use App\Models\System\StaticPageContentModel;

class PageController extends BaseController
{
    protected $pageModel;

    public function __construct()
    {
        $this->pageModel = new StaticPageContentModel();
    }

    public function show($slug)
    {
        $page = $this->pageModel->getBySlug($slug);

        if (!$page) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Page not found');
        }

        return view('system/pages/show', ['page' => $page]);
    }

    public function index()
    {
        $pages = $this->pageModel->findAll();
        return view('system/pages/index', ['pages' => $pages]);
    }

    public function create()
    {
        return view('system/pages/create');
    }

    public function store()
    {
        $data = [
            'page_name' => $this->request->getPost('page_name'),
            'page_slug' => url_title($this->request->getPost('page_slug'), '-', true),
            'page_content' => $this->request->getPost('page_content'),
        ];

        if ($this->pageModel->insert($data)) {
            return redirect()->to('/pages')->with('success', 'Page created successfully');
        }

        return redirect()->back()->with('error', 'Failed to create page');
    }

    public function edit($id)
    {
        $page = $this->pageModel->find($id);
        return view('system/pages/edit', ['page' => $page]);
    }

    public function update($id)
    {
        $data = [
            'page_name' => $this->request->getPost('page_name'),
            'page_slug' => url_title($this->request->getPost('page_slug'), '-', true),
            'page_content' => $this->request->getPost('page_content'),
        ];

        if ($this->pageModel->update($id, $data)) {
            return redirect()->to('/pages')->with('success', 'Page updated successfully');
        }

        return redirect()->back()->with('error', 'Failed to update page');
    }

    public function delete($id)
    {
        if ($this->pageModel->delete($id)) {
            return redirect()->to('/pages')->with('success', 'Page deleted successfully');
        }

        return redirect()->back()->with('error', 'Failed to delete page');
    }
}
