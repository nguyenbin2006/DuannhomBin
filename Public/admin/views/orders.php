<h2>Quản lý đơn hàng</h2>
<table>
    <tr>
        <th>ID</th>
        <th>Email nhận hàng</th>
        <th>SĐT</th>
        <th>Địa chỉ giao hàng</th>
        <th>Tổng tiền</th>
        <th>Ngày đặt</th>
        <th>Trạng thái</th>
        <th>Hành động</th>
    </tr>
    <?php foreach ($orders as $order) { ?>
        <tr>
            <td><?= $order->id ?></td>
            <td><?= $order->email ?></td>
            <td><?= $order->phone ?></td>
            <td><?= $order->address ?: 'Chưa cập nhật' ?></td>
            <td><?= number_format($order->total_amount, 0, ',', '.') ?>đ</td>
            <td><?= $order->order_date ?></td>
            <td>
                <form method="POST" action="index.php?section=orders&action=update_status">
                    <input type="hidden" name="id" value="<?= $order->id ?>">
                    <select name="status" onchange="this.form.submit()">
                        <option value="Chưa giao" <?= $order->status == 'Chưa giao' ? 'selected' : '' ?>>Chưa giao</option>
                        <option value="Đã giao" <?= $order->status == 'Đã giao' ? 'selected' : '' ?>>Đã giao</option>
                    </select>
                </form>
            </td>
            <td>
                <a href="index.php?section=orders&action=delete_order&id=<?= $order->id ?>" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</a>
            </td>
        </tr>
    <?php } ?>
</table>