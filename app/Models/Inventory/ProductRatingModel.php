<?php

namespace App\Models\Inventory;

use CodeIgniter\Model;

class ProductRatingModel extends Model
{
    protected $table = 'product_ratings';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['product_id', 'user_id', 'rating_score', 'rating_comments', 'price_at_purchase'];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = null;
    protected $deletedField = null;

    protected $validationRules = [
        'product_id' => 'required|integer',
        'user_id' => 'permit_empty|integer',
        'rating_score' => 'required|integer|in_list[1,2,3,4,5]',
        'rating_comments' => 'permit_empty|string',
        'price_at_purchase' => 'required|decimal',
    ];

    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    protected $casts = [
        'rating_score' => 'integer',
        'price_at_purchase' => 'float',
    ];
    protected $castHandlers = [];

    public function getByProductId(int $productId)
    {
        return $this->where('product_id', $productId)->orderBy('created_at', 'DESC')->findAll();
    }

    public function getAverageRatingByProduct(int $productId)
    {
        return $this->selectAvg('rating_score', 'average_rating')
                    ->where('product_id', $productId)
                    ->first();
    }

    public function getByUserId(int $userId)
    {
        return $this->where('user_id', $userId)->orderBy('created_at', 'DESC')->findAll();
    }
}
