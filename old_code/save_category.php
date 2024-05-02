<?php
// received data from FORM
$name = $_POST["name"];

// code save to DB
$host = "localhost";
$user = "root";
$pass = "root";
$db = "t2311e_php";

$conn = new mysqli($host,$user,$pass,$db);
if($conn->connect_error){
die("Connect Database Failed");
}

$sql = "INSERT INTO categories(name) VALUES('$name')";
$conn->query($sql);
header("Location:/demo4.php");