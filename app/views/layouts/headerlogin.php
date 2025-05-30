<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShopTKB</title>
    <link rel="icon" href="/DuannhomBin/Public/assets/img/logo.jpg" type="image/x-icon" />
    <link rel="stylesheet" href="/DuannhomBin/Public/assets/css/style.css?v=<?php echo time();?>">
    <link rel="stylesheet" href="/DuannhomBin/Public/assets/css/web.css?v=<?php echo time();?>">
    <link rel="stylesheet" href="/DuannhomBin/Public/assets/css/cart.css?v=<?php echo time();?>">
    <link rel="stylesheet" href="/DuannhomBin/Public/assets/css/view.css?v=<?php echo time();?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/DuannhomBin/Public/assets/font/themify-icons/themify-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
</head>
<body>
<header>
    <div class="header-top d-flex flex-wrap justify-content-between align-items-center">
        <div class="logo">
            <img  src="/DuannhomBin/Public/assets/img/logo.jpg" alt="Logo">
        </div>
        <div class="header-info d-flex flex-wrap justify-content-center gap-3">
            <span><i class="ti-headphone"></i> HOTLINE: 0123456789 | 0123456789</span>
            <span><i class="ti-location-pin"></i> HỆ THỐNG CỬA HÀNG</span>
                
        </div>
        <div class="search-bar d-flex align-items-center">
    <input type="text" id="searchInput" placeholder="Tìm sản phẩm" oninput="filterProducts(this.value)" style="flex-grow: 1;">
    <button onclick="filterProducts(document.getElementById('searchInput').value)" class="btn btn-secondary ms-2"><i class="ti-search"></i></button>
    <div id="searchResults" class="search-results"></div>
</div>
        <div class="btn-login-group d-flex gap-2">
            <a href="/DuannhomBin/Public/index.php?controller=cart&action=index" class="btn-dangky"> <i class="ti-user"></i>TÀI KHOẢN</a>
            <a href="/DuannhomBin/Public/index.php?controller=user&action=logout" class="btn-dangky">Đăng xuất</a>
        </div>
    </div>
    <div class="menu-chinh">
        <ul class="d-flex flex-wrap justify-content-center gap-3">
            <li><a href="/DuannhomBin/Public/index.php?controller=home&action=indexlogin">TRANG CHỦ</a></li>
            <li><a href="/DuannhomBin/Public/index.php?controller=product&action=indexlogin">SẢN PHẨM</a></li>
            <li><a href="/DuannhomBin/Public/index.php?controller=cart&action=index"> GIỎ HÀNG<i class="ti-shopping-cart"></i></a></li>
        </ul>
    </div>
</header>

<script>
    function filterProducts(keyword) {
        // Chỉ gửi yêu cầu nếu từ khóa có ít nhất 3 ký tự
        if (keyword.length < 3) {
            document.getElementById('searchResults').classList.remove('active');
            return;
        }

        fetch(`/DuannhomBin/Public/index.php?controller=product&action=search&keyword=${encodeURIComponent(keyword)}`)
            .then(response => response.json())
            .then(data => {
                const searchResults = document.getElementById('searchResults');
                searchResults.innerHTML = '';

                if (data.length === 0) {
                    searchResults.classList.remove('active');
                } else {
                    searchResults.classList.add('active');
                    data.forEach(product => {
                        const productItem = document.createElement('div');
                        productItem.classList.add('product-item');
                        productItem.innerHTML = `
                            <img src="/DuannhomBin/Public/assets/img/${product.image}" alt="${product.name}">
                            <div class="product-info">
                                <div class="product-name">${product.name}</div>
                                <div class="product-price">${product.price}</div>
                            </div>
                        `;
                        // Thêm sự kiện onclick để chuyển hướng đến trang chi tiết sản phẩm
                        productItem.onclick = function() {
                            window.location.href = `/DuannhomBin/Public/index.php?controller=product&action=show&id=${product.id}`;
                        };
                        searchResults.appendChild(productItem);
                    });
                }
            })
            .catch(error => console.error('Lỗi:', error));
    }

    // Ẩn kết quả khi click ra ngoài
    document.addEventListener('click', function(event) {
        const searchBar = document.querySelector('.search-bar');
        if (!searchBar.contains(event.target)) {
            document.getElementById('searchResults').classList.remove('active');
        }
    });
</script>