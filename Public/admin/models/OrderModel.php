<?php
class OrderModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getUserById($id) {
        $sql = "SELECT username, full_name, address FROM users WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function createOrder($user_id, $cart, $address = '') {
        $sql = "INSERT INTO orders (user_id, address, created_at) VALUES (:user_id, :address, NOW())";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['user_id' => $user_id, 'address' => $address]);
        $order_id = $this->db->lastInsertId();
    
        foreach ($cart as $product_id => $quantity) {
            $sql = "SELECT price FROM products WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->execute(['id' => $product_id]);
            $product = $stmt->fetch(PDO::FETCH_OBJ);
    
            if ($product) {
                $subtotal = $product->price * $quantity;
                $sql = "INSERT INTO order_items (order_id, product_id, quantity, subtotal) VALUES (:order_id, :product_id, :quantity, :subtotal)";
                $stmt = $this->db->prepare($sql);
                $stmt->execute([
                    'order_id' => $order_id,
                    'product_id' => $product_id,
                    'quantity' => $quantity,
                    'subtotal' => $subtotal
                ]);
            } else {
                throw new Exception("Sản phẩm với ID $product_id không tồn tại.");
            }
        }
    }
    
    public function getAllOrders() {
        $sql = "SELECT o.*, u.username, u.full_name 
                FROM orders o 
                JOIN users u ON o.user_id = u.id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function updateOrderStatus($id, $status) {
        $sql = "UPDATE orders SET status = :status WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['id' => $id, 'status' => $status]);
    }

    public function deleteOrder($id) {
        $sql = "DELETE FROM order_items WHERE order_id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);

        $sql = "DELETE FROM orders WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }
}
?>