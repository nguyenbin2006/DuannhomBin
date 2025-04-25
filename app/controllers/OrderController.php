<?php
require_once __DIR__ . '/../Model/OrderModel.php';
require_once __DIR__ . '/../Model/Product.php';

class OrderController
{
    public function checkout()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $orderModel = new OrderModel();
        $productModel = new ProductModel();

        $total = 0;
        foreach ($_SESSION['cart'] as $item) {
            $product = $productModel->getProductById($item['product_id']);
            $total += $product['Price'] * $item['quantity'];
        }

        // Tạo đơn hàng
        $orderId = $orderModel->createOrder($_SESSION['user_id'], $total);
        include __DIR__ . '/../Views/Order/checkout_success.php';
        // Thêm từng sản phẩm vào đơn hàng
        foreach ($_SESSION['cart'] as $item) {
            $product = $productModel->getProductById($item['product_id']);
            $orderModel->addOrderItem($orderId, $item['product_id'], $item['quantity'], $product['Price']);
        }

        // Xóa giỏ hàng
        unset($_SESSION['cart']);

        // Gọi view và truyền biến cần thiết
        $orderId = htmlspecialchars($orderId);
        $config = require __DIR__ . '/../config.php';
        include __DIR__ . '/../Views/Order/checkout_success.php';
    }
}
