<?php 
include __DIR__ . '/../layouts/' . (isset($_SESSION['user_id']) ? 'headerlogin.php' : 'header.php');
?>
<div class="product-detail-container">
    <h2>Chi tiết sản phẩm</h2>
    <div class="product-detail">
        <div class="product-image">
            <img src="/DuannhomBin/Public/assets/img/<?= htmlspecialchars($product->image ?? '') ?>" alt="<?= htmlspecialchars($product->name ?? '') ?>" class="product-detail-img">
        </div>
        <div class="product-info">
            <h3 class="card-title"><?= htmlspecialchars($product->name ?? '') ?></h3>
            <p class="card-text">Giá: <?= number_format($product->price ?? 0, 0, ',', '.') ?>đ</p>
            <p class="card-text">Danh mục: <?= htmlspecialchars($product->category ?? 'Chưa có danh mục') ?></p>
            <p class="card-text">Tồn kho: <?= htmlspecialchars($product->stock ?? 0) ?></p>
            <p class="card-text">Mô tả: <?= htmlspecialchars($product->description ?? 'Chưa có mô tả') ?></p>
            <p class="card-text">Ngày tạo: <?= htmlspecialchars($product->created_at ?? 'Chưa có thông tin') ?></p>
            <?php if (isset($_SESSION['user_id'])): ?>
                <form action="/DuannhomBin/Public/index.php?controller=cart&action=add" method="POST" style="display: inline;">
                    <input type="hidden" name="product_id" value="<?= $product->id ?? 0 ?>">
                    <button type="submit" class="btn-primary">Thêm vào giỏ hàng</button>
                </form>
            <?php else: ?>
                <p>Vui lòng <a href="/DuannhomBin/Public/index.php?controller=user&action=login">đăng nhập</a> để thêm vào giỏ hàng.</p>
            <?php endif; ?>
            <div>
                <a href="/DuannhomBin/Public/index.php?controller=product&action=index" class="back">Quay lại</a>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>