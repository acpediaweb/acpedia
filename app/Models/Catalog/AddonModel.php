<?php

namespace App\Models\Catalog;

use CodeIgniter\Model;

class AddonModel extends Model
{
    protected $table = 'addons';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['addon_name', 'addon_description', 'addon_price'];

    protected $useTimestamps = false;
    protected $createdField = null;
    protected $updatedField = null;
    protected $deletedField = null;

    protected $validationRules = [
        'addon_name' => 'required|min_length[1]|max_length[100]',
        'addon_description' => 'permit_empty|string',
        'addon_price' => 'required|decimal',
    ];

    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    protected $casts = [
        'addon_price' => 'float',
    ];
    protected $castHandlers = [];

    public function getByName(string $name)
    {
        return $this->where('addon_name', $name)->first();
    }
}
