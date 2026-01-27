<?php
namespace App\Models;
use CodeIgniter\Model;

class AddonModel extends Model {
    protected $table = 'addons';
    protected $allowedFields = ['addon_name', 'addon_description', 'addon_price'];
}