<?php require "header.php" ?>
<!-- Header End -->
<?php
if (!empty($_GET['id'])) {
    $id = $_GET['id'];
    $catTag = $db->crud("SELECT * FROM categories WHERE id=:id", [":id" => $id], true);
    $result = $db->crud("SELECT * FROM products WHERE category_id=:cat_id", [":cat_id" => $id], null, true);
} elseif (!empty($_GET['tag_id'])) {
    $id = $_GET['tag_id'];
    $catTag = $db->crud("SELECT * FROM tags WHERE id=:id", [":id" => $id], true);
    $result = $db->crud("SELECT * FROM products WHERE tag_id=:tag_id", [":tag_id" => $id], null, true);
} else {
    $result = $db->crud("SELECT * FROM products", null, null, true);
}
?>
<!-- Image Header Start -->
<section>
    <div class="bg text-center" style="background: linear-gradient(to right, rgba(0, 0, 0, 0.442), rgba(0, 0, 0, 0.442)),url('images/cloth.jpg') no-repeat center;background-attachment:fixed;">
        <div class="img-bg-text">
            <h3>
                <?= (!empty($catTag)) ? "Products of " . strtoupper($catTag->name) : "Browse All"; ?>
            </h3>
        </div>
    </div>
</section>
<!-- Image Header End -->

<!-- Categories Section Start -->


<!-- Categories Details Section Start -->
<div class="container mt-5">
    <div class="featured-products">
        <div class="featured-products-title mb-5">
            <h2>FEATURED PRODUCTS</h2>
        </div><br>
        <div class="mt-3">

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
                                    <p><?= escape(substr($product->description, 0, 70)) ?><span class="text-muted"> <a href="#" class="text-dark text-muted" style="font-size: 14px;">See More...</a></span></p>
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
                                        <a href="addtocart.php?id=<?= escape($product->id) ?>&qty=1" type="button" class="btn btn-sm btn-outline-danger m-1" id="cart-hover"><span id="cart-hover-text">Add To Cart</span><i class="fa-solid fa-cart-plus ms-1"></i></a>
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
<!-- Categories Details Section End -->
<!-- Trending Section Start -->
<div id="container" class="container my-5">
    <div class="featured-products my-5">
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
<!-- Categories Section End -->

<?php require "footer.php" ?>