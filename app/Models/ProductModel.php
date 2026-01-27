<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table            = 'products';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $allowedFields    = [
        'product_name', 'product_description', 'slug', 
        'base_price', 'sale_price', 
        'category_id', 'type_id', 'brand_id', 'pk_category_id', 
        'main_image', 'additional_images', 'extra_attributes'
    ];

    /**
     * Reusable filter logic to avoid repeating code for Count and Data
     */
    private function applyFilters($filters)
    {
        $this->select('products.*, COALESCE(products.sale_price, products.base_price) as final_price');
        $this->join('brands', 'brands.id = products.brand_id', 'left');
        $this->join('types', 'types.id = products.type_id', 'left');
        $this->join('pk_categories', 'pk_categories.id = products.pk_category_id', 'left');
        
        if (!empty($filters['brand_id']))       $this->whereIn('products.brand_id', (array)$filters['brand_id']);
        if (!empty($filters['type_id']))        $this->whereIn('products.type_id', (array)$filters['type_id']);
        if (!empty($filters['category_id']))    $this->whereIn('products.category_id', (array)$filters['category_id']);
        if (!empty($filters['pk_category_id'])) $this->whereIn('products.pk_category_id', (array)$filters['pk_category_id']);

        if (!empty($filters['min_price'])) {
            $this->where('COALESCE(products.sale_price, products.base_price) >=', $filters['min_price']);
        }
        if (!empty($filters['max_price'])) {
            $this->where('COALESCE(products.sale_price, products.base_price) <=', $filters['max_price']);
        }

        if (!empty($filters['keyword'])) {
            $this->groupStart()
                ->like('products.product_name', $filters['keyword'])
                ->orLike('products.product_description', $filters['keyword'])
            ->groupEnd();
        }
    }

    public function getManualPagination(array $filters, int $limit, int $offset)
    {
        $this->applyFilters($filters);

        // Sorting
        $sort = $filters['sort'] ?? 'newest';
        switch ($sort) {
            case 'price_asc':  $this->orderBy('final_price', 'ASC'); break;
            case 'price_desc': $this->orderBy('final_price', 'DESC'); break;
            case 'name_asc':   $this->orderBy('product_name', 'ASC'); break;
            default:           $this->orderBy('products.created_at', 'DESC'); break;
        }

        return $this->limit($limit, $offset)->findAll();
    }

    public function getTotalFilteredCount(array $filters)
    {
        $this->applyFilters($filters);
        return $this->countAllResults();
    }
}