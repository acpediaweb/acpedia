<?php

namespace App\Models;

use CodeIgniter\Model;

class UserAddressModel extends Model
{
    protected $table            = 'users_addresses';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $allowedFields    = [
        'user_id', 'street', 'sub_district', 'district', 'city', 
        'province', 'postal_code', 'latitude', 'longitude', 'is_primary'
    ];

    protected $useTimestamps    = false;
}
