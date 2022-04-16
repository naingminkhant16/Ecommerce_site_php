<?php
session_start();
if (empty($_SESSION['user_id']) && empty($_SESSION['logged_in'])) {
    header("location: login.php?error=login");
}
if ($_SESSION['user_role'] != 1) {
    header("location: login.php?error=password");
}
require '../config/config.php';
$id = $_GET['id'];
$db = new DB();
$result = $db->crud("DELETE FROM products WHERE id=:id", [':id' => $id]);
if (isset($result)) header("location: index.php");
