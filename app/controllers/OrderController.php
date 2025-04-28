<?php
require_once __DIR__ . '/../Models/OrderModel.php';
require_once __DIR__ . '/../Models/Product.php';
require_once __DIR__ . '/../Models/Cart.php';

class OrderController extends Controller
{
    protected function view($view, $data = []) 
    {
        $filePath = __DIR__ . '/../Views/' . $view . '.php';
        if (!file_exists($filePath)) {
            die("View file not found: $filePath");
        }
        
        extract($data);
        require_once $filePath;
    }

    public function checkout()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Kiểm tra session user_id
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?controller=user&action=login');
            exit();
        }

        // Kiểm tra dữ liệu giao hàng từ form
        if (!isset($_POST['phone']) || !isset($_POST['email']) || !isset($_POST['address'])) {
            header('Location: index.php?controller=cart&action=index&error=missing_info');
            exit();
        }

        $phone = trim($_POST['phone']);
        $email = trim($_POST['email']);
        $address = trim($_POST['address']);

        // Kiểm tra định dạng email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header('Location: index.php?controller=cart&action=index&error=invalid_email');
            exit();
        }

        // Kiểm tra số điện thoại (ví dụ: chỉ chứa số và có độ dài hợp lý)
        if (!preg_match('/^[0-9]{10,15}$/', $phone)) {
            header('Location: index.php?controller=cart&action=index&error=invalid_phone');
            exit();
        }

        // Kiểm tra địa chỉ không rỗng
        if (empty($address)) {
            header('Location: index.php?controller=cart&action=index&error=invalid_address');
            exit();
        }

        // Sử dụng CartModel để lấy giỏ hàng
        $cartModel = new Cart($this->db);
        $cartItems = $cartModel->getCart($_SESSION['user_id']);

        // Kiểm tra giỏ hàng
        if (empty($cartItems)) {
            header('Location: index.php?controller=cart&action=index&error=empty_cart');
            exit();
        }

        $orderModel = new OrderModel($this->db);
        $productModel = new Product($this->db);

        $total = 0;
        foreach ($cartItems as $item) {
            $product = $productModel->getProductById($item->product_id);
            if (!$product) {
                header('Location: index.php?controller=cart&action=index&error=invalid_product');
                exit();
            }
            $total += $product['Price'] * $item->quantity;
        }

        // Tạo đơn hàng
        $orderId = $orderModel->createOrder($_SESSION['user_id'], $total, $phone, $email, $address);
        
        if (!$orderId) {
            header('Location: index.php?controller=cart&action=index&error=order_failed');
            exit();
        }

        // Thêm từng sản phẩm vào đơn hàng
        foreach ($cartItems as $item) {
            $product = $productModel->getProductById($item->product_id);
            $orderModel->addOrderItem($orderId, $item->product_id, $item->quantity, $item->price);
        }

        // Xóa giỏ hàng sau khi đặt hàng thành công
        $cartModel->clearCart($_SESSION['user_id']);

        // Chuyển hướng về trang giỏ hàng với thông báo thành công
        header('Location: /DuannhomBin/Public/index.php?controller=cart&action=index&success=order_placed');
        exit();
    }
}