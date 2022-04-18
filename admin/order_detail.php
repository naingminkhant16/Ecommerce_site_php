<?php include 'header.php'; ?>

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Order Details</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <div class="overflow-auto">
                            <table id="d-table">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Order ID</th>
                                        <th>Product Name</th>
                                        <th>Quantity</th>
                                        <th>Order Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $id = $_GET['id'];
                                    $result = $db->crud("SELECT * FROM sale_order_detail WHERE sale_order_id=:id", [":id" => $id], null, true);

                                    if ($result) :
                                        $i = 1;
                                        foreach ($result as $value) :
                                            $presult = $db->crud("SELECT * FROM products WHERE id=:id", [':id' => $value->product_id], true);
                                    ?>
                                            <tr>
                                                <td><?= $i ?></td>

                                                <td><?= escape($value->sale_order_id) ?></td>
                                                <td>
                                                    <p><?= escape($presult->name) ?></p>
                                                </td>
                                                <td>
                                                    <p><?= escape($value->quantity) ?></p>
                                                </td>
                                                <td>
                                                    <p><?= escape(date('Y-m-d', strtotime($value->order_date))) ?></p>
                                                </td>
                                            </tr>
                                    <?php $i++;
                                        endforeach;
                                    endif; ?>
                                </tbody>
                            </table>
                        </div>
                        <br>
                        <a href="order_list.php" type="button" class="btn btn-default">Back</a>
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