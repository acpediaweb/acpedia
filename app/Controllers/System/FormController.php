<?php

namespace App\Controllers\System;

use App\Controllers\BaseController;
use App\Models\System\HVACFormSubmissionModel;
use App\Models\System\ContactUsFormSubmissionModel;

class FormController extends BaseController
{
    protected $hvacFormModel;
    protected $contactFormModel;

    public function __construct()
    {
        $this->hvacFormModel = new HVACFormSubmissionModel();
        $this->contactFormModel = new ContactUsFormSubmissionModel();
    }

    public function submitHVACForm()
    {
        if ($this->request->getMethod() === 'post') {
            $data = [
                'first_name' => $this->request->getPost('first_name'),
                'last_name' => $this->request->getPost('last_name'),
                'email' => $this->request->getPost('email'),
                'phone_number' => $this->request->getPost('phone_number'),
                'whatsapp_number' => $this->request->getPost('whatsapp_number'),
                'subject' => $this->request->getPost('subject'),
                'message' => $this->request->getPost('message'),
            ];

            if ($this->hvacFormModel->insert($data)) {
                return redirect()->back()->with('success', 'Form submitted successfully');
            }

            return redirect()->back()->with('error', 'Failed to submit form');
        }

        return view('system/forms/hvac');
    }

    public function submitContactForm()
    {
        if ($this->request->getMethod() === 'post') {
            $data = [
                'full_name' => $this->request->getPost('full_name'),
                'email' => $this->request->getPost('email'),
                'phone_number' => $this->request->getPost('phone_number'),
                'whatsapp_number' => $this->request->getPost('whatsapp_number'),
                'subject' => $this->request->getPost('subject'),
                'message' => $this->request->getPost('message'),
            ];

            if ($this->contactFormModel->insert($data)) {
                return redirect()->back()->with('success', 'Form submitted successfully');
            }

            return redirect()->back()->with('error', 'Failed to submit form');
        }

        return view('system/forms/contact');
    }

    public function viewHVACSubmissions()
    {
        $submissions = $this->hvacFormModel->findAll();
        return view('system/forms/hvac_submissions', ['submissions' => $submissions]);
    }

    public function viewContactSubmissions()
    {
        $submissions = $this->contactFormModel->findAll();
        return view('system/forms/contact_submissions', ['submissions' => $submissions]);
    }
}
