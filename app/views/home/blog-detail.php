<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include __DIR__ . '/../layouts/header.php';
$id = $_GET['id'] ?? 0;
if ($id == 1) {
    include __DIR__ . '/blogs/blog1.php';
} else if ($id == 2) {
    include __DIR__ . '/blogs/blog2.php';
} else if ($id == 3) {
    include __DIR__ . '/blogs/blog3.php';
} else if ($id == 4) {
    include __DIR__ . '/blogs/blog4.php';
} else {
    echo "<p>Bài viết không tồn tại.</p>";
}
include __DIR__ . '/../layouts/footer.php';
?>