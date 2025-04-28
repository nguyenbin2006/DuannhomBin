<h2>Quản lý người dùng</h2>
<table>
    <tr>
        <th>ID</th>
        <th>Email</th>
        <th>Tên người dùng</th>
        <th>Hành động</th>
    </tr>
    <?php foreach ($users as $user) { ?>
        <tr>
            <td><?= $user->id ?></td>
            <td><?= $user->username ?></td>
            <td><?= $user->email ?></td>
            <td>
                <a href="index.php?section=users&action=delete_user&id=<?= $user->id ?>" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</a>
            </td>
        </tr>
    <?php } ?>
</table>