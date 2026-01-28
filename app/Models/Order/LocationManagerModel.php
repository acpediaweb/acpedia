<?php

namespace App\Models\Order;

use CodeIgniter\Model;

class LocationManagerModel extends Model
{
    protected $table = 'location_managers';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $useSoftDeletes = false;
    protected array $allowedFields = ['manager_location_name', 'manager_name', 'manager_email', 'manager_phone', 'kelurahan', 'kecamatan', 'city', 'province', 'postal_code', 'street', 'qr_code', 'latitude', 'longitude'];

    protected $useTimestamps = false;
    protected $createdField = null;
    protected $updatedField = null;
    protected $deletedField = null;

    protected $validationRules = [
        'manager_location_name' => 'required|min_length[1]|max_length[100]',
        'manager_name' => 'required|min_length[1]|max_length[100]',
        'manager_email' => 'required|valid_email|is_unique[location_managers.manager_email]',
        'manager_phone' => 'permit_empty|string|max_length[20]',
        'kelurahan' => 'required|min_length[1]|max_length[100]',
        'kecamatan' => 'required|min_length[1]|max_length[100]',
        'city' => 'required|min_length[1]|max_length[100]',
        'province' => 'required|min_length[1]|max_length[100]',
        'postal_code' => 'required|min_length[1]|max_length[20]',
        'street' => 'required|min_length[1]|max_length[255]',
        'qr_code' => 'required|min_length[1]|max_length[255]',
        'latitude' => 'permit_empty|decimal',
        'longitude' => 'permit_empty|decimal',
    ];

    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    protected array $casts = [
        'latitude' => 'float',
        'longitude' => 'float',
    ];

    public function getByEmail(string $email)
    {
        return $this->where('manager_email', $email)->first();
    }

    public function getByCity(string $city)
    {
        return $this->where('city', $city)->findAll();
    }
}
