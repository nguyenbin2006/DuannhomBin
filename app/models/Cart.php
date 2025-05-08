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

    public function addToCart($user_id, $product_id, $quantity = 1) {
        if ($this->db === null) {
            throw new Exception("Database connection is not initialized in Cart model.");
        }
    
        error_log("Add to cart: user_id=$user_id, product_id=$product_id, quantity=$quantity");
    
        $query = "SELECT * FROM " . $this->table_name . " WHERE user_id = :user_id AND product_id = :product_id";
        $this->db->query($query);
        $this->db->bind(':user_id', $user_id);
        $this->db->bind(':product_id', $product_id);
        $existingItem = $this->db->single();
    
        if ($existingItem) {
            $newQuantity = $existingItem->quantity + $quantity;
            $query = "UPDATE " . $this->table_name . " SET quantity = :quantity WHERE user_id = :user_id AND product_id = :product_id";
            $this->db->query($query);
            $this->db->bind(':quantity', $newQuantity);
            $this->db->bind(':user_id', $user_id);
            $this->db->bind(':product_id', $product_id);
            $result = $this->db->execute();
            if (!$result) {
                error_log("SQL Error in addToCart (UPDATE): " . print_r($this->db->getConnection()->errorInfo(), true));
            }
            return $result;
        } else {
            $query = "INSERT INTO " . $this->table_name . " (user_id, product_id, quantity) VALUES (:user_id, :product_id, :quantity)";
            $this->db->query($query);
            $this->db->bind(':user_id', $user_id);
            $this->db->bind(':product_id', $product_id);
            $this->db->bind(':quantity', $quantity);
            $result = $this->db->execute();
            if (!$result) {
                error_log("SQL Error in addToCart (INSERT): " . print_r($this->db->getConnection()->errorInfo(), true));
            }
            return $result;
        }
    }

    public function getCart($user_id) {
        if ($this->db === null) {
            throw new Exception("Database connection is not initialized in Cart model.");
        }
    
        $query = "SELECT c.*, p.name, p.price, p.image, p.stock 
                 FROM " . $this->table_name . " c 
                 JOIN products p ON c.product_id = p.id 
                 WHERE c.user_id = :user_id";
        $this->db->query($query);
        $this->db->bind(':user_id', $user_id);
        return $this->db->resultSet();
    }

    public function removeFromCart($user_id, $product_id) {
        if ($this->db === null) {
            error_log("Database connection not initialized");
            throw new Exception("Database connection is not initialized in Cart model.");
        }
    
        // Kiểm tra bản ghi trước khi xóa
        $checkQuery = "SELECT COUNT(*) FROM " . $this->table_name . " WHERE user_id = :user_id AND product_id = :product_id";
        $this->db->query($checkQuery);
        $this->db->bind(':user_id', $user_id);
        $this->db->bind(':product_id', $product_id);
        $count = $this->db->singleColumn();
        error_log("Records found before delete: $count");
    
        $query = "DELETE FROM " . $this->table_name . " WHERE user_id = :user_id AND product_id = :product_id";
        $this->db->query($query);
        $this->db->bind(':user_id', $user_id);
        $this->db->bind(':product_id', $product_id);
        
        $result = $this->db->execute();
        
        if (!$result) {
            error_log("SQL Execution failed: " . print_r($this->db->getConnection()->errorInfo(), true));
        }
        
        $stmt = $this->db->getConnection()->query("SELECT ROW_COUNT()");
        $rowCount = $stmt->fetchColumn();
    
        error_log("Remove Cart Item - User ID: $user_id, Product ID: $product_id, Rows Affected: $rowCount");
        
        return $rowCount > 0;
    }
    public function getCartItem($user_id, $product_id) {
        if ($this->db === null) {
            throw new Exception("Database connection is not initialized in Cart model.");
        }

        $query = "SELECT * FROM " . $this->table_name . " WHERE user_id = :user_id AND product_id = :product_id";
        $this->db->query($query);
        $this->db->bind(':user_id', $user_id);
        $this->db->bind(':product_id', $product_id);
        return $this->db->single();
    }

    public function updateQuantity($user_id, $product_id, $quantity) {
        if ($this->db === null) {
            throw new Exception("Database connection is not initialized in Cart model.");
        }
    
        $product = $this->getProductById($product_id);
        if (!$product) {
            error_log("Product not found: product_id=$product_id");
            return false;
        }
    
        if ($quantity > $product->stock) {
            error_log("Quantity exceeds stock: requested=$quantity, stock=$product->stock");
            return false;
        }
    
        $query = "UPDATE " . $this->table_name . " SET quantity = :quantity WHERE user_id = :user_id AND product_id = :product_id";
        $this->db->query($query);
        $this->db->bind(':quantity', $quantity);
        $this->db->bind(':user_id', $user_id);
        $this->db->bind(':product_id', $product_id);
        $result = $this->db->execute();
    
        if (!$result) {
            error_log("SQL Error in updateQuantity: " . print_r($this->db->getConnection()->errorInfo(), true));
        }
    
        return $result;
    }

    public function getProductById($product_id) {
        if ($this->db === null) {
            throw new Exception("Database connection is not initialized in Cart model.");
        }

        $query = "SELECT * FROM products WHERE id = :product_id";
        $this->db->query($query);
        $this->db->bind(':product_id', $product_id);
        return $this->db->single();
    }

    public function clearCart($user_id) {
        if ($this->db === null) {
            throw new Exception("Database connection is not initialized in Cart model.");
        }

        $query = "DELETE FROM " . $this->table_name . " WHERE user_id = :user_id";
        $this->db->query($query);
        $this->db->bind(':user_id', $user_id);
        $result = $this->db->execute();
        
        if (!$result) {
            error_log("SQL Error in clearCart: " . print_r($this->db->getConnection()->errorInfo(), true));
        }
        
        return $result;
    }
}