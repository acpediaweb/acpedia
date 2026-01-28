<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 */
abstract class BaseController extends Controller
{
    protected $request;
    protected $helpers = [];

   public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
{
    parent::initController($request, $response, $logger);

    $this->session = \Config\Services::session();

    // Fetch Mini Cart Data if logged in
    $cartItems = [];
    if (session()->get('isLoggedIn')) {
        $db = \Config\Database::connect();
        $cartItems = $db->table('user_cart_items as uci')
            ->select('uci.*, p.product_name, p.base_price as p_price, p.sale_price, s.service_title, s.base_price as s_price')
            ->join('user_cart as uc', 'uc.id = uci.cart_id')
            ->join('products as p', 'p.id = uci.product_id', 'left')
            ->join('services as s', 's.id = uci.service_id', 'left')
            ->where('uc.user_id', session()->get('user_id'))
            ->get()
            ->getResult();
    }
    
    // Share with all views
    view()->setVar('headerCartItems', $cartItems);
}
}