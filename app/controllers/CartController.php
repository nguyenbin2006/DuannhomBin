<?php
class CartController extends Controller {
    private $cartModel;

    public function __construct() {
        parent::__construct();
        $this->cartModel = $this->model('cart');
    }

    public function index() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /shopvotcaulong/Public/index.php?controller=user&action=login');
            exit();
        }

        $cartItems = $this->cartModel->getCart($_SESSION['user_id']);
        $this->view('cart/index', ['cartItems' => $cartItems]);
    }

    public function add() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /shopvotcaulong/Public/index.php?controller=user&action=login');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $product_id = $_POST['product_id'];
            $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;

            if ($this->cartModel->addToCart($_SESSION['user_id'], $product_id, $quantity)) {
                header('Location: /shopvotcaulong/Public/index.php?controller=cart&action=index');
                exit();
            } else {
                echo "Lỗi khi thêm sản phẩm vào giỏ hàng.";
            }
        }
    }

    public function remove($product_id) {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /shopvotcaulong/Public/index.php?controller=user&action=login');
            exit();
        }

        if ($this->cartModel->removeFromCart($_SESSION['user_id'], $product_id)) {
            header('Location: /shopvotcaulong/Public/index.php?controller=cart&action=index');
            exit();
        } else {
            echo "Lỗi khi xóa sản phẩm khỏi giỏ hàng.";
        }
    }
}