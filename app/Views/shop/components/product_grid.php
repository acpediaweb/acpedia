<?php
// Defensive coding
$products = $products ?? [];
$paginationLinks = $paginationLinks ?? '';
?>

<div id="productsGrid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 mb-6">
    <?php if (empty($products)): ?>
        <div class="col-span-full text-center py-10 text-gray-500">
            Tidak ada produk ditemukan.
        </div>
    <?php else: ?>
        <?php foreach ($products as $product): ?>
            <?php $detailUrl = base_url('produk/' . ($product['slug'] ?? '#')); ?>
            <div class="product-card bg-white rounded-lg shadow hover:shadow-lg transition-shadow overflow-hidden">
                <div class="relative">
                    <?php
                    $imageUrl = $product['main_image_url'] ?? '';
                    $isAbsoluteUrl = preg_match('/^https?:\/\//i', $imageUrl);
                    ?>
                    <a href="<?= $detailUrl ?>" class="block">
                        <?php if (!empty($imageUrl)): ?>
                            <img src="<?= $isAbsoluteUrl ? $imageUrl : base_url($imageUrl) ?>" alt="<?= esc($product['name'] ?? '') ?>" class="w-full h-48 object-cover hover:opacity-90 transition-opacity">
                        <?php else: ?>
                            <div class="w-full h-48 flex items-center justify-center bg-gray-100 text-gray-400">[No Image]</div>
                        <?php endif; ?>
                    </a>

                    <?php
                    $basePrice = $product['base_price'] ?? 0;
                    $salePrice = $product['sale_price'] ?? null;
                    $isOnSale = $salePrice && $salePrice < $basePrice;
                    $discountPercent = $isOnSale && $basePrice > 0 ? round((($basePrice - $salePrice) / $basePrice) * 100) : 0;
                    ?>
                    <?php if ($isOnSale): ?>
                        <div class="absolute top-2 right-2 bg-[#F99C1C] text-white rounded-full w-12 h-12 flex items-center justify-center font-bold text-sm pointer-events-none"><?= $discountPercent ?>%</div>
                    <?php endif; ?>
                </div>

                <div class="p-3">
                    <div class="flex items-center gap-2 mb-2">
                        <span class="text-xs px-2 py-1 bg-[#41B8EA] text-white rounded"><?= esc($product['category_name'] ?? 'Unknown') ?></span>
                        <span class="text-xs px-2 py-1 bg-[#3EB48A] text-white rounded"><?= esc($product['pk_name'] ?? 'Unknown PK') ?></span>
                    </div>
                    <h3 class="font-semibold text-sm mb-2 line-clamp-2">
                        <a href="<?= $detailUrl ?>" class="hover:text-[#41B8EA] transition-colors"><?= esc($product['name'] ?? 'Produk') ?></a>
                    </h3>
                    
                    <div class="mb-3">
                        <?php if ($isOnSale): ?>
                            <div class="text-xs text-gray-400 line-through">Rp <?= number_format($basePrice, 0, ',', '.') ?></div>
                        <?php endif; ?>
                        <div class="text-lg font-bold text-[#ED2024]">Rp <?= number_format($isOnSale ? $salePrice : $basePrice, 0, ',', '.') ?></div>
                    </div>

                    <div class="flex gap-2">
                         <button data-compare-slug="<?= $product['slug'] ?? '' ?>" data-compare-name="<?= esc($product['name'] ?? '') ?>" class="compare-toggle-btn flex-1 text-xs border border-[#41B8EA] text-[#41B8EA] hover:bg-[#41B8EA] hover:text-white py-2 px-3 rounded transition-colors">Komparasi</button>
                        
                        <?php 
                        // Simplified stock check for view
                        $initialStock = $product['stock'] ?? 0; 
                        // If you need real-time stock, you might need to query explicitly, but usually it's passed in $product
                        $isOutOfStock = ($initialStock <= 0);
                        ?>
                        <button id="btn-product-<?= $product['id'] ?? 0 ?>" class="add-to-cart-btn flex-1 text-xs py-2 px-3 rounded transition-colors <?= $isOutOfStock ? 'bg-gray-400 cursor-not-allowed' : 'bg-[#F99C1C] hover:bg-[#F99C1C]/90 text-white' ?>" data-id="<?= $product['id'] ?? 0 ?>" data-name="<?= esc($product['name'] ?? '') ?>" data-price="<?= $isOnSale ? $salePrice : $basePrice ?>" data-stock="<?= $initialStock ?>" <?= $isOutOfStock ? 'disabled' : '' ?>>
                            <?= $isOutOfStock ? 'Stok Habis' : 'Pesan' ?>
                        </button>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<?= $paginationLinks ?>