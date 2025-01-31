<?php

include('../middleware/userMiddleware.php');
include('includes/header.php');

?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header events-header">
                    <h4>Users</h4>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Update Role</th>
                                    <th>Delete User</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $users = getAll('users');

                                if (count($users) > 0) {
                                    foreach ($users as $user) {
                                ?>
                                        <tr>
                                            <td> <?= $user['id'] ?></td>
                                            <td> <?= $user['name'] ?></td>
                                            <td> <?= $user['email'] ?></td>
                                            <td>
                                                <?php
                                                if ($user['role_as'] == 1) {
                                                    echo 'Admin';
                                                } else {
                                                    echo 'User';
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <form action="backend/button_handle_code.php" method="POST" onsubmit="return confirm('Are you sure you want to update this user role?');">
                                                    <input type="hidden" name="id" value="<?= $user['id'] ?>">

                                                    <select name="role_as" class="form-select">
                                                        <option value="0" <?= $user['role_as'] == 0 ? 'selected' : '' ?>>User</option>
                                                        <option value="1" <?= $user['role_as'] == 1 ? 'selected' : '' ?>>Admin</option>
                                                    </select>

                                                    <div style="margin-top: 10px;"></div>

                                                    <button type="submit" class="btn btn-primary btn-sm" name="update_role_btn">Update Role</button>
                                                </form>
                                            </td>
                                            <td>
                                                <form action="backend/button_handle_code.php" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                                    <input type="hidden" name="id" value="<?= $user['id'] ?>">
                                                    <button type="submit" class="btn btn-danger btn-sm" name="delete_user_btn">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                } else {
                                    echo "<tr><td colspan='8'>No users found</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('includes/footer.php'); ?>