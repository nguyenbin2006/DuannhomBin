<?php 
$base = $config['base'];
$baseURL = $config['baseURL'];
$assets = $config['assets'];
include __DIR__ . '/../layouts/headerlogin.php';
?>

<div class="giohang">
    <li class="text-cart">Giỏ hàng của bạn</li>
</div>

<?php if (isset($success)): ?>
    <div class="alert alert-success">
        <?php
        if ($success == 'order_placed') echo 'Đặt hàng thành công! Kiểm tra trạng thái đơn hàng của bạn bên dưới.';
        elseif ($success == 'added') echo 'Thêm sản phẩm vào giỏ hàng thành công!';
        elseif ($success == 'removed') echo 'Xóa sản phẩm khỏi giỏ hàng thành công!';
        ?>
    </div>
<?php endif; ?>

<?php if (isset($error)): ?>
    <div class="alert alert-danger">
        <?php
        if ($error == 'empty_cart') echo 'Giỏ hàng của bạn đang trống!';
        elseif ($error == 'invalid_product') echo 'Sản phẩm không hợp lệ!';
        elseif ($error == 'order_failed') echo 'Không thể tạo đơn hàng. Vui lòng thử lại!';
        elseif ($error == 'missing_info') echo 'Vui lòng nhập đầy đủ thông tin giao hàng!';
        elseif ($error == 'invalid_email') echo 'Email không hợp lệ!';
        elseif ($error == 'invalid_phone') echo 'Số điện thoại không hợp lệ!';
        elseif ($error == 'invalid_address') echo 'Địa chỉ không hợp lệ!';
        elseif ($error == 'add_failed') echo 'Thêm sản phẩm vào giỏ hàng thất bại!';
        elseif ($error == 'remove_failed') echo 'Xóa sản phẩm khỏi giỏ hàng thất bại!';
        ?>
    </div>
<?php endif; ?>

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

        <!-- Form nhập thông tin giao hàng -->
        <form action="<?=$baseURL?>Public/index.php?controller=order&action=checkout" method="POST">
        <h4 class="delivery-form-title">Thông tin giao hàng</h4>
            <div class="form-group">
                <label for="phone">Số điện thoại:</label>
                <input type="text" class="form-control" id="phone" name="phone" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="address">Địa chỉ giao hàng:</label>
                <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
            </div>
            <button type="submit" class="checkout-btn">Thanh toán</button>
        </form>
    </div>
<?php endif; ?>

<!-- Hiển thị danh sách đơn hàng -->
<div class="orders-section">
    <h2 class="orders-title">Danh sách đơn hàng của bạn</h2>
    <?php if (empty($orders)): ?>
        <p class="empty-orders">Bạn chưa có đơn hàng nào.</p>
    <?php else: ?>
        <div class="orders-list">
            <?php foreach ($orders as $order): ?>
                <div class="order-item">
                    <div class="order-details">
                        <p><strong>Mã đơn hàng:</strong> <?= htmlspecialchars($order->id) ?></p>
                        <p><strong>Tổng tiền:</strong> <?= number_format($order->total_amount, 0, ',', '.') ?>đ</p>
                        <p><strong>Ngày đặt:</strong> <?= htmlspecialchars($order->order_date) ?></p>
                        <p><strong>Trạng thái:</strong> 
                            <span class="order-status <?= $order->status === 'Đã giao' ? 'status-delivered' : 'status-pending' ?>">
                                <?= htmlspecialchars($order->status) ?>
                            </span>
                        </p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>

<script>
function updateQuantity(productId, change) {
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