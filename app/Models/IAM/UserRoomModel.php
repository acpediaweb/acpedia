<?php

namespace App\Models\IAM;

use CodeIgniter\Model;

class UserRoomModel extends Model
{
    protected $table = 'user_room';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $useSoftDeletes = false;
    protected array $allowedFields = ['address_id', 'room_name', 'room_subtitle'];

    protected $useTimestamps = false;
    protected $createdField = null;
    protected $updatedField = null;
    protected $deletedField = null;

    protected $validationRules = [
        'address_id' => 'required|integer',
        'room_name' => 'required|min_length[1]|max_length[100]',
        'room_subtitle' => 'permit_empty|string|max_length[150]',
    ];

    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    protected array $casts = [];

    public function getByAddressId(int $addressId)
    {
        return $this->where('address_id', $addressId)->findAll();
    }
}
