<?php include 'header.php'; ?>

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Premium Customers</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="overflow-auto">
                            <table id="d-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Customer Name</th>
                                        <th>Total Bought Price</th>
                                        <th>E-mail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $result = $db->crud("SELECT * FROM users", null, null, true);

                                    if ($result) :
                                        $i = 1;
                                        foreach ($result as $value) :
                                            $total = 0;

                                            $cus_result = $db->crud("SELECT total_price FROM sale_orders WHERE user_id=:id", [':id' => $value->id], null, true);

                                            foreach ($cus_result as $price) {
                                                $total += $price->total_price;
                                            }
                                            if ($total > 1000) :

                                    ?>
                                                <tr>
                                                    <td><?= $i ?></td>
                                                    <td><?= escape($value->name) ?></td>
                                                    <td>$ <?= escape($total) ?></td>
                                                    <td><?= escape($value->email) ?></td>
                                                </tr>
                                    <?php $i++;
                                            endif;
                                        endforeach;
                                    endif;
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <br>

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