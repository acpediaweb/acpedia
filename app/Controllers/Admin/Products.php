<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ProductModel;
use App\Models\CategoryModel;
use App\Models\BrandModel;
use App\Models\ProductTypeModel;

class Products extends BaseController
{
    protected $productModel;
    protected $categoryModel;
    protected $brandModel;
    protected $typeModel;
    protected $perPage = 20;

    public function __construct()
    {
        $this->productModel = new ProductModel();
        $this->categoryModel = new CategoryModel();
        $this->brandModel = new BrandModel();
        $this->typeModel = new ProductTypeModel();
    }

    /**
     * Display list of all products
     */
    public function index()
    {
        $page = $this->request->getVar('page') ?? 1;
        $search = $this->request->getVar('search') ?? '';
        $brand = $this->request->getVar('brand') ?? '';

        $query = $this->productModel
            ->select('products.*, brands.name as brand_name, product_categories.category_id')
            ->join('brands', 'brands.id = products.brand_id', 'left')
            ->join('product_categories', 'product_categories.product_id = products.id', 'left');

        if (!empty($search)) {
            $query = $query->like('products.name', $search);
        }

        if (!empty($brand)) {
            $query = $query->where('products.brand_id', $brand);
        }

        $products = $query->distinct()
            ->orderBy('products.name', 'ASC')
            ->paginate($this->perPage, 'products');

        return view('admin/products/index', [
            'products' => $products,
            'pager' => $this->productModel->pager,
            'searchQuery' => $search,
            'selectedBrand' => $brand,
            'brands' => $this->brandModel->findAll(),
        ]);
    }

    /**
     * Show edit form for product (also used for create)
     */
    public function edit($id = null)
    {
        $product = null;
        if ($id) {
            $product = $this->productModel->find($id);
            if (!$product) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        }

        return view('admin/products/form', [
            'product' => $product,
            'brands' => $this->brandModel->findAll(),
            'categories' => $this->categoryModel->findAll(),
            'types' => $this->typeModel->findAll(),
        ]);
    }

    /**
     * Save product (create or update)
     */
    public function save()
    {
        $id = $this->request->getPost('id');
        $validation = $this->validate([
            'name' => 'required|min_length[3]|max_length[255]',
            'description' => 'required',
            'price' => 'required|numeric',
            'brand_id' => 'required|numeric',
            'product_type_id' => 'required|numeric',
            'unit' => 'required|min_length[1]|max_length[50]',
        ]);

        if (!$validation) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $data = [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'price' => $this->request->getPost('price'),
            'brand_id' => $this->request->getPost('brand_id'),
            'product_type_id' => $this->request->getPost('product_type_id'),
            'unit' => $this->request->getPost('unit'),
            'is_active' => $this->request->getPost('is_active') ? 1 : 0,
        ];

        // Handle main image
        $mainImage = $this->request->getFile('main_image');
        if ($mainImage && $mainImage->isValid()) {
            $name = time() . '_' . $mainImage->getRandomName();
            $mainImage->move(WRITEPATH . 'uploads', $name);
            $data['main_image_url'] = $name;
        }

        // Handle additional images
        $additionalImages = $this->request->getFiles('additional_images');
        if (!empty($additionalImages)) {
            $images = [];
            foreach ($additionalImages as $file) {
                if ($file->isValid()) {
                    $name = time() . '_' . $file->getRandomName();
                    $file->move(WRITEPATH . 'uploads', $name);
                    $images[] = ['url' => $name, 'order' => count($images)];
                }
            }
            if (!empty($images)) {
                $data['additional_images'] = json_encode($images);
            }
        }

        // Handle extra attributes
        $attributeKeys = $this->request->getPost('attribute_key');
        $attributeValues = $this->request->getPost('attribute_value');
        if (!empty($attributeKeys)) {
            $attributes = [];
            foreach ($attributeKeys as $idx => $key) {
                if (!empty($key) && isset($attributeValues[$idx])) {
                    $attributes[$key] = $attributeValues[$idx];
                }
            }
            if (!empty($attributes)) {
                $data['extra_attributes'] = json_encode($attributes);
            }
        }

        if ($id) {
            $this->productModel->update($id, $data);
            $message = 'Product updated successfully';
        } else {
            $id = $this->productModel->insert($data);
            $message = 'Product created successfully';
        }

        // Handle categories
        $categories = $this->request->getPost('categories') ?? [];
        if (!empty($categories)) {
            // Delete existing categories
            $db = \Config\Database::connect();
            $db->table('product_categories')->where('product_id', $id)->delete();

            // Insert new categories
            foreach ($categories as $catId) {
                $db->table('product_categories')->insert([
                    'product_id' => $id,
                    'category_id' => $catId,
                ]);
            }
        }

        return redirect()->to('admin/products')
            ->with('success', $message);
    }

    /**
     * Delete a product
     */
    public function delete($id)
    {
        $product = $this->productModel->find($id);
        if (!$product) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Product not found'
            ])->setStatusCode(404);
        }

        $this->productModel->delete($id);

        return redirect()->to('admin/products')
            ->with('success', 'Product deleted successfully');
    }
}
