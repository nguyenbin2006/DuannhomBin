<?php
class UserModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllUsers() {
        $sql = "SELECT id, username, email, full_name FROM users";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function deleteUser($id) {
        // Bắt đầu một transaction để đảm bảo tính toàn vẹn dữ liệu
        $this->db->beginTransaction();
        try {
            // Xóa các mục trong order_items liên quan đến đơn hàng của người dùng
            $sql = "DELETE oi FROM order_items oi
                    JOIN orders o ON oi.order_id = o.id
                    WHERE o.user_id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->execute(['id' => $id]);

            // Xóa các đơn hàng của người dùng trong bảng orders
            $sql = "DELETE FROM orders WHERE user_id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->execute(['id' => $id]);

            // Xóa người dùng trong bảng users
            $sql = "DELETE FROM users WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->execute(['id' => $id]);

            // Commit transaction
            $this->db->commit();
        } catch (Exception $e) {
            // Rollback transaction nếu có lỗi
            $this->db->rollBack();
            throw $e;
        }
    }
}
?>