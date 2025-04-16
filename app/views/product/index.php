<?php include __DIR__ .'/../layouts/header.php'; ?>
<div class="content">
    <ul>
        <li><a href="">Sản phẩm</a></li>
    </ul>
</div>
<div class="product-container">
    <?php if (isset($products) && !empty($products)): ?>
        <?php foreach ($products as $product): ?>
            <div class="card">
                <img src="/shopvotcaulong/Public/assets/img/<?= $product->image ?>" class="card-img-top" alt="Sản phẩm">
                <div class="card-body">
                    <h5 class="card-title"><?= $product->name ?></h5>
                    <p class="card-text">Giá: <?= number_format($product->price, 0, ',', '.') ?>đ</p>
                    <a href="#" class="btn-view">View</a>
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <form action="/shopvotcaulong/Public/index.php?controller=cart&action=add" method="POST" style="display: inline;">
                            <input type="hidden" name="product_id" value="<?= $product->id ?>">
                            <input type="number" name="quantity" value="1" min="1" style="width: 50px;">
                            <button type="submit" class="btn-primary">THÊM VÀO GIỎ HÀNG</button>
                        </form>
                    <?php else: ?>
                        <a href="/shopvotcaulong/Public/index.php?controller=user&action=login" class="btn-primary">Đăng nhập để thêm</a>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Không có sản phẩm nào để hiển thị.</p>
    <?php endif; ?>
</div>

<?php include __DIR__ .'/../layouts/footer.php'; ?>