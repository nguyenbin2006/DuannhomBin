<?php
class HomeController extends Controller {
    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $product = $this->model('Product');
        $products = $product->getAll();
        $this->view('home/index', ['products' => $products]);
    }

    public function indexlogin() {
        $product = $this->model('Product');
        $products = $product->getAll();
        $this->view('home/indexlogin', ['products' => $products]);
        $data = [];
        $this->view('home/indexlogin', $data);
    }
}