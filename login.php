<?php require "header.php" ?>
<!-- Header End -->
<?php
if (!empty($_POST)) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // $user = $db->checkEmailExist($email, "users");
    $user = $db->where('email', $email)->first('users');
    if ($user) {
        if (password_verify($password, $user->password)) {
            $_SESSION['user']['id'] = $user->id;
            $_SESSION['user']['name'] = $user->name;
            $_SESSION['user']['email'] = $user->email;
            $_SESSION['user']['role'] = $user->role;
            // $_SESSION['logged_in'][''] = time();

            echo "<script>window.location.href='index.php'</script>";
            die();
        } else {
            echo "<script>alert('Incorrect Password')</script>";
        }
    } else {
        $emailErr = "Email doesn't exist.";
    }
}
?>

<!--  Form Start -->
<section class="login_box_area my-3">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="login_box_img">
                    <img class="img-fluid" src="images/bg2.jpg" alt="">
                    <div class="hover">
                        <h4>New to our website?</h4>
                        <p>There are thoundsands of customers all over the world. Delivery to every place in the world</p>
                        <a class="btn btn-warning text-light" href="register.php">Create an Account</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="login_form_inner">
                    <h3>Log in to enter</h3>
                    <form class="row login_form" action="" method="post" id="contactForm">
                        <?php if (isset($emailErr)) : ?>
                            <div class="alert alert-warning">
                                <?= $emailErr ?>
                            </div>
                        <?php endif; ?>
                        <input type="hidden" class="form-control" name="_token" value="<?= $_SESSION['_token'] ?>">
                        <div class="col-md-12 form-group">
                            <input type="email" class="form-control" id="name" required name="email" placeholder="Email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email'">
                        </div>
                        <div class="col-md-12 form-group mb-3">
                            <input type="password" class="form-control" id="name" required name="password" placeholder="Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'">
                        </div>
                        <div class="col-md-12 form-group">
                            <button type="submit" value="submit" class="btn btn-warning text-light w-100">Log In</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>


<?php require "footer.php" ?>