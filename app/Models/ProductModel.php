<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Entities\Product;

class ProductModel extends Model
{
    protected $table            = 'products';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = Product::class; // Map results to our Entity
    protected $useSoftDeletes   = true; // Matches your 'deleted_at' column
    protected $allowedFields    = [
        'product_name', 'product_description', 'slug', 'base_price', 
        'sale_price', 'category_id', 'type_id', 'brand_id', 
        'pk_category_id', 'main_image', 'additional_images', 'extra_attributes'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    /**
     * Fetch products with their related Master Data
     */
    public function getWithRelations()
    {
        return $this->select('products.*, brands.brand_name, types.type_name, pk_categories.pk_category_name')
            ->join('brands', 'brands.id = products.brand_id', 'left')
            ->join('types', 'types.id = products.type_id', 'left')
            ->join('pk_categories', 'pk_categories.id = products.pk_category_id', 'left')
            ->where('products.deleted_at', null)
            ->findAll();
    }
}