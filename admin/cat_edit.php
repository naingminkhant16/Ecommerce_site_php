<?php include 'header.php'; ?>
<?php
$id = $_GET['id'];

$value = $db->crud("SELECT * FROM categories WHERE id=:id", [":id" => $id], true);

if (!empty($_POST)) {
    (!isEmptyInput($_POST)) ? $noErr = true : $err = isEmptyInput($_POST);

    if (!empty($err)) {
        $findErrArr = ['name', "description"];
        $err = explode(',', $err);

        $uiErr = [];
        foreach ($findErrArr as $findErr) {
            if (in_array($findErr, $err)) {
                $uiErr[$findErr] = $findErr . " is required!";
            }
        }
    } else {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $id = $_POST['id'];

        $result = $db->crud("UPDATE categories SET name=:name,description=:description WHERE id=:id", [
            ':name' => $name,
            ':description' => $description,
            ':id' => $id
        ]);
        if ($result) {
            echo "<script>alert('Successfully Updated Category.');window.location.href='category.php';</script>";
        }
    }
}

?>


<!-- Main content -->
<div class="content">
    <div class="container" style="max-width: 600px;">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Edit Category</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="" class="" method="POST">
                            <input type="hidden" name="_token" class="form-control" value="<?= $_SESSION['_token'] ?>">
                            <input type="hidden" name="id" class="form-control" value="<?= escape($value->id) ?>">
                            <div class="form-group">
                                <label type="text" class="form-label">Name</label>
                                <p style="color:red"><?= isset($uiErr["name"]) ? '*' . $uiErr["name"] : '' ?></p>
                                <input type="text" class="form-control" name='name' value="<?= escape($value->name) ?>">
                            </div>
                            <div class="form-group">
                                <label type="text" class="form-label">Description</label>
                                <p style="color:red"><?= isset($uiErr["description"]) ? '*' . $uiErr["description"] : '' ?></p>
                                <textarea name="description" class="form-control" rows="5"><?= escape($value->description) ?></textarea>
                            </div>
                            <br><br>
                            <div class="form-group">
                                <a href="category.php" type="button" class="btn btn-default">Back</a>
                                <input type="submit" value="SUBMIT" class="btn btn-primary">
                            </div>
                        </form>
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