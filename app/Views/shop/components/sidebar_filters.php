<?php
// Defensive coding: Ensure variables exist to prevent crashes
$currentFilters = $currentFilters ?? [];
$currentURLParams = $currentURLParams ?? $_GET; // Fallback to $_GET if variable missing
$brands = $brands ?? [];
$pkList = $pkList ?? [];
$categories = $categories ?? [];
?>

<div class="bg-white rounded-lg p-4 shadow">
    <h3 class="font-bold mb-4 text-[#373E51]">Filter</h3>
    
    <?php if (!empty($_GET)): ?>
        <div class="mb-6">
            <a href="<?= strtok($_SERVER['REQUEST_URI'], '?') ?>" 
               class="w-full inline-block text-center px-4 py-2 rounded border border-red-500 bg-red-500 text-white hover:bg-red-600 hover:border-red-600 transition-all">
                Reset Filters
            </a>
        </div>
    <?php endif; ?>

    <div class="mb-6">
        <button id="brandsFilterToggle" class="w-full flex items-center justify-between mb-3 hover:text-[#41B8EA] transition-colors">
            <h4 class="font-semibold text-[#373E51]">Brands</h4>
            <i data-lucide="chevron-down" id="brandsFilterChevron" class="h-5 w-5 text-[#41B8EA] transition-transform duration-200"></i>
        </button>
        <div id="brandsFilterContent" class="dropdown-content open space-y-2">
            <?php foreach ($brands as $brand): 
                $brandId = $brand['id'] ?? $brand['name'];
                $isActive = (string)($currentFilters['brand_id'] ?? null) === (string)$brandId;
                
                // Use buildFilterUrl if exists, otherwise manual fallback
                if (function_exists('buildFilterUrl')) {
                    $url = buildFilterUrl($currentURLParams, 'brand_id', $brandId);
                } else {
                    $params = $_GET;
                    $params['brand_id'] = $brandId;
                    $url = current_url() . '?' . http_build_query($params);
                }
            ?>
            <button class="brand-filter-btn w-full text-left px-3 py-2 rounded border transition-all <?= $isActive ? 'bg-[#41B8EA] text-white border-[#41B8EA]' : 'bg-white hover:border-[#41B8EA] hover:bg-gray-50 text-gray-700 border-gray-300' ?>" data-brand="<?= esc($brand['name'] ?? '') ?>" data-url="<?= esc($url) ?>">
                <span class="text-sm"><?= esc($brand['name'] ?? 'Unknown Brand') ?></span>
            </button>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="mb-6">
        <button id="pkFilterToggle" class="w-full flex items-center justify-between mb-3 hover:text-[#41B8EA] transition-colors">
            <h4 class="font-semibold text-[#373E51]">Kapasitas PK</h4>
            <i data-lucide="chevron-down" id="pkFilterChevron" class="h-5 w-5 text-[#41B8EA] transition-transform duration-200"></i>
        </button>
        <div id="pkFilterContent" class="dropdown-content open space-y-2">
            <?php foreach ($pkList as $pk): 
                $pkId = $pk['id'] ?? $pk['name'];
                $isActive = (string)($currentFilters['pk_id'] ?? null) === (string)$pkId;
                
                if (function_exists('buildFilterUrl')) {
                    $url = buildFilterUrl($currentURLParams, 'pk_id', $pkId);
                } else {
                    $params = $_GET;
                    $params['pk_id'] = $pkId;
                    $url = current_url() . '?' . http_build_query($params);
                }
            ?>
            <button class="pk-filter-btn w-full text-left px-3 py-2 rounded border transition-all <?= $isActive ? 'bg-[#41B8EA] text-white border-[#41B8EA]' : 'bg-white hover:border-[#41B8EA] hover:bg-gray-50 text-gray-700 border-gray-300' ?>" data-pk="<?= esc($pk['name'] ?? '') ?>" data-url="<?= esc($url) ?>">
                <span class="text-sm"><?= esc($pk['name'] ?? 'Unknown PK') ?></span>
            </button>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="mb-6">
        <button id="typeFilterToggle" class="w-full flex items-center justify-between mb-3 hover:text-[#41B8EA] transition-colors">
            <h4 class="font-semibold text-[#373E51]">Tipe AC</h4>
            <i data-lucide="chevron-down" id="typeFilterChevron" class="h-5 w-5 text-[#41B8EA] transition-transform duration-200"></i>
        </button>
        <div id="typeFilterContent" class="dropdown-content open space-y-2">
            <?php
            $acTypes = [
                ['id' => 1, 'name' => 'Inverter'],
                ['id' => 2, 'name' => 'Non Inverter'],
            ];
            foreach ($acTypes as $type): 
                $typeId = $type['id'];
                $isActive = (string)($currentFilters['ac_type_id'] ?? null) === (string)$typeId;
                
                if (function_exists('buildFilterUrl')) {
                    $url = buildFilterUrl($currentURLParams, 'ac_type_id', $typeId);
                } else {
                    $params = $_GET;
                    $params['ac_type_id'] = $typeId;
                    $url = current_url() . '?' . http_build_query($params);
                }
            ?>
            <button id="<?= str_replace(' ', '', $type['name']) ?>FilterBtn" class="type-filter-btn w-full text-left px-3 py-2 rounded border transition-all <?= $isActive ? 'bg-[#41B8EA] text-white border-[#41B8EA]' : 'bg-white hover:border-[#41B8EA] hover:bg-gray-50 text-gray-700 border-gray-300' ?>" data-type="<?= esc($type['name']) ?>" data-url="<?= esc($url) ?>">
                <span class="text-sm"><?= esc($type['name']) ?></span>
            </button>
            <?php endforeach; ?>
        </div>
    </div>

    <div>
        <button id="otherProductsToggle" class="w-full flex items-center justify-between mb-3 hover:text-[#41B8EA] transition-colors">
            <h4 class="font-semibold text-[#373E51]">Produk Lainnya</h4>
            <i data-lucide="chevron-down" id="otherProductsChevron" class="h-5 w-5 text-[#41B8EA] transition-transform duration-200"></i>
        </button>
        <div id="otherProductsContent" class="dropdown-content open space-y-2">
            <?php foreach ($categories as $category): 
                $categoryId = $category['id'] ?? $category['name'];
                $isActive = (string)($currentFilters['category_id'] ?? null) === (string)$categoryId;
                
                if (function_exists('buildFilterUrl')) {
                    $url = buildFilterUrl($currentURLParams, 'category_id', $categoryId);
                } else {
                    $params = $_GET;
                    $params['category_id'] = $categoryId;
                    $url = current_url() . '?' . http_build_query($params);
                }
            ?>
            <button class="other-product-btn w-full text-left px-3 py-2 rounded border transition-all <?= $isActive ? 'bg-[#41B8EA] text-white border-[#41B8EA]' : 'bg-white hover:border-[#41B8EA] hover:bg-gray-50 text-gray-700 border-gray-300' ?>" data-product="<?= esc($category['name'] ?? '') ?>" data-url="<?= esc($url) ?>">
                <span class="text-sm"><?= esc($category['name'] ?? 'Unknown Product') ?></span>
            </button>
            <?php endforeach; ?>
        </div>
    </div>
</div>