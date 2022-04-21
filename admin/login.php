<?php
session_start();
require '../config/config.php';
require '../config/common.php';
require "../config/functions.php";
if ($_POST) {
    $db = new DB();
    $email = $_POST['email'];
    $password = $_POST['password'];
    $user = $db->crud("SELECT * FROM users WHERE email=:email", [':email' => $email], true);

    if ($user) {
        if (password_verify($password, $user->password) && $user->role == 1) {
            $_SESSION['admin']['id'] = $user->id;
            $_SESSION['admin']['name'] = $user->name;
            // $_SESSION['admin']['logged_in'] = time();
            $_SESSION['admin']['role'] = $user->role;
            header("location: index.php");
            die();
        } else {
            header('location: login.php?error=password');
        }
    } else {
        header('location: login.php?error=email');
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Team12 Shop | Admin Login</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="#"><b>Team12 |</b>Admin Panel</a>
        </div>
        <?php if (isset($_GET['error'])) : ?>
            <div class="alert alert-warning text-center">
                <?php if ($_GET['error'] == 'email') {
                    echo "Email does not exist!!";
                } ?>
                <?php if ($_GET['error'] == 'password') {
                    echo "Incorrect Password! Or Maybe you don't have access to login admin panel";
                } ?>
                <?php if ($_GET['error'] == 'login') {
                    echo "Login Please!";
                } ?>
            </div>
        <?php endif; ?>
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in to manage your shop</p>

                <form action="login.php" method="POST">
                    <input type="hidden" name="_token" class="form-control" value="<?= $_SESSION['_token'] ?>">
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" name="email" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="password" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- /.col -->
                        <div class="col">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>

</body>

</html>