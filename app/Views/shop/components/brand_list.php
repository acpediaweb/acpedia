 <div class="bg-white py-6 border-b">
    <div class="container mx-auto px-4">
        <div class="flex justify-center items-center gap-4 md:gap-6 lg:gap-8 flex-wrap">
            
            <?php foreach ($brands as $brand): 
                
                $logoPath = $brand['logo_url'] 
                    ? base_url($brand['logo_url']) 
                    : 'https://placehold.co/100x30/FFFFFF/373E51?text=' . urlencode($brand['name']);
                $queryData = array_filter($currentFilters); 
                
                if (!empty($currentSearch)) {
                    $queryData['search'] = $currentSearch;
                }
                
                $queryData['brand_id'] = $brand['id'];
                
                $baseUrl = url_to('Toko::index');
                
                if (!empty($queryData)) {
                    $filterUrl = $baseUrl . '?' . http_build_query($queryData);
                } else {
                    $filterUrl = $baseUrl;
                }
            ?>
                
                <a href="<?= esc($filterUrl) ?>" title="Lihat produk <?= esc($brand['name']) ?>">
                    <img src="<?= esc($logoPath) ?>" 
                         alt="<?= esc($brand['name']) ?> Logo" 
                         class="brand-logo h-6 md:h-7 lg:h-8 w-auto object-contain cursor-pointer">
                </a>
            <?php endforeach; ?>
            
        </div>
    </div>
</div>