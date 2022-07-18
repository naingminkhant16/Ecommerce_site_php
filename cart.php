<?php require "header.php" ?>
<?php
if (empty($_SESSION['user'])) {
    echo "<h1 style='text-align:center;margin:80px auto'>Need to register or login in order to check out your items.</h1>";
} else {
?>
    <!-- Image Header Start -->
    <section>
        <div class="bg text-center" style="background: linear-gradient(to right, rgba(0, 0, 0, 0.442), rgba(0, 0, 0, 0.442)),url('images/cloth.jpg') no-repeat center;background-attachment:fixed;">
            <div class="img-bg-text">
                <h3>Your Items</h3>
            </div>
        </div>
    </section>
    <!-- Image Header End -->

    <!-- Shoping Cart Section Begin -->
    <section class="cart_area">
        <div class="container">
            <div class="cart_inner">
                <div class="table-responsive">
                    <?php if (isset($_SESSION['cart'])) : ?>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Product</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $total = 0;
                                foreach ($_SESSION['cart'] as $key => $qty) :
                                    $id = str_replace('id', '', $key);
                                    // $result = $db->crud("SELECT * FROM products WHERE id=:id", [':id' => $id], true);
                                    $result = $db->where('id', $id)->first('products');
                                    $total += $result->price * $qty;
                                ?>
                                    <tr>
                                        <td>
                                            <div class="media">
                                                <div class="d-flex">
                                                    <img src="admin/images/<?= escape($result->image) ?>" width="110" height="100">
                                                </div>
                                                <div class="media-body">
                                                    <p><?= escape($result->name) ?></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <h5>$<?= escape($result->price) ?></h5>
                                        </td>
                                        <td>
                                            <h5> <?= escape($qty) ?></h5>
                                        </td>
                                        <td>
                                            <h5>$<?= escape($result->price) * $qty ?></h5>
                                        </td>
                                        <td>
                                            <a href="cart_item_clear.php?id=<?= escape($result->id) ?>" class="btn btn-sm btn-danger">Clear</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                <tr>
                                    <td>

                                    </td>
                                    <td>

                                    </td>
                                    <td>
                                        <h5>Subtotal</h5>
                                    </td>
                                    <td>
                                        <h5>$<?= $total ?></h5>
                                    </td>
                                    <td></td>
                                </tr>

                                <tr class="out_button_area">
                                    <td>

                                    </td>
                                    <td>

                                    </td>
                                    <td>
                                        <a class="btn btn-sm btn-outline-danger" href="clearall.php">Clear All</a>
                                    </td>
                                    <td>
                                        <a class="btn btn-sm btn-outline-dark" href="index.php">Continue Shopping</a>
                                    </td>
                                    <td>
                                        <!-- <div class="checkout_btn_inner d-flex align-items-center justify-content-"> -->
                                        <!-- <a class="btn btn-sm btn-outline-primary" href="sale_order.php">Submit Order</a> -->
                                        <!-- </div> -->
                                    </td>
                                </tr>
                            </tbody>
                        </table><br>

                </div><br>
                <h4>Please Confirm Order Form</h4>
                <form action="sale_order.php" method="POST">
                    <?php
                        // $user = $db->crud("SELECT * FROM users WHERE id=:id", [":id" => $_SESSION['user']['id']], true);
                        $user = $db->where('id', $_SESSION['user']['id'])->first('users');
                    ?>
                    <input type="hidden" class="form-control" name="_token" value="<?= $_SESSION['_token'] ?>">
                    <div class="row">
                        <div class="form-group mb-3 col-md-6">
                            <label class="form-label">Name</label>
                            <input type="name" class="form-control" name="name" placeholder="Name" required value="<?= $user->name ?>">
                        </div>
                        <div class="form-group mb-3 col-md-6">
                            <label class="form-label">Phone</label>
                            <input type="text" class="form-control" name="phone" placeholder="Phone" required value="<?= $user->phone ?>">
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label">Delivery To</label>
                        <textarea type="text" class="form-control" rows="5" name="address" placeholder="Your Address" required><?= $user->address ?></textarea>
                    </div>
                    <div class="row">
                        <div class="form-group mb-3 col-md-6">
                            <label class="form-label">Contact Email</label>
                            <input type="email" class="form-control" name="email" value="<?= $user->email ?>" required placeholder="Email">
                        </div>
                        <div class="form-group mb-3 col-md-4">
                            <label class="form-label">Total Items</label>
                            <input type="number" class="form-control" name="total_items" required disabled value="<?= $cart ?>">
                        </div>
                        <div class="form-group mb-3 col-md-2">
                            <label class="form-label">Total Price</label>
                            <input type="text" class="form-control" name="total_price" required disabled value="<?= $total ?>">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-warning text-light">Submit Order</button>
                </form>
            <?php else : echo "<h1 style='text-align:center;margin:40px auto'>No Cart Item Yet.</h1>" ?>
            <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Shoping Cart Section End -->

    <!-- Footer Section Start -->
    <!--  FOOTER START -->

<?php }
require "footer.php" ?>