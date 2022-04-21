<?php
function dd($str)
{
    echo "<pre>";
    return die(var_dump($str));
}
function isEmptyInput($formData)
{
    //check inputs are empty or not
    $err = null;
    foreach ($formData as $key => $value) {
        empty(trim($value)) ? $err .= $key . "," : "";
    }
    if (empty($err)) {
        return false;
    } else {
        return $err;
    }
}
// Escape html for output (XSS attack)
function escape($html)
{
    return htmlspecialchars($html, ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8");
}
//add to cart function
function addCart($id, $qty)
{
    global $db;
    $result = $db->crud("SELECT * FROM products WHERE id=:id", [':id' => $id], true);

    if ($qty > $result->quantity) {
        echo "<script>alert('Not enough items!');window.location.href='p_details.php?id=" . $id . "'</script>";
        exit();
    }
    if (isset($_SESSION['cart']['id' . $id])) {
        $_SESSION['cart']['id' . $id] += $qty;
    } else {
        $_SESSION['cart']['id' . $id] = $qty;
    }
    return true;
}