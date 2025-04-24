<?php
class AdminProductController extends Controller {
    private $productModel;

    public function __construct() {
        $this->productModel = $this->model('Product');
    }

    public function index() {
        $products = $this->productModel->getAll();
        $this->view('admin/index', ['products' => $products]);
    }

    public function add() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'name' => $_POST['name'],
                'price' => $_POST['price'],
                'stock' => $_POST['stock'],
                'image' => $_POST['image'],
                'description' => $_POST['description'],
                'category' => $_POST['category']
            ];
            $this->productModel->add($data);
            header("Location: index.php");
            exit();
        }
        $this->view('admin/add');
    }

    public function edit() {
        $id = $_GET['id'];
        $product = $this->productModel->getById($id);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'id' => $id,
                'name' => $_POST['name'],
                'price' => $_POST['price'],
                'stock' => $_POST['stock'],
                'image' => $_POST['image'],
                'description' => $_POST['description'],
                'category' => $_POST['category']
            ];
            $this->productModel->update($data);
            header("Location: index.php");
            exit();
        }

        $this->view('admin/edit', ['product' => $product]);
    }

    public function delete() {
        $id = $_GET['id'];
        $this->productModel->delete($id);
        header("Location: index.php");
        exit();
    }
}