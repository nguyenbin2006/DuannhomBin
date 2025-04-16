<?php
class User {
    private $db;
    private $table_name = "users";

    public $id;
    public $email;
    public $password;

    public function __construct($db) {
        $this->db = $db;
    }

    public function findUserByEmail($email) {
        if ($this->db === null) {
            throw new Exception("Database connection is not initialized in User model.");
        }
        $query = "SELECT * FROM " . $this->table_name . " WHERE email = :email LIMIT 1";
        $this->db->query($query);
        $this->db->bind(':email', $email);
        return $this->db->single();
    }
    
    public function findUserById($id) {
        if ($this->db === null) {
            throw new Exception("Database connection is not initialized in User model.");
        }
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id LIMIT 1";
        $this->db->query($query);
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function create() {
        if ($this->db === null) {
            throw new Exception("Database connection is not initialized in User model.");
        }
        $query = "INSERT INTO " . $this->table_name . " (email, password) VALUES (:email, :password)";
        $this->db->query($query);
        $this->db->bind(':email', $this->email);
        $this->db->bind(':password', $this->password);
        return $this->db->execute();
    }
}