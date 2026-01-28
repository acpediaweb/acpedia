<?php

namespace App\Models;

use CodeIgniter\Model;

class BrandModel extends Model
{
    protected $table            = 'brands';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['brand_name', 'brand_description', 'brand_logo'];
    protected $useTimestamps    = true;
}