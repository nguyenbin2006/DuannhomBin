<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShopTKB</title>
    <link rel="icon" href="/DuannhomBin/Public/assets/img/logo.jpg" type="image/x-icon" />
    <link rel="stylesheet" href="/DuannhomBin/Public/assets/css/cart.css?v=<?php echo time();?>">
    <link rel="stylesheet" href="/DuannhomBin/Public/assets/css/style.css?v=<?php echo time();?>">
    <link rel="stylesheet" href="/DuannhomBin/Public/assets/css/web.css?v=<?php echo time();?>">
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
        <div class="search-bar">
            <form action="/DuannhomBin/Public/index.php?controller=product&action=search" method="GET">
                <input type="text" name="query" placeholder="Tìm sản phẩm">
                <button type="submit"><i class="ti-search"></i></button>
            </form>
        </div>
        <div class="btn-login-group d-flex gap-2">
            <a href="/DuannhomBin/Public/index.php?controller=user&action=register" class="btn-dangky">Đăng ký</a>
            <a href="/DuannhomBin/Public/index.php?controller=user&action=login" class="btn-dangnhap">Đăng nhập</a>
        </div>
    </div>
    <div class="menu-chinh">
        <ul class="d-flex flex-wrap justify-content-center gap-3">
            <li><a href="/DuannhomBin/Public/index.php?controller=home&action=index">TRANG CHỦ</a></li>
            <li><a href="/DuannhomBin/Public/index.php?controller=product&action=index">SẢN PHẨM</a></li>
            <li><a href="/DuannhomBin/Public/index.php?controller=cart&action=index"> <i class="ti-shopping-cart"></i>GIỎ HÀNG</a></li>
        </ul>
    </div> 
</header>