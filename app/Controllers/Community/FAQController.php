<?php

namespace App\Controllers\Community;

use App\Controllers\BaseController;
use App\Models\Community\FAQModel;
use App\Models\Community\FAQCategoryModel;
use App\Models\Community\FAQVoteModel;

class FAQController extends BaseController
{
    protected $faqModel;
    protected $categoryModel;
    protected $voteModel;

    public function __construct()
    {
        $this->faqModel = new FAQModel();
        $this->categoryModel = new FAQCategoryModel();
        $this->voteModel = new FAQVoteModel();
    }

    public function index()
    {
        $categories = $this->categoryModel->findAll();
        $faqs = $this->faqModel->findAll();
        return view('community/faq/index', ['categories' => $categories, 'faqs' => $faqs]);
    }

    public function byCategory($categoryId)
    {
        $category = $this->categoryModel->find($categoryId);
        $faqs = $this->faqModel->getByCategoryId($categoryId);
        return view('community/faq/by_category', ['category' => $category, 'faqs' => $faqs]);
    }

    public function search()
    {
        $query = $this->request->getGet('q');
        $faqs = $this->faqModel->searchByQuestion($query);
        return view('community/faq/search_results', ['query' => $query, 'faqs' => $faqs]);
    }

    public function vote($faqId)
    {
        $isHelpful = $this->request->getPost('is_helpful');
        $ipAddress = $this->request->getIPAddress();

        $data = [
            'faq_id' => $faqId,
            'is_helpful' => $isHelpful ? 1 : 0,
            'ip_address' => $ipAddress,
            'voted_at' => date('Y-m-d H:i:s'),
        ];

        if (session()->has('user_id')) {
            $data['user_id'] = session()->get('user_id');
        }

        if ($this->voteModel->insert($data)) {
            return redirect()->back()->with('success', 'Thank you for your feedback');
        }

        return redirect()->back()->with('error', 'Failed to record your vote');
    }
}
