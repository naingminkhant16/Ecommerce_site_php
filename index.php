<?php require_once "header.php" ?>
<!-- Hero Start -->
<section id="hero" class="d-flex align-items-center">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 d-flex flex-column justify-content-center">
                <p class="text-warning"><b>UP TO 50% OFF</b></p>
                <h1>
                    <FONT COLOR="white">Summer Fashion</FONT>
                </h1>
                <p class="mt-4" style="color: #ccc;">Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                    Soluta quam unde optio dolore repellat perferendis odit facere libero laboriosam, distinctio
                    officiis quos quis esse fugiat.</p>
                <div class="text-center text-lg-start">
                    <a href="#products" class="btn-read-more text-decoration-none">SHOP NOW!</a>
                </div>
            </div>
            <div class="col-lg-6 order-1 order-lg-2 hero-img">
                <!-- <img src="./images/shop.jpg" class="img-fluid" alt=""> -->
            </div>
        </div>
    </div>
</section>
<!-- Hero End -->
<!-- discount  -->
<div class="container my-4">
    <div class="row g-2">
        <div class="col-sm-4">
            <div class="aler alert-warning text-center py-2">
                <h5 class="text-dark mt-2">10% Summer Discount</h5>
                <p class="text-muted">on every summer items</p>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="aler alert-warning text-center py-2">
                <h5 class="text-dark mt-2">FREE STANDARD DELIVERY</h5>
                <p class="text-muted">on order over $69</p>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="aler alert-warning text-center py-2">
                <h5 class="text-dark mt-2">Up to 50% Discount</h5>
                <p class="text-muted">on every overleft item</p>
            </div>
        </div>

    </div>
</div>
<!-- Categories Start -->
<div class="container-fluid category">
    <div class="row g-3">
        <div class="col-md-4">
            <div>
                <div class="categories-img" id="cat-hover" style="background:linear-gradient(to right,rgba(0, 0, 0, 0.442), rgba(0, 0, 0, 0.442)), url('./images/cat_women.jpg') no-repeat center;">
                    <div class="cat-link">
                        <a href="category.php?tag_id=2">Women</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div>
                <div class="categories-img" id="cat-hover" style="background:linear-gradient(to right,rgba(0, 0, 0, 0.442), rgba(0, 0, 0, 0.442)),url('./images/cat_man.jpg') no-repeat;">
                    <div class="cat-link">
                        <a href="category.php?tag_id=1">Men</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div>
                <div class="categories-img" id="cat-hover" style="background:linear-gradient(to right,rgba(0, 0, 0, 0.442), rgba(0, 0, 0, 0.442)),url('./images/cat_kid.jpg') no-repeat center;">
                    <div class="cat-link">
                        <a href="category.php?tag_id=3">Kids</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Categories End -->
<br>
<!-- Featured Products Start -->
<div class="container mt-5">
    <div class="featured-products" id="products">
        <div class="featured-products-title mb-5">
            <h2>FEATURED PRODUCTS</h2>
        </div><br>
        <div class="mt-3">
            <?php
            if (!empty($_POST['search'])) :
                $searchKey = $_POST['search'];
                $result = $db->crud("SELECT * FROM products WHERE name LIKE '%$searchKey%' ORDER BY id desc", null, null, true);
            ?>
                <div class="alert alert-info ms-2 mt-3" style="max-width: 300px;">Search result of <span style="font-weight: 600;"><?= $searchKey ?></span></div>
            <?php
            else :
                $result = $db->crud("SELECT * FROM products ORDER BY id desc LIMIT 0,9", null, null, true);
            endif;
            ?>
            <div class="row row-cols-1 row-cols-sm-3 g-3">
                <?php
                if ($result) :
                    foreach ($result as $product) :
                ?>
                        <div class="col">
                            <div class="card">
                                <div class="card-body">
                                    <a href="p_details.php?id=<?= $product->id ?>"><img src="admin/images/<?= $product->image ?>" class="card-img-top"></a>
                                    <span class="badge bg-info p-2 my-3" style="font-size: 12px;">
                                        <?php
                                        $p_tag = $db->crud("SELECT * FROM tags WHERE id=:id", [':id' => $product->tag_id], true);
                                        ?>
                                        <a href='category.php?tag_id=<?= escape($p_tag->id) ?>' class='text-decoration-none text-white'><?= escape($p_tag->name) ?></a>
                                    </span>
                                    <span class="badge bg-warning p-2 my-3" style="font-size: 12px;">
                                        <?php
                                        $p_cat = $db->crud("SELECT * FROM categories WHERE id=:id", [':id' => $product->category_id], true);
                                        ?>
                                        <a href='category.php?id=<?= escape($p_cat->id) ?>' class='text-decoration-none text-white'><?= escape($p_cat->name) ?></a>
                                    </span>

                                    <br>
                                    <h5 style="font-weight: 600;">
                                        <a href="p_details.php?id=<?= $product->id ?>" class="text-decoration-none text-black"> <?= escape($product->name) ?></a>
                                    </h5>
                                    <p><?= escape(substr($product->description, 0, 70)) ?><span class="text-muted"> <a href="p_details.php?id=<?= $product->id ?>" class="text-dark text-muted" style="font-size: 14px;">See More...</a></span></p>
                                    <span style="font-weight: 600;">Instock - <?= escape($product->quantity) ?></span> |
                                    <span style="font-weight: 600;">Price - $<?= escape($product->price) ?></span>
                                    <p style="font-weight:600;">Available Size -
                                        <?php
                                        $sizes = $db->crud("SELECT * FROM sizes", null, null, true);
                                        $p_sizes = $db->crud("SELECT * FROM product_sizes WHERE product_id=:pid", [":pid" => $product->id], null, true);

                                        foreach ($sizes as $size) {
                                            foreach ($p_sizes as $ps) {
                                                echo ($size->id == $ps->size_id) ? "<span class='badge bg-secondary p-1' style='font-size: 12px;'>" . escape($size->name) . "</span>" . "&nbsp;" : '';
                                            }
                                        }
                                        ?>
                                    </p>
                                    <div class="d-flex">
                                        <a href="p_details.php?id=<?= escape($product->id) ?>" type="button" class="btn btn-sm btn-outline-dark m-1">Details</a>
                                        <a href="addtocart.php?id=<?= $product->id ?>&qty=1" type="button" class="btn btn-sm btn-outline-danger m-1" id="cart-hover"><span id="cart-hover-text">Add To Cart</span><i class="fa-solid fa-cart-plus ms-1"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php
                    endforeach;
                endif;
                ?>
            </div>
            <a href="category.php" class="text-decoration-none text-end d-block mt-2 browse-all-btn">Browse All <i class="fa-solid fa-arrow-right"></i></a>
        </div>
    </div>
</div>
<!-- Featured Products End-->
<br>
<!-- Trending Section Start -->
<div id="container" class="container my-5">
    <div class="featured-products my-5" id="trend">
        <div class="featured-products-title">
            <h2>TRENDING PRODUCTS</h2>
        </div>
    </div>
    <div id="slider-container">
        <span onclick="slideRight()" class="btn"></span>
        <div id="slider">
            <?php $result = $db->crud("SELECT * FROM products ORDER BY id DESC LIMIT 6", null, null, true);
            foreach ($result as $p) :
            ?>
                <div class="slide">
                    <a href="p_details.php?id=<?= $p->id ?>"><img src="admin/images/<?= $p->image ?>" alt="" class="img-fluid"></a>
                </div>
            <?php endforeach; ?>
        </div>
        <span onclick="slideLeft()" class="btn"></span>
    </div>
</div>
<!-- Trending Section End -->
<br>
<!-- Blog Section Start -->
<!-- <div class="container">
    <div class="row">
        <div class="col-lg-6 mt-3">
            <h2 style="color: orange; float: left;">From Our Blog</h2>
        </div>
        <div class="col-lg-6 mt-3">
            <button class="btn-browse">Browse More<i class="bi bi-arrow-right"></i></button>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4 text-center">
            <div class="card">
                <div class="card-header">
                    <img src="./images/Men.jpg" alt="rover" />
                </div>
                <div class="card-body">
                    <span class="tag tag-teal">Technology</span>
                    <h4>
                        Why is the Tesla Cybertruck designed the way it
                        is?
                    </h4>
                    <p>
                        An exploration into the truck's polarising design
                    </p>
                    <div class="user">
                        <img src="https://studyinbaltics.ee/wp-content/uploads/2020/03/3799Ffxy.jpg" alt="user" />
                        <div class="user-info">
                            <h5>July Dec</h5>
                            <small>2h ago</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 text-center">
            <div class="card">
                <div class="card-header">
                    <img src="./images/Women.jpg" alt="ballons" />
                </div>
                <div class="card-body">
                    <span class="tag tag-purple">Popular</span>
                    <h4>
                        How to Keep Going When You Don’t Know What’s Next
                    </h4>
                    <p>
                        The future can be scary, but there are ways to
                        deal with that fear.
                    </p>
                    <div class="user">
                        <img src="https://studyinbaltics.ee/wp-content/uploads/2020/03/3799Ffxy.jpg" alt="user" />
                        <div class="user-info">
                            <h5>Eyup Ucmaz</h5>
                            <small>Yesterday</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 text-center">
            <div class="card">
                <div class="card-header">
                    <img src="./images/Kids.jpg" alt="city" />
                </div>
                <div class="card-body">
                    <span class="tag tag-pink">Design</span>
                    <h4>
                        10 Rules of Dashboard Design
                    </h4>
                    <p>
                        Dashboard Design Guidelines
                    </p>
                    <div class="user">
                        <img src="https://studyinbaltics.ee/wp-content/uploads/2020/03/3799Ffxy.jpg" alt="user" />
                        <div class="user-info">
                            <h5>Carrie Brewer</h5>
                            <small>1w ago</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->
<!-- Blog Section End -->

<!-- Banner Section Start -->
<?php require_once "footer.php" ?>