<?php

namespace App\Models\Community;

use CodeIgniter\Model;

class FAQModel extends Model
{
    protected $table = 'faqs';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['category_id', 'question', 'answer'];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $validationRules = [
        'category_id' => 'permit_empty|integer',
        'question' => 'required|min_length[1]|max_length[255]',
        'answer' => 'required|string',
    ];

    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    protected $casts = [];

    public function getByCategoryId(int $categoryId)
    {
        return $this->where('category_id', $categoryId)->orderBy('created_at', 'ASC')->findAll();
    }

    public function searchByQuestion(string $query)
    {
        return $this->like('question', $query)->findAll();
    }
}
