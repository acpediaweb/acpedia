<?php

namespace App\Models\Community;

use CodeIgniter\Model;

class FAQCategoryModel extends Model
{
    protected $table = 'faqs_categories';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $useSoftDeletes = false;
    protected array $allowedFields = ['category_name', 'category_description'];

    protected $useTimestamps = false;
    protected $createdField = null;
    protected $updatedField = null;
    protected $deletedField = null;

    protected $validationRules = [
        'category_name' => 'required|min_length[1]|max_length[100]|is_unique[faqs_categories.category_name]',
        'category_description' => 'permit_empty|string',
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
