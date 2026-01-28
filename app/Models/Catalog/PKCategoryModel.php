<?php

namespace App\Models\Catalog;

use CodeIgniter\Model;

class PKCategoryModel extends Model
{
    protected $table = 'pk_categories';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['pk_category_name', 'pk_category_description', 'icon'];

    protected $useTimestamps = false;
    protected $createdField = null;
    protected $updatedField = null;
    protected $deletedField = null;

    protected $validationRules = [
        'pk_category_name' => 'required|min_length[1]|max_length[100]|is_unique[pk_categories.pk_category_name]',
        'pk_category_description' => 'permit_empty|string',
        'icon' => 'required|min_length[1]|max_length[100]',
    ];

    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    protected $casts = [];

    public function getByName(string $name)
    {
        return $this->where('pk_category_name', $name)->first();
    }
}
