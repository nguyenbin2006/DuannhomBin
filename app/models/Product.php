<?php
class Product {
    private $db;
    private $table_name = "products";

    public $id;
    public $name;
    public $price;
    public $description;
    public $image;
    public $category;
    public $created_at;
    public $stock;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAll() {
        $this->db->query("SELECT * FROM " . $this->table_name);
        return $this->db->resultSet();
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " 
            (name, price, description, image, category, stock) 
            VALUES (:name, :price, :description, :image, :category, :stock)";
        $this->db->query($query);
        $this->db->bind(':name', $this->name);
        $this->db->bind(':price', $this->price);
        $this->db->bind(':description', $this->description);
        $this->db->bind(':image', $this->image);
        $this->db->bind(':category', $this->category);
        $this->db->bind(':stock', $this->stock);
        return $this->db->execute();
    }

    public function update($id) {
        $query = "UPDATE " . $this->table_name . " 
                  SET name = :name, price = :price, description = :description,
                      image = :image, category = :category, stock = :stock 
                  WHERE id = :id";
        $this->db->query($query);
        $this->db->bind(':name', $this->name);
        $this->db->bind(':price', $this->price);
        $this->db->bind(':description', $this->description);
        $this->db->bind(':image', $this->image);
        $this->db->bind(':category', $this->category);
        $this->db->bind(':stock', $this->stock);
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    public function delete($id) {
        $this->db->query("DELETE FROM " . $this->table_name . " WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    public function findById($id) {
        $this->db->query("SELECT * FROM " . $this->table_name . " WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }
}
