<?php
session_start();

require 'config/functions.php';
require 'config/config.php';
require 'config/common.php';

$db = new DB();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

    <!-- CSS Links -->
    <link rel="stylesheet" href="./css/style.css">
    <!-- <link rel="stylesheet" href="css/pages.css"> -->
    <!-- <link rel="stylesheet" href="css/contact.css"> -->
    <!-- fontawesome  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>

    <!-- Header Start -->
    <section id="header" class="bg-white shadow-sm">
        <div class="header-top">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8 text-center text-sm-start">
                        <pre style="font-size: 12px;"><i class="bi bi-telephone-fill"></i>0-12347890 | 7 Days a week | 9 am to 7 pm</pre>
                    </div>

                    <div class="col-sm-4 text-center text-sm-end top-nav">
                        <?php if (!empty($_SESSION['user'])) :
                            echo  "Login with " . $_SESSION['user']['email'];
                        else :  ?>
                            <a href="register.php" class="text-decoration-none text-black">
                                <i class="fa-solid fa-user ms-2"></i>
                            </a>
                        <?php endif; ?>
                        <a href="cart.php" class="">
                            <i class="fa-solid fa-cart-shopping position-relative">
                                <span class="bg-danger position-absolute top-0 
                                start-100 translate-middle badge
                                 rounded-pill" style="font-size: 10px;"><?php
                                                                        $cart = 0;
                                                                        if (isset($_SESSION['cart'])) {
                                                                            foreach ($_SESSION['cart'] as $qty) {
                                                                                $cart += $qty;
                                                                            }
                                                                        }
                                                                        echo $cart;
                                                                        ?></span></i>
                        </a>
                        <?php if (empty($_SESSION['user'])) : ?>
                            <a href="login.php"><i class="fa-solid fa-arrow-right-to-bracket"></i></a>
                        <?php else : ?>
                            <a href="logout.php"><i class="fa-solid fa-arrow-right-from-bracket"></i></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="header-bottom">
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container">
                    <a class="navbar-brand" href="/">
                        <div class=""><img src="./images/logo.jpg" alt="logo" class="img-fluid"></div>
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavDropdown">
                        <ul class="navbar-nav ms-auto text-center">
                            <?php
                            $last = $_SERVER["PHP_SELF"];
                            ?>
                            <li class="nav-item">
                                <a class="nav-link <?php if ($last == '/index.php') echo "active" ?>" aria-current="page" href="index.php">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php if ($last == '/About.php') echo "active" ?>" href="./About.php">About Us</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle <?php if ($last == '/category.php') echo "active" ?>" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Category&Tag
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <?php
                                    $cats = $db->all("categories");
                                    foreach ($cats as $cat) :
                                    ?>
                                        <li><a class="dropdown-item" href="category.php?id=<?= escape($cat->id) ?>"><?= strtoupper(escape($cat->name)) ?></a></li>
                                    <?php endforeach; ?>
                                    <div class="dropdown-divider"></div>
                                    <?php $tags = $db->all("tags");
                                    foreach ($tags as $tag) :
                                    ?>
                                        <li><a class="dropdown-item" href="category.php?tag_id=<?= escape($tag->id) ?>"><?= strtoupper(escape($tag->name)) ?></a></li>
                                    <?php endforeach; ?>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php if ($last == '/contact.php') echo "active" ?>" href="contact.php">Contact Us</a>
                            </li>

                            <li class="search-container">
                                <form action="search.php">
                                    <!-- <input type="hidden" class="form-control" name="_token" value="<?= $_SESSION['_token'] ?>"> -->
                                    <input type="text" placeholder="Search Product.." name="search">
                                    <button type="submit"><i class="bi bi-search"></i></button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- </div> -->
            <!-- </div> -->
        </div>
    </section>
    <!-- Header End -->