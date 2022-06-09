<?php
require "./config/config.php";
require "./config/functions.php";
$db = new DB;
$res = $db->where('id', '=', 23)->update(['title' => 'this is title', "body" => "this is body"], 'blogs');
// echo $db->sql;
dd($res);
