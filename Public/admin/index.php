<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

require_once 'database.php';
require_once 'models/ProductModel.php';
require_once 'models/UserModel.php';
require_once 'models/OrderModel.php';
require_once 'models/ReportModel.php';

$db = new Database();
$conn = $db->getConnection();

$productModel = new ProductModel($conn);
$userModel = new UserModel($conn);
$orderModel = new OrderModel($conn);
$reportModel = new ReportModel($conn);

$action = isset($_GET['action']) ? $_GET['action'] : 'dashboard';
$section = isset($_GET['section']) ? $_GET['section'] : 'products';
$error_message = null;

// Quản lý sản phẩm
if ($section == 'products') {
    if ($action == 'add_product' && $_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'];
        $price = $_POST['price'];
        $stock = $_POST['stock'];
        $description = $_POST['description'] ?? '';
        $category = $_POST['category'] ?? '';
        $created_at = $_POST['created_at'] ?? date('Y-m-d H:i:s');
        $image = isset($_FILES['image']) ? $_FILES['image'] : null;

        try {
            $productModel->addProduct($name, $price, $stock, $description, $category, $created_at, $image);
            header("Location: index.php?section=products");
            exit();
        } catch (Exception $e) {
            $error_message = $e->getMessage();
        }
    }

    if ($action == 'delete_product') {
        $id = $_GET['id'];
        try {
            $productModel->deleteProduct($id);
            header("Location: index.php?section=products");
            exit();
        } catch (Exception $e) {
            $error_message = $e->getMessage();
        }
    }

    if ($action == 'edit_product' && $_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $stock = $_POST['stock'];
        $image = isset($_FILES['image']) ? $_FILES['image'] : null;

        try {
            $productModel->updateProduct($id, $name, $price, $stock, $image);
            header("Location: index.php?section=products");
            exit();
        } catch (Exception $e) {
            $error_message = $e->getMessage();
        }
    }

    $products = $productModel->getAllProducts();
}

// Quản lý người dùng
if ($section == 'users') {
    if ($action == 'delete_user') {
        $id = $_GET['id'];
        $userModel->deleteUser($id);
        header("Location: index.php?section=users");
        exit();
    }

    $users = $userModel->getAllUsers();
}

// Quản lý đơn hàng
if ($section == 'orders') {
    if ($action == 'delete_order') {
        $id = $_GET['id'];
        $orderModel->deleteOrder($id);
        header("Location: index.php?section=orders");
        exit();
    }

    if ($action == 'update_status' && $_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = $_POST['id'];
        $status = $_POST['status'];
        $orderModel->updateOrderStatus($id, $status);
        header("Location: index.php?section=orders");
        exit();
    }

    $orders = $orderModel->getAllOrders();
}

// Báo cáo doanh thu
if ($section == 'reports') {
    $month = isset($_GET['month']) ? $_GET['month'] : date('Y-m');
    $total_revenue = $reportModel->getTotalRevenue($month);
    $report_orders = $reportModel->getOrdersByMonth($month);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Quản trị Admin</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <h2>Admin Panel</h2>
            <a href="index.php?section=products">Quản lý sản phẩm</a>
            <a href="index.php?section=users">Quản lý người dùng</a>
            <a href="index.php?section=orders">Quản lý đơn hàng</a>
            <a href="index.php?section=reports">Báo cáo doanh thu</a>
            <a href="index.php?logout=true">Đăng xuất</a>
            <?php
            if (isset($_GET['logout'])) {
                session_destroy();
                header("Location: login.php");
                exit();
            }
            ?>
        </div>
        <div class="content">
            <?php if ($error_message) { ?>
                <p class="error"><?php echo $error_message; ?></p>
            <?php } ?>
            <?php
            if ($section == 'products') {
                include 'views/products.php';
            } elseif ($section == 'users') {
                include 'views/users.php';
            } elseif ($section == 'orders') {
                include 'views/orders.php';
            } elseif ($section == 'reports') {
                include 'views/reports.php';
            }
            ?>
        </div>
    </div>
</body>
</html>