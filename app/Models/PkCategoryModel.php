<?php
namespace App\Models;
use CodeIgniter\Model;

class PkCategoryModel extends Model {
    protected $table = 'pk_categories';
    protected $primaryKey = 'id';
    protected $allowedFields = ['pk_category_name', 'pk_category_description', 'icon'];
}