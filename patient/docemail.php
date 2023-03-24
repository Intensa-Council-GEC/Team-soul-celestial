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
    <link rel="stylesheet" href="../css/st1.css">
    <link rel="stylesheet" href="./ss.css">
</head>

<body>
    <div class="nav1">
        <a href="#" class="logo">MyHealthCompass</a>
        <ul>
            <li><a href="home.php">home</a></li>
            <li><a href="./profile.php">Profile</a></li>
            <li><a href="../logout.php">Logout</a></li>
        </ul>
    </div>
    <div class="content">
        <div class="tt">

            <div>
                <div class='title'>Doctor's Details</div>
                <div class='group bb'>
                    <div>Doctor's Email</div>
                    <div>Doctor Name</div>
                </div>
                <div class="ggg">
                    <?php
                    $q1 = "SELECT * FROM doctor";
                    $r = mysqli_query($conn, $q1);
                    while ($row = mysqli_fetch_array($r)) {
                        $demail = $row['email'];
                        $docname = $row['username'];
                    ?>
                        <div class='group'>
                            <div><?php echo $demail; ?></div>
                            <div><?php echo $docname ?></div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
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