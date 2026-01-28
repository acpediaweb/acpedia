<?php

namespace App\Controllers\Operations;

use App\Controllers\BaseController;
use App\Models\Operations\OrderTechWorkModel;
use App\Models\Order\OrderModel;

class TechnicianWorkController extends BaseController
{
    protected $techWorkModel;
    protected $orderModel;

    public function __construct()
    {
        $this->techWorkModel = new OrderTechWorkModel();
        $this->orderModel = new OrderModel();
    }

    public function index()
    {
        if (!session()->has('user_id')) {
            return redirect()->to('/auth/login');
        }

        $technicianId = session()->get('user_id');
        $jobs = $this->techWorkModel->getByTechnicianId($technicianId);
        return view('operations/technician_work/index', ['jobs' => $jobs]);
    }

    public function clockIn($orderId)
    {
        if (!session()->has('user_id')) {
            return redirect()->to('/auth/login');
        }

        if ($this->request->getMethod() === 'post') {
            $selfie = $this->request->getFile('clockin_selfie');
            $selfieName = '';

            if ($selfie && $selfie->isValid() && !$selfie->hasMoved()) {
                $selfieName = $selfie->getRandomName();
                $selfie->move('uploads/technician', $selfieName);
            }

            $data = [
                'order_id' => $orderId,
                'technician_actor_id' => session()->get('user_id'),
                'clockin_timestamp' => date('Y-m-d H:i:s'),
                'clockin_latitude' => $this->request->getPost('latitude'),
                'clockin_longitude' => $this->request->getPost('longitude'),
                'clockin_selfie_url' => $selfieName,
            ];

            if ($this->techWorkModel->insert($data)) {
                $this->orderModel->update($orderId, ['order_status' => 'In Progress']);
                return redirect()->back()->with('success', 'Clock-in recorded successfully');
            }
        }

        return view('operations/technician_work/clock_in', ['orderId' => $orderId]);
    }

    public function clockOut($jobId)
    {
        if (!session()->has('user_id')) {
            return redirect()->to('/auth/login');
        }

        if ($this->request->getMethod() === 'post') {
            $selfie = $this->request->getFile('clockout_selfie');
            $selfieName = '';

            if ($selfie && $selfie->isValid() && !$selfie->hasMoved()) {
                $selfieName = $selfie->getRandomName();
                $selfie->move('uploads/technician', $selfieName);
            }

            $data = [
                'clockout_timestamp' => date('Y-m-d H:i:s'),
                'clockout_latitude' => $this->request->getPost('latitude'),
                'clockout_longitude' => $this->request->getPost('longitude'),
                'clockout_selfie_url' => $selfieName,
                'completion_notes' => $this->request->getPost('completion_notes'),
            ];

            if ($this->techWorkModel->update($jobId, $data)) {
                $job = $this->techWorkModel->find($jobId);
                $this->orderModel->update($job->order_id, ['order_status' => 'Completed']);
                return redirect()->to('/technician-work')->with('success', 'Clock-out recorded successfully');
            }
        }

        $job = $this->techWorkModel->find($jobId);
        return view('operations/technician_work/clock_out', ['job' => $job]);
    }
}
