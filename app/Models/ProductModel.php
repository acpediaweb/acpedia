<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table            = 'products';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'product_name', 'product_description', 'slug', 
        'base_price', 'sale_price', 
        'category_id', 'type_id', 'brand_id', 'pk_category_id', 
        'main_image', 'additional_images', 'extra_attributes'
    ];

    private function applyFilters($filters)
    {
        // 1. Update Select to include names from joined tables
        $this->select('products.*, 
            COALESCE(products.sale_price, products.base_price) as final_price,
            brands.brand_name, 
            types.type_name, 
            pk_categories.pk_category_name,
            categories.category_name'
        );

        $this->join('brands', 'brands.id = products.brand_id', 'left');
        $this->join('types', 'types.id = products.type_id', 'left');
        $this->join('pk_categories', 'pk_categories.id = products.pk_category_id', 'left');
        $this->join('categories', 'categories.id = products.category_id', 'left');
        
        // 2. Filter by Names (matching your HTML data-attributes)
        if (!empty($filters['brands'])) {
            $this->whereIn('brands.brand_name', (array)$filters['brands']);
        }
        if (!empty($filters['types'])) {
            $this->whereIn('types.type_name', (array)$filters['types']);
        }
        // Note: JS sends 'pk', 'category' as single strings, but we can wrap in array
        if (!empty($filters['pk'])) {
            $this->where('pk_categories.pk_category_name', $filters['pk']);
        }
        if (!empty($filters['category'])) {
             // Mapping "wall-mounted" (slug style) to Name if necessary, 
             // or ensure your DB category_name matches the HTML data-category
             // For now assuming partial match or exact match logic:
             $this->like('categories.category_name', str_replace('-', ' ', $filters['category']));
        }

        if (!empty($filters['search'])) {
            $this->groupStart()
                ->like('products.product_name', $filters['search'])
                ->orLike('brands.brand_name', $filters['search'])
            ->groupEnd();
        }
        
        // Price sorting logic remains...
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

    public function getFilteredProducts(array $filters)
    {
        $this->applyFilters($filters);

        $sort = $filters['sort'] ?? 'terbaru';
        switch ($sort) {
            case 'low':  $this->orderBy('final_price', 'ASC'); break;
            case 'high': $this->orderBy('final_price', 'DESC'); break;
            case 'terlaris': 
                // Placeholder for sales logic, or fallback to default
                $this->orderBy('products.created_at', 'DESC'); 
                break;
            default: // 'terbaru'
                $this->orderBy('products.created_at', 'DESC'); 
                break;
        }

        return $this->findAll();
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