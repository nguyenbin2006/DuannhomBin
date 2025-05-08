<h2>Quản lý sản phẩm</h2>
<h3>Thêm sản phẩm mới</h3>
<form method="POST" action="index.php?section=products&action=add_product" enctype="multipart/form-data">
    <div class="form-group">
        <label>Tên sản phẩm</label>
        <input type="text" name="name" required>
    </div>
    <div class="form-group">
        <label>Giá</label>
        <input type="number" name="price" required>
    </div>
    <div class="form-group">
        <label>Tồn kho</label>
        <input type="number" name="stock" required>
    </div>
    <div class="form-group">
        <label>Mô tả</label>
        <textarea name="description" rows="4"></textarea>
    </div>
    <div class="form-group">
        <label>Danh mục</label>
        <input type="text" name="category">
    </div>
    <div class="form-group">
        <label>Ngày tạo</label>
        <input type="date" name="created_at">
    </div>
    <div class="form-group">
        <label>Ảnh sản phẩm</label>
        <input type="file" name="image" accept="image/*" required>
    </div>
    <div class="form-group">
        <button type="submit">Thêm sản phẩm</button>
    </div>
</form>

<h3>Danh sách sản phẩm</h3>
<table>
    <tr>
        <th>ID</th>
        <th>Tên</th>
        <th>Giá</th>
        <th>Tồn kho</th>
        <th>Ảnh</th>
        <th>Hành động</th>
    </tr>
    <?php
    $base_url = 'http://localhost/DuannhomBin/Public/assets/img/';
    foreach ($products as $product) {
        $image_url = empty($product->image) ? $base_url . 'placeholder.jpg' : $base_url . $product->image;
    ?>
        <tr>
            <td><?= $product->id ?></td>
            <td><?= $product->name ?></td>
            <td><?= number_format($product->price, 0, ',', '.') ?>đ</td>
            <td><?= $product->stock ?></td>
            <td><img src="<?= $image_url ?>" width="50" onerror="this.src='http://localhost/DuannhomBin/Public/assets/img/placeholder.jpg';"></td>
            <td>
                <a href="index.php?section=products&action=edit&id=<?= $product->id ?>" class="btn btn-primary">Sửa</a>
                <a href="index.php?section=products&action=delete_product&id=<?= $product->id ?>" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</a>
            </td>
        </tr>
    <?php } ?>
</table>

<?php if ($action == 'edit' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $product = $productModel->getProductById($id);
    $image_url = empty($product->image) ? $base_url . 'placeholder.jpg' : $base_url . $product->image;
    ?>
    <h3>Sửa sản phẩm</h3>
    <form method="POST" action="index.php?section=products&action=edit_product" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $product->id ?>">
        <div class="form-group">
            <label>Tên sản phẩm</label>
            <input type="text" name="name" value="<?= $product->name ?>" required>
        </div>
        <div class="form-group">
            <label>Giá</label>
            <input type="number" name="price" value="<?= $product->price ?>" required>
        </div>
        <div class="form-group">
            <label>Tồn kho</label>
            <input type="number" name="stock" value="<?= $product->stock ?>" required>
        </div>
        <div class="form-group">
            <label>Ảnh hiện tại</label>
            <img src="<?= $image_url ?>" width="50">
        </div>
        <div class="form-group">
            <label>Thay ảnh mới (bỏ trống nếu không thay đổi)</label>
            <input type="file" name="image" accept="image/*">
        </div>
        <div class="form-group">
            <button type="submit">Cập nhật</button>
        </div>
    </form>
<?php } ?>

<?php if ($error_message): ?>
    <p class="error"><?= $error_message ?></p>
<?php endif; ?>