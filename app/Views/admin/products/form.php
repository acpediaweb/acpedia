<?= $this->extend('admin/admin-layout') ?>

<?= $this->section('content') ?>

<div class="max-w-4xl mx-auto space-y-6">
    <!-- Page Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-white">
                <?= $product ? 'Edit Product' : 'Create New Product' ?>
            </h1>
            <p class="text-gray-400 mt-1"><?= $product ? 'Update product details' : 'Add a new product to catalog' ?></p>
        </div>
        <a href="<?= base_url('admin/products') ?>" class="px-4 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded font-semibold transition-colors">
            Back to Products
        </a>
    </div>

    <!-- Form -->
    <form action="<?= base_url('admin/products/save') ?>" method="post" enctype="multipart/form-data" class="space-y-6">
        <?= csrf_field() ?>
        <?php if ($product): ?>
            <input type="hidden" name="id" value="<?= $product->id ?>">
        <?php endif; ?>

        <!-- Basic Information -->
        <div class="bg-gray-800 border border-gray-700 rounded-lg p-6">
            <h2 class="text-xl font-bold text-white mb-6">Basic Information</h2>

            <div class="space-y-4">
                <!-- Product Name -->
                <div>
                    <label class="text-gray-400 text-sm font-semibold block mb-2">Product Name *</label>
                    <input type="text" name="product_name" value="<?= $product ? esc($product->product_name) : esc(old('product_name')) ?>"
                        class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded text-white placeholder-gray-400 focus:outline-none focus:border-blue-500"
                        placeholder="Enter product name" required>
                    <?php if (isset($errors['product_name'])): ?>
                        <p class="text-red-400 text-sm mt-1"><?= $errors['product_name'] ?></p>
                    <?php endif; ?>
                </div>

                <!-- Description -->
                <div>
                    <label class="text-gray-400 text-sm font-semibold block mb-2">Description *</label>
                    <textarea name="product_description" rows="4"
                        class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded text-white placeholder-gray-400 focus:outline-none focus:border-blue-500"
                        placeholder="Enter product description" required><?= $product ? esc($product->product_description) : esc(old('product_description')) ?></textarea>
                    <?php if (isset($errors['product_description'])): ?>
                        <p class="text-red-400 text-sm mt-1"><?= $errors['product_description'] ?></p>
                    <?php endif; ?>
                </div>

                <!-- Grid: Prices, Brand, Type, Category -->
                <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
                    <!-- Base Price -->
                    <div>
                        <label class="text-gray-400 text-sm font-semibold block mb-2">Base Price (Rp) *</label>
                        <input type="number" name="base_price" step="0.01" value="<?= $product ? esc($product->base_price) : esc(old('base_price')) ?>"
                            class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded text-white placeholder-gray-400 focus:outline-none focus:border-blue-500"
                            placeholder="0" required>
                        <?php if (isset($errors['base_price'])): ?>
                            <p class="text-red-400 text-sm mt-1"><?= $errors['base_price'] ?></p>
                        <?php endif; ?>
                    </div>

                    <!-- Sale Price -->
                    <div>
                        <label class="text-gray-400 text-sm font-semibold block mb-2">Sale Price (Rp)</label>
                        <input type="number" name="sale_price" step="0.01" value="<?= $product ? esc($product->sale_price) : esc(old('sale_price')) ?>"
                            class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded text-white placeholder-gray-400 focus:outline-none focus:border-blue-500"
                            placeholder="0">
                    </div>

                    <!-- Brand -->
                    <div>
                        <label class="text-gray-400 text-sm font-semibold block mb-2">Brand</label>
                        <select name="brand_id" class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded text-white focus:outline-none focus:border-blue-500">
                            <option value="">Select Brand</option>
                            <?php foreach ($brands as $brand): ?>
                                <option value="<?= $brand->id ?>" <?= ($product && $product->brand_id === (int)$brand->id) ? 'selected' : '' ?>>
                                    <?= esc($brand->brand_name) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Product Type -->
                    <div>
                        <label class="text-gray-400 text-sm font-semibold block mb-2">Product Type</label>
                        <select name="type_id" class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded text-white focus:outline-none focus:border-blue-500">
                            <option value="">Select Type</option>
                            <?php foreach ($types as $type): ?>
                                <option value="<?= $type->id ?>" <?= ($product && $product->type_id === (int)$type->id) ? 'selected' : '' ?>>
                                    <?= esc($type->type_name) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <!-- Category -->
                <div>
                    <label class="text-gray-400 text-sm font-semibold block mb-2">Category</label>
                    <select name="category_id" class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded text-white focus:outline-none focus:border-blue-500">
                        <option value="">Select Category</option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?= $category->id ?>" <?= ($product && $product->category_id === (int)$category->id) ? 'selected' : '' ?>>
                                <?= esc($category->category_name) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>

        <!-- Images -->
        <div class="bg-gray-800 border border-gray-700 rounded-lg p-6">
            <h2 class="text-xl font-bold text-white mb-6">Product Images</h2>

            <div class="space-y-4">
                <!-- Main Image -->
                <div>
                    <label class="text-gray-400 text-sm font-semibold block mb-2">Main Image</label>
                    <?php if ($product && !empty($product->main_image)): ?>
                        <div class="mb-4 flex items-center gap-4">
                            <img src="<?= base_url('file/uploads/' . $product->main_image) ?>" 
                                alt="Main" class="w-24 h-24 object-cover rounded border border-gray-600">
                            <div>
                                <p class="text-gray-300 text-sm">Current main image</p>
                                <p class="text-gray-500 text-xs"><?= esc($product->main_image) ?></p>
                            </div>
                        </div>
                    <?php endif; ?>
                    <input type="file" name="main_image" accept="image/*"
                        class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded text-white focus:outline-none focus:border-blue-500"
                        placeholder="Upload main image">
                    <p class="text-gray-500 text-xs mt-1">Leave empty to keep current image</p>
                </div>

                <!-- Additional Images -->
                <div>
    <label class="text-gray-400 text-sm font-semibold block mb-2">Additional Images</label>
    <input type="file" name="additional_images[]" accept="image/*" multiple
        class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded text-white focus:outline-none focus:border-blue-500">
    <p class="text-gray-500 text-xs mt-1">Upload multiple images as JSON array</p>
    
    <?php if ($product && !empty($product->additional_images)): ?>
        <div class="mt-4">
            <p class="text-gray-400 text-sm font-semibold mb-3">Current Additional Images</p>
            <div class="grid grid-cols-4 gap-3">
                <?php 
                    $images = json_decode($product->additional_images, true);
                    if (is_array($images)): 
                        foreach ($images as $idx => $img): 
                ?>
                    <div class="relative">
                        <img src="<?= base_url('file/uploads/' . $img) ?>" 
                            alt="Additional" class="w-full h-20 object-cover rounded border border-gray-600">
                        <span class="absolute top-1 right-1 bg-gray-900 text-white text-xs px-2 py-1 rounded">
                            #<?= ($idx + 1) ?>
                        </span>
                    </div>
                <?php 
                        endforeach; 
                    endif; 
                ?>
            </div>
        </div>
    <?php endif; ?> </div>
            </div>
        </div>

        <!-- Extra Attributes -->
        <div class="bg-gray-800 border border-gray-700 rounded-lg p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-white">Extra Attributes</h2>
                <button type="button" id="addAttribute" class="px-3 py-1 bg-green-600 hover:bg-green-700 text-white text-sm rounded font-semibold transition-colors">
                    + Add Attribute
                </button>
            </div>

            <div id="attributesContainer" class="space-y-3">
                <?php if ($product && !empty($product->extra_attributes)): ?>
                    <?php 
                        $attributes = json_decode($product->extra_attributes, true);
                        if (is_array($attributes)):
                            foreach ($attributes as $key => $value):
                    ?>
                        <div class="flex gap-2 attribute-row">
                            <input type="text" name="attribute_key[]" value="<?= esc($key) ?>" 
                                placeholder="Attribute name (e.g. Color, Size)"
                                class="flex-1 px-4 py-2 bg-gray-700 border border-gray-600 rounded text-white placeholder-gray-400 focus:outline-none focus:border-blue-500">
                            <input type="text" name="attribute_value[]" value="<?= esc($value) ?>" 
                                placeholder="Value"
                                class="flex-1 px-4 py-2 bg-gray-700 border border-gray-600 rounded text-white placeholder-gray-400 focus:outline-none focus:border-blue-500">
                            <button type="button" onclick="this.parentElement.remove()" class="px-3 py-2 bg-red-600 hover:bg-red-700 text-white rounded font-semibold text-sm transition-colors">
                                Remove
                            </button>
                        </div>
                    <?php endforeach; endif; endif; ?>
            </div>

            <p class="text-gray-500 text-xs mt-2">Add key-value pairs for custom product attributes</p>
        </div>

        <!-- Form Actions -->
        <div class="flex gap-3">
            <button type="submit" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded font-bold transition-colors">
                <?= $product ? 'Update Product' : 'Create Product' ?>
            </button>
            <a href="<?= base_url('admin/products') ?>" class="px-6 py-3 bg-gray-700 hover:bg-gray-600 text-white rounded font-bold transition-colors">
                Cancel
            </a>
        </div>
    </form>
</div>

<script>
document.getElementById('addAttribute').addEventListener('click', function() {
    const container = document.getElementById('attributesContainer');
    const row = document.createElement('div');
    row.className = 'flex gap-2 attribute-row';
    row.innerHTML = `
        <input type="text" name="attribute_key[]" 
            placeholder="Attribute name (e.g. Color, Size)"
            class="flex-1 px-4 py-2 bg-gray-700 border border-gray-600 rounded text-white placeholder-gray-400 focus:outline-none focus:border-blue-500">
        <input type="text" name="attribute_value[]" 
            placeholder="Value"
            class="flex-1 px-4 py-2 bg-gray-700 border border-gray-600 rounded text-white placeholder-gray-400 focus:outline-none focus:border-blue-500">
        <button type="button" onclick="this.parentElement.remove()" class="px-3 py-2 bg-red-600 hover:bg-red-700 text-white rounded font-semibold text-sm transition-colors">
            Remove
        </button>
    `;
    container.appendChild(row);
});
</script>

<?= $this->endSection() ?>
