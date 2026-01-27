<?php
namespace App\Models;
use CodeIgniter\Model;

class ServiceModel extends Model {
    protected $table = 'services';
    protected $primaryKey = 'id';
    protected $allowedFields = ['service_title', 'service_description', 'base_price'];

    /**
     * Get a specific service with its detailed price matrix
     */
    public function getServiceWithPrices($serviceId) {
        $service = $this->find($serviceId);
        if ($service) {
            $db = \Config\Database::connect();
            $service['price_matrix'] = $db->table('service_prices')
                ->select('service_prices.*, types.type_name')
                ->join('types', 'types.id = service_prices.type_id')
                ->where('service_id', $serviceId)
                ->get()->getResultArray();
        }
        return $service;
    }
}