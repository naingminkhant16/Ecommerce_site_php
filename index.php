<?php require_once "header.php"; ?>
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
                // $result = $db->crud("SELECT * FROM products WHERE name LIKE '%$searchKey%' ORDER BY id desc", null, null, true);
                $result = $db->where('name', 'LIKE', "%$searchKey%")->orderBy('id', 'DESC')->get('products');
            ?>
                <div class="alert alert-info ms-2 mt-3" style="max-width: 300px;">Search result of <span style="font-weight: 600;"><?= $searchKey ?></span></div>
            <?php
            else :
                // $result = $db->crud("SELECT * FROM products ORDER BY id desc LIMIT 0,9", null, null, true);
                $result = $db->orderBy('id', 'DESC')->limit(0, 8)->get('products');
            // dd($result);
            endif;
            ?>
            <div class="row g-3">
                <?php
                if ($result) :
                    foreach ($result as $product) :
                ?>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <a href="p_details.php?id=<?= $product->id ?>"><img src="admin/images/<?= $product->image ?>" class="card-img-top"></a>
                                    <span class="badge bg-secondary p-2 my-3" style="font-size: 12px;">
                                        <?php
                                        // $p_tag = $db->crud("SELECT * FROM tags WHERE id=:id", [':id' => $product->tag_id], true);
                                        $p_tag = $db->where('id', $product->tag_id)->first('tags');
                                        ?>
                                        <a href='category.php?tag_id=<?= escape($p_tag->id) ?>' class='text-decoration-none text-white'><?= escape($p_tag->name) ?></a>
                                    </span>
                                    <span class="badge bg-secondary p-2 my-3" style="font-size: 12px;">
                                        <?php
                                        // $p_cat = $db->crud("SELECT * FROM categories WHERE id=:id", [':id' => $product->category_id], true);
                                        $p_cat = $db->where('id', $product->category_id)->first('categories');
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
                                        // $sizes = $db->crud("SELECT * FROM sizes", null, null, true);
                                        $sizes = $db->all('sizes');
                                        // $p_sizes = $db->crud("SELECT * FROM product_sizes WHERE product_id=:pid", [":pid" => $product->id], null, true);
                                        $p_sizes = $db->where('product_id', $product->id)->get('product_sizes');
                                        foreach ($sizes as $size) {
                                            foreach ($p_sizes as $ps) {
                                                echo ($size->id == $ps->size_id) ? "<span class='badge bg-secondary p-1' style='font-size: 12px;'>" . escape($size->name) . "</span>" . "&nbsp;" : '';
                                            }
                                        }
                                        ?>
                                    </p>
                                    <div class="d-flex">
                                        <a href="p_details.php?id=<?= escape($product->id) ?>" type="button" class="btn btn-sm btn-dark m-1">Details</a>
                                        <a href="addtocart.php?id=<?= $product->id ?>&qty=1" type="button" class="btn btn-sm btn-danger m-1" id="cart-hover"><span id="cart-hover-text">Add To Cart</span><i class="fa-solid fa-cart-plus ms-1"></i></a>
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
<?php require_once "trending_products.php"; ?>
<br>

<!-- Banner Section Start -->
<?php require_once "footer.php" ?>