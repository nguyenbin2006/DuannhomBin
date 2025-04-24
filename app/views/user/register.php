<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="container mt-5">
    <h3>Đăng ký</h3>
    <?php if (!empty($error)): ?>
        <p style="color:red;"><?php echo $error; ?></p>
    <?php endif; ?>
    <?php if (!empty($success)): ?>
        <p style="color:green;"><?php echo $success; ?></p>
    <?php endif; ?>
    <form action="/DuannhomBin/Public/index.php?controller=user&action=register" method="POST">
        <label for="username">User Name</label>
        <input type="text" name="username" placeholder="User Name" id="username" required>

        <label for="email">Email</label>
        <input type="email" name="email" placeholder="Email" id="email" required>

        <label for="password">Password</label>
        <input type="password" name="password" placeholder="Password" id="password" required>

        <label for="confirm_password">Confirm Password</label>
        <input type="password" name="confirm_password" placeholder="Confirm Password" id="confirm_password" required>

        <button type="submit">Register</button>
        <p class="social-text">Register with a social media account</p>
        
        <div class="social-icons">
            <button class="social-icon fb"><i class="fa-brands ti-facebook"></i></button>
            <button class="social-icon tw"><i class="fa-brands ti-twitter"></i></button>
            <button class="social-icon in"><i class="fa-brands ti-instagram"></i></button>
        </div>
    </form>
    <p class="mt-3">Already have an account? <a href="/DuannhomBin/Public/index.php?controller=user&action=login">Log in here</a></p>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>