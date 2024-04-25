<?php
$id = $_GET["id"];
$name = $_POST["name"];

$host = "localhost";
$user = "root";
$pass = "root";
$db = "t2311e_php";

$conn = new mysqli($host,$user,$pass,$db);
if($conn->connect_error){
die("Connect Database Failed");
}

$sql = "DELETE FROM categories WHERE id = $id";
$conn->query($sql);
header("Location: /demo4.php");