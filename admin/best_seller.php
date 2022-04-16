<?php include 'header.php'; ?>

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Best Seller Items</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row row-cols-1 row-cols-md-4">
                            <?php
                            $result = $db->crud("SELECT * FROM products", null, null, true);

                            if ($result) :

                                foreach ($result as $value) :
                                    $best_result = $db->crud("SELECT quantity FROM sale_order_detail WHERE product_id=:id", [':id' => $value->id], null, true);

                                    if (count($best_result) >= 3) :
                            ?>
                                        <div class="col">
                                            <div class="card">
                                                <img class="card-img-top" src="images/<?= escape($value->image) ?>">
                                                <div class="card-body">
                                                    <span class="badge p-1 bg-danger d-inline mb-5">Total sold out(<?= escape(count($best_result)) ?>)</span>
                                                    <h5 class="text-bold"><?= escape($value->name) ?></h5>
                                                    <p>Price - <?= escape($value->price) ?></p>
                                                </div>
                                            </div>
                                        </div>
                            <?php
                                    endif;
                                endforeach;
                            endif;
                            ?>
                        </div>
                        <!-- <a href="logout.php" type="button" class="btn btn-secondary float-right">Logout</a><br> -->

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