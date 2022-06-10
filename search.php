<?php
if (empty($_POST['search'])) {
    header("location: index.php");
    die();
} else {
    $searchKey = $_POST['search'];
}

require "header.php";
// $products = $db->crud("SELECT * FROM products WHERE name LIKE '%$searchKey%'", null, null, true);
$products = $db->where('name', "LIKE", "%$searchKey%")->all('products');
// dd($products);
?>
<div class="container mt-5">
    <h2>Search Results</h2>
    <hr>
    <div class="row row-cols-1 row-cols-sm-3 g-3 mt-4">

        <?php
        if (!empty($products)) :
            foreach ($products as $product) :
        ?>
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <a href="p_details.php?id=<?= $product->id ?>"><img src="admin/images/<?= $product->image ?>" class="card-img-top"></a>
                            <span class="badge bg-info p-2 my-3" style="font-size: 12px;">
                                <?php
                                // $p_tag = $db->crud("SELECT * FROM tags WHERE id=:id", [':id' => $product->tag_id], true);
                                $p_tag = $db->find('tags', $product->tag_id);
                                ?>
                                <a href='category.php?tag_id=<?= escape($p_tag->id) ?>' class='text-decoration-none text-white'><?= escape($p_tag->name) ?></a>
                            </span>
                            <span class="badge bg-warning p-2 my-3" style="font-size: 12px;">
                                <?php
                                // $p_cat = $db->crud("SELECT * FROM categories WHERE id=:id", [':id' => $product->category_id], true);
                                $p_cat = $db->find('categories', $product->category_id);
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
                                $p_sizes = $db->where('product_id', '=', $product->id)->all('product_sizes');
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
            <?php endforeach; ?>
        <?php else : ?>
            <div class="text-center fs-1 " style="height: 43vh">
                <p class="mt-3 mt-sm-0"> NO PRODUCTS</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php require "footer.php" ?>