<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

class CartController extends Controller {
    private $cartModel;

    public function __construct() {
        parent::__construct();
        $this->cartModel = $this->model('Cart');
    }

    public function index() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /DuannhomBin/Public/index.php?controller=user&action=login');
            exit();
        }
    
        $cartItems = $this->cartModel->getCart($_SESSION['user_id']);

        // Tính tổng giá trị giỏ hàng
        $total = 0;
        $productModel = $this->model('Product');
        foreach ($cartItems as $item) {
            $product = $productModel->getProductById($item->product_id);
            if ($product) {
                $item->price = $product['Price'];
                $item->name = $product['Name'];
                $item->image = $product['Image'];
                $total += $product['Price'] * $item->quantity;
            }
        }

        // Lấy danh sách đơn hàng của người dùng
        $orderModel = $this->model('OrderModel');
        $orders = $orderModel->getOrdersByUserId($_SESSION['user_id']);

        $config = [
            'base_url' => 'http://localhost/DuannhomBin/Public/',
            'base' => 'http://localhost/DuannhomBin/',
            'baseURL' => 'http://localhost/DuannhomBin/',
            'assets' => 'http://localhost/DuannhomBin/Public/assets/'
        ];
    
        $this->view('cart/index', [
            'cartItems' => $cartItems,
            'total' => $total,
            'orders' => $orders,
            'config' => $config,
            'error' => isset($_GET['error']) ? $_GET['error'] : null,
            'success' => isset($_GET['success']) ? $_GET['success'] : null
        ]);
    }
    
    public function add() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /DuannhomBin/Public/index.php?controller=user&action=login');
            exit();
        }
    
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $product_id = $_POST['product_id'];
            $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;
    
            error_log("Adding to cart - User ID: " . $_SESSION['user_id'] . ", Product ID: $product_id, Quantity: $quantity");
            if ($this->cartModel->addToCart($_SESSION['user_id'], $product_id, $quantity)) {
                header('Location: /DuannhomBin/Public/index.php?controller=cart&action=index&success=added');
                exit();
            } else {
                header('Location: /DuannhomBin/Public/index.php?controller=cart&action=index&error=add_failed');
                exit();
            }
        }
    }

    public function remove() {
        if (!isset($_SESSION['user_id'])) {
            error_log("No session user_id - Redirecting to login");
            header('Location: /DuannhomBin/Public/index.php?controller=user&action=login');
            exit();
        }
    
        error_log("Remove called - Session User ID: " . $_SESSION['user_id'] . ", Request: " . print_r($_GET, true));
        $product_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
    
        if ($product_id <= 0) {
            error_log("Invalid product_id: $product_id");
            header('Location: /DuannhomBin/Public/index.php?controller=cart&action=index&error=invalid_product');
            exit();
        }
    
        error_log("Attempting to remove Product ID: $product_id");
        $result = $this->cartModel->removeFromCart($_SESSION['user_id'], $product_id);
        if ($result) {
            error_log("Remove successful - Redirecting with success");
            header('Location: /DuannhomBin/Public/index.php?controller=cart&action=index&success=removed');
            exit();
        } else {
            error_log("Remove failed - Redirecting with error");
            header('Location: /DuannhomBin/Public/index.php?controller=cart&action=index&error=remove_failed');
            exit();
        }
    }

    public function update() {
        if (!isset($_SESSION['user_id'])) {
            echo json_encode(['success' => false, 'message' => 'Vui lòng đăng nhập để cập nhật giỏ hàng']);
            exit();
        }
    
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $product_id = isset($_POST['product_id']) ? (int)$_POST['product_id'] : 0;
            $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 0;
    
            if ($product_id <= 0 || $quantity < 1) {
                echo json_encode(['success' => false, 'message' => 'Số lượng hoặc sản phẩm không hợp lệ']);
                exit();
            }
    
            // Kiểm tra tồn kho
            $product = $this->cartModel->getProductById($product_id);
            if ($product && $quantity > $product->stock) {
                echo json_encode(['success' => false, 'message' => 'Số lượng vượt quá tồn kho']);
                exit();
            }
    
            // Cập nhật số lượng trong giỏ
            $updated = $this->cartModel->updateQuantity($_SESSION['user_id'], $product_id, $quantity);
    
            if ($updated) {
                $cartItems = $this->cartModel->getCart($_SESSION['user_id']);
                $total = 0;
                $product_price = 0;
    
                foreach ($cartItems as $item) {
                    $total += $item->price * $item->quantity;
                    if ($item->product_id == $product_id) {
                        $product_price = $item->price;
                    }
                }
    
                echo json_encode([
                    'success' => true,
                    'total' => number_format($total, 0, ',', '.'),
                    'price' => $product_price
                ]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Không thể cập nhật số lượng']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Yêu cầu không hợp lệ']);
        }
    
        exit();
    }
}