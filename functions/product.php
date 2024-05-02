<?php
require_once("database.php");
function newest_product(){
    $sql = "select * from products order by id desc limit 4";
    $result = query($sql);
    $list = [];
    while($row = $result->fetch_assoc()){
        $list[]=$row;
    }
    return $list;
}