<?php include __DIR__ .'/../layouts/headerlogin.php'; ?>
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
                    <div class="action-container">
                        <button href="#" class="btn-view">View</button>
                        <input type="hidden" name="product_id" value="<?= $product->id ?>">
                        <input class="quantity-input"type="number" name="quantity" value="1" min="1">
                    </div>
                    <form action="/shopvotcaulong/Public/index.php?controller=cart&action=add" method="POST">   
                        <input type="hidden" name="product_id" value="<?= $product->id ?>">
                        <button type="submit" class="btn-primary">THÊM VÀO GIỎ HÀNG</button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Không có sản phẩm nào để hiển thị.</p>
    <?php endif; ?>
</div>
<?php include __DIR__ .'/../layouts/footer.php'; ?>