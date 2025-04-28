<?php
class ReportModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getTotalRevenue($month) {
        $sql = "SELECT SUM(total_amount) as total_revenue FROM orders WHERE DATE_FORMAT(order_date, '%Y-%m') = :month AND status = 'Đã giao'";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['month' => $month]);
        return $stmt->fetch(PDO::FETCH_OBJ)->total_revenue;
    }

    public function getOrdersByMonth($month) {
        $sql = "SELECT o.*, u.username FROM orders o JOIN users u ON o.user_id = u.id WHERE DATE_FORMAT(o.order_date, '%Y-%m') = :month AND o.status = 'Đã giao'";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['month' => $month]);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}
?>