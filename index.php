<?php
require_once '../app/core/DBConnection.php';
require_once '../app/core/Controller.php';
require_once '../app/controllers/AdminController.php';
require_once '../app/controllers/HomeController.php';
require_once '../app/controllers/ProductController.php';
require_once '../app/controllers/UserController.php';

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

    $controllerName = ucfirst($controller) . 'Controller';
    $controllerFile = "../app/controllers/$controllerName.php";

    if (file_exists($controllerFile)) {
        require_once $controllerFile;
        $controller = new $controllerName();
        if (method_exists($controller, $action)) {
            call_user_func_array([$controller, $action], []);
        } else {
            echo "Method '$action' not found in $controllerName!";
        }
    } else {
        echo "Controller '$controllerName' not found!";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}