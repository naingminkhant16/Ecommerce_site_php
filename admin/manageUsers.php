<?php include 'header.php' ?>
<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Manage Users</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <a href="createUser.php" class="btn btn-success">Create User</a><br><br>
                        <div class="overflow-auto">
                            <table id="d-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>E-mail</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        <th>Role</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (empty($_POST['search'])) {
                                        $result = $db->crud("SELECT * FROM users", null, null, true);
                                    } else {
                                        $searchKey = $_POST['search'];
                                        $statement = $pdo->prepare("SELECT * FROM users WHERE name LIKE '%$searchKey%'");
                                        $statement->execute();
                                        $result = $statement->fetchAll(PDO::FETCH_OBJ);
                                    }

                                    if ($result) :
                                        $i = 1;
                                        foreach ($result as $user) : ?>
                                            <tr>
                                                <th scope="row"><?= $i ?></th>
                                                <td><?= escape($user->name) ?></td>
                                                <td><?= escape($user->email) ?></td>
                                                <td><?= escape($user->phone) ?></td>
                                                <td><?= escape($user->address) ?></td>
                                                <td><?php if ($user->role > 0) {
                                                        echo 'Admin';
                                                    } else {
                                                        echo "User";
                                                    }
                                                    ?></td>
                                                <td class="d-flex justify-content-start align-items-center"><?php if ($_SESSION['user_id'] == $user->id) {
                                                                                                                echo "###";
                                                                                                            } else { ?>
                                                        <a href="changeRole.php?id=<?= $user->id ?>& role=<?= $user->role ?>" onclick="return confirm('Are you sure you want to change user\'s role?')" class="btn btn-sm btn-primary">Role</a>&nbsp;
                                                        <a href="editUser.php?id=<?= $user->id ?>" class="btn btn-sm btn-warning">Edit</a>&nbsp;
                                                        <a href="deleteUser.php?id=<?= $user->id ?>" onclick="return confirm('Are you sure you want to delete?')" class="btn btn-sm btn-danger">Delete</a>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                    <?php $i++;
                                        endforeach;
                                    endif; ?>
                                </tbody>
                            </table><br>
                        </div>

                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include 'footer.html' ?>