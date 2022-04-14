<?php include 'header.php'; ?>

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Orders Listing</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="overflow-auto">
                            <table id="d-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>User</th>
                                        <th>Total Price</th>
                                        <th>Order Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    ////pdo section
                                    $result = $db->crud("SELECT * FROM sale_orders ORDER BY id desc", null, null, true);
                                    if ($result) :
                                        $i = 1;
                                        foreach ($result as $value) :
                                            $user_result = $db->crud("SELECT * FROM users WHERE id=:id", [':id' => $value->user_id], true);
                                    ?>
                                            <tr>
                                                <td><?= $i ?></td>

                                                <td><?= escape($user_result->name) ?></td>
                                                <td>
                                                    <p>$-<?= escape($value->total_price) ?></p>
                                                </td>
                                                <td>
                                                    <p><?= escape(date('Y-m-d', strtotime($value->order_date))) ?></p>
                                                </td>
                                                <td>
                                                    <div class="d-flex">
                                                        <a href="order_detail.php?id=<?= $value->id ?>" type="button" class="btn btn-sm btn-primary m-1">Details</a>
                                                    </div>
                                                </td>
                                            </tr>
                                    <?php $i++;
                                        endforeach;
                                    endif; ?>
                                </tbody>
                            </table><br>
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