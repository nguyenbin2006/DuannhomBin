<?php
try {
    $pdo = new PDO("mysql:host=localhost;dbname=shopvotcaulong;charset=utf8", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Kết nối cơ sở dữ liệu thành công!";
} catch (PDOException $e) {
    echo "Lỗi kết nối: " . $e->getMessage();
}
?>