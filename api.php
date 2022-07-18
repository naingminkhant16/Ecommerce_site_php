<?php
include_once "config/functions.php";
include_once "config/config.php";

$products = new DB();
print_r(json_encode($products->all('products')));
