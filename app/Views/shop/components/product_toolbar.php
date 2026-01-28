<?php
// Defensive coding: Ensure variables exist
$currentSearch = $currentSearch ?? '';
$currentSort = $currentSort ?? '';
$currentURLParams = $currentURLParams ?? $_GET; // Fallback to $_GET
?>

<div class="bg-white rounded-lg p-4 shadow mb-6">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-xl md:text-2xl font-bold text-[#373E51]">Penjualan</h2>
    </div>
    <div class="flex flex-col md:flex-row md:items-center gap-3 md:gap-4">
        <span class="font-semibold hidden md:inline text-[#373E51]">Filter</span>
        <div class="flex flex-col md:flex-row gap-3 md:gap-2 md:items-center flex-1">
            
            <div class="flex gap-2 overflow-x-auto pb-2 md:pb-0 scrollbar-hide">
                <?php
                $tabs = [
                    ['label' => 'Terbaru', 'sort_value' => 'latest'],
                    ['label' => 'Diskon', 'sort_value' => 'discount'],
                    ['label' => 'Terlaris', 'sort_value' => 'best_seller'],
                ];
                $activeSort = $currentURLParams['sort'] ?? 'latest';
                ?>
                <?php foreach ($tabs as $tab): 
                    $isActive = $activeSort === $tab['sort_value'];
                    
                    if (function_exists('buildFilterUrl')) {
                        $url = buildFilterUrl($currentURLParams, 'sort', $tab['sort_value']);
                    } else {
                        // Manual fallback if function missing
                        $params = $currentURLParams;
                        $params['sort'] = $tab['sort_value'];
                        $url = current_url() . '?' . http_build_query($params);
                    }
                ?>
                <a href="<?= $url ?>"
                   class="tab-btn px-4 py-2 rounded whitespace-nowrap transition-colors <?= $isActive ? 'bg-[#41B8EA] text-white' : 'hover:bg-gray-100' ?>" 
                   data-tab="<?= esc($tab['sort_value']) ?>">
                    <?= esc($tab['label']) ?>
                </a>
                <?php endforeach; ?>
            </div>
            
            <div class="relative flex-1 md:ml-4">
                <form method="GET" action="<?= current_url() ?>">
                    <input type="text" name="search" id="searchQuery" placeholder="Cari produk..."
                        class="w-full border border-gray-300 rounded-lg focus:outline-none focus:border-[#41B8EA] focus:ring-1 focus:ring-[#41B8EA] transition-colors pl-10 pr-4 py-2"
                        value="<?= esc($currentSearch) ?>" />
                    <i data-lucide="search" class="absolute left-3 top-1/2 transform -translate-y-1/2 h-4 w-4 text-gray-400"></i>
                    
                    <?php 
                    // Safely loop params
                    $safeParams = is_array($currentURLParams) ? $currentURLParams : $_GET;
                    foreach ($safeParams as $key => $value): 
                    ?>
                        <?php if ($key !== 'search' && $key !== 'page' && !empty($value) && is_string($value)): ?>
                            <input type="hidden" name="<?= esc($key) ?>" value="<?= esc($value) ?>">
                        <?php endif; ?>
                    <?php endforeach; ?>
                </form>
            </div>

            <form id="sortForm" method="GET" action="<?= current_url() ?>" class="w-full md:w-auto md:ml-auto">
                <select name="sort" id="priceSort" 
                        class="border border-gray-300 rounded-lg px-4 py-2 w-full md:w-auto focus:outline-none focus:border-[#41B8EA] focus:ring-1 focus:ring-[#41B8EA] transition-colors" 
                        onchange="document.getElementById('sortForm').submit()">
                    <option value="">Harga</option>
                    <option value="price_asc" <?= ($currentSort == 'price_asc') ? 'selected' : '' ?>>Harga: Rendah ke Tinggi</option>
                    <option value="price_desc" <?= ($currentSort == 'price_desc') ? 'selected' : '' ?>>Harga: Tinggi ke Rendah</option>
                </select>
                <?php 
                foreach ($safeParams as $key => $value): ?>
                    <?php if ($key !== 'sort' && $key !== 'page' && !empty($value) && is_string($value)): ?>
                        <input type="hidden" name="<?= esc($key) ?>" value="<?= esc($value) ?>">
                    <?php endif; ?>
                <?php endforeach; ?>
            </form>
        </div>
    </div>
</div>