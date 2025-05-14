<?php 
$base = isset($config['base']) ? $config['base'] : 'http://localhost/DuannhomBin/';
$baseURL = isset($config['baseURL']) ? $config['baseURL'] : 'http://localhost/DuannhomBin/';
$assets = isset($config['assets']) ? $config['assets'] : 'http://localhost/DuannhomBin/Public/assets/';
include __DIR__ . '/../layouts/headerlogin.php';
?>

<div class="slideshow-container">
        <!-- Thay thế các URL hình ảnh dưới đây bằng URL thật của bạn -->
        <div class="slide" style="background-image: url('/DuannhomBin/Public/assets/img/img3.png');"></div>
        <div class="slide" style="background-image: url('/DuannhomBin/Public/assets/img/img1.png');"></div>
        <div class="slide" style="background-image: url('/DuannhomBin/Public/assets/img/img4.png');"></div>

        <div class="nav-arrow prev" onclick="changeSlide(-1)">&#10094;</div>
        <div class="nav-arrow next" onclick="changeSlide(1)">&#10095;</div>
    </div>

<div class="content">
    <ul>
        <li><a href="<?= $baseURL ?>Public/index.php?controller=product&action=index">Sản phẩm</a></li>
    </ul>
</div>
<div class="product-container">
    <?php if (isset($products) && !empty($products)): ?>
        <?php foreach ($products as $product): ?>
            <div class="card">
                <img src="<?= $assets ?>img/<?= htmlspecialchars($product->image ?? '') ?>" class="card-img-top" alt="Sản phẩm">
                <div class="card-body">
                    <h5 class="card-title"><?= htmlspecialchars($product->name ?? '') ?></h5>
                    <p class="card-text">Giá: <?= number_format($product->price ?? 0, 0, ',', '.') ?>đ</p>
                    <a href="<?= $baseURL ?>Public/index.php?controller=product&action=show&id=<?= $product->id ?? 0 ?>" class="btn-view">View</a>
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <form action="<?= $baseURL ?>Public/index.php?controller=cart&action=add" method="POST" style="display: inline;">
                            <input type="hidden" name="product_id" value="<?= $product->id ?? 0 ?>">
                            <button type="submit" class="btn-primary">Thêm vào giỏ hàng</button>
                        </form>
                    <?php else: ?>
                        <a href="<?= $baseURL ?>Public/index.php?controller=user&action=login" class="btn-primary">Đăng nhập để thêm</a>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Không có sản phẩm nào để hiển thị.</p>
    <?php endif; ?>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>

<script>
        let currentSlide = 0;
        const slides = document.querySelectorAll('.slide');
        const totalSlides = slides.length;

        function showSlide(index) {
            slides.forEach((slide, i) => {
                slide.classList.remove('active');
                if (i === index) {
                    slide.classList.add('active');
                }
            });
        }

        function changeSlide(direction) {
            currentSlide = (currentSlide + direction + totalSlides) % totalSlides;
            showSlide(currentSlide);
            resetTimer();
        }

        let slideInterval = setInterval(() => {
            changeSlide(1);
        }, 5000);

        function resetTimer() {
            clearInterval(slideInterval);
            slideInterval = setInterval(() => {
                changeSlide(1);
            }, 5000);
        }

        showSlide(currentSlide);
    </script>