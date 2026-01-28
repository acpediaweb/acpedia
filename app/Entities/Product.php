<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Product extends Entity
{
    // Automatically cast JSON columns to Arrays
    protected $casts = [
        'additional_images' => 'json',
        'extra_attributes'  => 'json',
        'base_price'        => 'float',
        'sale_price'        => 'float',
    ];

    /**
     * Custom method to calculate the current display price
     */
    public function getPrice()
    {
        return $this->attributes['sale_price'] ?? $this->attributes['base_price'];
    }

    /**
     * Helper to get the primary image or a placeholder
     */
    public function getImageUrl()
    {
        return $this->attributes['main_image'] 
            ? base_url('uploads/products/' . $this->attributes['main_image']) 
            : base_url('assets/images/placeholder-ac.png');
    }
}