<?php
class Product {
    private $db;
    private $table_name = "products";

    public $id;
    public $name;
    public $price;
    public $description;
    public $image;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAll() {
        if ($this->db === null) {
            throw new Exception("Database connection is not initialized in Product model.");
        }
        $query = "SELECT * FROM " . $this->table_name;
        $this->db->query($query);
        return $this->db->resultSet();
    }

    public function create() {
        if ($this->db === null) {
            throw new Exception("Database connection is not initialized in Product model.");
        }
        $query = "INSERT INTO " . $this->table_name . " (name, price, description, image) VALUES (:name, :price, :description, :image)";
        $this->db->query($query);
        $this->db->bind(':name', $this->name);
        $this->db->bind(':price', $this->price);
        $this->db->bind(':description', $this->description);
        $this->db->bind(':image', $this->image);
        return $this->db->execute();
    }
}