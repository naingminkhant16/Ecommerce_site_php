<?php include('header.php') ?>
<?php
// $result = $db->crud("SELECT * FROM products WHERE id=:pid", [':pid' => $_GET['id']], true);
$result = $db->where('id', $_GET['id'])->first('products');
?>
<section>
    <div class="bg text-center" style="background: linear-gradient(to right, rgba(0, 0, 0, 0.442), rgba(0, 0, 0, 0.442)),url('images/cloth.jpg') no-repeat center;background-attachment:fixed;">
        <div class="img-bg-text">
            <h3>Product Details</h3>
        </div>
    </div>
</section>
<!--================Single Product Area =================-->
<!-- <div class="product_image_area"> -->
<div class="container my-4">
    <div class="row  s_product_inner">
        <div class="col-lg-6">
            <div class="">
                <img class="img-fluid" src="admin/images/<?= escape($result->image) ?>">
            </div>
        </div>
        <div class="col-lg-5 offset-lg-1">
            <div class="s_product_text">
                <h3><?= escape($result->name) ?></h3>
                <h2 style="color: orange;">$<?= escape($result->price) ?></h2>
                <ul class="list" style=" padding-left: 0;">
                    <li class=""><a class="active" href="#"><span>Category</span> :<?php
                                                                                    // $cat_result = $db->crud("SELECT * FROM categories WHERE id=:id", [':id' => $result->category_id], true);
                                                                                    $cat_result = $db->where('id', $result->category_id)->first('categories');
                                                                                    echo strtoupper(escape($cat_result->name)) ?> </a></li>
                    <li class=""><a class="active" href="#"><span>Tag</span> :<?php
                                                                                // $tag_result = $db->crud("SELECT * FROM tags WHERE id=:id", [':id' => $result->tag_id], true);
                                                                                $tag_result = $db->where('id', $result->tag_id)->first('tags');
                                                                                echo strtoupper(escape($tag_result->name)) ?> </a></li>
                    <li><a href="#"><span>Availibility</span> : In Stock(<?= escape($result->quantity) ?>) | Size (
                            <?php
                            // $sizes = $db->crud("SELECT * FROM sizes", null, null, true);
                            $sizes = $db->all('sizes');
                            // $p_sizes = $db->crud("SELECT * FROM product_sizes WHERE product_id=:pid", [":pid" => $result->id], null, true);
                            $p_sizes = $db->where('product_id', $result->id)->get('product_sizes');
                            foreach ($sizes as $size) {
                                foreach ($p_sizes as $ps) {
                                    echo ($size->id == $ps->size_id) ? escape($size->name) . " " : '';
                                }
                            }
                            ?>)</a></li>
                </ul>
                <p> <?= escape($result->description) ?></p>
                <form action="addtocart.php" method="POST">
                    <input type="hidden" class="form-control" name="_token" value="<?= $_SESSION['_token'] ?>">
                    <input type="hidden" name="id" class="form-control" value="<?= escape($result->id) ?>">

                    <div class="product_count">
                        <label for="qty">Quantity:</label>
                        <input type="text" name="qty" id="sst" maxlength="12" value="1" title="Quantity:" class="input-text qty">
                        <button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;" class="increase items-count" type="button"><i class="fa-solid fa-angle-up"></i></button>
                        <button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst ) && sst > 0 ) result.value--;return false;" class="reduced items-count" type="button"><i class="fa-solid fa-angle-down"></i></button>
                    </div>

                    <div class="card_area d-flex align-items-center">
                        <a href="index.php" class="btn btn-btn-outline-dark">Products</a>
                        <button type="submit" class="btn btn-warning text-white" style="border:1px">Add to Cart</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>