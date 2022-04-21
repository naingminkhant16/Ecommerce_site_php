<?php
session_start();
require "config/config.php";
require "config/functions.php";
$db = new DB();
if (!empty($_POST)) {
    $id = $_POST['id'];
    $qty = intval($_POST['qty']);

    if (addCart($id, $qty)) {
        header("location: p_details.php?id=" . $id);
    }
} elseif (isset($_GET)) {
    $id = $_GET['id'];
    $qty = intval($_GET['qty']);

    if (addCart($id, $qty)) {
        header("location: index.php");
    }
}


