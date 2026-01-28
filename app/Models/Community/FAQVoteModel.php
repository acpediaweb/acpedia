<?php

namespace App\Models\Community;

use CodeIgniter\Model;

class FAQVoteModel extends Model
{
    protected $table = 'faqs_votes';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['faq_id', 'user_id', 'is_helpful', 'ip_address', 'voted_at'];

    protected $useTimestamps = false;
    protected $createdField = null;
    protected $updatedField = null;
    protected $deletedField = null;

    protected $validationRules = [
        'faq_id' => 'required|integer',
        'user_id' => 'permit_empty|integer',
        'is_helpful' => 'required|in_list[0,1]',
        'ip_address' => 'permit_empty|valid_ip',
        'voted_at' => 'permit_empty|valid_date',
    ];

    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    protected $casts = [
        'is_helpful' => 'boolean',
    ];

    public function getByFAQId(int $faqId)
    {
        return $this->where('faq_id', $faqId)->findAll();
    }

    public function getHelpfulVotesByFAQ(int $faqId)
    {
        return $this->where('faq_id', $faqId)->where('is_helpful', true)->countAllResults();
    }

    public function getUnhelpfulVotesByFAQ(int $faqId)
    {
        return $this->where('faq_id', $faqId)->where('is_helpful', false)->countAllResults();
    }
}
