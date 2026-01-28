<?php

namespace App\Models\Community;

use CodeIgniter\Model;

class ForumPostModel extends Model
{
    protected $table = 'forum_posts';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $useSoftDeletes = true;
    protected $deletedField = 'deleted_at';
    protected array $allowedFields = ['thread_id', 'post_author_id', 'post_content'];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $validationRules = [
        'thread_id' => 'required|integer',
        'post_author_id' => 'permit_empty|integer',
        'post_content' => 'required|string',
    ];

    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    protected array $casts = [];

    public function getByThreadId(int $threadId)
    {
        return $this->where('thread_id', $threadId)->orderBy('created_at', 'ASC')->findAll();
    }

    public function getByAuthorId(int $authorId)
    {
        return $this->where('post_author_id', $authorId)->orderBy('created_at', 'DESC')->findAll();
    }

    public function getLatestPosts(int $limit = 10)
    {
        return $this->orderBy('created_at', 'DESC')->limit($limit)->findAll();
    }
}
