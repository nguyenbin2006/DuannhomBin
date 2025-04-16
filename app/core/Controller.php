<?php
class Controller {
    protected $db;

    public function __construct() {
        try {
            $database = new DBConnection();
            $connection = $database->getConnection();
            if (!$connection) {
                throw new Exception("Failed to initialize DBConnection in Controller.");
            }
            $this->db = $database;
        } catch (Exception $e) {
            echo "Error in Controller constructor: " . $e->getMessage();
            exit();
        }
    }

    protected function model($model) {
        $modelPath = '../app/models/' . $model . '.php';
        if (!file_exists($modelPath)) {
            throw new Exception("Model file not found: " . $modelPath);
        }
        require_once $modelPath;
        $instance = new $model($this->db);
        return $instance;
    }

    protected function view($view, $data = []) {
        extract($data);
        $viewPath = '../app/views/' . $view . '.php';
        if (!file_exists($viewPath)) {
            throw new Exception("View file not found: " . $viewPath);
        }
        require_once $viewPath;
    }
}