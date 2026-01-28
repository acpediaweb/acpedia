<?php

namespace App\Models\Catalog;

use CodeIgniter\Model;

class PipeModel extends Model
{
    protected $table = 'pipes';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['pipe_type', 'pipe_description', 'price_per_meter'];

    protected $useTimestamps = false;
    protected $createdField = null;
    protected $updatedField = null;
    protected $deletedField = null;

    protected $validationRules = [
        'pipe_type' => 'required|min_length[1]|max_length[100]',
        'pipe_description' => 'permit_empty|string',
        'price_per_meter' => 'required|decimal',
    ];

    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    protected $casts = [
        'price_per_meter' => 'float',
    ];

    public function getByType(string $type)
    {
        return $this->where('pipe_type', $type)->first();
    }
}
