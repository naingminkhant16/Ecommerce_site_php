<?php require "header.php" ?>
<!-- Header End -->
<?php
if (!empty($_POST)) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $user = $db->checkEmailExist($email, "users");
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
<!-- Image Header Start -->
<section>
    <div class="bg text-center" style="background: linear-gradient(to right, rgba(0, 0, 0, 0.442), rgba(0, 0, 0, 0.442)),url('images/cloth.jpg') no-repeat center;background-attachment:fixed;">
        <div class="img-bg-text">
            <h3>Login Now</h3>
        </div>
    </div>
</section>
<!-- Image Header End -->

<!--  Form Start -->
<section class="login_box_area section_gap mt-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="login_box_img">
                    <img class="img-fluid" src="images/bg2.jpg" alt="">
                    <div class="hover">
                        <h4>New to our website?</h4>
                        <p>There are advances being made in science and technology everyday, and a good example of this is the</p>
                        <a class="btn btn-outline-warning text-light" href="register.php">Create an Account</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="login_form_inner">
                    <h3>Log in to enter</h3>
                    <form class="row login_form" action="" method="post" id="contactForm" novalidate="novalidate">
                        <?php if (isset($emailErr)) : ?>
                            <div class="alert alert-warning">
                                <?= $emailErr ?>
                            </div>
                        <?php endif; ?>
                        <input type="hidden" class="form-control" name="_token" value="<?= $_SESSION['_token'] ?>">
                        <div class="col-md-12 form-group">
                            <input type="email" class="form-control" id="name" name="email" placeholder="Email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email'">
                        </div>
                        <div class="col-md-12 form-group mb-3">
                            <input type="password" class="form-control" id="name" name="password" placeholder="Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'">
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
<!--  Form End -->

<!-- Footer Section Start -->
<!--  FOOTER START -->

<?php require "footer.php" ?>