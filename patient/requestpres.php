<?php
require "./config.php";
if (!isset($_SESSION['username'])) {
    header('location:main.php');
}


$pid=$_GET['pid'];

$sql = "UPDATE prescription SET refill='1' WHERE pid=$pid";
        $result = mysqli_query($conn, $sql);

        if (!$result) {
            $error = "Failed to insert into the database.";
        } else {
            header("Location: home.php");
        }
?>