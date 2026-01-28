<?php

namespace App\Controllers\Users;

use App\Controllers\BaseController;
use App\Models\UserModel;

class UserProfile extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    /**
     * Display user profile
     */
    public function index()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('login')->with('error', 'Please login first');
        }

        $userId = session()->get('user_id');
        $user = $this->userModel->find($userId);

        if (!$user) {
            return redirect()->to('/')->with('error', 'User not found');
        }

        $data = [
            'title' => 'My Profile',
            'user'  => $user
        ];

        return view('users/profile/index', $data);
    }

    /**
     * Update basic profile information
     */
    public function updateProfile()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('login');
        }

        $userId = session()->get('user_id');
        
        // Validate input
        if (!$this->validate([
            'fullname' => 'required|min_length[3]|max_length[50]'
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $fullname = $this->request->getPost('fullname');

        // Check if fullname is unique (excluding current user)
        $existing = $this->userModel
            ->where('fullname', $fullname)
            ->where('id !=', $userId)
            ->first();

        if ($existing) {
            return redirect()->back()->withInput()->with('error', 'Fullname already taken');
        }

        // Update profile
        $this->userModel->update($userId, [
            'fullname' => $fullname
        ]);

        // Update session
        session()->set('fullname', $fullname);

        return redirect()->back()->with('success', 'Profile updated successfully');
    }

    /**
     * Update profile picture
     */
    public function updateProfilePicture()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('login');
        }

        $userId = session()->get('user_id');
        $file = $this->request->getFile('profile_picture');

        if (!$file || !$file->isValid()) {
            return redirect()->back()->with('error', 'Please select a valid image file');
        }

        // Validate file type
        if (!in_array($file->getMimeType(), ['image/jpeg', 'image/png', 'image/gif'])) {
            return redirect()->back()->with('error', 'Only JPG, PNG, and GIF images are allowed');
        }

        // Validate file size (max 5MB)
        if ($file->getSize() > 5242880) {
            return redirect()->back()->with('error', 'File size must be less than 5MB');
        }

        // Generate unique filename
        $newName = 'profile_' . $userId . '_' . time() . '.' . $file->getExtension();

        // Move file to uploads directory
        $file->move(WRITEPATH . 'uploads', $newName);

        // Get old profile picture and delete if exists
        $user = $this->userModel->find($userId);
        if ($user && $user->profile_picture) {
            $oldPath = WRITEPATH . 'uploads/' . $user->profile_picture;
            if (file_exists($oldPath)) {
                unlink($oldPath);
            }
        }

        // Update database
        $this->userModel->update($userId, [
            'profile_picture' => $newName
        ]);

        return redirect()->back()->with('success', 'Profile picture updated successfully');
    }

    /**
     * Change password
     */
    public function changePassword()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('login');
        }

        // Validate input
        if (!$this->validate([
            'old_password'      => 'required|min_length[8]',
            'new_password'      => 'required|min_length[8]',
            'confirm_password'  => 'required|matches[new_password]'
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $userId = session()->get('user_id');
        $user = $this->userModel->find($userId);
        $oldPassword = $this->request->getPost('old_password');

        // Verify old password
        if (!password_verify($oldPassword, $user->password_hash)) {
            return redirect()->back()->with('error', 'Old password is incorrect');
        }

        // Update password
        $newPassword = $this->request->getPost('new_password');
        $this->userModel->update($userId, [
            'password_hash' => $newPassword
        ]);

        return redirect()->back()->with('success', 'Password changed successfully');
    }
}
