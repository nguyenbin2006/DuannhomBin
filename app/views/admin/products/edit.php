<h2>Sửa sản phẩm</h2>
<form method="POST">
    Tên: <input name="name" value="<?= $product['name'] ?>"><br>
    Giá: <input name="price" value="<?= $product['price'] ?>"><br>
    Mô tả: <textarea name="description"><?= $product['description'] ?></textarea><br>
    Link ảnh: <input name="image" value="<?= $product['image'] ?>"><br>
    <button type="submit">Cập nhật</button>
</form>
