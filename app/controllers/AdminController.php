<?php
class AdminController extends Controller {
    private $productModel;

    public function __construct() {
        parent::__construct();
        $this->productModel = $this->model('Product');
    }

    public function index() {
        $products = $this->productModel->getAll();
        $this->view('admin/index', ['products' => $products]);
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $price = $_POST['price'];
            $stock = $_POST['stock'];
            $image = $_POST['image'];
            $description = $_POST['description'];
            $category = $_POST['category'];

            $this->productModel->createProduct($name, $price, $stock, $image, $description, $category);
            header('Location: /shopvotcaulong/Public/index.php?controller=admin&action=index');
            exit();
        } else {
            $this->view('admin/create');
        }
    }

    public function edit() {
        $id = $_GET['id'] ?? 0;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $price = $_POST['price'];
            $stock = $_POST['stock'];
            $image = $_POST['image'];
            $description = $_POST['description'];
            $category = $_POST['category'];

            $this->productModel->updateProduct($id, $name, $price, $stock, $image, $description, $category);
            header('Location: /shopvotcaulong/Public/index.php?controller=admin&action=index');
            exit();
        } else {
            $product = $this->productModel->getProductById($id);
            $this->view('admin/edit', ['product' => $product]);
        }
    }

    public function delete($id) {
        // Kiểm tra $id có hợp lệ không
        if (!isset($id) || !is_numeric($id)) {
            die("ID sản phẩm không hợp lệ!");
        }

        try {
            // Viết câu lệnh SQL để xóa sản phẩm
            $query = "DELETE FROM products WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);   
            $result = $stmt->execute();

            if ($result) {
                // Xóa thành công, chuyển hướng về trang quản lý
                header("Location: /shopvotcaulong/Public/index.php?controller=admin&message=delete_success");
            } else {    
                // Xóa thất bại
                header("Location: /shopvotcaulong/Public/index.php?controller=admin&message=delete_failed");
            }
        } catch (Exception $e) {
            // Xử lý lỗi nếu có
            die("Lỗi khi xóa sản phẩm: " . $e->getMessage());
        }
    }
}
