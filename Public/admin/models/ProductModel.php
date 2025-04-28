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
        $sql = "INSERT INTO products (name, price, stock, image) VALUES (:name, :price, :stock, :image)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['name' => $name, 'price' => $price, 'stock' => $stock, 'image' => $image]);
    }

    public function getProductById($id) {
        $sql = "SELECT * FROM products WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function updateProduct($id, $name, $price, $stock, $image) {
        $sql = "UPDATE products SET name = :name, price = :price, stock = :stock, image = :image WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['id' => $id, 'name' => $name, 'price' => $price, 'stock' => $stock, 'image' => $image]);
    }

    public function deleteProduct($id) {
        $sql = "DELETE FROM products WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }
}
?>