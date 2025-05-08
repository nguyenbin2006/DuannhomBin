<?php include __DIR__ . '/../layouts/header.php'; ?>
<div class="content">
    <ul>
        <li><a href="/DuannhomBin/Public/index.php?controller=product&action=index">Sản phẩm</a></li>
    </ul>
</div>
<div class="product-container">
    <?php if (isset($products) && !empty($products)): ?>
        <?php foreach ($products as $product): ?>
            <div class="card">
                <img src="/DuannhomBin/Public/assets/img/<?= htmlspecialchars($product->image ?? '') ?>" class="card-img-top" alt="Sản phẩm">
                <div class="card-body">
                    <h5 class="card-title"><?= htmlspecialchars($product->name ?? '') ?></h5>
                    <p class="card-text">Giá: <?= number_format($product->price ?? 0, 0, ',', '.') ?>đ</p>
                    <a href="/DuannhomBin/Public/index.php?controller=product&action=show&id=<?= $product->id ?? 0 ?>" class="btn-view">View</a>
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <form action="/DuannhomBin/Public/index.php?controller=cart&action=add" method="POST" style="display: inline;">
                            <input type="hidden" name="product_id" value="<?= $product->id ?? 0 ?>">
                            <button type="submit" class="btn-primary">Thêm vào giỏ hàng</button>
                        </form>
                    <?php else: ?>
                        <a href="/DuannhomBin/Public/index.php?controller=user&action=login" class="btn-primary">Đăng nhập để thêm</a>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Không có sản phẩm nào để hiển thị.</p>
    <?php endif; ?>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>