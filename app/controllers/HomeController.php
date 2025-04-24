<?php
class HomeController extends Controller {
    public function __construct() {
        parent::__construct();
    }
    public function index() {
        $productModel = $this->model('Product');
        $products = $productModel->getAll();
        $this->view('home/index', ['products' => $products]);
        $data = [];
        if (isset($_SESSION['user_id'])) {
            $data['isLoggedIn'] = true;
        } else {
            $data['isLoggedIn'] = false;
        }
        $this->view('home/index', $data);
    }

    public function indexlogin() {
        $productModel = $this->model('Product');
        $products = $productModel->getAll();
        $this->view('home/indexlogin', ['products' => $products]);
        $data = [];
        $this->view('home/indexlogin', $data);
    }
}