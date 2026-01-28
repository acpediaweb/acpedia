<?php

namespace App\Models\Catalog;

use CodeIgniter\Model;

class ServicePriceModel extends Model
{
    protected $table = 'service_prices';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['service_id', 'type_id', 'is_per_pk', 'price'];

    protected $useTimestamps = false;
    protected $createdField = null;
    protected $updatedField = null;
    protected $deletedField = null;

    protected $validationRules = [
        'service_id' => 'required|integer',
        'type_id' => 'required|integer',
        'is_per_pk' => 'permit_empty|in_list[0,1]',
        'price' => 'required|decimal',
    ];

    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    protected $casts = [
        'is_per_pk' => 'boolean',
        'price' => 'float',
    ];

    public function getByServiceAndType(int $serviceId, int $typeId)
    {
        return $this->where('service_id', $serviceId)->where('type_id', $typeId)->first();
    }

    public function getByServiceId(int $serviceId)
    {
        return $this->where('service_id', $serviceId)->findAll();
    }
}
