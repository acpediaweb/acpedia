<?php

namespace App\Models;

use CodeIgniter\Model;

class ForumModel extends Model
{
    protected $table            = 'forum';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = true;
    protected $allowedFields    = [
        'thread_poster_id', 'thread_title', 'flair_id', 'status'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    /**
     * Get forum thread with poster and flair details
     */
    public function getThreadWithDetails($threadId)
    {
        return $this->select('forum.*, users.fullname as poster_name, forum_flairs.flair_name, forum_flairs.flair_color')
            ->join('users', 'users.id = forum.thread_poster_id', 'left')
            ->join('forum_flairs', 'forum_flairs.id = forum.flair_id', 'left')
            ->where('forum.id', $threadId)
            ->first();
    }

    /**
     * Get all forum threads with details
     */
    public function getAllWithDetails()
    {
        return $this->select('forum.*, users.fullname as poster_name, forum_flairs.flair_name, forum_flairs.flair_color')
            ->join('users', 'users.id = forum.thread_poster_id', 'left')
            ->join('forum_flairs', 'forum_flairs.id = forum.flair_id', 'left')
            ->orderBy('forum.created_at', 'DESC')
            ->paginate(20);
    }
}
