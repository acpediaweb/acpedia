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

        if (!empty($status) && in_array($status, ['Open', 'Closed'])) {
            $query = $query->where('status', $status);
        }

        if (!empty($search)) {
            $query = $query->like('thread_title', $search);
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
            ->select('forum_posts.*, users.fullname, users.profile_picture')
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
