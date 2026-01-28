<?php

namespace App\Models\Catalog;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table = 'categories';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['category_name', 'category_description', 'icon'];

    protected $useTimestamps = false;
    protected $createdField = null;
    protected $updatedField = null;
    protected $deletedField = null;

    protected $validationRules = [
        'category_name' => 'required|min_length[1]|max_length[100]|is_unique[categories.category_name]',
        'category_description' => 'permit_empty|string',
        'icon' => 'required|min_length[1]|max_length[100]',
    ];

    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    protected array $casts = [];

    public function getByName(string $name)
    {
        return $this->where('category_name', $name)->first();
    }
}
