<?php
namespace App\Models;
use CodeIgniter\Model;

class PipeModel extends Model {
    protected $table = 'pipes';
    protected $allowedFields = ['pipe_type', 'pipe_description', 'price_per_meter'];
}