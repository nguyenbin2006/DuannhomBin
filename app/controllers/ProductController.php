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

    public function show($id) {
        $product = $this->productModel->findById($id);
        if (!$product) {
            header('Location: /DuannhomBin/Public/index.php?controller=product&action=index&error=product_not_found');
            exit();
        }
        $this->view('product/view', ['product' => $product]);
    }

    public function deleteProduct($id) {
        $query = "DELETE FROM products WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}