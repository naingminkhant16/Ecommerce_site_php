<?php include 'header.php'; ?>

<!-- Main content -->
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Weekly Sales Orders</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">

            <table id="d-table">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Customer Name</th>
                  <th>Total Price</th>
                  <th>Order Date</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $currentDate = date('Y-m-d');
                $toDate = date('Y-m-d', strtotime('tomorrow'));
                $fromDate = date('Y-m-d', strtotime($currentDate . '-7 day'));

                $result = $db->crud("SELECT * FROM sale_orders WHERE order_date BETWEEN :fromDate AND :toDate  ORDER BY id desc", [
                  ':fromDate' => $fromDate,
                  ':toDate' => $toDate
                ], null, true);

                if ($result) :
                  $i = 1;
                  foreach ($result as $value) :
                    $user_result = $db->crud("SELECT * FROM users WHERE id=:id", [':id' => $value->user_id], true);
                ?>
                    <tr>
                      <td><?= $i ?></td>
                      <td><?= escape($user_result->name) ?></td>
                      <td><?= escape($value->total_price) ?></td>
                      <td><?= escape(date('Y-m-d', strtotime($value->order_date))) ?></td>
                    </tr>
                <?php $i++;
                  endforeach;
                endif;
                ?>
              </tbody>
            </table><br>

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