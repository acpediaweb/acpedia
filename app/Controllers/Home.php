<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Home extends BaseController
{
    /**
     * Display company profile homepage
     * Route: /
     */
    public function index()
    {
        $data = [
            'title' => 'ACPedia - Home',
            'page' => 'home',
        ];

        return view('home/index', $data);
    }

    /**
     * Display about us page
     * Route: /tentang-kami
     */
    public function about()
    {
        $data = [
            'title' => 'ACPedia - Tentang Kami',
            'page' => 'about',
        ];

        return view('home/about', $data);
    }

    /**
     * Display services overview
     * Route: /layanan
     */
    public function services()
    {
        $data = [
            'title' => 'ACPedia - Layanan Kami',
            'page' => 'services',
        ];

        return view('home/services', $data);
    }

    /**
     * Display contact us page
     * Route: /hubungi-kami
     */
    public function contact()
    {
        if ($this->request->getMethod() === 'post') {
            // Handle contact form submission
            $validationRules = [
                'full_name' => 'required|min_length[1]|max_length[100]',
                'email' => 'required|valid_email',
                'phone_number' => 'permit_empty|string|max_length[20]',
                'subject' => 'required|min_length[1]|max_length[150]',
                'message' => 'required|string|min_length[5]',
            ];

            if ($this->validate($validationRules)) {
                // Save form submission
                $contactModel = new \App\Models\System\ContactUsFormSubmissionModel();
                $data = [
                    'full_name' => $this->request->getPost('full_name'),
                    'email' => $this->request->getPost('email'),
                    'phone_number' => $this->request->getPost('phone_number'),
                    'whatsapp_number' => $this->request->getPost('whatsapp_number'),
                    'subject' => $this->request->getPost('subject'),
                    'message' => $this->request->getPost('message'),
                ];

                if ($contactModel->save($data)) {
                    session()->setFlashdata('success', 'Pesan Anda telah dikirim. Kami akan menghubungi Anda segera.');
                    return redirect()->to('/hubungi-kami');
                } else {
                    session()->setFlashdata('error', 'Gagal mengirim pesan. Silakan coba lagi.');
                }
            } else {
                session()->setFlashdata('error', $this->validator->listErrors());
            }
        }

        $data = [
            'title' => 'ACPedia - Hubungi Kami',
            'page' => 'contact',
        ];

        return view('home/contact', $data);
    }

    /**
     * Display HVAC form page
     * Route: /form-hvac
     */
    public function hvacForm()
    {
        if ($this->request->getMethod() === 'post') {
            // Handle HVAC form submission
            $validationRules = [
                'first_name' => 'required|min_length[1]|max_length[50]',
                'last_name' => 'required|min_length[1]|max_length[50]',
                'email' => 'required|valid_email',
                'phone_number' => 'permit_empty|string|max_length[20]',
                'subject' => 'required|min_length[1]|max_length[150]',
                'message' => 'required|string|min_length[5]',
            ];

            if ($this->validate($validationRules)) {
                // Save HVAC form submission
                $formModel = new \App\Models\System\HVACFormSubmissionModel();
                $data = [
                    'first_name' => $this->request->getPost('first_name'),
                    'last_name' => $this->request->getPost('last_name'),
                    'email' => $this->request->getPost('email'),
                    'phone_number' => $this->request->getPost('phone_number'),
                    'whatsapp_number' => $this->request->getPost('whatsapp_number'),
                    'subject' => $this->request->getPost('subject'),
                    'message' => $this->request->getPost('message'),
                ];

                if ($formModel->save($data)) {
                    session()->setFlashdata('success', 'Form HVAC Anda telah dikirim. Tim kami akan segera menghubungi Anda.');
                    return redirect()->to('/form-hvac');
                } else {
                    session()->setFlashdata('error', 'Gagal mengirim form. Silakan coba lagi.');
                }
            } else {
                session()->setFlashdata('error', $this->validator->listErrors());
            }
        }

        $data = [
            'title' => 'ACPedia - Form HVAC',
            'page' => 'hvac_form',
        ];

        return view('home/hvac_form', $data);
    }

    /**
     * Display service detail page
     * Route: /layanan/:slug
     */
    public function serviceDetail($slug = null)
    {
        $services = [
            'pemasangan' => [
                'title' => 'ACPedia - Layanan Pemasangan',
                'name' => 'Pemasangan',
                'slug' => 'pemasangan'
            ],
            'perawatan' => [
                'title' => 'ACPedia - Layanan Perawatan',
                'name' => 'Perawatan',
                'slug' => 'perawatan'
            ],
            'perbaikan' => [
                'title' => 'ACPedia - Layanan Perbaikan',
                'name' => 'Perbaikan',
                'slug' => 'perbaikan'
            ],
        ];

        if (!$slug || !isset($services[$slug])) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = [
            'title' => $services[$slug]['title'],
            'page' => 'service',
            'service' => $services[$slug],
        ];

        return view('home/service_detail', $data);
    }

    /**
     * Display projects page
     * Route: /proyek
     */
    public function projects()
    {
        $data = [
            'title' => 'ACPedia - Proyek Kami',
            'page' => 'projects',
        ];

        return view('home/projects', $data);
    }

    /**
     * Display HVAC contact page (project detail)
     * Route: /proyek/hvac-contact
     */
    public function hvacContact()
    {
        $data = [
            'title' => 'ACPedia - HVAC Contact - Proyek',
            'page' => 'hvac_contact',
        ];

        return view('home/hvac_contact', $data);
    }
}
