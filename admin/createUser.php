<?php include 'header.php'; ?>
<?php

if (!empty($_POST)) {
    (!isEmptyInput($_POST)) ? $noErr = true : $err = isEmptyInput($_POST);

    if (!empty($err)) {
        $findErrArr = ['name', "email", "password", "phone", "address"];
        $err = explode(',', $err);

        $uiErr = [];
        foreach ($findErrArr as $findErr) {
            if (in_array($findErr, $err)) {
                $uiErr[$findErr] = $findErr . " is required!";
            }
        }
    } elseif (strlen(trim($_POST['password'])) < 6) {
        $pswLenErr = "Password must have atleast 6 characters.";
    } else {
        if (isset($_POST['admin'])) {
            $role = 1;
        } else {
            $role = 0;
        }
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $phone = $_POST['phone'];
        $address = $_POST['address'];

        $user = $db->checkEmailExist($email, "users");
        if ($user) {
            echo "<script>alert('Email already exist! Try again.');window.location.href='createUser.php'</script>";
        } else {
            $result = $db->crud("INSERT INTO users(name,email,password,phone,address,role) VALUES (:name,:email,:password,:phone,:address,:role)", [
                ':name' => $name,
                ':email' => $email,
                ':password' => $password,
                ':phone' => $phone,
                ':address' => $address,
                ':role' => $role
            ]);
            if ($result) {
                echo "<script>alert('Successfully added User');window.location.href='manageUsers.php'</script>";
            }
        }
    }
}

?>



<!-- Main content -->
<div class="content">
    <div class="container " style="max-width: 600px;">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Create New User</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="" class="" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" class="form-control" value="<?= $_SESSION['_token'] ?>">
                            <div class="form-group">
                                <label type="text" class="form-label">Name</label>
                                <p style="color:red"><?= isset($uiErr['name']) ? '*' . $uiErr['name'] : '' ?></p>
                                <input type="text" class="form-control" name='name'>
                            </div>
                            <div class="form-group">
                                <label type="text" class="form-label">E-mail</label>
                                <p style="color:red"><?= isset($uiErr['email']) ? '*' . $uiErr['email'] : '' ?></p>
                                <input type="email" class="form-control" name='email'>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Password</label>
                                <p style="color:red"><?= isset($uiErr['password']) ? '*' . $uiErr['password'] : '' ?></p>
                                <p style="color:red"><?= isset($pswLenErr) ? '*' . $pswLenErr : '' ?></p>
                                <input type="password" name="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Phone</label>
                                <p style="color:red"><?= isset($uiErr['phone']) ? '*' . $uiErr['phone'] : '' ?></p>
                                <input type="text" name="phone" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Address</label>
                                <p style="color:red"><?= isset($uiErr['address']) ? '*' . $uiErr['address'] : '' ?></p>
                                <textarea name="address" rows="5" class="form-control"></textarea>
                            </div>
                            <div class="form-check form-group">
                                <input type="checkbox" class="form-check-input" name="admin" value="1">
                                <label class="form-check-label">Admin</label>
                            </div>
                            <br><br>
                            <div class="form-group">
                                <a href="manageUsers.php" type="button" class="btn btn-default">Back</a>
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