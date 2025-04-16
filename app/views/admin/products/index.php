<h2>Danh sách sản phẩm</h2>
<a href="/admin/products/create">+ Thêm sản phẩm</a>
<table border="1">
    <tr>
        <th>ID</th><th>Tên</th><th>Giá</th><th>Ảnh</th><th>Hành động</th>
    </tr>
    <?php foreach ($products as $product): ?>
        <tr>
            <td><?= $product['id'] ?></td>
            <td><?= $product['name'] ?></td>
            <td><?= $product['price'] ?></td>
            <td><img src="<?= $product['image'] ?>" width="80"></td>
            <td>
                <a href="/admin/products/edit/<?= $product['id'] ?>">Sửa</a> |
                <a href="/admin/products/delete/<?= $product['id'] ?>" onclick="return confirm('Xoá?')">Xoá</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
