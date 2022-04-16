<?php include 'header.php'; ?>

<?php

if (!empty($_POST)) {

    (!isEmptyInput($_POST)) ? $noErr = true : $err = isEmptyInput($_POST);

    if (!empty($err)) {
        //found empty input fileds and make ui error message
        $findErrArr = ['name', "description", "category", "tag", "quantity", "price"];
        $err = explode(',', $err);

        $uiErr = [];
        foreach ($findErrArr as $findErr) {
            if (in_array($findErr, $err)) {
                $uiErr[$findErr] = $findErr . " is required!";
            }
        }
    } elseif (!is_numeric($_POST['quantity']) || !is_numeric($_POST['price'])) {
        if (!is_numeric($_POST['quantity'])) $quantityError = "Quantity should be integer value";
        if (!is_numeric($_POST['price'])) $priceError = "Price should be integer value";
    } else {
        $file = "images/" . $_FILES['image']['name'];
        $imageType = pathinfo($file, PATHINFO_EXTENSION);

        if ($imageType != 'jpg' && $imageType != 'jpeg' && $imageType != 'png') {
            echo "<script>alert('Invlaid image type')</script>";
        } else {
            $name = $_POST['name'];
            $description = $_POST['description'];
            $quantity = $_POST['quantity'];
            $category = $_POST['category'];
            $tag = $_POST['tag'];
            $price = $_POST['price'];
            $image = $_FILES['image']['name'];

            move_uploaded_file($_FILES['image']['tmp_name'], $file);
            $query = "INSERT INTO products(name,description,category_id,tag_id,quantity,price,image) VALUES(:name,:description,:category,:tag,:quantity,:price,:image)";
            $data = [
                ':name' => $name,
                ':description' => $description,
                ':category' => $category,
                ":tag" => $tag,
                ':quantity' => $quantity,
                ':price' => $price,
                ':image' => $image
            ];
            $result = $db->crud($query, $data);

            if ($result) {
                $sizes_arr = ["sm", "md", "lg", "xl"];
                foreach ($sizes_arr as $findSize) {
                    if (isset($_POST[$findSize])) {
                        $sid = $_POST[$findSize];
                        $db->crud("INSERT INTO product_sizes(product_id,size_id) VALUES (:pid,:sid)", [":pid" => $db->getlastInsertID(), ":sid" => $sid]);
                    }
                }
                echo "<script>alert('Successfully Uploaded New Product.');window.location.href='index.php';</script>";
            }
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
                        <h3 class="card-title">Create New Product</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="" class="" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" class="form-control" value="<?= $_SESSION['_token'] ?>">
                            <div class="form-group">
                                <label class="form-label">Name</label>
                                <p style="color:red"><?= isset($uiErr["name"]) ? '*' . $uiErr["name"] : '' ?></p>
                                <input type="text" class="form-control" name='name'>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Description</label>
                                <p style="color:red"><?= isset($uiErr["description"]) ? '*' . $uiErr["description"] : '' ?></p>
                                <textarea name="description" class="form-control" rows="5"></textarea>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Category</label>
                                <p style="color:red"><?= isset($uiErr["category"]) ? '*' . $uiErr["category"] : '' ?></p>
                                <select name="category" class="form-control">
                                    <option value="">Select Category</option>
                                    <?php

                                    $cat_result = $db->crud("SELECT * FROM categories", null, null, true);
                                    foreach ($cat_result as $cat) :
                                    ?>
                                        <option value="<?= $cat->id ?>"><?= $cat->name ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Tag</label>
                                <p style="color:red"><?= isset($uiErr["tag"]) ? '*' . $uiErr["tag"] : '' ?></p>
                                <select name="tag" class="form-control">
                                    <option value="">Select Tag</option>
                                    <?php

                                    $tag_result = $db->crud("SELECT * FROM tags", null, null, true);
                                    foreach ($tag_result as $tag) :
                                    ?>
                                        <option value="<?= $tag->id ?>"><?= $tag->name ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Sizes</label><br>
                                <?php
                                $sizes = $db->crud("SELECT * FROM sizes", null, null, true);
                                foreach ($sizes as $size) :
                                ?>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="<?= $size->name ?>" value="<?= $size->id ?>">
                                        <label class="form-check-label" for="inlineCheckbox1"><?= $size->name ?></label>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Quantity</label>
                                <p style="color:red"><?= isset($quantityError) ? '*' . $quantityError : '' ?></p>
                                <p style="color:red"><?= isset($uiErr["quantity"]) ? '*' . $uiErr["quantity"] : '' ?></p>
                                <input type="number" name="quantity" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Price</label>
                                <p style="color:red"><?= isset($priceError) ? '*' . $priceError : '' ?></p>
                                <p style="color:red"><?= isset($uiErr["price"]) ? '*' . $uiErr["price"] : '' ?></p>
                                <input type="number" name="price" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Image</label>
                                <p style="color:red"><?= isset($imageError) ? '*' . $imageError : '' ?></p>
                                <input type="file" name="image">
                            </div>

                            <br><br>
                            <div class="form-group text-right">
                                <a href="index.php" type="button" class="btn btn-default">Back</a>
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