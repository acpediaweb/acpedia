<?php

namespace App\Models\Community;

use CodeIgniter\Model;

class ForumModel extends Model
{
    protected $table = 'forum';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $useSoftDeletes = true;
    protected $deletedField = 'deleted_at';
    protected $allowedFields = ['thread_poster_id', 'thread_title', 'flair_id', 'status'];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $validationRules = [
        'thread_poster_id' => 'permit_empty|integer',
        'thread_title' => 'required|min_length[1]|max_length[150]',
        'flair_id' => 'permit_empty|integer',
        'status' => 'permit_empty|in_list[Open,Closed]',
    ];

    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    protected array $casts = [];

    public function getByPosterId(int $posterId)
    {
        return $this->where('thread_poster_id', $posterId)->orderBy('created_at', 'DESC')->findAll();
    }

    public function getByStatus(string $status)
    {
        return $this->where('status', $status)->orderBy('created_at', 'DESC')->findAll();
    }

    public function getOpenThreads()
    {
        return $this->where('status', 'Open')->orderBy('created_at', 'DESC')->findAll();
    }

    public function getByFlairId(int $flairId)
    {
        return $this->where('flair_id', $flairId)->findAll();
    }
}
