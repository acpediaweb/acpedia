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
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 * class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = [];

    /**
     * Be sure to declare properties for any property fetch you'll perform
     * in the constructor or any methods you create.
     *
     * @var \CodeIgniter\Session\Session
     */
    protected $session;

    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload Services
        $this->session = \Config\Services::session();

        // --- GLOBAL MINI-CART LOGIC ---
        $cartItems = [];

        // Check if user is logged in using the session keys defined in AuthController
        if ($this->session->get('isLoggedIn')) {
            $db = \Config\Database::connect();
            
            // Fetch combined Products and Services currently in user's cart
            $cartItems = $db->table('user_cart_items as uci')
                ->select('uci.*, p.product_name, p.base_price as p_price, p.sale_price, s.service_title, s.base_price as s_price')
                ->join('user_cart as uc', 'uc.id = uci.cart_id')
                ->join('products as p', 'p.id = uci.product_id', 'left')
                ->join('services as s', 's.id = uci.service_id', 'left')
                ->where('uc.user_id', $this->session->get('user_id'))
                ->get()
                ->getResult();
        }

        // Set the global variable for all views (including layouts)
        \Config\Services::renderer()->setVar('headerCartItems', $cartItems);
    }
}