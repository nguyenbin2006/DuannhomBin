<?php
class UserController extends Controller {
    private $userModel;

    public function __construct() {
        parent::__construct();
        $this->userModel = $this->model('User');
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $user = $this->userModel->findUserByEmail($username);

            if ($user && password_verify($password, $user->password)) {
                $_SESSION['user_id'] = $user->id;
                // Chuyển hướng đến trang dashboard sau khi đăng nhập
                header('Location: /shopvotcaulong/Public/index.php?controller=user&action=dashboard');
                exit();
            } else {
                $this->view('user/login', ['error' => 'Sai email/số điện thoại hoặc mật khẩu!']);
            }
        } else {
            $this->view('user/login');
        }
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];

            if ($password !== $confirm_password) {
                $this->view('user/register', ['error' => 'Mật khẩu và xác nhận mật khẩu không khớp!']);
                return;
            }

            $existingUser = $this->userModel->findUserByEmail($username);
            if ($existingUser) {
                $this->view('user/register', ['error' => 'Email hoặc số điện thoại đã được sử dụng!']);
                return;
            }

            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $this->userModel->email = $username;
            $this->userModel->password = $hashed_password;

            if ($this->userModel->create()) {
                $this->view('user/register', ['success' => 'Đăng ký thành công! Vui lòng đăng nhập.']);
            } else {
                $this->view('user/register', ['error' => 'Đăng ký thất bại! Vui lòng thử lại.']);
            }
        } else {
            $this->view('user/register');
        }
    }

    // Thêm phương thức dashboard
    public function dashboard() {
        // Kiểm tra xem người dùng đã đăng nhập chưa
        if (!isset($_SESSION['user_id'])) {
            header('Location: /shopvotcaulong/Public/index.php?controller=user&action=login');
            exit();
        }
    
        // Lấy thông tin người dùng bằng ID
        $user = $this->userModel->findUserById($_SESSION['user_id']);
        if (!$user) {
            session_unset();
            session_destroy();
            header('Location: /shopvotcaulong/Public/index.php?controller=user&action=login');
            exit();
        }
    
        // Lấy danh sách sản phẩm
        $productModel = $this->model('Product');
        $products = $productModel->getAll();
    
        // Truyền dữ liệu vào view
        $this->view('user/dashboard', [
            'user' => $user,
            'products' => $products
        ]);
    }

    // Thêm phương thức logout (nếu cần)
    public function logout() {
        session_unset();
        session_destroy();
        header('Location: /shopvotcaulong/Public/index.php?controller=home&action=index');
        exit();
    }
}