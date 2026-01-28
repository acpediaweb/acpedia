<?php

namespace App\Models\Catalog;

use CodeIgniter\Model;

class BrandModel extends Model
{
    protected $table = 'brands';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $useSoftDeletes = false;
    protected array $allowedFields = ['brand_name', 'brand_description', 'logo'];

    protected $useTimestamps = false;
    protected $createdField = null;
    protected $updatedField = null;
    protected $deletedField = null;

    protected $validationRules = [
        'brand_name' => 'required|min_length[1]|max_length[100]|is_unique[brands.brand_name]',
        'brand_description' => 'permit_empty|string',
        'logo' => 'required|min_length[1]|max_length[100]',
    ];

    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    protected array $casts = [];

    public function getByName(string $name)
    {
        return $this->where('brand_name', $name)->first();
    }
}
