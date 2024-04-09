<?php

include 'components/db_connect.php';
$id =$_GET['id'];
$status=$_GET['button_text'];
$q = "UPDATE userdata SET button_text = $status WHERE id = $id";
mysqli_query($conn,$q);
header("location: itadmin.php");
?>