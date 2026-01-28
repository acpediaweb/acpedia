<?php

namespace App\Models\Community;

use CodeIgniter\Model;

class UserTicketModel extends Model
{
    protected $table = 'user_tickets';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $useSoftDeletes = false;
    protected array $allowedFields = ['user_id', 'ticket_title', 'ticket_description', 'ticket_status'];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $validationRules = [
        'user_id' => 'required|integer',
        'ticket_title' => 'required|min_length[1]|max_length[100]',
        'ticket_description' => 'permit_empty|string',
        'ticket_status' => 'permit_empty|in_list[Open,In Progress,Resolved,Closed]',
    ];

    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    protected array $casts = [];

    public function getByUserId(int $userId)
    {
        return $this->where('user_id', $userId)->orderBy('created_at', 'DESC')->findAll();
    }

    public function getByStatus(string $status)
    {
        return $this->where('ticket_status', $status)->findAll();
    }

    public function getOpenTickets()
    {
        return $this->where('ticket_status', 'Open')->findAll();
    }
}
