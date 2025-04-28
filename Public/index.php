<?php
foreach (glob("App/Controllers/*.php") as $filename) {
    require_once $filename;
}

$controllerFilePath = realpath('../app/core/Controller.php');
$dbConnectionFilePath = realpath('../app/core/DBConnection.php');

if (!$controllerFilePath) {
    die("Cannot find Controller.php at ../app/core/Controller.php");
}
if (!$dbConnectionFilePath) {
    die("Cannot find DBConnection.php at ../app/core/DBConnection.php");
}

require_once $dbConnectionFilePath;
require_once $controllerFilePath;

// Khởi động session (cần cho đăng nhập)
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

try {
    $controller = isset($_GET['controller']) ? $_GET['controller'] : 'home';
    $action = isset($_GET['action']) ? $_GET['action'] : 'index';
    $id = isset($_GET['id']) ? $_GET['id'] : null;

    $controllerName = ucfirst($controller) . 'Controller';
    $controllerFile = "../app/controllers/$controllerName.php";

    if ($controller == 'admin') {
        $adminController = new AdminController();
        if ($action == 'delete' && $id) {
            $adminController->delete($id);
        }
    }

    if (file_exists($controllerFile)) {
        require_once $controllerFile;
        $controller = new $controllerName();

        if (method_exists($controller, $action)) {
            // Lấy tất cả tham số trên URL trừ 'controller' và 'action'
            $params = array_values(array_diff_key($_GET, array_flip(['controller', 'action'])));

            // Gọi hàm controller với tham số
            call_user_func_array([$controller, $action], $params);
        } else {
            echo "Method '$action' not found in $controllerName!";
        }
    } else {
        echo "Controller '$controllerName' not found!";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}


if ($action == 'checkout' && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 1;
    $address = $_POST['address'] ?? '';
    $orderModel->createOrder($user_id, $_SESSION['cart'], $address);
    unset($_SESSION['cart']);
    header("Location: index.php?success=1");
    exit();
}
?>