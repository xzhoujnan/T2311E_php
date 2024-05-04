<?php
session_start(); //open session
// add product to cart
$cart = isset($_SESSION["cart"])?$_SESSION["cart"]:[];

$id = $_POST["product_id"];
$bought_qty = $_POST["bought_qty"];

//kiem tra san pham da co trong gio chua
//neu co roi thi tang sl mua
//chua co thi them vao`
if(isset($card[$id])){
    $cart[$id] = $bought_qty;
}
else
{
    $cart [$id]= $bought_qty;
}

//gan gia tri tra lai ve session
$_SESSION["cart"] = $cart;
header("Location:/cart.php");