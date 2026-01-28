<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ForumModel;
use App\Models\ForumPostModel;

class Forum extends BaseController
{
    protected $forumModel;
    protected $postModel;
    protected $perPage = 20;

    public function __construct()
    {
        $this->forumModel = new ForumModel();
        $this->postModel = new ForumPostModel();
    }

    /**
     * List all forum threads
     */
    public function index()
    {
        $page = $this->request->getVar('page') ?? 1;
        $status = $this->request->getVar('status') ?? '';
        $search = $this->request->getVar('search') ?? '';

        $query = $this->forumModel;

        if (!empty($status)) {
            if ($status === 'open') {
                $query = $query->where('is_closed', 0);
            } elseif ($status === 'closed') {
                $query = $query->where('is_closed', 1);
            }
        }

        if (!empty($search)) {
            $query = $query->like('title', $search);
        }

        $threads = $query->orderBy('created_at', 'DESC')
            ->paginate($this->perPage, 'forum');

        return view('admin/forum/index', [
            'threads' => $threads,
            'pager' => $this->forumModel->pager,
            'selectedStatus' => $status,
            'searchQuery' => $search,
        ]);
    }

    /**
     * Show forum thread with posts
     */
    public function show($id)
    {
        $thread = $this->forumModel->find($id);

        if (!$thread) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // Get all posts in thread
        $posts = $this->postModel
            ->select('forum_posts.*, users.fullname, users.picture_url, forum_flairs.name as flair_name, forum_flairs.color as flair_color')
            ->join('users', 'users.id = forum_posts.user_id', 'left')
            ->join('forum_flairs', 'forum_flairs.id = forum_posts.forum_flair_id', 'left')
            ->where('forum_posts.forum_id', $id)
            ->orderBy('forum_posts.created_at', 'ASC')
            ->findAll();

        return view('admin/forum/detail', [
            'thread' => $thread,
            'posts' => $posts,
        ]);
    }

    /**
     * Close a forum thread
     */
    public function closeThread($id)
    {
        $thread = $this->forumModel->find($id);

        if (!$thread) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Thread not found'
            ])->setStatusCode(404);
        }

        $this->forumModel->update($id, ['is_closed' => 1]);

        return redirect()->to('admin/forum/' . $id)
            ->with('success', 'Thread closed successfully');
    }

    /**
     * Reopen a forum thread
     */
    public function reopenThread($id)
    {
        $thread = $this->forumModel->find($id);

        if (!$thread) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Thread not found'
            ])->setStatusCode(404);
        }

        $this->forumModel->update($id, ['is_closed' => 0]);

        return redirect()->to('admin/forum/' . $id)
            ->with('success', 'Thread reopened successfully');
    }
}
