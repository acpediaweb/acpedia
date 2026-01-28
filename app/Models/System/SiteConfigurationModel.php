<?php

namespace App\Models\System;

use CodeIgniter\Model;

class SiteConfigurationModel extends Model
{
    protected $table = 'site_configurations';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['config_key', 'config_value'];

    protected $useTimestamps = true;
    protected $createdField = null;
    protected $updatedField = 'last_updated';

    protected $validationRules = [
        'config_key' => 'required|min_length[1]|max_length[100]|is_unique[site_configurations.config_key]',
        'config_value' => 'required|string',
    ];

    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    protected array $casts = [];

    public function getByKey(string $key)
    {
        return $this->where('config_key', $key)->first();
    }

    public function getAllConfigs()
    {
        return $this->findAll();
    }

    public function getConfigValue(string $key, $default = null)
    {
        $config = $this->getByKey($key);
        return $config ? $config->config_value : $default;
    }
}
