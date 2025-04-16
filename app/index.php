<?php
$controller = $_GET['controller'] ?? 'product';
$action = $_GET['action'] ?? 'index';

$controllerFile = "./controllers/" . ucfirst($controller) . "Controller.php";

if (file_exists($controllerFile)) {
    require_once $controllerFile;
    $controllerClass = ucfirst($controller) . "Controller";
    $controllerObject = new $controllerClass();

    if (method_exists($controllerObject, $action)) {
        $controllerObject->$action();
    } else {
        echo "Không tìm thấy action: $action";
    }
} else {
    echo "Không tìm thấy controller: $controller";
}