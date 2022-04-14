<?php

if (isset($_POST['search'])) {
    setcookie('search', $_POST['search'], time() + (86400 * 30), "/"); // 86400 = 1 day
} else {
    if (empty($_GET['pageNo'])) {
        unset($_COOKIE['search']);
        setcookie('search', null, -1, '/');
    }
}
?>
<?php include 'header.php'; ?>

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Products Listing</h3>
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
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include 'footer.html' ?>