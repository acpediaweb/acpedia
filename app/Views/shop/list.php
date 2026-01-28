<?php

if (!function_exists('buildFilterUrl')) {
    function buildFilterUrl(array $currentParams, string $key, $value = null): string
    {
        $params = $currentParams;
        $isActive = (isset($params[$key]) && (string)$params[$key] === (string)$value);
        unset($params['page']);
        if ($isActive || $value === null) {
            unset($params[$key]);
        } else {
            $params[$key] = $value;
        }
        $params = array_filter($params, fn($v) => $v !== null && $v !== '');
        return current_url() . (empty($params) ? '' : '?' . http_build_query($params));
    }
}

$currentURLParams = array_merge($currentFilters ?? [], [
    'search' => $currentSearch ?? '',
    'sort' => $currentSort ?? '',
]);

$pkMap = [];
if (isset($pkList)) {
    foreach ($pkList as $item) {
        $pkMap[$item['name']] = $item['id'];
    }
}

$acTypeMap = [];
if (isset($categories)) {
    foreach ($categories as $item) {
        $acTypeMap[$item['name']] = $item['id'];
    }
}

$commonData = [
    'currentFilters' => $currentFilters ?? [],
    'currentSearch'  => $currentSearch ?? '',
    'currentSort'    => $currentSort ?? '',
    'currentURLParams' => $currentURLParams,
];

// Combine Maps into the filter data
$filterData = array_merge($commonData, [
    'pkMap'     => $pkMap,
    'acTypeMap' => $acTypeMap,
]);

$sidebarData = array_merge($commonData, [
    'brands' => $brands ?? [],
    'pkList' => $pkList ?? [],
    'categories' => $categories ?? [],
]);

$gridData = array_merge($commonData, [
    'products' => $products ?? [],
    'paginationLinks' => $paginationLinks ?? ''
]);
?>

<?= $this->extend('template-main') ?>

<?= $this->section('content') ?>

    <?= $this->include('shop/components/active_filter_alert', $commonData) ?>

    <?php if (empty($_GET)): ?>
        <?= $this->include('shop/components/tagline') ?>
        <?= $this->include('shop/components/service_icon') ?>
        <?= $this->include('shop/components/brand_list', $sidebarData) ?>
        
        <?= $this->include('shop/components/hero_filters', $filterData) ?>
        
        <?= $this->include('shop/components/category_nav', get_defined_vars()) ?>
    <?php endif; ?>

    <div class="container mx-auto px-4 py-8">
        <div class="flex flex-col lg:flex-row gap-6">
            <aside class="w-full lg:w-64 flex-shrink-0">
                <?= $this->include('shop/components/sidebar', $sidebarData) ?>
            </aside>

            <main class="flex-1">
                <?= $this->include('shop/components/product_toolbar', $commonData) ?>
                <?= $this->include('shop/components/product_grid', $gridData) ?>
            </main>
        </div>
    </div>

    <?= $this->include('shop/components/toko-js') ?>

<?= $this->endSection() ?>