<?php

namespace App\Cells;

use CodeIgniter\View\Cells\Cell;

class CartCell extends Cell
{
    public function mini()
    {
        $db = \Config\Database::connect();
        $session = session();

        if (!$session->get('isLoggedIn')) {
            return view('cells/mini_cart', ['items' => [], 'grandTotal' => 0, 'itemCount' => 0]);
        }

        $userId = $session->get('user_id');

        // 1. Fetch Items
        // FIXED: Changed p.image to p.main_image
        // FIXED: Removed s.image (column does not exist in schema)
        $items = $db->table('user_cart_items as uci')
            ->select('uci.*, p.product_name, p.main_image as p_image, p.base_price as p_price, p.sale_price, s.service_title, s.base_price as s_price')
            ->join('user_cart as uc', 'uc.id = uci.cart_id')
            ->join('products as p', 'p.id = uci.product_id', 'left')
            ->join('services as s', 's.id = uci.service_id', 'left')
            ->where('uc.user_id', $userId)
            ->get()
            ->getResult();

        $grandTotal = 0;
        $itemCount = 0;

        // 2. Calculate Totals & Attach Config Strings
        foreach ($items as $item) {
            $itemCount += $item->quantity;
            
            // Base Price Logic
            $isService = !empty($item->service_id);
            $basePrice = $isService ? $item->s_price : ($item->sale_price ?? $item->p_price);
            
            // Fetch Addons/Config
            $savedAddons = $db->table('user_cart_item_addons')
                ->where('cart_item_id', $item->id)
                ->get()
                ->getResult();

            $addonTotal = 0;
            $details = []; 

            foreach ($savedAddons as $sa) {
                // A. Pipe
                if (!empty($sa->pipe_id)) {
                    $pipe = $db->table('pipes')->where('id', $sa->pipe_id)->get()->getRow();
                    if ($pipe) {
                        $addonTotal += $pipe->price_per_meter;
                        $details[] = "Pipe: {$pipe->pipe_type}";
                    }
                }
                // B. Addons
                if (!empty($sa->addon_id)) {
                    $addon = $db->table('addons')->where('id', $sa->addon_id)->get()->getRow();
                    if ($addon) {
                        $addonTotal += $addon->addon_price;
                        $details[] = "+ {$addon->addon_name}";
                    }
                }
                // C. Config (Brand/PK)
                if (!empty($sa->extra_data_json)) {
                    $json = json_decode($sa->extra_data_json, true);
                    if(!empty($json['brand'])) $details[] = $json['brand'];
                    if(!empty($json['pk'])) $details[] = $json['pk'];
                    if(!empty($json['type'])) $details[] = $json['type'];
                }
            }

            $item->final_price = ($basePrice + $addonTotal) * $item->quantity;
            $item->config_summary = implode(', ', $details); 
            
            $grandTotal += $item->final_price;
        }

        return view('cells/mini_cart', [
            'items' => $items,
            'grandTotal' => $grandTotal,
            'itemCount' => $itemCount
        ]);
    }
}