<?php
class User {
    private $db;
    private $table_name = "users";

    public $id;
    public $username;
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

    public function findUserByUsername($username) {
        if ($this->db === null) {
            throw new Exception("Database connection is not initialized in User model.");
        }
        $query = "SELECT * FROM " . $this->table_name . " WHERE username = :username LIMIT 1";
        $this->db->query($query);
        $this->db->bind(':username', $username);
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

        if (empty($this->username) || empty($this->email) || empty($this->password)) {
            throw new Exception("Missing required fields: username, email, or password. Values: username=$this->username, email=$this->email, password=$this->password");
        }

        // Sử dụng PDO trực tiếp để kiểm tra
        $query = "INSERT INTO " . $this->table_name . " (username, email, password) VALUES (:username, :email, :password)";
        $stmt = $this->db->getConnection()->prepare($query);

        $params = [
            ':username' => $this->username,
            ':email' => $this->email,
            ':password' => $this->password
        ];

        // Debug: In truy vấn và tham số
        error_log("SQL Query: " . $query);
        error_log("Parameters: " . print_r($params, true));

        try {
            $stmt->execute($params);
            return true;
        } catch (PDOException $e) {
            throw new Exception("SQL Error: " . $e->getMessage());
        }
    }
}
?>