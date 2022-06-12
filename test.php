<?php
require "./config/config.php";
require "./config/functions.php";
$db = new DB;
// $res = $db->where('id', '=', 23)->update(['title' => 'this is title', "body" => "this is body"], 'blogs');
// $res = $db->where('name', 'LIKE', "%" . "versace" . "%")->orWhere('id', '<', 10)->orWhere('tag_id', '=', 1)->get('products');
// $res = $db->find('products', 3);
// $res = $db->where('id', 'in', [3, 6])->all('products');
// $res = $db->where('id', '=', 3)->update(['quantity' => 26], 'products');
// $res = $db->between('id', 1, 3)->all('products');
// $res = $db->where('price', '<', "0")->orWhere('id', '<', 100)->groupWhere()
//     ->where('tag_id', '=', 1)->groupWhere()->where('category_id', '=', 2)->get('products');
// $res = $db->where([
//     $db->where('price', '<', 10)
//         ->orWhere('quantity', '<=', 10)
// ])->where('id', '<', 5)->get('products');
// $res = $db->where('price', '<', 500)
//     ->orWhere('quantity', '>', 20)
//     ->groupWhere()
//     ->where('tag_id', '=', 1)
//     ->get('products');
$res = $db->where('id', '=', 343)
    ->orWhere('user_id', '=', 42)
    ->groupWhere()
    ->where('ff', "<", 43)
    ->update([
        'title' => "this is title",
        'body' => "lorem ispun some words hello world/."
    ], 'blogs');
dd($res);

/////////////////////////
