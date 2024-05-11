<?php


session_start();
require_once("functions/cart.php");
require_once("functions/checkout.php");
require_once("functions/paypal.php");


$customer_name = $_POST['customer_name'];
$tel = $_POST["tel"];
$address = $_POST["address"];
$shipping_method = $_POST["shipping_method"];
$payment_method = $_POST["payment_method"];

$cart = $_SESSION["cart"];
if(count($cart) == 0){
    header("Location : cart.php");
}

$products = get_cart();
$grand_total = 0;
foreach($products as $item){
    $grand_total += $item["price"] * $cart[$item["id"]];
}

switch($shipping_method){
    case "FREE" : break;
    case "STANDARD" : $grand_total += 10; break;
    case "EXPRESS" : $grand_total += 20; break;
}

$status = "PENDING";
$order_info = [
    "customer_name" => $customer_name,
    "tel" => $tel,
    "address" => $address,
    "grand_total" => $grand_total,
    "status" => $status,
    "shipping_method" => $shipping_method,
    "payment_method" => $payment_method
];
//create order
$order_id = order_create($order_info,$products,$cart);

//email
// Địa chỉ email người nhận
$to_email = "namdh.lhomme@gmail.com";

// Tiêu đề email
$subject = "Test email using PHP";

// Nội dung email
$message = "This is a test email sent from PHP.";

// Địa chỉ email người gửi
$from_email = "namdh.lhomme@gmail.com";

// Tiêu đề email được gửi
$headers = "From: $from_email";

// Gửi email
if (mail($to_email, $subject, $message, $headers)) {
    echo "Email sent successfully to $to_email";
} else {
    echo "Email sending failed...";
}

//clear cart
$_SESSION["cart"] = [];

//paypal
if($payment_method == "PAYPAL"){
// Thông tin tài khoản PayPal
$client_id = 'Abc_1WUCUF9SXhJVNls7YelYd7V3n9uy1wCl1XyidvHb4oKIoTNYQJKX-mewfSL-bbJ2aRFwl-WCPC2b';
$client_secret = 'Abc_1WUCUF9SXhJVNls7YelYd7V3n9uy1wCl1XyidvHb4oKIoTNYQJKX-mewfSL-bbJ2aRFwl-WCPC2b';

// Địa chỉ URL của trang xử lý thanh toán
$success_url = "http://localhost:8888/success_paypal.php?order_id=$order_id";
$cancel_url = "http://localhost:8888/cancel_paypal.php?order_id=$order_id";

// Lấy access token
$access_token = get_access_token($client_id, $client_secret);

// Tạo thanh toán
$payment = create_payment($access_token, $success_url,$cancel_url,$grand_total);

// Redirect tới trang thanh toán PayPal
header('Location: ' . $payment['links'][1]['href']);
}
else
{
    // redirect to thank you page
    header("Location : /thank_you.php?order_id=$order_id");
}