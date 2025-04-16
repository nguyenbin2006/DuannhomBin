<h2>Danh sách người dùng</h2>
<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Tên đăng nhập</th>
        <th>Email</th>
        <th>Hành động</th>
    </tr>
    <?php foreach ($users as $user): ?>
    <tr>
        <td><?= $user['id'] ?></td>
        <td><?= $user['username'] ?></td>
        <td><?= $user['email'] ?></td>
        <td><a href="index.php?controller=admin&action=delete&id=<?= $user['id'] ?>" onclick="return confirm('Xoá người dùng này?')">Xoá</a></td>
    </tr>
    <?php endforeach; ?>
</table>
