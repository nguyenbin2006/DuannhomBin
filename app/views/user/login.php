<?php include __DIR__ . '/../layouts/header.php'; ?>
<div class="container mt-5">
    <h3>Đăng nhập</h3>
    <?php if (!empty($error)): ?>
        <p style="color:red;"><?php echo $error; ?></p>
    <?php endif; ?>
    <form action="/shopvotcaulong/Public/index.php?controller=user&action=login" method="POST">
        <label for="username">User Name</label>
        <input type="text" name="username" placeholder="User Name" id="username" required>

        <label for="password">Password</label>
        <input type="password" name="password" placeholder="Password" id="password" required>

        <button href="/shopvotcaulong/Public/index.php?controller=home&action=index" type="submit">Log In</button>
        <p class="social-text">Login with a social media account</p>
        <div class="social-icons">
            <button class="social-icon fb"><i class="fa-brands ti-facebook"></i></button>
            <button class="social-icon tw"><i class="fa-brands ti-twitter"></i></button>
            <button class="social-icon in"><i class="fa-brands ti-instagram"></i></button>
        </div>
    </form>
    <p class="mt-3">Don't have an account? <a href="/shopvotcaulong/Public/index.php?controller=user&action=register">Register here</a></p>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>