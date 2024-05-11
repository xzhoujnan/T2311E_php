<?php
require_once("functions/checkout.php");
$order_id = $_GET["order_id"];
updateStatusPaid($order_id);
header("Location: /thank_you.php?order_id=$order_id");