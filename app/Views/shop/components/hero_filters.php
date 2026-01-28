<?php
// --- DATA PREPARATION ---

// 1. Get Data from Controller
$rawPkList  = $pkList ?? [];
$rawAcTypes = $acTypes ?? [];

// 2. Define the Static Display Labels (What you want to see)
$pkDisplayList     = ['1/2 PK', '3/4 PK', '1 PK', '1.5 PK', '2 PK', '2.5 PK'];
$acTypeDisplayList = ['Inverter AC', 'Non-Inverter AC'];

// 3. Robust ID Mapping
// We create a map that handles variations like "Inverter" vs "Inverter AC"
$pkMap = [];
foreach ($rawPkList as $item) {
    $name = is_array($item) ? $item['name'] : $item->name;
    $id   = is_array($item) ? $item['id']   : $item->id;
    $pkMap[$name] = $id;
}

$acTypeMap = [];
foreach ($rawAcTypes as $item) {
    $name = is_array($item) ? $item['name'] : $item->name;
    $id   = is_array($item) ? $item['id']   : $item->id;
    
    // Standard Map
    $acTypeMap[$name] = $id;
    
    // Fuzzy/Smart Map for Inverter/Non-Inverter
    // If DB has "Non Inverter", map it to "Non-Inverter AC" key
    if (stripos($name, 'Non') !== false) {
        $acTypeMap['Non-Inverter AC'] = $id;
    } 
    // If DB has "Inverter" (and not Non), map it to "Inverter AC" key
    elseif (stripos($name, 'Inverter') !== false) {
        $acTypeMap['Inverter AC'] = $id;
    }
}

// 4. Params
$currentFilters = $currentFilters ?? [];
$currentSearch  = $currentSearch ?? '';
?>

<div class="bg-white py-4 border-b">
    <div class="container mx-auto px-4">
        
        <div class="md:hidden">
            <div class="mt-3 space-y-3">
                
                <div class="grid grid-cols-2 gap-2">
                    <?php foreach ($pkDisplayList as $pkName): 
                        $pkId = $pkMap[$pkName] ?? null; 
                        if (is_null($pkId)) continue; 
                        
                        $queryData = array_filter($currentFilters); 
                        if (!empty($currentSearch)) $queryData['search'] = $currentSearch;
                        $queryData['pk_id'] = $pkId;
                        $filterUrl = current_url() . '?' . http_build_query($queryData);
                        
                        $isActive = (isset($currentFilters['pk_id']) && $currentFilters['pk_id'] == $pkId);
                        $activeClass = $isActive ? 'border-[#41B8EA] ring-2 ring-[#41B8EA]/30' : 'border-gray-300';
                    ?>
                        <a href="<?= esc($filterUrl) ?>" class="pk-btn px-4 py-3 rounded-lg border <?= $activeClass ?> bg-white hover:border-[#41B8EA] hover:shadow-md transition-all duration-200">
                            <span class="font-semibold text-sm"><?= esc($pkName) ?></span>
                        </a>
                    <?php endforeach; ?>
                </div>

                <div class="grid grid-cols-2 gap-2 pt-1">
                    <?php foreach ($acTypeDisplayList as $acTypeName): 
                        $acTypeId = $acTypeMap[$acTypeName] ?? null; 
                        if (is_null($acTypeId)) continue;
                        
                        $queryData = array_filter($currentFilters); 
                        if (!empty($currentSearch)) $queryData['search'] = $currentSearch;
                        $queryData['ac_type_id'] = $acTypeId;
                        $filterUrl = current_url() . '?' . http_build_query($queryData);
                        $filterUrl = str_replace(['?ac_type_id=', '&ac_type_id='], ['?category_id=', '&category_id='], $filterUrl);
                        
                        $colorClass = strtolower($acTypeName) === 'inverter' ? 'hover:border-[#3EB48A]' : 'hover:border-[#F99C1C]';
                        $isActive = (isset($currentFilters['ac_type_id']) && $currentFilters['ac_type_id'] == $acTypeId);
                        $activeClass = $isActive ? 'border-[#41B8EA] ring-2 ring-[#41B8EA]/30' : 'border-gray-300';
                        
                        $displayContent = '<span class="font-semibold text-sm">'.$acTypeName.'</span>';
                        if ($acTypeName === 'Inverter AC') $displayContent = '<img src="/src/assets/inverter.png" alt="Inverter" class="h-6 mx-auto">';
                        if ($acTypeName === 'Non-Inverter AC') $displayContent = '<img src="/src/assets/noninverter.png" alt="Non-Inverter" class="h-6 mx-auto">';
                    ?>
                        <a href="<?= esc($filterUrl) ?>" class="type-btn px-4 py-3 rounded-lg border <?= $activeClass ?> bg-white <?= $colorClass ?> hover:shadow-md transition-all duration-200 flex items-center justify-center">
                            <?= $displayContent ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div class="hidden md:block">
            <div class="flex justify-center items-center overflow-x-auto scrollbar-hide">
                <div class="w-full max-w-[1035px] h-[50px] flex flex-nowrap justify-center items-center gap-[10.88px]">
                    
                    <?php foreach ($pkDisplayList as $pkName): 
                        $pkId = $pkMap[$pkName] ?? null; 
                        if (is_null($pkId)) continue; 
                        
                        $queryData = array_filter($currentFilters); 
                        if (!empty($currentSearch)) $queryData['search'] = $currentSearch;
                        $queryData['pk_id'] = $pkId;
                        $filterUrl = current_url() . '?' . http_build_query($queryData);
                        
                        $isActive = (isset($currentFilters['pk_id']) && $currentFilters['pk_id'] == $pkId);
                        $activeClass = $isActive ? 'ring-2 ring-offset-2 ring-[#41B8EA]' : 'border-[#ced4da]';
                    ?>
                        <a href="<?= esc($filterUrl) ?>" class="pk-btn relative bg-white border <?= $activeClass ?> h-[45.862px] overflow-hidden rounded-[100px] w-[134.478px] flex-shrink-0 cursor-pointer transition-all duration-200 hover:shadow-lg hover:scale-105 hover:border-[#41B8EA] flex items-center justify-center">
                            <span class="font-semibold text-[#373E51] text-[16px]"><?= esc($pkName) ?></span>
                        </a>
                    <?php endforeach; ?>
                    
                    <?php foreach ($acTypeDisplayList as $acTypeName): 
                        // Using our smart map to find the ID
                        $acTypeId = $acTypeMap[$acTypeName] ?? null; 
                        
                        // If still null, we cannot render a filter button.
                        if (is_null($acTypeId)) continue; 
                        
                        $queryData = array_filter($currentFilters); 
                        if (!empty($currentSearch)) $queryData['search'] = $currentSearch;
                        $queryData['ac_type_id'] = $acTypeId;
                        $filterUrl = current_url() . '?' . http_build_query($queryData);
                        $filterUrl = str_replace(['?ac_type_id=', '&ac_type_id='], ['?category_id=', '&category_id='], $filterUrl);

                        $isActive = (isset($currentFilters['ac_type_id']) && $currentFilters['ac_type_id'] == $acTypeId);
                        $activeClass = $isActive ? 'ring-2 ring-offset-2 ring-[#41B8EA]' : 'border-[#ced4da]';
                        
                        // Image Only for Desktop
                        $displayContent = '<span class="font-semibold text-[16px]">'.$acTypeName.'</span>';
                        if ($acTypeName === 'Inverter AC') $displayContent = '<img src="/src/assets/inverter.png" alt="Inverter" class="h-6 object-contain">';
                        if ($acTypeName === 'Non-Inverter AC') $displayContent = '<img src="/src/assets/noninverter.png" alt="Non-Inverter" class="h-6 object-contain">';
                    ?>
                        <a href="<?= esc($filterUrl) ?>" class="type-btn relative bg-white border <?= $activeClass ?> h-[45.862px] overflow-hidden rounded-[100px] w-[134.478px] flex-shrink-0 cursor-pointer transition-all duration-200 hover:shadow-lg hover:scale-105 flex items-center justify-center">
                            <?= $displayContent ?>
                        </a>
                    <?php endforeach; ?>
                    
                </div>
            </div>
        </div>
    </div>
</div>