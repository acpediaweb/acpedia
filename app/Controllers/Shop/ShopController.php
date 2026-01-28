<?php

namespace App\Controllers\Shop;

use App\Controllers\BaseController;
use App\Models\ProductModel;

class ShopController extends BaseController
{
      public function index()
    {
        // --- 1. Configuration & Instantiation ---
        $limit = 16; 
        $productModel  = model('ProductModel');
        $brandModel    = model('BrandModel');
        $acTypeModel   = model('AcTypeModel');
        $pkListModel   = model('PkListModel');
        $categoryModel = model('CategoryModel');

        // --- 2. Retrieve & Sanitize Filters and Search/Sort ---
        $currentPage = max(1, (int)($this->request->getGet('page') ?? 1));
        $offset = ($currentPage - 1) * $limit;

        $search = $this->request->getGet('search');
        $sort = $this->request->getGet('sort');

        $filters = [
            'brand_id'    => (int)($this->request->getGet('brand_id') ?? 0) ?: null,
            'ac_type_id'  => (int)($this->request->getGet('ac_type_id') ?? 0) ?: null,
            'pk_id'       => (int)($this->request->getGet('pk_id') ?? 0) ?: null,
            'category_id' => (int)($this->request->getGet('category_id') ?? 0) ?: null,
        ];
        $activeFilters = array_filter($filters);

        // --- 3. Fetch Product Data and Total Count ---
        $products      = $productModel->getFilteredProducts($activeFilters, $search, $limit, $offset, $sort);
        $totalProducts = $productModel->getFilteredProductCount($activeFilters, $search);

        // --- 4. Fetch Filter Lists (Sidebar Data) ---
        $brands     = $brandModel->where('is_active', 1)->orderBy('sort_order', 'ASC')->findAll();
        $acTypes    = $acTypeModel->where('is_active', 1)->orderBy('sort_order', 'ASC')->findAll();
        $pkList     = $pkListModel->orderBy('sort_order', 'ASC')->findAll();
        $categories = $categoryModel->where('is_active', 1)->orderBy('sort_order', 'ASC')->findAll();

        // --- 5. Calculate Static AC Type Counts (Original Grouping) ---
        $acTypeGroups = [
            'count_wms' => [2], 'count_cas' => [6, 7], 'count_fls' => [3, 4], 
            'count_cls' => [5], 'count_vrf' => [8, 9], 'count_cld' => [10],
        ];

        $staticCounts = [];
        $trackedIds = [];
        $productBuilder = $productModel->builder()->where('is_active', 1);

        foreach ($acTypeGroups as $key => $ids) {
            $staticCounts[$key] = $productBuilder->resetQuery()->whereIn('ac_type_id', $ids)->countAllResults();
            $trackedIds = array_merge($trackedIds, $ids);
        }

        $trackedIds = array_unique($trackedIds);
        $staticCounts['count_etc'] = $productBuilder->resetQuery()->whereNotIn('ac_type_id', $trackedIds)->countAllResults();

        // --- 6. Manual Pagination HTML Generation ---
        $totalPages = (int)ceil($totalProducts / $limit);
        $paginationLinks = '';

        if ($totalPages > 1) {
            $currentQueryParams = $this->request->getGet();
            unset($currentQueryParams['page']); 
            $queryString = http_build_query($currentQueryParams);
            $baseUrl = current_url() . (empty($queryString) ? '?' : '?' . $queryString . '&');

            $range = 2; 
            $startPage = max(1, $currentPage - $range);
            $endPage = min($totalPages, $currentPage + $range);
            
            $paginationLinks .= '<div class="flex justify-center items-center gap-2 mt-8">';
            
            if ($currentPage > 1) {
                $paginationLinks .= '<a href="' . $baseUrl . 'page=' . ($currentPage - 1) . '" class="px-3 py-2 border border-gray-300 rounded-lg"><i data-lucide="chevron-left" class="h-5 w-5"></i></a>';
            }
            
            for ($i = $startPage; $i <= $endPage; $i++) {
                $activeClass = ($i === $currentPage) ? 'bg-gray-200 font-semibold' : 'hover:bg-gray-50';
                $paginationLinks .= '<a href="' . $baseUrl . 'page=' . $i . '" class="px-4 py-2 border border-gray-300 rounded-lg ' . $activeClass . '">' . $i . '</a>';
            }
            
            if ($currentPage < $totalPages) {
                $paginationLinks .= '<a href="' . $baseUrl . 'page=' . ($currentPage + 1) . '" class="px-3 py-2 border border-gray-300 rounded-lg"><i data-lucide="chevron-right" class="h-5 w-5"></i></a>';
            }
            $paginationLinks .= '</div>';
        }

        // --- 7. Pass Data to View ---
        $data = array_merge([
            'products'        => $products,
            'brands'          => $brands,
            'acTypes'         => $acTypes,
            'pkList'          => $pkList,
            'categories'      => $categories,
            'currentFilters'  => $activeFilters,
            'currentSearch'   => $search,
            'currentSort'     => $sort,
            'paginationLinks' => $paginationLinks,
            'totalProducts'   => $totalProducts,
            'currentPage'     => $currentPage,
            'perPage'         => $limit,
        ], $staticCounts);

        return view('shop/list', $data);
    }

    public function detail($slug)
{
    $model = new \App\Models\ProductModel();
    
    // Fetch product with relations (Brand, Category, PK)
    $product = $model->getWithRelations(['products.slug' => $slug]);

    if (!$product) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Product with slug $slug not found.");
    }

    $data = [
        'title'   => $product[0]->product_name . ' - HVACPRO',
        'product' => $product[0], // getWithRelations returns an array
    ];

    return view('shop/detail', $data);
}
}