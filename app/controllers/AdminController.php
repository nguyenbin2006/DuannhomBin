<?php
class AdminController {
    private $db;
    private $userModel;
    private $productModel;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->userModel = new User($this->db);
        $this->productModel = new Product($this->db);
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->userModel->email = $_POST['email'];
            $this->userModel->password = $_POST['password'];
            $user = $this->userModel->login();
            if ($user && $user['role'] == 'admin') {
                session_start();
                $_SESSION['admin_id'] = $user['id'];
                header('Location: /admin/dashboard');
            } else {
                $error = "Sai email hoặc mật khẩu!";
                require_once '../views/admin/login.php';
            }
        } else {
            require_once '../views/admin/login.php';
        }
    }

    public function manage_products() {
        $products = $this->productModel->getAll();
        require_once '../views/admin/manage_products.php';
    }
}
?>