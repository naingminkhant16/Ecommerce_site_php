<?php include 'header.php'; ?>

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Categories</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <a href="cat_add.php" class="btn btn-success">Create New Category</a><br><br>
                        <div class="overflow-auto">
                            <table id="d-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $result = $db->crud("SELECT * FROM categories ORDER BY id desc", null, null, true);
                                    if ($result) :
                                        $i = 1;
                                        foreach ($result as $value) :
                                    ?>
                                            <tr>
                                                <td><?= $i ?></td>
                                                <td><?= escape($value->name) ?></td>
                                                <td>
                                                    <p><?= escape(substr($value->description, 0, 100)) ?></p>
                                                </td>
                                                <td>
                                                    <div class="d-flex">
                                                        <a href="cat_edit.php?id=<?= $value->id ?>" type="button" class="btn btn-sm btn-warning m-1">Edit</a>
                                                        <a href="cat_delete.php?id=<?= $value->id ?>" onclick="return confirm('Are you sure you want to delete?')" type="button" class="btn btn-sm btn-danger m-1">Delete</a>
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
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Tags</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <a href="tag_add.php" class="btn btn-success">Create New Tag</a><br><br>
                        <div class="overflow-auto">
                            <table class="d-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $result = $db->crud("SELECT * FROM tags ORDER BY id desc", null, null, true);
                                    if ($result) :
                                        $i = 1;
                                        foreach ($result as $value) :
                                    ?>
                                            <tr>
                                                <td><?= $i ?></td>
                                                <td><?= escape($value->name) ?></td>
                                                <td>
                                                    <p><?= escape(substr($value->description, 0, 100)) ?></p>
                                                </td>
                                                <td>
                                                    <div class="d-flex">
                                                        <a href="tag_edit.php?id=<?= $value->id ?>" type="button" class="btn btn-sm btn-warning m-1">Edit</a>
                                                        <a href="tag_delete.php?id=<?= $value->id ?>" onclick="return confirm('Are you sure you want to delete?')" type="button" class="btn btn-sm btn-danger m-1">Delete</a>
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
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include 'footer.html' ?>