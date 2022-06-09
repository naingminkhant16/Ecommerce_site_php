<?php
if (empty($_POST) && empty($_SESSION['cart'])) {
    header("location: index.php");
    die();
}
require "header.php";

if (isset($_SESSION['cart'])) {
    $userId = $_SESSION['user']['id'];

    $total = 0;
    foreach ($_SESSION['cart'] as $key => $qty) :
        $id = str_replace('id', '', $key);
        // $result = $db->crud("SELECT * FROM products WHERE id=:id", [':id' => $id], true);
        $result = $db->find('products', $id);
        $total += $result->price * $qty;
    endforeach;

    //insert into sale_orders table
    // $query = "INSERT INTO sale_orders(user_id,total_price,order_date) VALUES (:user_id,:total_price,:order_date)";
    // $data = [
    //     ':user_id' => $userId,
    //     ':total_price' => $total,
    //     ':order_date' => date("Y-m-d H:i:s")
    // ];
    // $SOresult = $db->crud($query, $data);
    $SOresult = $db->store([
        'user_id' => $userId,
        'total_price' => $total,
        'order_date' => date("Y-m-d H:i:s")
    ], 'sale_orders');
    if ($SOresult) {
        $saleOrderId = $db->getlastInsertID();
        foreach ($_SESSION['cart'] as $key => $qty) {
            $id = str_replace('id', '', $key); //product id

            // $SODresult = $db->crud("INSERT INTO sale_order_detail(sale_order_id,product_id,quantity,order_date) VALUES (:sale_order_id,:product_id,:quantity,:order_date)", [
            //     ':sale_order_id' => $saleOrderId,
            //     ':product_id' => $id,
            //     ':quantity' => $qty,
            //     ':order_date' => date("Y-m-d H:i:s")
            // ]);
            $SODresult = $db->store([
                'sale_order_id' => $saleOrderId,
                'product_id' => $id,
                'quantity' => $qty,
                'order_date' => date("Y-m-d H:i:s")
            ], 'sale_order_detail');

            // $qtyresult = $db->crud("SELECT * FROM products WHERE id=:id", [
            //     ':id' => $id
            // ], true);
            $qtyresult = $db->find('products', $id);
            $updateQty = $qtyresult->quantity - $qty;

            // $newQty = $db->crud("UPDATE products SET quantity=:updateQty WHERE id=:id", [
            //     ':updateQty' => $updateQty,
            //     ':id' => $id
            // ]);
            $newQty = $db->where('id', '=', $id)->update(['quantity' => $updateQty], 'products');
        }
    }
}
if (isset($_POST)) {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];

    // update user data 
    // $query = "UPDATE users SET name=:name,email=:email,phone=:phone,address=:address WHERE id=:id";
    // $data = [
    //     ":name" => $name,
    //     ":email" => $email,
    //     ":phone" => $phone,
    //     ":address" => $address,
    //     ":id" => $_SESSION['user']['id']
    // ];
    // $updateUser = $db->crud($query, $data);
    $updateUser = $db->where('id', "=", $_SESSION['user']['id'])->update([
        "name" => $name,
        "email" => $email,
        "phone" => $phone,
        "address" => $address
    ], 'users');
}
?>
<?php if (isset($_SESSION['cart'])) : ?>
    <section class="order_details section_gap ">
        <div class="container p-5 bg-light" style="max-width:400px;">
            <h3 class="title_confirmation">Thank you. Your order has been received.</h3>
            <div class="row order_d_inner text-justify">
                <div class="col-lg-12">
                    <div class="details_item">
                        <h4>Order Info</h4>
                        <?php
                        // $order = $db->crud("SELECT * FROM sale_orders WHERE id=:id", [':id' => $saleOrderId], true);
                        $order = $db->find('sale_orders', $saleOrderId);
                        ?>
                        <ul class="" style="padding-left: 0;">
                            <li class="text-dark text-decoration-none"><span>Order Id</span> : <?= escape($order->id) ?></li>
                            <li class="text-dark text-decoration-none"><span>Customer Name</span> : <?= $name ?></li>
                            <li class="text-dark text-decoration-none"><span>Date</span> : <?= escape($order->order_date) ?></li>
                            <li class="text-dark text-decoration-none"><span>Total Items</span> : <?php $cart = 0;
                                                                                                    foreach ($_SESSION['cart'] as $qty) {
                                                                                                        $cart += $qty;
                                                                                                    };
                                                                                                    echo $cart; ?></li>
                            <li class="text-dark text-decoration-none"><span>Total Price</span> : $<?= $total ?></li>
                            <li class="text-dark text-decoration-none"><span>Delivery To</span> : <?= $address ?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php else : echo "<h1 style='text-align:center;margin:40px auto'>No Order Yet.</h1>" ?>
<?php
endif;
unset($_SESSION['cart']);
?>

<?php require "footer.php" ?>