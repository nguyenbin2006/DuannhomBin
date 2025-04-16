<?php
class Cart {
    private $db;
    private $table_name = "cart";

    public $id;
    public $user_id;
    public $product_id;
    public $quantity;

    public function __construct($db) {
        $this->db = $db;
    }

    // Thêm sản phẩm vào giỏ hàng
    public function addToCart($user_id, $product_id, $quantity = 1) {
        if ($this->db === null) {
            throw new Exception("Database connection is not initialized in Cart model.");
        }

        // Kiểm tra xem sản phẩm đã có trong giỏ hàng của người dùng chưa
        $query = "SELECT * FROM " . $this->table_name . " WHERE user_id = :user_id AND product_id = :product_id";
        $this->db->query($query);
        $this->db->bind(':user_id', $user_id);
        $this->db->bind(':product_id', $product_id);
        $existingItem = $this->db->single();

        if ($existingItem) {
            // Nếu sản phẩm đã có, cập nhật số lượng
            $query = "UPDATE " . $this->table_name . " SET quantity = quantity + :quantity WHERE user_id = :user_id AND product_id = :product_id";
            $this->db->query($query);
            $this->db->bind(':quantity', $quantity);
            $this->db->bind(':user_id', $user_id);
            $this->db->bind(':product_id', $product_id);
            return $this->db->execute();
        } else {
            // Nếu sản phẩm chưa có, thêm mới
            $query = "INSERT INTO " . $this->table_name . " (user_id, product_id, quantity) VALUES (:user_id, :product_id, :quantity)";
            $this->db->query($query);
            $this->db->bind(':user_id', $user_id);
            $this->db->bind(':product_id', $product_id);
            $this->db->bind(':quantity', $quantity);
            return $this->db->execute();
        }
    }

    // Lấy giỏ hàng của người dùng
    public function getCart($user_id) {
        if ($this->db === null) {
            throw new Exception("Database connection is not initialized in Cart model.");
        }

        $query = "SELECT c.*, p.name, p.price, p.image 
                 FROM " . $this->table_name . " c 
                 JOIN products p ON c.product_id = p.id 
                 WHERE c.user_id = :user_id";
        $this->db->query($query);
        $this->db->bind(':user_id', $user_id);
        return $this->db->resultSet();
    }

    // Xóa sản phẩm khỏi giỏ hàng
    public function removeFromCart($user_id, $product_id) {
        if ($this->db === null) {
            throw new Exception("Database connection is not initialized in Cart model.");
        }

        $query = "DELETE FROM " . $this->table_name . " WHERE user_id = :user_id AND product_id = :product_id";
        $this->db->query($query);
        $this->db->bind(':user_id', $user_id);
        $this->db->bind(':product_id', $product_id);
        return $this->db->execute();
    }
}