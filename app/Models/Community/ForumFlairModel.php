<?php

namespace App\Models\Community;

use CodeIgniter\Model;

class ForumFlairModel extends Model
{
    protected $table = 'forum_flairs';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['flair_name', 'flair_color', 'flair_description'];

    protected $useTimestamps = false;
    protected $createdField = null;
    protected $updatedField = null;
    protected $deletedField = null;

    protected $validationRules = [
        'flair_name' => 'required|min_length[1]|max_length[50]|is_unique[forum_flairs.flair_name]',
        'flair_color' => 'required|regex_match[/^#[0-9A-F]{6}$/i]',
        'flair_description' => 'permit_empty|string',
    ];

    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    protected array $casts = [];

    public function getByName(string $name)
    {
        return $this->where('flair_name', $name)->first();
    }
}
