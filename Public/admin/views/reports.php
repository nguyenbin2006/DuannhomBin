<h2>Báo cáo doanh thu</h2>
<form method="GET" action="index.php">
    <input type="hidden" name="section" value="reports">
    <div class="form-group">
        <label>Chọn tháng</label>
        <input type="month" name="month" value="<?= $month ?>" required>
        <button type="submit">Xem báo cáo</button>
    </div>
</form>
<h3>Tổng doanh thu: <?= number_format($total_revenue ?: 0, 0, ',', '.') ?>đ</h3>
<table>
    <tr>
        <th>ID</th>
        <th>Người dùng</th>
        <th>Tổng tiền</th>
        <th>Ngày đặt</th>
    </tr>
    <?php foreach ($report_orders as $order) { ?>
        <tr>
            <td><?= $order->id ?></td>
            <td><?= $order->username ?></td>
            <td><?= number_format($order->total_amount, 0, ',', '.') ?>đ</td>
            <td><?= $order->order_date ?></td>
        </tr>
    <?php } ?>
</table>