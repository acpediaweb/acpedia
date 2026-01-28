<?php

namespace App\Models;

use CodeIgniter\Model;

class CartModel extends Model
{
    protected $table            = 'user_cart';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['user_id', 'faktur_requested', 'scheduled_datetime'];
    protected $returnType       = 'object';
    protected $useTimestamps    = false; 
}