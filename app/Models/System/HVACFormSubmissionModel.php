<?php

namespace App\Models\System;

use CodeIgniter\Model;

class HVACFormSubmissionModel extends Model
{
    protected $table = 'hvac_form_submissions';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $useSoftDeletes = false;
    protected array $allowedFields = ['first_name', 'last_name', 'email', 'phone_number', 'whatsapp_number', 'subject', 'message'];

    protected $useTimestamps = true;
    protected $createdField = 'submitted_at';
    protected $updatedField = null;
    protected $deletedField = null;

    protected $validationRules = [
        'first_name' => 'required|min_length[1]|max_length[50]',
        'last_name' => 'required|min_length[1]|max_length[50]',
        'email' => 'required|valid_email',
        'phone_number' => 'permit_empty|string|max_length[20]',
        'whatsapp_number' => 'permit_empty|string|max_length[20]',
        'subject' => 'required|min_length[1]|max_length[150]',
        'message' => 'required|string',
    ];

    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    protected array $casts = [];

    public function getByEmail(string $email)
    {
        return $this->where('email', $email)->findAll();
    }

    public function getRecentSubmissions(int $limit = 10)
    {
        return $this->orderBy('submitted_at', 'DESC')->limit($limit)->findAll();
    }
}
