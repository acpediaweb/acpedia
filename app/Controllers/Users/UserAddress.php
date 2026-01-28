<?php

namespace App\Controllers\Users;

use App\Controllers\BaseController;
use App\Models\UserAddressModel;

class UserAddress extends BaseController
{
    protected $addressModel;

    public function __construct()
    {
        $this->addressModel = new UserAddressModel();
    }

    /**
     * List all user addresses
     */
    public function index()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('login')->with('error', 'Please login first');
        }

        $userId = session()->get('user_id');
        $addresses = $this->addressModel
            ->where('user_id', $userId)
            ->orderBy('is_primary', 'DESC')
            ->orderBy('id', 'DESC')
            ->findAll();

        $data = [
            'title'     => 'My Addresses',
            'addresses' => $addresses
        ];

        return view('users/address/index', $data);
    }

    /**
     * Show add address form
     */
    public function create()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('login');
        }

        $data = [
            'title' => 'Add New Address'
        ];

        return view('users/address/form', $data);
    }

    /**
     * Store new address
     */
    public function store()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('login');
        }

        // Validate input
        if (!$this->validate([
            'street'       => 'required|min_length[5]|max_length[255]',
            'sub_district' => 'required|min_length[2]|max_length[100]',
            'district'     => 'required|min_length[2]|max_length[100]',
            'city'         => 'required|min_length[2]|max_length[100]',
            'province'     => 'required|min_length[2]|max_length[100]',
            'postal_code'  => 'required|min_length[5]|max_length[20]'
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $userId = session()->get('user_id');

        // Check if this is the first address (make it primary)
        $existingCount = $this->addressModel
            ->where('user_id', $userId)
            ->countAllResults();

        $isPrimary = ($existingCount === 0) ? 1 : 0;

        // Insert address
        $this->addressModel->insert([
            'user_id'       => $userId,
            'street'        => $this->request->getPost('street'),
            'sub_district'  => $this->request->getPost('sub_district'),
            'district'      => $this->request->getPost('district'),
            'city'          => $this->request->getPost('city'),
            'province'      => $this->request->getPost('province'),
            'postal_code'   => $this->request->getPost('postal_code'),
            'latitude'      => $this->request->getPost('latitude') ?? null,
            'longitude'     => $this->request->getPost('longitude') ?? null,
            'is_primary'    => $isPrimary
        ]);

        return redirect()->to('users/address')->with('success', 'Address added successfully');
    }

    /**
     * Show edit address form
     */
    public function edit($id)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('login');
        }

        $userId = session()->get('user_id');
        $address = $this->addressModel
            ->where('id', $id)
            ->where('user_id', $userId)
            ->first();

        if (!$address) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = [
            'title'   => 'Edit Address',
            'address' => $address
        ];

        return view('users/address/form', $data);
    }

    /**
     * Update address
     */
    public function update($id)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('login');
        }

        // Validate input
        if (!$this->validate([
            'street'       => 'required|min_length[5]|max_length[255]',
            'sub_district' => 'required|min_length[2]|max_length[100]',
            'district'     => 'required|min_length[2]|max_length[100]',
            'city'         => 'required|min_length[2]|max_length[100]',
            'province'     => 'required|min_length[2]|max_length[100]',
            'postal_code'  => 'required|min_length[5]|max_length[20]'
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $userId = session()->get('user_id');
        
        // Verify ownership
        $address = $this->addressModel
            ->where('id', $id)
            ->where('user_id', $userId)
            ->first();

        if (!$address) {
            return redirect()->to('users/address')->with('error', 'Address not found');
        }

        // Update address
        $this->addressModel->update($id, [
            'street'       => $this->request->getPost('street'),
            'sub_district' => $this->request->getPost('sub_district'),
            'district'     => $this->request->getPost('district'),
            'city'         => $this->request->getPost('city'),
            'province'     => $this->request->getPost('province'),
            'postal_code'  => $this->request->getPost('postal_code'),
            'latitude'     => $this->request->getPost('latitude') ?? $address->latitude,
            'longitude'    => $this->request->getPost('longitude') ?? $address->longitude
        ]);

        return redirect()->to('users/address')->with('success', 'Address updated successfully');
    }

    /**
     * Set address as primary
     */
    public function setPrimary($id)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('login');
        }

        $userId = session()->get('user_id');
        
        // Verify ownership
        $address = $this->addressModel
            ->where('id', $id)
            ->where('user_id', $userId)
            ->first();

        if (!$address) {
            return redirect()->to('users/address')->with('error', 'Address not found');
        }

        // Set all addresses to not primary
        $db = \Config\Database::connect();
        $db->table('users_addresses')
            ->where('user_id', $userId)
            ->update(['is_primary' => false]);

        // Set this address as primary
        $this->addressModel->update($id, ['is_primary' => true]);

        return redirect()->to('users/address')->with('success', 'Primary address updated');
    }

    /**
     * Delete address
     */
    public function delete($id)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('login');
        }

        $userId = session()->get('user_id');
        
        // Verify ownership
        $address = $this->addressModel
            ->where('id', $id)
            ->where('user_id', $userId)
            ->first();

        if (!$address) {
            return redirect()->to('users/address')->with('error', 'Address not found');
        }

        // Cannot delete if it's the only address
        $count = $this->addressModel
            ->where('user_id', $userId)
            ->countAllResults();

        if ($count === 1) {
            return redirect()->to('users/address')->with('error', 'You must have at least one address');
        }

        // Delete address
        $this->addressModel->delete($id);

        return redirect()->to('users/address')->with('success', 'Address deleted successfully');
    }
}
