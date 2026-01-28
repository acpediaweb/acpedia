<?php

namespace App\Models\Catalog;

use CodeIgniter\Model;

class ServiceModel extends Model
{
    protected $table = 'services';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['service_title', 'service_description', 'base_price'];

    protected $useTimestamps = false;
    protected $createdField = null;
    protected $updatedField = null;
    protected $deletedField = null;

    protected $validationRules = [
        'service_title' => 'required|min_length[1]|max_length[100]',
        'service_description' => 'permit_empty|string',
        'base_price' => 'required|decimal',
    ];

    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    protected $casts = [
        'base_price' => 'float',
    ];

    public function getByTitle(string $title)
    {
        return $this->where('service_title', $title)->first();
    }
}
