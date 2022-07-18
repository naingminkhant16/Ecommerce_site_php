<?php require "header.php" ?>
<!-- Header End -->
<?php
if (!empty($_GET['id'])) {
    $id = $_GET['id'];
    // $catTag = $db->crud("SELECT * FROM categories WHERE id=:id", [":id" => $id], true);
    $catTag = $db->where('id', $id)->first("categories");
    // $result = $db->crud("SELECT * FROM products WHERE category_id=:cat_id", [":cat_id" => $id], null, true);
    $result = $db->where('category_id', $id)->get('products');
} elseif (!empty($_GET['tag_id'])) {
    $id = $_GET['tag_id'];
    // $catTag = $db->crud("SELECT * FROM tags WHERE id=:id", [":id" => $id], true);
    $catTag =  $db->where('id', $id)->first("tags");
    // $result = $db->crud("SELECT * FROM products WHERE tag_id=:tag_id", [":tag_id" => $id], null, true);
    $result = $db->where('tag_id', $id)->get('products');
} else {
    // $result = $db->crud("SELECT * FROM products", null, null, true);
    $result = $db->all('products');
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

            <div class="row g-3">
                <?php
                if ($result) :
                    foreach ($result as $product) :
                ?>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <a href="p_details.php?id=<?= $product->id ?>"><img src="admin/images/<?= $product->image ?>" class="card-img-top"></a>
                                    <span class="badge bg-info p-2 my-3" style="font-size: 12px;">
                                        <?php
                                        // $p_tag = $db->crud("SELECT * FROM tags WHERE id=:id", [':id' => $product->tag_id], true);
                                        $p_tag = $db->where('id', $product->tag_id)->first('tags');
                                        ?>
                                        <a href='category.php?tag_id=<?= escape($p_tag->id) ?>' class='text-decoration-none text-white'>
                                            <?= escape($p_tag->name) ?></a>
                                    </span>
                                    <span class="badge bg-warning p-2 my-3" style="font-size: 12px;">
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
                                    <p>
                                        <?= escape(substr($product->description, 0, 70)) ?>
                                        <span class="text-muted"> <a href="#" class="text-dark text-muted" style="font-size: 14px;">See More...</a></span>
                                    </p>
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

<?php require_once "trending_products.php"; ?>

<?php require "footer.php" ?>