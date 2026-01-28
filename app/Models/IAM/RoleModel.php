<?php

namespace App\Models\IAM;

use CodeIgniter\Model;

class RoleModel extends Model
{
    protected $table = 'roles';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['role_name', 'role_color', 'role_description'];

    protected $useTimestamps = false;
    protected $createdField = null;
    protected $updatedField = null;
    protected $deletedField = null;

    protected $validationRules = [
        'role_name' => 'required|min_length[1]|max_length[50]|is_unique[roles.role_name]',
        'role_color' => 'required|regex_match[/^#[0-9A-F]{6}$/i]',
        'role_description' => 'permit_empty|string',
    ];

    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    protected array $casts = [];

    public function getByName(string $roleName)
    {
        return $this->where('role_name', $roleName)->first();
    }
}
