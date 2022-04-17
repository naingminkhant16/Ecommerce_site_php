<?php include 'header.php'; ?>
<?php

if (isset($_GET)) {
    $result = $db->crud("SELECT * FROM users WHERE id=:id", [':id' => $_GET['id']], true);
}

if (!empty($_POST)) {
    if (trim($_POST['password'])) {
        if (strlen(trim($_POST['password'])) < 6) {
            echo "<script>alert('Password should have atleast 6 characters!!');window.location.href='editUser.php?id=" . $_GET['id'] . "'</script>";
            exit();
        } else {
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        }
    } else {
        $id = $_POST['id'];
        $password = $db->crud("SELECT * FROM users WHERE id=:id", [":id" => $id], true);
        $password = $_POST['password'] = $password->password;
    }

    (!isEmptyInput($_POST)) ? $noErr = true : $err = isEmptyInput($_POST);

    if (!empty($err)) {
        $findErrArr = ['name', "email", "phone", "address"];
        $err = explode(',', $err);

        $uiErr = [];
        foreach ($findErrArr as $findErr) {
            if (in_array($findErr, $err)) {
                $uiErr[$findErr] = $findErr . " is required!";
            }
        }
    } else {
        if (isset($_POST['admin'])) {
            $role = 1;
        } else {
            $role = 0;
        }
        $id = $_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];

        $user = $db->crud("SELECT * FROM users WHERE email=:email AND email!=:current_email", [":email" => $email, ":current_email" => $result->email], true);

        if ($user) {
            echo "<script>alert('Email duplicated! Try again.');window.location.href='editUser.php?id=$id'</script>";
        } else {
            $query = "UPDATE users SET name=:name,email=:email,password=:password,phone=:phone,address=:address,role=:role WHERE id=:id";
            $data = [
                ':name' => $name,
                ':email' => $email,
                ':password' => $password,
                ':phone' => $phone,
                ':address' => $address,
                ':role' => $role,
                ':id' => $id
            ];
            $result = $db->crud($query, $data);
            if ($result) {
                echo "<script>alert('Successfully Updated UserData');window.location.href='manageUsers.php'</script>";
            }
        }
    }
}
?>


<!-- Main content -->
<div class="content">
    <div class="container" style="max-width: 600px;">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Edit User</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="" method="POST">
                            <input type="hidden" class="form-control" name='id' value="<?= $result->id ?>">
                            <input type="hidden" name="_token" class="form-control" value="<?= $_SESSION['_token'] ?>">
                            <div class="form-group">
                                <label type="text" class="form-label">Name</label>
                                <p style="color:red"><?= isset($uiErr['name']) ? '*' . $uiErr['name'] : '' ?></p>
                                <input type="text" class="form-control" name='name' value="<?= escape($result->name) ?>" required>
                            </div>
                            <div class="form-group">
                                <label type="text" class="form-label">E-mail</label>
                                <p style="color:red"><?= isset($uiErr['email']) ? '*' . $uiErr['email'] : '' ?></p>
                                <input type="email" class="form-control" name='email' value="<?= escape($result->email) ?>" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Current Password exist.Type here to change new password.">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Phone</label>
                                <p style="color:red"><?= isset($uiErr['phone']) ? '*' . $uiErr['phone'] : '' ?></p>
                                <input type="text" name="phone" class="form-control" value="<?= escape($result->phone) ?>">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Address</label>
                                <p style="color:red"><?= isset($uiErr['address']) ? '*' . $uiErr['address'] : '' ?></p>
                                <input type="text" name="address" class="form-control" value="<?= escape($result->address) ?>">
                            </div>
                            <div class="form-check form-group">
                                <input type="checkbox" class="form-check-input" name="admin" <?= ($result->role == '1') ? 'checked' : '' ?> value="1">
                                <label class="form-check-label">Admin</label>
                            </div>
                            <div class="form-group">
                                <a href="manageUsers.php" class="btn btn-default">Back</a>
                                <input type="submit" value="SUBMIT" class="btn btn-primary">
                            </div>
                        </form>
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