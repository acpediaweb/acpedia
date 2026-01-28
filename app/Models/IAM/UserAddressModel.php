<?php

namespace App\Models\IAM;

use CodeIgniter\Model;

class UserAddressModel extends Model
{
    protected $table = 'users_addresses';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['user_id', 'street', 'sub_district', 'district', 'city', 'province', 'postal_code', 'latitude', 'longitude', 'is_primary'];

    protected $useTimestamps = false;
    protected $createdField = null;
    protected $updatedField = null;
    protected $deletedField = null;

    protected $validationRules = [
        'user_id' => 'required|integer',
        'street' => 'required|min_length[1]|max_length[255]',
        'sub_district' => 'required|min_length[1]|max_length[100]',
        'district' => 'required|min_length[1]|max_length[100]',
        'city' => 'required|min_length[1]|max_length[100]',
        'province' => 'required|min_length[1]|max_length[100]',
        'postal_code' => 'required|min_length[1]|max_length[20]',
        'latitude' => 'permit_empty|decimal',
        'longitude' => 'permit_empty|decimal',
        'is_primary' => 'permit_empty|in_list[0,1]',
    ];

    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    protected $casts = [
        'latitude' => 'float',
        'longitude' => 'float',
        'is_primary' => 'boolean',
    ];

    public function getByUserId(int $userId)
    {
        return $this->where('user_id', $userId)->findAll();
    }

    public function getPrimaryAddress(int $userId)
    {
        return $this->where('user_id', $userId)->where('is_primary', true)->first();
    }
}
