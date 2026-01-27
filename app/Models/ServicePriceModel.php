<?php
namespace App\Models;
use CodeIgniter\Model;

class ServicePriceModel extends Model {
    protected $table = 'service_prices';
    protected $primaryKey = 'id';
    protected $allowedFields = ['service_id', 'type_id', 'is_per_pk', 'price'];

    /**
     * Calculate price for a specific request
     */
    public function calculateFinalPrice($serviceId, $typeId, $pkValue = 1) {
        $rule = $this->where(['service_id' => $serviceId, 'type_id' => $typeId])->first();
        if (!$rule) return null;
        
        return $rule['is_per_pk'] ? ($rule['price'] * $pkValue) : $rule['price'];
    }
}