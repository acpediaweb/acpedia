<?php

namespace App\Models;

use CodeIgniter\Model;

class ForumPostModel extends Model
{
    protected $table            = 'forum_posts';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = true;
    protected $allowedFields    = [
        'thread_id', 'post_author_id', 'post_content'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    /**
     * Get forum posts with author details
     */
    public function getPostsWithAuthor($threadId)
    {
        return $this->select('forum_posts.*, users.fullname as author_name, users.profile_picture')
            ->join('users', 'users.id = forum_posts.post_author_id', 'left')
            ->where('forum_posts.thread_id', $threadId)
            ->orderBy('forum_posts.created_at', 'ASC')
            ->findAll();
    }
}
