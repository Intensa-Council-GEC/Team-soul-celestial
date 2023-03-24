<?php
require "./config.php";
if (!isset($_SESSION['username'])) {
    header('location:main.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="../css/main2.css">
    <link rel="stylesheet" href="../css/st1.css">
</head>

<body>
    <div class="nav1">
        <a href="#" class="logo">myhealthcompass</a>
        <ul>
            <li><a href="./home.php">home</a></li>
            <li><a href="./profile.php">Profile</a></li>
            <li><a href="../logout.php">Logout</a></li>
        </ul>
    </div>
    <div class="content contt">
        <div class="tt">
            <div class="btnm"><a href="../video/videochat2.html">Video</a></div>
            <div class="btnm"><a href="./appointment.php">Appointment</a></div>
            <div class="btnm"><a href="./docemail.php">Doctor Details</a></div>
            <div class="btnm"><a href="./symptomindex.html">Symptom Checker</a></div>
            <div class="btnm"><a href="./viewpres.php">view prescription</a></div>
            <div class="btnm"><a href="./MedRep.php">Medical Report</a></div>

        </div>
    </div>
    <script type="text/javascript">
        window.addEventListener("scroll", function() {
            var nav = document.querySelector(".nav1");
            nav.classList.toggle("sticky", window.scrollY > 0);
        })
    </script>
</body>

</html>