<?php
// Kết nối cơ sở dữ liệu
class Database {
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "duannhomBin";
    private $conn;

    public function __construct() {
        try {
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function getConnection() {
        return $this->conn;
    }
}

$db = new Database();
$conn = $db->getConnection();

// Xử lý đăng nhập admin (đơn giản, bạn có thể cải tiến thêm)
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        if ($username === "admin" && $password === "123456") {
            $_SESSION['admin_logged_in'] = true;
            header("Location: admin.php");
            exit();
        } else {
            $login_error = "Tên đăng nhập hoặc mật khẩu không đúng!";
        }
    }
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Đăng nhập Admin</title>
        <style>
            body { font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0; display: flex; justify-content: center; align-items: center; height: 100vh; }
            .login-container { background-color: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); width: 300px; }
            .login-container h2 { text-align: center; margin-bottom: 20px; }
            .login-container input { width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ddd; border-radius: 4px; }
            .login-container button { width: 100%; padding: 10px; background-color: #007bff; color: #fff; border: none; border-radius: 4px; cursor: pointer; }
            .login-container button:hover { background-color: #0056b3; }
            .error { color: red; text-align: center; }
        </style>
    </head>
    <body>
        <div class="login-container">
            <h2>Đăng nhập Admin</h2>
            <form method="POST">
                <input type="text" name="username" placeholder="Tên đăng nhập" required>
                <input type="password" name="password" placeholder="Mật khẩu" required>
                <button type="submit" name="login">Đăng nhập</button>
                <?php if (isset($login_error)) echo "<p class='error'>$login_error</p>"; ?>
            </form>
        </div>
    </body>
    </html>
    <?php
    exit();
}

// Xử lý các tác vụ admin
$action = isset($_GET['action']) ? $_GET['action'] : 'dashboard';
$section = isset($_GET['section']) ? $_GET['section'] : 'products';

// Quản lý sản phẩm
if ($section == 'products') {
    if ($action == 'add_product' && $_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'];
        $price = $_POST['price'];
        $stock = $_POST['stock'];
        $image = $_POST['image'];
        $sql = "INSERT INTO products (name, price, stock, image) VALUES (:name, :price, :stock, :image)";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['name' => $name, 'price' => $price, 'stock' => $stock, 'image' => $image]);
        header("Location: admin.php?section=products");
        exit();
    }

    if ($action == 'delete_product') {
        $id = $_GET['id'];
        $sql = "DELETE FROM products WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        header("Location: admin.php?section=products");
        exit();
    }

    if ($action == 'edit_product' && $_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $stock = $_POST['stock'];
        $image = $_POST['image'];
        $sql = "UPDATE products SET name = :name, price = :price, stock = :stock, image = :image WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['id' => $id, 'name' => $name, 'price' => $price, 'stock' => $stock, 'image' => $image]);
        header("Location: admin.php?section=products");
        exit();
    }

    $products = $conn->query("SELECT * FROM products")->fetchAll(PDO::FETCH_OBJ);
}

// Quản lý người dùng
if ($section == 'users') {
    if ($action == 'delete_user') {
        $id = $_GET['id'];
        $sql = "DELETE FROM users WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        header("Location: admin.php?section=users");
        exit();
    }

    $users = $conn->query("SELECT * FROM users")->fetchAll(PDO::FETCH_OBJ);
}

// Quản lý đơn hàng
if ($section == 'orders') {
    if ($action == 'delete_order') {
        $id = $_GET['id'];
        $sql = "DELETE FROM orders WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        $sql = "DELETE FROM order_items WHERE order_id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        header("Location: admin.php?section=orders");
        exit();
    }

    if ($action == 'update_status' && $_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = $_POST['id'];
        $status = $_POST['status'];
        $sql = "UPDATE orders SET status = :status WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['id' => $id, 'status' => $status]);
        header("Location: admin.php?section=orders");
        exit();
    }

    $orders = $conn->query("SELECT * FROM orders")->fetchAll(PDO::FETCH_OBJ);
}

// Báo cáo doanh thu
if ($section == 'reports') {
    $month = isset($_GET['month']) ? $_GET['month'] : date('Y-m');
    $sql = "SELECT SUM(total_amount) as total_revenue FROM orders WHERE DATE_FORMAT(order_date, '%Y-%m') = :month AND status = 'Đã giao'";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['month' => $month]);
    $total_revenue = $stmt->fetch(PDO::FETCH_OBJ)->total_revenue;

    $sql = "SELECT o.*, u.username FROM orders o JOIN users u ON o.user_id = u.id WHERE DATE_FORMAT(o.order_date, '%Y-%m') = :month AND o.status = 'Đã giao'";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['month' => $month]);
    $report_orders = $stmt->fetchAll(PDO::FETCH_OBJ);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Quản trị Admin</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0; }
        .container { display: flex; min-height: 100vh; }
        .sidebar { width: 250px; background-color: #343a40; color: #fff; padding: 20px; }
        .sidebar h2 { margin-top: 0; }
        .sidebar a { color: #fff; text-decoration: none; display: block; padding: 10px; margin: 5px 0; border-radius: 4px; }
        .sidebar a:hover { background-color: #495057; }
        .content { flex: 1; padding: 20px; }
        .content h2 { margin-top: 0; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid #ddd; }
        th, td { padding: 10px; text-align: left; }
        th { background-color: #007bff; color: #fff; }
        .btn { padding: 5px 10px; border: none; border-radius: 4px; cursor: pointer; text-decoration: none; display: inline-block; }
        .btn-primary { background-color: #007bff; color: #fff; }
        .btn-danger { background-color: #dc3545; color: #fff; }
        .btn-success { background-color: #28a745; color: #fff; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; }
        .form-group input, .form-group select { width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; }
        .form-group button { padding: 10px 20px; background-color: #007bff; color: #fff; border: none; border-radius: 4px; cursor: pointer; }
        .form-group button:hover { background-color: #0056b3; }
    </style>
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <h2>Admin Panel</h2>
            <a href="admin.php?section=products">Quản lý sản phẩm</a>
            <a href="admin.php?section=users">Quản lý người dùng</a>
            <a href="admin.php?section=orders">Quản lý đơn hàng</a>
            <a href="admin.php?section=reports">Báo cáo doanh thu</a>
            <a href="admin.php?logout=true">Đăng xuất</a>
            <?php
            if (isset($_GET['logout'])) {
                session_destroy();
                header("Location: admin.php");
                exit();
            }
            ?>
        </div>
        <div class="content">
            <?php if ($section == 'products') { ?>
                <h2>Quản lý sản phẩm</h2>
                <h3>Thêm sản phẩm mới</h3>
                <form method="POST" action="admin.php?section=products&action=add_product">
                    <div class="form-group">
                        <label>Tên sản phẩm</label>
                        <input type="text" name="name" required>
                    </div>
                    <div class="form-group">
                        <label>Giá</label>
                        <input type="number" name="price" required>
                    </div>
                    <div class="form-group">
                        <label>Tồn kho</label>
                        <input type="number" name="stock" required>
                    </div>
                    <div class="form-group">
                        <label>Ảnh (URL)</label>
                        <input type="text" name="image" required>
                    </div>
                    <div class="form-group">
                        <button type="submit">Thêm sản phẩm</button>
                    </div>
                </form>

                <h3>Danh sách sản phẩm</h3>
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Tên</th>
                        <th>Giá</th>
                        <th>Tồn kho</th>
                        <th>Ảnh</th>
                        <th>Hành động</th>
                    </tr>
                    <?php foreach ($products as $product) { ?>
                        <tr>
                            <td><?= $product->id ?></td>
                            <td><?= $product->name ?></td>
                            <td><?= number_format($product->price, 0, ',', '.') ?>đ</td>
                            <td><?= $product->stock ?></td>
                            <td><img src="<?= $product->image ?>" width="50"></td>
                            <td>
                                <a href="admin.php?section=products&action=edit&id=<?= $product->id ?>" class="btn btn-primary">Sửa</a>
                                <a href="admin.php?section=products&action=delete_product&id=<?= $product->id ?>" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</a>
                            </td>
                        </tr>
                    <?php } ?>
                </table>

                <?php if ($action == 'edit' && isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $sql = "SELECT * FROM products WHERE id = :id";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute(['id' => $id]);
                    $product = $stmt->fetch(PDO::FETCH_OBJ);
                    ?>
                    <h3>Sửa sản phẩm</h3>
                    <form method="POST" action="admin.php?section=products&action=edit_product">
                        <input type="hidden" name="id" value="<?= $product->id ?>">
                        <div class="form-group">
                            <label>Tên sản phẩm</label>
                            <input type="text" name="name" value="<?= $product->name ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Giá</label>
                            <input type="number" name="price" value="<?= $product->price ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Tồn kho</label>
                            <input type="number" name="stock" value="<?= $product->stock ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Ảnh (URL)</label>
                            <input type="text" name="image" value="<?= $product->image ?>" required>
                        </div>
                        <div class="form-group">
                            <button type="submit">Cập nhật</button>
                        </div>
                    </form>
                <?php } ?>
            <?php } elseif ($section == 'users') { ?>
                <h2>Quản lý người dùng</h2>
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Tên người dùng</th>
                        <th>Email</th>
                        <th>Hành động</th>
                    </tr>
                    <?php foreach ($users as $user) { ?>
                        <tr>
                            <td><?= $user->id ?></td>
                            <td><?= $user->username ?></td>
                            <td><?= $user->email ?></td>
                            <td>
                                <a href="admin.php?section=users&action=delete_user&id=<?= $user->id ?>" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</a>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            <?php } elseif ($section == 'orders') { ?>
                <h2>Quản lý đơn hàng</h2>
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Người dùng</th>
                        <th>Tổng tiền</th>
                        <th>Ngày đặt</th>
                        <th>Trạng thái</th>
                        <th>Hành động</th>
                    </tr>
                    <?php foreach ($orders as $order) {
                        $user = $conn->query("SELECT username FROM users WHERE id = {$order->user_id}")->fetch(PDO::FETCH_OBJ);
                        ?>
                        <tr>
                            <td><?= $order->id ?></td>
                            <td><?= $user->username ?></td>
                            <td><?= number_format($order->total_amount, 0, ',', '.') ?>đ</td>
                            <td><?= $order->order_date ?></td>
                            <td>
                                <form method="POST" action="admin.php?section=orders&action=update_status">
                                    <input type="hidden" name="id" value="<?= $order->id ?>">
                                    <select name="status" onchange="this.form.submit()">
                                        <option value="Chưa giao" <?= $order->status == 'Chưa giao' ? 'selected' : '' ?>>Chưa giao</option>
                                        <option value="Đã giao" <?= $order->status == 'Đã giao' ? 'selected' : '' ?>>Đã giao</option>
                                    </select>
                                </form>
                            </td>
                            <td>
                                <a href="admin.php?section=orders&action=delete_order&id=<?= $order->id ?>" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</a>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            <?php } elseif ($section == 'reports') { ?>
                <h2>Báo cáo doanh thu</h2>
                <form method="GET" action="admin.php">
                    <input type="hidden" name="section" value="reports">
                    <div class="form-group">
                        <label>Chọn tháng</label>
                        <input type="month" name="month" value="<?= $month ?>" required>
                        <button type="submit">Xem báo cáo</button>
                    </div>
                </form>
                <h3>Tổng doanh thu: <?= number_format($total_revenue ?: 0, 0, ',', '.') ?>đ</h3>
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Người dùng</th>
                        <th>Tổng tiền</th>
                        <th>Ngày đặt</th>
                    </tr>
                    <?php foreach ($report_orders as $order) { ?>
                        <tr>
                            <td><?= $order->id ?></td>
                            <td><?= $order->username ?></td>
                            <td><?= number_format($order->total_amount, 0, ',', '.') ?>đ</td>
                            <td><?= $order->order_date ?></td>
                        </tr>
                    <?php } ?>
                </table>
            <?php } ?>
        </div>
    </div>
</body>
</html>