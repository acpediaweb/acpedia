<?php namespace App\Models;

use CodeIgniter\Model;

class AcTypeModel extends Model
{

    protected $table      = 'types';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'type_name',
        'type_description',
        'icon',
        'description'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}