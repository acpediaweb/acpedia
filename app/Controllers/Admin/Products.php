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
            ->select('products.*, brands.brand_name, categories.category_name, types.type_name')
            ->join('brands', 'brands.id = products.brand_id', 'left')
            ->join('categories', 'categories.id = products.category_id', 'left')
            ->join('types', 'types.id = products.type_id', 'left');

        if (!empty($search)) {
            $query = $query->like('products.product_name', $search);
        }

        if (!empty($brand)) {
            $query = $query->where('products.brand_id', $brand);
        }

        $products = $query->orderBy('products.product_name', 'ASC')
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
            'product_name' => 'required|min_length[3]|max_length[100]',
            'product_description' => 'required',
            'base_price' => 'required|numeric',
            'brand_id' => 'permit_empty|numeric',
            'category_id' => 'permit_empty|numeric',
            'type_id' => 'permit_empty|numeric',
        ]);

        if (!$validation) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        // Generate slug from product name
        $productName = $this->request->getPost('product_name');
        $slug = url_title($productName, '-', true);

        $data = [
            'product_name' => $productName,
            'product_description' => $this->request->getPost('product_description'),
            'slug' => $slug,
            'base_price' => $this->request->getPost('base_price'),
            'sale_price' => $this->request->getPost('sale_price') ?? null,
            'brand_id' => $this->request->getPost('brand_id') ?? null,
            'category_id' => $this->request->getPost('category_id') ?? null,
            'type_id' => $this->request->getPost('type_id') ?? null,
            'pk_category_id' => $this->request->getPost('pk_category_id') ?? null,
        ];

        // Handle main image
        $mainImage = $this->request->getFile('main_image');
        if ($mainImage && $mainImage->isValid()) {
            $name = time() . '_' . $mainImage->getRandomName();
            $mainImage->move(WRITEPATH . 'uploads', $name);
            $data['main_image'] = $name;
        }

        // Handle additional images (stored as JSON)
        $additionalImages = $this->request->getFileMultiple('additional_images');

if ($additionalImages) {
    $images = [];
    foreach ($additionalImages as $file) {
        // Check if file was actually uploaded and is valid
        if ($file->isValid() && !$file->hasMoved()) {
            $name = $file->getRandomName(); // CI4 handles unique names better this way
            $file->move(WRITEPATH . 'uploads', $name);
            $images[] = $name;
        }
    }
    
    if (!empty($images)) {
        // If updating, you might want to merge with existing images 
        // instead of overwriting, but for now, this matches your logic:
        $data['additional_images'] = json_encode($images);
    }
}

        // Handle extra attributes (stored as JSON)
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
