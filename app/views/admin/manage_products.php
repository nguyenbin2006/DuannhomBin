<?php include '../layouts/header.php'; ?>
<div class="container">
    <h2>Quản lý sản phẩm</h2>
    <a href="/admin/add_product" class="btn btn-primary mb-3">Thêm sản phẩm</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên</th>
                <th>Giá</th>
                <th>Mô tả</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td><?php echo $product['id']; ?></td>
                    <td><?php echo $product['name']; ?></td>
                    <td><?php echo $product['price']; ?></td>
                    <td><?php echo $product['description']; ?></td>
                    <td>
                        <a href="/admin/edit_product/<?php echo $product['id']; ?>" class="btn btn-warning">Sửa</a>
                        <a href="/admin/delete_product/<?php echo $product['id']; ?>" class="btn btn-danger">Xóa</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php include '../layouts/footer.php'; ?>