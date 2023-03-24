<?php
require "./config.php";
if (!isset($_SESSION['username'])) {
    header('location:main.php');
}



$pid=$_GET['pid'];
$d=date("Y-m-d");
$dd = date('Y-m-d', strtotime("+3 months", strtotime($d)));
$sql = "UPDATE prescription SET refill='0',startt=$d,endd=$dd WHERE pid=$pid";
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            $error = "Failed to insert into the database.";
        } else {
            header("Location: home.php");
        }
?>