<div class="bg-white py-6 border-b">
    <div class="container mx-auto px-4">
        <div class="md:hidden">
            <button id="productCategoriesToggle" class="w-full flex items-center justify-between px-4 py-3 bg-white border border-gray-300 rounded-lg hover:border-[#41B8EA] transition-colors">
                <span class="font-semibold text-[#373E51]">Kategori Produk</span>
                <i data-lucide="chevron-down" id="productCategoriesChevron" class="h-5 w-5 text-[#41B8EA] transition-transform duration-200"></i>
            </button>
            <div id="productCategoriesContent" class="dropdown-content mt-3 space-y-2 overflow-hidden">
                <?= $this->include('toko/category_buttons_content', get_defined_vars()) ?>
            </div>
        </div>

        <div class="hidden md:block">
            <div id="productsScrollContainer" class="flex justify-center items-center overflow-x-auto md:overflow-x-visible scroll-smooth snap-x snap-mandatory scrollbar-hide cursor-grab">
                <div class="w-full max-w-[1151.99px] h-[144px] min-w-[800px] md:min-w-0 snap-center">
                    <div class="h-full flex items-stretch justify-center">
                        <?= $this->include('toko/category_buttons_content', get_defined_vars()) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>