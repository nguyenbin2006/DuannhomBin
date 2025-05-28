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
<!-- Sản phẩm nổi bật -->
<section class="featured-products py-5 bg-light">
  <div class="container">
    <h2 class="text-center mb-5 text-primary fw-bold">🔥 SẢN PHẨM NỔI BẬT 🔥</h2>
    <div class="row justify-content-center">

      <!-- Sản phẩm 1 -->
      <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4 d-flex">
        <div class="card text-center shadow-sm w-100">
          <img src="/DuannhomBin/Public/assets/img/nanoflare1000z.png" class="card-img-top" >
          <div class="card-body">
            <h5 class="card-title2">Vợt Yonex Nanoflare 1000z</h5>
            <p class="card-text text-danger fw-bold">5.050.000đ</p>
            <a href="/DuannhomBin/Public/index.php?controller=product&action=show&id=<?= $product->id ?? 0 ?>" 
            class="btn btn-outline-primary btn-sm">Xem chi tiết</a>
          </div>
        </div>
      </div>
      
      <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4 d-flex">
        <div class="card text-center shadow-sm w-100">
          <img src="/DuannhomBin/Public/assets/img/1746672194_vot-cau-long-victor-thruster-ryuga-ii-pro-cps-ma-taiwan.jpg" class="card-img-top" >
          <div class="card-body">
            <h5 class="card-title2">Vợt Victor Thruster Ryuga</h5>
            <p class="card-text text-danger fw-bold">4.150.000đ</p>
            <a href="/DuannhomBin/Public/index.php?controller=product&action=show&id=<?= $product->id ?? 0 ?>" 
            class="btn btn-outline-primary btn-sm">Xem chi tiết</a>
          </div>
        </div>
      </div>

      <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4 d-flex">
        <div class="card text-center shadow-sm w-100">
          <img src="/DuannhomBin/Public/assets/img/1746672345_vot-cau-long-victor-thruster-ryuga-metallic-cps-ma-taiwan.jpg" class="card-img-top" >
          <div class="card-body">
            <h5 class="card-title2">Vợt Cầu Lông Victor Thruster Ryuga Metallic CPS</h5>
            <p class="card-text text-danger fw-bold">4.050.000đ</p>
            <a href="/DuannhomBin/Public/index.php?controller=product&action=show&id=<?= $product->id ?? 0 ?>" 
            class="btn btn-outline-primary btn-sm">Xem chi tiết</a>
          </div>
        </div>
      </div>

      <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4 d-flex">
        <div class="card text-center shadow-sm w-100">
          <img src="/DuannhomBin/Public/assets/img/vot-cau-long-lining-woods-n90-noi-dia-trung_1741051062.jpg" class="card-img-top" >
          <div class="card-body">
            <h5 class="card-title2">Vợt cầu lông Lining Woods N90</h5>
            <p class="card-text text-danger fw-bold">5.049.000đ</p>
            <a href="/DuannhomBin/Public/index.php?controller=product&action=show&id=<?= $product->id ?? 0 ?>" 
            class="btn btn-outline-primary btn-sm">Xem chi tiết</a>
          </div>
        </div>
      </div>

     
    </div>
  </div>
</section>


<!-- Khuyến mãi đang diễn ra -->
<section class="promotion-section py-5 bg-warning-subtle">
  <div class="container">
    <h2 class="text-center text-danger mb-5 fw-bold">🎁 KHUYẾN MÃI ĐANG DIỄN RA 🎁</h2>
    <div class="row justify-content-center">

      <!-- Khuyến mãi 1 -->
      <div class="col-12 col-sm-6 col-md-4 mb-4 d-flex">
        <div class="card border-danger shadow-sm w-100">
          <div class="card-body text-center">
            <h5 class="card-title text-danger fw-semibold">🔥 Giảm 20% toàn bộ vợt Yonex</h5>
            <p class="card-text small">Từ 1/6 đến 10/6 - Áp dụng khi mua online</p>
            <a href="#" class="btn btn-outline-danger btn-sm">Xem ngay</a>
          </div>
        </div>
      </div>

      <!-- Khuyến mãi 2 -->
      <div class="col-12 col-sm-6 col-md-4 mb-4 d-flex">
        <div class="card border-success shadow-sm w-100">
          <div class="card-body text-center">
            <h5 class="card-title text-success fw-semibold">🎉 Mua 2 vợt, tặng 1 cuốn cán</h5>
            <p class="card-text small">Tự động áp dụng tại giỏ hàng – Không cần mã</p>
            <a href="#" class="btn btn-outline-success btn-sm">Mua ngay</a>
          </div>
        </div>
      </div>

      <!-- Khuyến mãi 3 -->
      <div class="col-12 col-sm-6 col-md-4 mb-4 d-flex">
        <div class="card border-primary shadow-sm w-100">
          <div class="card-body text-center">
            <h5 class="card-title text-primary fw-semibold">🚚 Miễn phí vận chuyển từ 500.000đ</h5>
            <p class="card-text small">Áp dụng toàn quốc cho mọi sản phẩm</p>
            <a href="#" class="btn btn-outline-primary btn-sm">Xem chi tiết</a>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<section class="testimonials py-5">
  <div class="container">
    <h2 class="text-center mb-5">💬 Khách hàng nói gì?</h2>
    <div class="row justify-content-center">
      <div class="col-md-4">
        <blockquote class="blockquote">
          <p>"Shop giao hàng rất nhanh, vợt đánh cực tốt!"</p>
          <footer class="blockquote-footer">Nguyễn Văn A</footer>
        </blockquote>
      </div>
      <div class="col-md-4">
        <blockquote class="blockquote">
          <p>"Tư vấn nhiệt tình, giá cả hợp lý, sẽ quay lại mua tiếp."</p>
          <footer class="blockquote-footer">Trần Thị B</footer>
        </blockquote>
      </div>
    </div>
  </div>
</section>


<section class="blog-section py-5 bg-light">
  <div class="container">
    <h2 class="text-center mb-5 fw-bold text-dark">📰 Tin tức & Mẹo chơi cầu lông</h2>
    <div class="row">
      
      <!-- Bài viết 1 -->
      <div class="col-md-6 col-lg-4 mb-4">
        <article class="blog-article h-100 shadow-sm bg-white rounded overflow-hidden">
          <img src="/DuannhomBin/Public/assets/img/chonvotchonguoimoi.jpg" alt="blog" class="img-fluid w-100 blog-img">
          <div class="p-4">
            <h5 class="fw-bold text-primary mb-2">📌 Cách chọn vợt cầu lông cho người mới</h5>
            <p class="text-muted small">Viết bởi <strong>Admin</strong> • 25/05/2025</p>
            <p class="text-dark small">
              Nếu bạn là người mới bắt đầu chơi cầu lông và phân vân không biết nên chọn loại vợt nào phù hợp, bài viết này sẽ giúp bạn hiểu rõ...
            </p>
            <a href="/DuannhomBin/app/views/home/blog-detail.php?id=1" class="btn btn-outline-primary btn-sm mt-2">Đọc tiếp</a>
          </div>
        </article>
      </div>

      <div class="col-md-6 col-lg-4 mb-4">
        <article class="blog-article h-100 shadow-sm bg-white rounded overflow-hidden">
          <img src="/DuannhomBin/Public/assets/img/olympicparis.jpg" alt="blog" class="img-fluid w-100 blog-img">
          <div class="p-4">
            <h5 class="fw-bold text-primary mb-2">📌 Sự kiện giải đấu</h5>
            <p class="text-muted small">Viết bởi <strong>Admin</strong> • 25/05/2025</p>
            <p class="text-dark small">
              Cập nhật thông tin giải đấu cầu lông liên tục
            </p>
            <a href="/DuannhomBin/app/views/home/blog-detail.php?id=3" class="btn btn-outline-primary btn-sm mt-2">Đọc tiếp</a>
          </div>
        </article>
      </div>

      <div class="col-md-6 col-lg-4 mb-4">
        <article class="blog-article h-100 shadow-sm bg-white rounded overflow-hidden">
          <img src="/DuannhomBin/Public/assets/img/san-cau-long-phu-tho-1.jpg" alt="blog" class="img-fluid w-100 blog-img">
          <div class="p-4">
            <h5 class="fw-bold text-primary mb-2">📌 Các sân cầu lông mới tại TP.Hồ Chí Minh</h5>
            <p class="text-muted small">Viết bởi <strong>Admin</strong> • 25/05/2025</p>
            <p class="text-dark small">
              Sân cầu lông mới phù hợp cho nhu cầu tập luyện cho người mới và cũng như người có trình độ cao
            </p>
            <a href="/DuannhomBin/app/views/home/blog-detail.php?id=4" class="btn btn-outline-primary btn-sm mt-2">Đọc tiếp</a>
          </div>
        </article>
      </div>


      <!-- Thêm các bài viết khác ở đây -->

    </div>
  </div>
</section>
</div>

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