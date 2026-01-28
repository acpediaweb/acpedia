<?php

namespace App\Models;

use CodeIgniter\Model;

class ServiceModel extends Model
{
    protected $table            = 'services';
    protected $primaryKey       = 'id';
    protected $returnType       = 'object';
    protected $allowedFields    = ['service_title', 'service_description', 'base_price'];

    /**
     * Get pricing for a specific service based on AC type
     */
    public function getCalculatedPrice($serviceId, $typeId = null)
    {
        if (!$typeId) return $this->find($serviceId)->base_price;

        $db = \Config\Database::connect();
        return $db->table('service_prices')
                  ->where(['service_id' => $serviceId, 'type_id' => $typeId])
                  ->get()
                  ->getRow();
    }
}