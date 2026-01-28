<?= $this->extend('admin/admin-layout') ?>

<?= $this->section('content') ?>

<div class="max-w-4xl mx-auto space-y-6">
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

    <form action="<?= base_url('admin/products/save') ?>" method="post" enctype="multipart/form-data" class="space-y-6">
        <?= csrf_field() ?>
        <?php if ($product): ?>
            <input type="hidden" name="id" value="<?= $product->id ?>">
        <?php endif; ?>

        <div class="bg-gray-800 border border-gray-700 rounded-lg p-6">
            <h2 class="text-xl font-bold text-white mb-6">Basic Information</h2>

            <div class="space-y-4">
                <div>
                    <label class="text-gray-400 text-sm font-semibold block mb-2">Product Name *</label>
                    <input type="text" name="product_name" value="<?= $product ? esc($product->product_name) : esc(old('product_name')) ?>"
                        class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded text-white focus:outline-none focus:border-blue-500"
                        placeholder="e.g. MacBook Pro M3" required>
                    <?php if (isset($errors['product_name'])): ?>
                        <p class="text-red-400 text-sm mt-1"><?= $errors['product_name'] ?></p>
                    <?php endif; ?>
                </div>

                <div>
                    <label class="text-gray-400 text-sm font-semibold block mb-2">Description *</label>
                    <textarea name="product_description" rows="4"
                        class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded text-white focus:outline-none focus:border-blue-500"
                        placeholder="Detailed product specs..." required><?= $product ? esc($product->product_description) : esc(old('product_description')) ?></textarea>
                </div>
            </div>
        </div>

        <div class="bg-gray-800 border border-gray-700 rounded-lg p-6">
            <h2 class="text-xl font-bold text-white mb-6">Pricing & Specifications</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-4">
                    <div>
                        <label class="text-gray-400 text-sm font-semibold block mb-2">Base Price (Rp) *</label>
                        <input type="number" name="base_price" step="0.01" value="<?= $product ? esc($product->base_price) : esc(old('base_price')) ?>"
                            class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded text-white focus:outline-none focus:border-blue-500" required>
                    </div>
                    <div>
                        <label class="text-gray-400 text-sm font-semibold block mb-2">Sale Price (Rp)</label>
                        <input type="number" name="sale_price" step="0.01" value="<?= $product ? esc($product->sale_price) : esc(old('sale_price')) ?>"
                            class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded text-white focus:outline-none focus:border-blue-500">
                    </div>
                </div>

                <div class="space-y-4">
                    <div>
                        <label class="text-gray-400 text-sm font-semibold block mb-2">Brand *</label>
                        <select name="brand_id" required class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded text-white focus:outline-none focus:border-blue-500">
                            <option value="" disabled <?= !$product ? 'selected' : '' ?>>-- Choose Brand --</option>
                            <?php foreach ($brands as $brand): ?>
                                <option value="<?= $brand->id ?>" <?= ($product && (int)$product->brand_id === (int)$brand->id) ? 'selected' : '' ?>>
                                    <?= esc($brand->brand_name) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div>
                        <label class="text-gray-400 text-sm font-semibold block mb-2">Category *</label>
                        <select name="category_id" required class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded text-white focus:outline-none focus:border-blue-500">
                            <option value="" disabled <?= !$product ? 'selected' : '' ?>>-- Choose Category --</option>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?= $category->id ?>" <?= ($product && (int)$product->category_id === (int)$category->id) ? 'selected' : '' ?>>
                                    <?= esc($category->category_name) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div>
                        <label class="text-gray-400 text-sm font-semibold block mb-2">Product Type *</label>
                        <select name="type_id" required class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded text-white focus:outline-none focus:border-blue-500">
                            <option value="" disabled <?= !$product ? 'selected' : '' ?>>-- Choose Type --</option>
                            <?php foreach ($types as $type): ?>
                                <option value="<?= $type->id ?>" <?= ($product && (int)$product->type_id === (int)$type->id) ? 'selected' : '' ?>>
                                    <?= esc($type->type_name) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-gray-800 border border-gray-700 rounded-lg p-6">
            <h2 class="text-xl font-bold text-white mb-6">Product Images</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="text-gray-400 text-sm font-semibold block mb-2">Main Image</label>
                    <?php if ($product && !empty($product->main_image)): ?>
                        <img src="<?= base_url('file/uploads/' . $product->main_image) ?>" class="w-32 h-32 object-cover rounded mb-2 border border-gray-600">
                    <?php endif; ?>
                    <input type="file" name="main_image" accept="image/*" class="w-full text-gray-400 text-sm">
                </div>
                <div>
                    <label class="text-gray-400 text-sm font-semibold block mb-2">Gallery Images</label>
                    <input type="file" name="additional_images[]" accept="image/*" multiple class="w-full text-gray-400 text-sm">
                    <?php if ($product && !empty($product->additional_images)): ?>
                        <div class="flex gap-2 mt-2">
                            <span class="text-xs text-gray-500"><?= count(json_decode($product->additional_images)) ?> images uploaded</span>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="bg-gray-800 border border-gray-700 rounded-lg p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-white">Extra Attributes</h2>
                <button type="button" id="addAttribute" class="px-3 py-1 bg-green-600 hover:bg-green-700 text-white text-sm rounded transition-colors">+ Add</button>
            </div>
            <div id="attributesContainer" class="space-y-3">
                <?php if ($product && !empty($product->extra_attributes)): 
                    $attrs = json_decode($product->extra_attributes, true);
                    foreach ($attrs as $key => $val): ?>
                    <div class="flex gap-2">
                        <input type="text" name="attribute_key[]" value="<?= esc($key) ?>" placeholder="Key" class="flex-1 px-4 py-2 bg-gray-700 border border-gray-600 rounded text-white">
                        <input type="text" name="attribute_value[]" value="<?= esc($val) ?>" placeholder="Value" class="flex-1 px-4 py-2 bg-gray-700 border border-gray-600 rounded text-white">
                        <button type="button" onclick="this.parentElement.remove()" class="px-3 py-2 bg-red-600 text-white rounded">×</button>
                    </div>
                <?php endforeach; endif; ?>
            </div>
        </div>

        <div class="flex gap-3 pt-4">
            <button type="submit" class="px-8 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded font-bold transition-all transform hover:scale-105">
                <?= $product ? 'Save Changes' : 'Publish Product' ?>
            </button>
            <a href="<?= base_url('admin/products') ?>" class="px-8 py-3 bg-gray-700 text-white rounded font-bold">Cancel</a>
        </div>
    </form>
</div>

<script>
document.getElementById('addAttribute').addEventListener('click', function() {
    const container = document.getElementById('attributesContainer');
    const row = document.createElement('div');
    row.className = 'flex gap-2';
    row.innerHTML = `
        <input type="text" name="attribute_key[]" placeholder="e.g. Color" class="flex-1 px-4 py-2 bg-gray-700 border border-gray-600 rounded text-white">
        <input type="text" name="attribute_value[]" placeholder="e.g. Midnight Blue" class="flex-1 px-4 py-2 bg-gray-700 border border-gray-600 rounded text-white">
        <button type="button" onclick="this.parentElement.remove()" class="px-3 py-2 bg-red-600 text-white rounded">×</button>
    `;
    container.appendChild(row);
});
</script>

<?= $this->endSection() ?>