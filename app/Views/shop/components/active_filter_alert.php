<?php if (!empty($_GET)): 
    $cleanUrl = strtok($_SERVER["REQUEST_URI"], '?'); 
?>
<div class="max-w-4xl mx-auto"> 
    <div class="bg-blue-50 border border-blue-200 text-blue-700 p-4 rounded-lg flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 shadow-md" id="activeFilterNotification">
        <div class="flex items-center space-x-3 mb-3 sm:mb-0">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <p class="text-sm font-medium text-gray-800">
                <strong>Filter Active:</strong> The top menu is hidden to focus on results.
            </p>
        </div>
        <a href="<?= htmlspecialchars($cleanUrl) ?>" 
           class="inline-block bg-red-500 hover:bg-red-600 text-white text-xs font-semibold py-1 px-3 rounded-full transition-colors shadow-md text-center w-full sm:w-auto">
            Reset Filter
        </a>
    </div>
</div>
<?php endif; ?>