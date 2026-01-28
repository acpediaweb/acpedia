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

        // Join to get author name and count posts
        $query = $this->forumModel
            ->select('forum.*, users.fullname as author_name, COUNT(forum_posts.id) as post_count')
            ->join('users', 'users.id = forum.thread_poster_id', 'left')
            ->join('forum_posts', 'forum_posts.thread_id = forum.id AND forum_posts.deleted_at IS NULL', 'left')
            ->groupBy('forum.id');

        if (!empty($status) && in_array($status, ['Open', 'Closed'])) {
            $query = $query->where('forum.status', $status);
        }

        if (!empty($search)) {
            $query = $query->like('forum.thread_title', $search);
        }

        $threads = $query->orderBy('forum.created_at', 'DESC')
            ->paginate($this->perPage, 'forum');

        return view('admin/forum/index', [
            'threads' => $threads,
            'pager' => $this->forumModel->pager,
            'selectedStatus' => $status,
            'searchQuery' => $search,
        ]);
    }

    /**
     * Show forum thread with vBulletin-style details
     */
    public function show($id)
    {
        // Get Thread Details
        $thread = $this->forumModel
            ->select('forum.*, users.fullname as author_name')
            ->join('users', 'users.id = forum.thread_poster_id', 'left')
            ->where('forum.id', $id)
            ->first();

        if (!$thread) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // Get Posts with User Stats (Join Date for 'Member Since')
        $posts = $this->postModel
            ->select('forum_posts.*, users.fullname, users.profile_picture, users.created_at as member_since')
            ->join('users', 'users.id = forum_posts.post_author_id', 'left')
            ->where('forum_posts.thread_id', $id)
            ->where('forum_posts.deleted_at', null)
            ->orderBy('forum_posts.created_at', 'ASC')
            ->findAll();

        return view('admin/forum/detail', [
            'thread' => $thread,
            'posts' => $posts,
        ]);
    }

    /**
     * Handle Reply Submission (QuillJS)
     */
    public function reply($id)
    {
        $content = $this->request->getPost('content');
        
        // Basic validation to ensure content isn't empty or just whitespace
        if (empty(trim(strip_tags($content)))) {
             return redirect()->back()->with('error', 'Reply cannot be empty.');
        }

        $this->postModel->insert([
            'thread_id' => $id,
            'post_author_id' => session()->get('user_id'),
            'content' => $content, // QuillJS sends HTML
            'created_at' => date('Y-m-d H:i:s')
        ]);

        // Touch the thread to update 'updated_at'
        $this->forumModel->update($id, ['updated_at' => date('Y-m-d H:i:s')]);

        return redirect()->to('admin/forum/' . $id)->with('success', 'Reply posted successfully');
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

        $this->forumModel->update($id, ['status' => 'Closed']);

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

        $this->forumModel->update($id, ['status' => 'Open']);

        return redirect()->to('admin/forum/' . $id)
            ->with('success', 'Thread reopened successfully');
    }

    /**
     * Show create thread form
     */
    public function create()
    {
        return view('admin/forum/form');
    }

    /**
     * Save new thread
     */
    public function save()
    {
        $title = $this->request->getPost('thread_title');
        if (empty($title)) {
            return redirect()->back()->withInput()->with('error', 'Thread title is required');
        }

        $data = [
            'thread_poster_id' => session()->get('user_id') ?? null,
            'thread_title' => $title,
            'flair_id' => $this->request->getPost('flair_id') ?: null,
            'status' => 'Open',
        ];

        $id = $this->forumModel->insert($data);

        return redirect()->to('admin/forum/' . $id)->with('success', 'Thread created');
    }
}