<?php

namespace App\Controllers\Community;

use App\Controllers\BaseController;
use App\Models\Community\UserTicketModel;
use App\Models\Community\UserTicketResponseModel;

class TicketController extends BaseController
{
    protected $ticketModel;
    protected $responseModel;

    public function __construct()
    {
        $this->ticketModel = new UserTicketModel();
        $this->responseModel = new UserTicketResponseModel();
    }

    public function index()
    {
        if (!session()->has('user_id')) {
            return redirect()->to('/auth/login');
        }

        $userId = session()->get('user_id');
        $tickets = $this->ticketModel->getByUserId($userId);
        return view('community/tickets/index', ['tickets' => $tickets]);
    }

    public function create()
    {
        return view('community/tickets/create');
    }

    public function store()
    {
        if (!session()->has('user_id')) {
            return redirect()->to('/auth/login');
        }

        $data = [
            'user_id' => session()->get('user_id'),
            'ticket_title' => $this->request->getPost('ticket_title'),
            'ticket_description' => $this->request->getPost('ticket_description'),
            'ticket_status' => 'Open',
        ];

        if ($this->ticketModel->insert($data)) {
            return redirect()->to('/tickets')->with('success', 'Ticket created successfully');
        }

        return redirect()->back()->with('error', 'Failed to create ticket');
    }

    public function show($id)
    {
        $ticket = $this->ticketModel->find($id);
        $responses = $this->responseModel->getByTicketId($id);
        return view('community/tickets/show', ['ticket' => $ticket, 'responses' => $responses]);
    }

    public function addResponse($ticketId)
    {
        if (!session()->has('user_id')) {
            return redirect()->to('/auth/login');
        }

        $data = [
            'ticket_id' => $ticketId,
            'responder_user_id' => session()->get('user_id'),
            'response_message' => $this->request->getPost('response_message'),
        ];

        if ($this->responseModel->insert($data)) {
            return redirect()->back()->with('success', 'Response added successfully');
        }

        return redirect()->back()->with('error', 'Failed to add response');
    }
}
