<?php

namespace App\Models\System;

use CodeIgniter\Model;

class StaticPageContentModel extends Model
{
    protected $table = 'static_page_contents';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['page_name', 'page_slug', 'page_content'];

    protected $useTimestamps = true;
    protected $createdField = null;
    protected $updatedField = 'last_updated';

    protected $validationRules = [
        'page_name' => 'required|min_length[1]|max_length[100]|is_unique[static_page_contents.page_name]',
        'page_slug' => 'required|min_length[1]|max_length[150]|is_unique[static_page_contents.page_slug]',
        'page_content' => 'required|string',
    ];

    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    protected $casts = [];

    public function getBySlug(string $slug)
    {
        return $this->where('page_slug', $slug)->first();
    }

    public function getByName(string $name)
    {
        return $this->where('page_name', $name)->first();
    }
}
