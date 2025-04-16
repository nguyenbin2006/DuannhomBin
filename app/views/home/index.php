<?php include __DIR__ .'/../layouts/header.php'; ?>

<img class="content-img" src="/shopvotcaulong/Public/assets/img/img1.png" alt="">
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
                    <a href="#" class="btn-primary">ĐĂNG NHẬP ĐỂ THÊM</a>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Không có sản phẩm nào để hiển thị.</p>
    <?php endif; ?>
</div>

<?php include __DIR__ .'/../layouts/footer.php'; ?>