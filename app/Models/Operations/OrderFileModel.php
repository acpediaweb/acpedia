<?php

namespace App\Models\Operations;

use CodeIgniter\Model;

class OrderFileModel extends Model
{
    protected $table = 'order_files';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['order_discussion_id', 'file_urls', 'uploaded_at'];

    protected $useTimestamps = false;
    protected $createdField = null;
    protected $updatedField = null;
    protected $deletedField = null;

    protected $validationRules = [
        'order_discussion_id' => 'required|integer',
        'file_urls' => 'required|min_length[1]|max_length[255]',
        'uploaded_at' => 'permit_empty|valid_date',
    ];

    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    protected $casts = [];
    protected $castHandlers = [];

    public function getByDiscussionId(int $discussionId)
    {
        return $this->where('order_discussion_id', $discussionId)->findAll();
    }
}
