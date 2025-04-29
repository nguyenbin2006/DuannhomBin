<h2>Quản lý người dùng</h2>
<table>
    <tr>
        <th>ID</th>
        <th>Tên người dùng</th>
        <th>Email</th>
        <th>Tên đầy đủ</th>
        <th>Hành động</th>
    </tr>
    <?php foreach ($users as $user) { ?>
        <tr>
            <td><?= $user->id ?></td>
            <td><?= $user->username ?></td> <!-- Sửa: Hiển thị username ở cột Tên người dùng -->
            <td><?= $user->email ?></td>    <!-- Sửa: Hiển thị email ở cột Email -->
            <td><?= $user->full_name ?: 'Chưa cập nhật' ?></td>
            <td>
                <a href="index.php?section=users&action=delete_user&id=<?= $user->id ?>" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</a>
            </td>
        </tr>
    <?php } ?>
</table>