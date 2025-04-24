<?php
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
        $this->view('cart/index', ['cartItems' => $cartItems]);
    }

    public function add() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /DuannhomBin/Public/index.php?controller=user&action=login');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $product_id = $_POST['product_id'];
            $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;

            if ($this->cartModel->addToCart($_SESSION['user_id'], $product_id, $quantity)) {
                header('Location: /DuannhomBin/Public/index.php?controller=cart&action=index');
                exit();
            } else {
                echo "Lỗi khi thêm sản phẩm vào giỏ hàng.";
            }
        }
    }

    public function remove($product_id) {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /DuannhomBin/Public/index.php?controller=user&action=login');
            exit();
        }

        if ($this->cartModel->removeFromCart($_SESSION['user_id'], $product_id)) {
            header('Location: /DuannhomBin/Public/index.php?controller=cart&action=index');
            exit();
        } else {
            echo "Lỗi khi xóa sản phẩm khỏi giỏ hàng.";
        }
    }

    // Trong CartController.php, action update
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

        // Cập nhật số lượng
        $updated = $this->cartModel->updateQuantity($_SESSION['user_id'], $product_id, $quantity); // Sửa tên hàm từ updateCartItem thành updateQuantity
        if ($updated) {
            $cartItems = $this->cartModel->getCart($_SESSION['user_id']);
            $total = 0;
            foreach ($cartItems as $item) {
                $total += $item->price * $item->quantity;
            }
            echo json_encode([
                'success' => true,
                'total' => number_format($total, 0, ',', '.')
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