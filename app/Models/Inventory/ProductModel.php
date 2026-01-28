<?php

namespace App\Models\Inventory;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $useSoftDeletes = true;
    protected $deletedField = 'deleted_at';
    protected $allowedFields = ['product_name', 'product_description', 'slug', 'base_price', 'sale_price', 'category_id', 'type_id', 'brand_id', 'pk_category_id', 'main_image', 'additional_images', 'extra_attributes'];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $validationRules = [
        'product_name' => 'required|min_length[1]|max_length[100]',
        'product_description' => 'permit_empty|string',
        'slug' => 'required|min_length[1]|max_length[150]|is_unique[products.slug]',
        'base_price' => 'required|decimal',
        'sale_price' => 'permit_empty|decimal',
        'category_id' => 'permit_empty|integer',
        'type_id' => 'permit_empty|integer',
        'brand_id' => 'permit_empty|integer',
        'pk_category_id' => 'permit_empty|integer',
        'main_image' => 'required|min_length[1]|max_length[255]',
        'additional_images' => 'permit_empty|string',
        'extra_attributes' => 'permit_empty|string',
    ];

    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    protected array $casts = [
        'base_price' => 'float',
        'sale_price' => 'float',
        'additional_images' => 'json',
        'extra_attributes' => 'json',
    ];

    public function getBySlug(string $slug)
    {
        return $this->where('slug', $slug)->first();
    }

    public function getByCategoryId(int $categoryId)
    {
        return $this->where('category_id', $categoryId)->findAll();
    }

    public function getByBrandId(int $brandId)
    {
        return $this->where('brand_id', $brandId)->findAll();
    }

    public function getOnSale()
    {
        return $this->whereNotNull('sale_price')->findAll();
    }
}
