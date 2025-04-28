<?php
class OrderModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function createOrder($userId, $total, $phone, $email, $address) {
        $sql = "INSERT INTO orders (user_id, total_amount, phone, email, address, order_date, status) VALUES (:user_id, :total_amount, :phone, :email, :address, NOW(), 'Chưa giao')";
        $this->db->query($sql);
        $this->db->bind(':user_id', $userId);
        $this->db->bind(':total_amount', $total);
        $this->db->bind(':phone', $phone);
        $this->db->bind(':email', $email);
        $this->db->bind(':address', $address);
        
        $result = $this->db->execute();
        
        if ($result === false) {
            $errorInfo = $this->db->getConnection()->errorInfo();
            error_log("Lỗi khi tạo đơn hàng: " . print_r($errorInfo, true));
            return false;
        }
        
        $orderId = $this->db->getConnection()->lastInsertId();
        if (!$orderId) {
            error_log("Lỗi: Không lấy được orderId sau khi thêm đơn hàng.");
            return false;
        }
        
        return $orderId;
    }

    public function addOrderItem($orderId, $productId, $quantity, $price) {
        $sql = "INSERT order_items (order_id, product_id, quantity, price) VALUES (:order_id, :product_id, :quantity, :price)";
        $this->db->query($sql);
        $this->db->bind(':order_id', $orderId);
        $this->db->bind(':product_id', $productId);
        $this->db->bind(':quantity', $quantity);
        $this->db->bind(':price', $price);
        $result = $this->db->execute();
        if ($result === false) {
            error_log("Lỗi khi thêm sản phẩm vào đơn hàng: " . print_r($this->db->getConnection()->errorInfo(), true));
        }
        return $result;
    }

    public function getOrdersByUserId($userId) {
        $sql = "SELECT id, total_amount, order_date, status FROM orders WHERE user_id = :user_id ORDER BY order_date DESC";
        $this->db->query($sql);
        $this->db->bind(':user_id', $userId);
        $result = $this->db->execute();
        if ($result === false) {
            $errorInfo = $this->db->getConnection()->errorInfo();
            error_log("Lỗi khi lấy đơn hàng: " . print_r($errorInfo, true));
            return [];
        }
        $orders = $this->db->resultSet();
        error_log("Đơn hàng lấy được cho user_id $userId: " . print_r($orders, true));
        return $orders;
    }
}