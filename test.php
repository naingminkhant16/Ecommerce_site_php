<?php
require "./config/config.php";
require "./config/functions.php";
$db = new DB;
// $res = $db->where('id', '=', 23)->update(['title' => 'this is title', "body" => "this is body"], 'blogs');
$res = $db->where('category_id', '=', 2)->all('products');
// $res = $db->find('products', 3);
// $res = $db->where('id', 'in', [3, 6])->all('products');
// $res = $db->where('id', '=', 3)->update(['quantity' => 26], 'products');
// $res = $db->between('id', 1, 3)->all('products');
dd($res);
