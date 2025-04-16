<?php include '../layouts/header.php'; ?>
<div class="container">
    <h2>Danh sách sản phẩm</h2>
    <div class="row">
        <?php foreach ($products as $product): ?>
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $product['name']; ?></h5>
                        <p class="card-text"><?php echo $product['description']; ?></p>
                        <p class="card-text">Giá: <?php echo $product['price']; ?> VNĐ</p>
                        <a href="/user/product_detail/<?php echo $product['id']; ?>" class="btn btn-info">Xem chi tiết</a>
                        <a href="/user/add_to_cart/<?php echo $product['id']; ?>" class="btn btn-success">Thêm vào giỏ</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?php include '../layouts/footer.php'; ?>