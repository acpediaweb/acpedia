<?php

namespace App\Models\Catalog;

use CodeIgniter\Model;

class TypeModel extends Model
{
    protected $table = 'types';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['type_name', 'type_description', 'icon'];

    protected $useTimestamps = false;
    protected $createdField = null;
    protected $updatedField = null;
    protected $deletedField = null;

    protected $validationRules = [
        'type_name' => 'required|min_length[1]|max_length[100]|is_unique[types.type_name]',
        'type_description' => 'permit_empty|string',
        'icon' => 'required|min_length[1]|max_length[100]',
    ];

    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    protected $casts = [];
    protected $castHandlers = [];

    public function getByName(string $name)
    {
        return $this->where('type_name', $name)->first();
    }
}
