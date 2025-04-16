<?php
class ProductController extends Controller {
    private $productModel;

    public function __construct() {
        parent::__construct();
        $this->productModel = $this->model('Product');
    }

    public function index() {
        $products = $this->productModel->getAll();
        $this->view('product/index', ['products' => $products]);
    }

    public function indexlogin() {
        $products = $this->productModel->getAll();
        $this->view('product/indexlogin', ['products' => $products]);
    }
}