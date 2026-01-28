<?php

namespace App\Models\Community;

use CodeIgniter\Model;

class UserTicketResponseModel extends Model
{
    protected $table = 'user_ticket_responses';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['ticket_id', 'responder_user_id', 'response_message'];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = null;
    protected $deletedField = null;

    protected $validationRules = [
        'ticket_id' => 'required|integer',
        'responder_user_id' => 'permit_empty|integer',
        'response_message' => 'required|string',
    ];

    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    protected $casts = [];
    protected $castHandlers = [];

    public function getByTicketId(int $ticketId)
    {
        return $this->where('ticket_id', $ticketId)->orderBy('created_at', 'ASC')->findAll();
    }

    public function getByResponderId(int $responderId)
    {
        return $this->where('responder_user_id', $responderId)->findAll();
    }
}
