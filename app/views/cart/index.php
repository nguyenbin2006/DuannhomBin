<?php 
$base = $config['base'];
$baseURL = $config['baseURL'];
$assets = $config['assets'];
include __DIR__ . '/../layouts/headerlogin.php';
?>


<div class="giohang">
<li class="text-cart">Giỏ hàng của bạn</li>
</div>
<?php if (empty($cartItems)): ?>
    <p class="empty-cart">Giỏ hàng của bạn đang trống.</p>
<?php else: ?>
    <div class="cart-container">
        <?php foreach ($cartItems as $item): ?>
            <div class="cart-item" data-id="<?= $item->product_id ?>">
                <img src="<?=$assets?>img/<?= htmlspecialchars($item->image) ?>" alt="<?= htmlspecialchars($item->name) ?>" class="cart-item-img">
                <div class="cart-item-details">
                    <h5 class="cart-item-name"><?= htmlspecialchars($item->name) ?></h5>
                    <p class="cart-item-price">Giá: <?= number_format($item->price, 0, ',', '.') ?>đ</p>
                    <div class="cart-item-quantity">
                        <button class="quantity-btn increase" onclick="updateQuantity(<?= $item->product_id ?>, +1)">+</button>
                        <span class="quantity"><?= $item->quantity ?></span>
                        <button class="quantity-btn decrease" onclick="updateQuantity(<?= $item->product_id ?>, -1)">-</button>
                        
                    </div>
                    <p class="cart-item-total">Tổng: <?= number_format($item->price * $item->quantity, 0, ',', '.') ?>đ</p>
                    <a href="<?=$base_url?>index.php?controller=cart&action=remove&id=<?= $item->product_id ?>"
                    onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')">Xóa</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="cart-summary">
        <h3>Tổng cộng: 
            <?php
                $total = 0;
                foreach ($cartItems as $item) {
                    $total += $item->price * $item->quantity;
                }
                echo number_format($total, 0, ',', '.') . 'đ';
            ?>
        </h3>
        <a href="<?=$baseURL?>order/checkout" class="checkout-btn">Thanh toán</a>
    </div>
<?php endif; ?>

<?php include __DIR__ . '/../layouts/footer.php'; ?>

<script>
// Hàm cập nhật số lượng (tăng/giảm)
function updateQuantity(productId, change) {
    // Tìm đúng phần tử sản phẩm tương ứng
    const cartItem = document.querySelector(`.cart-item[data-id="${productId}"]`);
    const quantityElement = cartItem.querySelector('.quantity');
    let currentQuantity = parseInt(quantityElement.textContent);
    let newQuantity = currentQuantity + change;

    if (newQuantity < 1) newQuantity = 1;

    fetch('/DuannhomBin/Public/index.php?controller=cart&action=update', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `product_id=${productId}&quantity=${newQuantity}`
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            quantityElement.textContent = newQuantity;

            const price = data.price;
            const itemTotalElement = cartItem.querySelector('.cart-item-total');
            itemTotalElement.textContent = `Tổng: ${(price * newQuantity).toLocaleString('vi-VN')}đ`;

            document.querySelector('.cart-summary h3').textContent = `Tổng cộng: ${data.total}đ`;
        } else {
            alert(data.message || 'Lỗi khi cập nhật số lượng!');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Lỗi khi cập nhật số lượng!');
    });
}

</script>