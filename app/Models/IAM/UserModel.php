<?php

namespace App\Models\IAM;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['fullname', 'email', 'profile_picture', 'password_hash', 'role_id', 'is_active', 'technician_rating_avg'];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = null;
    protected $deletedField = null;

    protected $validationRules = [
        'fullname' => 'required|min_length[1]|max_length[50]|is_unique[users.fullname]',
        'email' => 'required|valid_email|is_unique[users.email]',
        'profile_picture' => 'permit_empty|string|max_length[255]',
        'password_hash' => 'required|string',
        'role_id' => 'permit_empty|integer',
        'is_active' => 'permit_empty|in_list[0,1]',
        'technician_rating_avg' => 'permit_empty|decimal',
    ];

    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    protected $casts = [
        'is_active' => 'boolean',
        'technician_rating_avg' => 'float',
    ];
    protected $castHandlers = [];

    public function getByEmail(string $email)
    {
        return $this->where('email', $email)->first();
    }

    public function getActiveUsers()
    {
        return $this->where('is_active', true)->findAll();
    }

    public function getUsersByRole(int $roleId)
    {
        return $this->where('role_id', $roleId)->findAll();
    }

    public function getTechnicians()
    {
        return $this->where('role_id', function($query) {
            $query->select('id')->from('roles')->where('role_name', 'Technician');
        })->findAll();
    }
}
