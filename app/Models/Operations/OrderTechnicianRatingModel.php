<?php

namespace App\Models\Operations;

use CodeIgniter\Model;

class OrderTechnicianRatingModel extends Model
{
    protected $table = 'order_technician_ratings';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['order_id', 'user_id', 'technician_user_id', 'rating_score', 'rating_comments'];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = null;
    protected $deletedField = null;

    protected $validationRules = [
        'order_id' => 'required|integer',
        'user_id' => 'permit_empty|integer',
        'technician_user_id' => 'permit_empty|integer',
        'rating_score' => 'required|integer|in_list[1,2,3,4,5]',
        'rating_comments' => 'permit_empty|string',
    ];

    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    protected $casts = [
        'rating_score' => 'integer',
    ];

    public function getByOrderId(int $orderId)
    {
        return $this->where('order_id', $orderId)->first();
    }

    public function getByTechnicianId(int $technicianId)
    {
        return $this->where('technician_user_id', $technicianId)->findAll();
    }

    public function getAverageRatingByTechnician(int $technicianId)
    {
        return $this->selectAvg('rating_score', 'average_rating')
                    ->where('technician_user_id', $technicianId)
                    ->first();
    }
}
