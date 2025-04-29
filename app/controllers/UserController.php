<?php
class UserController extends Controller {
    private $userModel;

    public function __construct() {
        parent::__construct();
        $this->userModel = $this->model('User');
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username_or_email = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            if (empty($username_or_email) || empty($password)) {
                $this->view('user/login', ['error' => 'Vui lòng nhập đầy đủ thông tin!']);
                return;
            }

            $user = filter_var($username_or_email, FILTER_VALIDATE_EMAIL)
                ? $this->userModel->findUserByEmail($username_or_email)
                : $this->userModel->findUserByUsername($username_or_email);

            if ($user && password_verify($password, $user->password)) {
                $_SESSION['user_id'] = $user->id;
                header('Location: /DuannhomBin/Public/index.php?controller=user&action=dashboard');
                exit();
            } else {
                $this->view('user/login', ['error' => 'Sai tên người dùng/email hoặc mật khẩu!']);
            }
        } else {
            $this->view('user/login');
        }
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $confirm_password = $_POST['confirm_password'] ?? '';

            if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
                $this->view('user/register', ['error' => 'Vui lòng nhập đầy đủ thông tin!']);
                return;
            }

            if ($password !== $confirm_password) {
                $this->view('user/register', ['error' => 'Mật khẩu và xác nhận mật khẩu không khớp!']);
                return;
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $this->view('user/register', ['error' => 'Email không hợp lệ!']);
                return;
            }

            $existingUser = $this->userModel->findUserByEmail($email);
            if ($existingUser) {
                $this->view('user/register', ['error' => 'Email đã được sử dụng!']);
                return;
            }

            $existingUsername = $this->userModel->findUserByUsername($username);
            if ($existingUsername) {
                $this->view('user/register', ['error' => 'Tên người dùng đã được sử dụng!']);
                return;
            }

            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $this->userModel->username = $username;
            $this->userModel->email = $email;
            $this->userModel->password = $hashed_password;

            try {
                if ($this->userModel->create()) {
                    $this->view('user/register', ['success' => 'Đăng ký thành công! Vui lòng đăng nhập.']);
                } else {
                    $this->view('user/register', ['error' => 'Đăng ký thất bại! Vui lòng thử lại.']);
                }
            } catch (Exception $e) {
                $this->view('user/register', ['error' => 'Lỗi: ' . $e->getMessage()]);
            }
        } else {
            $this->view('user/register');
        }
    }

    public function dashboard() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /DuannhomBin/Public/index.php?controller=user&action=login');
            exit();
        }
    
        $user = $this->userModel->findUserById($_SESSION['user_id']);
        if (!$user) {
            session_unset();
            session_destroy();
            header('Location: /DuannhomBin/Public/index.php?controller=user&action=login');
            exit();
        }
    
        $productModel = $this->model('Product');
        $products = $productModel->getAll();
    
        $this->view('user/dashboard', [
            'user' => $user,
            'products' => $products
        ]);
    }

    public function logout() {
        session_unset();
        session_destroy();
        header('Location: /DuannhomBin/Public/index.php?controller=home&action=index');
        exit();
    }
}