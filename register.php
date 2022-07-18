<?php require "header.php" ?>
<!-- Header End -->
<?php

if (!empty($_POST)) {
    if (
        empty($_POST['name']) || empty($_POST['email']) || empty($_POST['password'])
        || empty($_POST['phone']) || empty($_POST['address']) || strlen($_POST['password']) < 6
    ) {
        if (empty($_POST['name'])) {
            $nameError = "Name is required";
        }
        if (empty($_POST['email'])) {
            $emailError = "Email is required";
        }
        if (empty($_POST['password'])) {
            $passwordError = "Password is required";
        }
        if (strlen($_POST['password']) < 6) {
            $passwordError = "Password should have atleast 6 characters";
        }
        if (empty($_POST['phone'])) {
            $phoneError = "Phone is required";
        }
        if (empty($_POST['address'])) {
            $addressError = "Address is required";
        }
    } else {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $phone = $_POST['phone'];
        $address = $_POST['address'];

        //check email duplicated
        $emailDuplicated = $db->where('email', $email)->first('users');

        if ($emailDuplicated) {
            echo "<script>alert('Email Duplicated!!');window.location.href='register.php'</script>";
            exit();
        }

        $result = $db->store([
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'phone' => $phone,
            'address' => $address,
            'role' => 0
        ], 'users');
        if ($result) {
            echo "<script>alert('Successfully created account,you can now login.');window.location.href='login.php'</script>";
        }
    }
}
?>
<!-- Image Header Start -->
<!-- <section>
    <div class="bg text-center" style="background: linear-gradient(to right, rgba(0, 0, 0, 0.442), rgba(0, 0, 0, 0.442)),url('images/cloth.jpg') no-repeat center;background-attachment:fixed;">
        <div class="img-bg-text">
            <h3>Register Now</h3>
        </div>
    </div>
</section> -->
<!-- Image Header End -->
<br>
<!--  Form Start -->
<section class="">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 container">
                <div class="login_form_inner">
                    <h3>Register With Email</h3>
                    <form class="row login_form" action="" method="post" id="contactForm" novalidate="novalidate">
                        <input type="hidden" class="form-control" name="_token" value="<?= $_SESSION['_token'] ?>">
                        <div class="col-md-12 form-group">
                            <input type="text" class="form-control" id="name" name="name" style="<?= empty($nameError) ? '' : 'border:1px solid red;'; ?>" placeholder="Name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Name'">
                            <small style="color:red;float:left"><?= isset($nameError) ? '*' . $nameError : '' ?></small>
                        </div>
                        <div class="col-md-12 form-group">
                            <input type="email" class="form-control" id="name" name="email" style="<?= empty($emailError) ? '' : 'border:1px solid red;'; ?>" placeholder="Email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email'">
                            <small style="color:red;float:left"><?= isset($emailError) ? '*' . $emailError : '' ?></small>
                        </div>
                        <div class="col-md-12 form-group">
                            <input type="password" class="form-control" id="name" name="password" style="<?= empty($passwordError) ? '' : 'border:1px solid red;'; ?>" placeholder="Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'">
                            <small style="color:red;float:left"><?= isset($passwordError) ? '*' . $passwordError : '' ?></small>
                        </div>
                        <div class="col-md-12 form-group">
                            <input type="text" class="form-control" id="name" name="phone" style="<?= empty($phoneError) ? '' : 'border:1px solid red;'; ?>" placeholder="Phone" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Phone'">
                            <small style="color:red;float:left"><?= isset($phoneError) ? '*' . $phoneError : '' ?></small>
                        </div>
                        <div class="col-md-12 form-group">
                            <textarea name="address" rows="3" class="form-control border-top-0" style="<?= empty($addressError) ? '' : 'border:1px solid red;'; ?>" placeholder="Address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Address'"></textarea>
                            <small style="color:red;float:left"><?= isset($addressError) ? '*' . $addressError : '' ?></small>
                        </div>
                        <div class="col-md-12 form-group mt-3">
                            <button type="submit" value="submit" class="btn btn-warning text-light w-100">Register</button>
                            <a href="login.php" type="button" class="btn btn-light text-black" style="color:white">Login</a>
                        </div>
                    </form>
                    <br><br>
                </div>
            </div>
        </div>
    </div>
</section><br>
<!--  Form End -->

<!-- Footer Section Start -->
<!--  FOOTER START -->

<?php require "footer.php" ?>