<?php include 'header.php'; ?>

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Products Listing Table</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <a href="product_add.php" class="btn btn-success">Create New Product</a><br><br>
                        <div class="overflow-auto">
                            <table class="" id="d-table">
                                <thead>
                                    <tr>
                                        <th style="width: 10px;">#</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Category</th>
                                        <th>Tag</th>
                                        <th>Size Available</th>
                                        <th>In Stock</th>
                                        <th>Price</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $result = $db->crud("SELECT * FROM products ORDER BY id desc", null, null, true);
                                    if ($result) :
                                        $i = 1;
                                        foreach ($result as $value) :
                                            $cat_result = $db->crud("SELECT * FROM categories WHERE id=:id", [':id' => $value->category_id], true);
                                            $tag_result = $db->crud("SELECT * FROM tags WHERE id=:id", [':id' => $value->tag_id], true);

                                    ?>
                                            <tr>
                                                <td><?= $i ?></td>
                                                <td><?= escape($value->name) ?></td>
                                                <td>
                                                    <p><?= escape(substr($value->description, 0, 30)) ?></p>
                                                </td>
                                                <td><?= escape($cat_result->name) ?></td>
                                                <td><?= escape($tag_result->name) ?></td>
                                                <?php
                                                $sizes_id = $db->crud("SELECT size_id FROM product_sizes WHERE product_id=:pid", [":pid" => $value->id], null, true);
                                                $available_sizes = [];
                                                foreach ($sizes_id as $size_id) {
                                                    $sizes = $db->crud("SELECT * FROM sizes WHERE id=:sid", [":sid" => $size_id->size_id], true);
                                                    $available_sizes[] = $sizes->name;
                                                };
                                                ?>
                                                <td>
                                                    <?php
                                                    foreach ($available_sizes as $size) {
                                                        echo $size . "&nbsp;&nbsp;";
                                                    }
                                                    ?>
                                                </td>

                                                <td><?= escape($value->quantity) ?></td>
                                                <td>$-<?= escape($value->price) ?></td>
                                                <td>
                                                    <div class="d-flex">
                                                        <a href="product_edit.php?id=<?= escape($value->id) ?>" type="button" class="btn btn-sm btn-warning m-1">Edit</a>
                                                        <a href="product_delete.php?id=<?= escape($value->id) ?>" onclick="return confirm('Are you sure you want to delete?')" type="button" class="btn btn-sm btn-danger m-1">Delete</a>
                                                    </div>
                                                </td>
                                            </tr>
                                    <?php $i++;
                                        endforeach;
                                    endif; ?>
                                </tbody>
                            </table>
                            <br>
                        </div>

                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col-md-6 -->
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-item-center justify-content-between ">
                            <h3 class="card-title">Products Listing</h3>
                            <div>
                                <form action="" method="POST">
                                    <input type="hidden" name="_token" class="form-control" value="<?= $_SESSION['_token'] ?>">
                                    <input type="search" name="search" class="form-control" placeholder="Search Product">
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php
                    if (!empty($_POST['search'])) :
                        $searchKey = $_POST['search'];
                        $result = $db->crud("SELECT * FROM products WHERE name LIKE '%$searchKey%' ORDER BY id desc", null, null, true);
                    ?>
                        <div class="alert alert-info ms-2 mt-3" style="max-width: 200px;">Search result of <span style="font-weight: 600;"><?= $searchKey ?></span></div>
                    <?php
                    endif;
                    ?>
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-1">
                        <?php
                        if ($result) :
                            foreach ($result as $product) :
                        ?>
                                <div class="col p-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <img src="./images/<?= $product->image ?>" class="card-img-top">
                                            <span class="badge bg-info p-2 my-3" style="font-size: 12px;">
                                                <?php
                                                $p_tag = $db->crud("SELECT * FROM tags WHERE id=:id", [':id' => $product->tag_id], true);
                                                echo escape($p_tag->name);
                                                ?>
                                            </span>
                                            <span class="badge bg-info p-2 my-3" style="font-size: 12px;">
                                                <?php
                                                $p_cat = $db->crud("SELECT * FROM categories WHERE id=:id", [':id' => $product->category_id], true);
                                                echo escape($p_cat->name);
                                                ?>
                                            </span>

                                            <br>
                                            <h5 style="font-weight: 600;">
                                                <?= escape($product->name) ?>
                                            </h5>
                                            <p><?= escape(substr($product->description, 0, 70)) ?><span class="text-muted">...</span></p>
                                            <span style="font-weight: 600;">Instock - <?= escape($product->quantity) ?></span> |
                                            <span style="font-weight: 600;">Price - <?= escape($product->price) ?></span>
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
                                                <a href="product_edit.php?id=<?= escape($product->id) ?>" type="button" class="btn btn-sm btn-warning m-1">Edit</a>
                                                <a href="product_delete.php?id=<?= escape($product->id) ?>" onclick="return confirm('Are you sure you want to delete?')" type="button" class="btn btn-sm btn-danger m-1">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        <?php
                            endforeach;
                        endif;
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include 'footer.html' ?>