<?php 

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
            <div class="cart-item">
                <img src="/DuannhomBin/Public/assets/img/<?= htmlspecialchars($item->image) ?>" alt="<?= htmlspecialchars($item->name) ?>" class="cart-item-img">
                <div class="cart-item-details">
                    <h5 class="cart-item-name"><?= htmlspecialchars($item->name) ?></h5>
                    <p class="cart-item-price">Giá: <?= number_format($item->price, 0, ',', '.') ?>đ</p>
                    <div class="cart-item-quantity">
                        <button class="quantity-btn increase" onclick="updateQuantity(<?= $item->product_id ?>, +1)">+</button>
                        <span class="quantity"><?= $item->quantity ?></span>
                        <button class="quantity-btn decrease" onclick="updateQuantity(<?= $item->product_id ?>, -1)">-</button>
                        
                    </div>
                    <p class="cart-item-total">Tổng: <?= number_format($item->price * $item->quantity, 0, ',', '.') ?>đ</p>
                    <a href="index.php?controller=cart&action=remove&id=<?= $item->product_id ?>" 
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
        <a href="<?= $baseURL ?>order/checkout" class="checkout-btn">Thanh toán</a>
    </div>
<?php endif; ?>

<?php include __DIR__ . '/../layouts/footer.php'; ?>

<script>
// Hàm cập nhật số lượng (tăng/giảm)
function updateQuantity(productId, change) {
    let quantityElement = document.querySelector(`.cart-item-details .quantity`);
    let currentQuantity = parseInt(quantityElement.textContent);
    let newQuantity = currentQuantity + change;

    if (newQuantity < 1) {
        newQuantity = 1; // Không cho phép số lượng nhỏ hơn 1
    }

    // Gửi yêu cầu AJAX để cập nhật số lượng trong cơ sở dữ liệu
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
            // Cập nhật tổng cho sản phẩm
            let price = parseInt(document.querySelector(`.cart-item-details .cart-item-price`).textContent.replace(/[^0-9]/g, ''));
            document.querySelector(`.cart-item-details .cart-item-total`).textContent = `Tổng: ${newQuantity * price}đ`;
            // Cập nhật tổng cộng
            document.querySelector('.cart-summary h3').textContent = `Tổng cộng: ${data.total}đ`;
        } else {
            alert('Lỗi khi cập nhật số lượng!');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Lỗi khi cập nhật số lượng!');
    });
}
</script>