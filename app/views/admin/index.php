<h2>Quản lý sản phẩm</h2>
<a href="/shopvotcaulong/Public/index.php?controller=admin&action=create">+ Thêm sản phẩm mới</a>

<?php
if (isset($_GET['message'])) {
    if ($_GET['message'] == 'delete_success') {
        echo "<p style='color: green;'>Xóa sản phẩm thành công!</p>";
    } elseif ($_GET['message'] == 'delete_failed') {
        echo "<p style='color: red;'>Xóa sản phẩm thất bại!</p>";
    }
}
?>

<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Tên</th>
        <th>Giá</th>
        <th>Hình ảnh</th>
        <th>Tồn kho</th>
        <th>Hành động</th>
    </tr>
    <?php foreach ($products as $product): ?>
    <tr>
        <td><?= $product->id ?></td>
        <td><?= $product->name ?></td>
        <td><?= number_format($product->price, 0, ',', '.') ?>đ</td>
        <td><img src="/shopvotcaulong/Public/assets/img/<?= $product->image ?>" width="80"></td>
        <td><?= $product->stock ?></td>
        <td>
            <a href="/shopvotcaulong/Public/index.php?controller=admin&action=edit&id=<?= $product->id ?>">Sửa</a> |
            <a href="/shopvotcaulong/Public/index.php?controller=admin&action=delete&id=<?= $product->id ?>" onclick="return confirm('Xóa sản phẩm này?')">Xóa</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>