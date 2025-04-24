<h2>Chỉnh sửa sản phẩm</h2>
<form method="POST" action="">
    <label>Tên sản phẩm:</label><br>
    <input type="text" name="name" value="<?= $product->name ?>"><br><br>

    <label>Giá:</label><br>
    <input type="text" name="price" value="<?= $product->price ?>"><br><br>

    <label>Số lượng tồn kho:</label><br>
    <input type="number" name="stock" value="<?= $product->stock ?>"><br><br>

    <label>URL Hình ảnh:</label><br>
    <input type="text" name="image" value="<?= $product->image ?>"><br><br>

    <input type="submit" value="Cập nhật">
</form>