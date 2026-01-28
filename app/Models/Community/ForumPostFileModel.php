<?php

namespace App\Models\Community;

use CodeIgniter\Model;

class ForumPostFileModel extends Model
{
    protected $table = 'forum_post_files';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $useSoftDeletes = false;
    protected array $allowedFields = ['forum_post_id', 'file_urls', 'uploaded_at'];

    protected $useTimestamps = false;
    protected $createdField = null;
    protected $updatedField = null;
    protected $deletedField = null;

    protected $validationRules = [
        'forum_post_id' => 'required|integer',
        'file_urls' => 'required|min_length[1]|max_length[255]',
        'uploaded_at' => 'permit_empty|valid_date',
    ];

    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    protected array $casts = [];

    public function getByPostId(int $postId)
    {
        return $this->where('forum_post_id', $postId)->findAll();
    }
}
