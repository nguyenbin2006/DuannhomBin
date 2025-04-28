<?php 
include __DIR__ . '/../../../App/Views/layouts/headerlogin.php'; 
?>
<h2>🎉 Đặt hàng thành công!</h2>
<?php if (isset($orderId) && !empty($orderId)): ?>
    <p>Mã đơn hàng của bạn là: <?= htmlspecialchars($orderId) ?></p>
<?php else: ?>
    <p>Lỗi: Không tìm thấy mã đơn hàng.</p>
<?php endif; ?>
<a href="/DuannhomBin/Public/index.php"><span>🏠</span> Quay về trang chủ</a>
<?php 
include __DIR__ . '/../../../App/Views/layouts/footer.php'; 
?>