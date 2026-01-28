<div class="relative inline-block text-left">
    <button id="cartButton" 
            class="flex items-center space-x-2 px-3 py-2 bg-blue-50 rounded-xl text-blue-700 font-bold hover:bg-blue-100 transition-all border border-blue-100 relative">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
        </svg>
        <span id="cartItemCountText" class="text-xs">0</span>
        
        <span id="cartNotificationDot" class="hidden absolute -top-1 -right-1 flex h-3 w-3">
            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
            <span class="relative inline-flex rounded-full h-3 w-3 bg-red-500"></span>
        </span>
    </button>

    <div id="cartDropdown" 
         class="hidden absolute right-0 mt-3 w-96 bg-white border border-gray-100 rounded-2xl shadow-2xl z-50 overflow-hidden ring-1 ring-black ring-opacity-5 transform origin-top-right transition-all">
        
        <div class="p-4 border-b border-gray-100 bg-gray-50/50 flex justify-between items-center">
            <span class="font-bold text-sm text-gray-800">Your Selection</span>
            <span id="cartItemLabel" class="text-[10px] uppercase font-bold text-gray-400 tracking-wider">0 Items</span>
        </div>
        
        <div id="cartItemsList" class="max-h-[24rem] overflow-y-auto custom-scrollbar">
            <div class="p-12 text-center" id="emptyCartMessage">
                <div class="mb-3 inline-flex items-center justify-center w-12 h-12 rounded-full bg-gray-50 text-gray-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                </div>
                <p class="text-xs font-medium text-gray-900">Your cart is empty</p>
                <p class="text-[10px] text-gray-400 mt-1">Add items to get started</p>
            </div>
        </div>

        <div id="cartFooter" class="hidden p-4 bg-gray-50 border-t border-gray-100">
            <div class="flex justify-between items-center mb-4">
                <span class="text-xs font-bold text-gray-500 uppercase tracking-wider">Subtotal</span>
                <span id="cartGrandTotal" class="text-lg font-black text-gray-900">Rp 0</span>
            </div>
            <a href="/shop/cart" class="block w-full py-3 bg-blue-600 hover:bg-blue-700 text-white text-center rounded-xl text-xs font-bold uppercase tracking-widest transition-all shadow-lg shadow-blue-200 hover:shadow-blue-300">
                View Cart & Checkout
            </a>
        </div>
    </div>
</div>