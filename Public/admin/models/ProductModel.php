<?php
class ProductModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllProducts() {
        return $this->db->query("SELECT * FROM products")->fetchAll(PDO::FETCH_OBJ);
    }

    public function addProduct($name, $price, $stock, $image) {
        // Xử lý file ảnh
        $image_name = $this->uploadImage($image);
        if (!$image_name) {
            throw new Exception("Lỗi khi tải ảnh lên. Vui lòng kiểm tra file ảnh và thử lại.");
        }

        $sql = "INSERT INTO products (name, price, stock, image) VALUES (:name, :price, :stock, :image)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['name' => $name, 'price' => $price, 'stock' => $stock, 'image' => $image_name]);
    }

    public function getProductById($id) {
        $sql = "SELECT * FROM products WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function updateProduct($id, $name, $price, $stock, $image) {
        $product = $this->getProductById($id);
        $image_name = $product->image; // Giữ ảnh cũ nếu không có ảnh mới

        if ($image && !empty($image['name'])) {
            // Xóa ảnh cũ nếu có
            $old_image_path = __DIR__ . '/../../assets/img/' . $product->image;
            if (file_exists($old_image_path) && $product->image != 'placeholder.jpg') {
                unlink($old_image_path);
            }
            // Tải ảnh mới lên
            $image_name = $this->uploadImage($image);
            if (!$image_name) {
                throw new Exception("Lỗi khi tải ảnh lên. Vui lòng kiểm tra file ảnh và thử lại.");
            }
        }

        $sql = "UPDATE products SET name = :name, price = :price, stock = :stock, image = :image WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['id' => $id, 'name' => $name, 'price' => $price, 'stock' => $stock, 'image' => $image_name]);
    }

    public function canDeleteProduct($id) {
        $sql = "SELECT COUNT(*) FROM order_items WHERE product_id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);
        $count = $stmt->fetchColumn();

        if ($count > 0) {
            return false;
        }

        $sql = "SELECT COUNT(*) FROM cart WHERE product_id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);
        $count = $stmt->fetchColumn();

        if ($count > 0) {
            return false;
        }

        return true;
    }

    public function deleteProduct($id) {
        if (!$this->canDeleteProduct($id)) {
            throw new Exception("Không thể xóa sản phẩm vì sản phẩm đang được sử dụng trong đơn hàng hoặc giỏ hàng.");
        }

        $product = $this->getProductById($id);
        // Xóa ảnh nếu không phải là ảnh mặc định
        $image_path = __DIR__ . '/../../assets/img/' . $product->image;
        if (file_exists($image_path) && $product->image != 'placeholder.jpg') {
            unlink($image_path);
        }

        $sql = "DELETE FROM products WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }

    private function uploadImage($image) {
        // Kiểm tra nếu $image là null hoặc không có file được tải lên
        if (!$image || !isset($image['error']) || $image['error'] === UPLOAD_ERR_NO_FILE) {
            return false; // Không có file, trả về false
        }

        if ($image['error'] !== UPLOAD_ERR_OK) {
            return false; // Lỗi tải file
        }

        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($image['type'], $allowed_types)) {
            return false; // Định dạng file không hợp lệ
        }

        $upload_dir = __DIR__ . '/../../assets/img/';
        // Đảm bảo thư mục tồn tại
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        $image_name = time() . '_' . basename($image['name']);
        $upload_path = $upload_dir . $image_name;

        if (move_uploaded_file($image['tmp_name'], $upload_path)) {
            return $image_name;
        }
        return false;
    }
}
?>