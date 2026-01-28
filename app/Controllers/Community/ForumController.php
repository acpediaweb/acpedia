<?php

namespace App\Controllers\Community;

use App\Controllers\BaseController;
use App\Models\Community\ForumModel;
use App\Models\Community\ForumPostModel;
use App\Models\Community\ForumFlairModel;

class ForumController extends BaseController
{
    protected $forumModel;
    protected $postModel;
    protected $flairModel;

    public function __construct()
    {
        $this->forumModel = new ForumModel();
        $this->postModel = new ForumPostModel();
        $this->flairModel = new ForumFlairModel();
    }

    public function index()
    {
        $threads = $this->forumModel->getOpenThreads();
        return view('community/forum/index', ['threads' => $threads]);
    }

    public function create()
    {
        $flairs = $this->flairModel->findAll();
        return view('community/forum/create', ['flairs' => $flairs]);
    }

    public function store()
    {
        if (!session()->has('user_id')) {
            return redirect()->to('/auth/login');
        }

        $data = [
            'thread_poster_id' => session()->get('user_id'),
            'thread_title' => $this->request->getPost('thread_title'),
            'flair_id' => $this->request->getPost('flair_id'),
            'status' => 'Open',
        ];

        $threadId = $this->forumModel->insert($data);
        if ($threadId) {
            return redirect()->to('/forum/' . $threadId)->with('success', 'Thread created successfully');
        }

        return redirect()->back()->with('error', 'Failed to create thread');
    }

    public function show($id)
    {
        $thread = $this->forumModel->find($id);
        $posts = $this->postModel->getByThreadId($id);
        return view('community/forum/show', ['thread' => $thread, 'posts' => $posts]);
    }

    public function addPost($threadId)
    {
        if (!session()->has('user_id')) {
            return redirect()->to('/auth/login');
        }

        $data = [
            'thread_id' => $threadId,
            'post_author_id' => session()->get('user_id'),
            'post_content' => $this->request->getPost('post_content'),
        ];

        if ($this->postModel->insert($data)) {
            return redirect()->back()->with('success', 'Post added successfully');
        }

        return redirect()->back()->with('error', 'Failed to add post');
    }
}
