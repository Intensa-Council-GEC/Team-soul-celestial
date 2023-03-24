<?php

if (isset($_SESSION['username'])) {
    if ($_SESSION['type'] == 'doctor') {
        header('location: doctor/home.php');
    } else {
        header('location: patient/home.php');
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FORM</title>
    <link rel='stylesheet' href='css/st1.css'>
    <link rel='stylesheet' href='css/main.css'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>

<body>

    <div class="box1">
        <div class="btnm"><a href="./doctor/login.php">login as a doctor </a></div>
        <div class="btnm"><a href="./patient/login.php">login as a patient </a></div>
    </div>
    <!-- <iframe src='https://my.spline.design/untitled-db612e82ef0e5f7819ec25f9f6d8a365/' frameborder='0' width='100%' height='100%'></iframe> -->
</body>

</html>