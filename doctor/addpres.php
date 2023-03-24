<?php
require "./config.php";
if (!isset($_SESSION['username'])) {
    header('location:main.php');
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $startt = $_POST["startt"];
    $endd = $_POST["endd"];
    $mname = $_POST["mname"];
    $pname = $_POST["pname"];
    $dname = $_POST["dname"];

    if (empty($pname) || empty($dname)) {
        $error = "All fields are required.";
    } else {

        $sql = "INSERT INTO prescription (startt , endd,mname,pname,dname) VALUES ('$startt', '$endd', '$mname', '$pname', '$dname')";
        $result = mysqli_query($conn, $sql);

        if (!$result) {
            $error = "Failed to insert into the database.";
        } else {
            header("Location: home.php");
        }
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <!-- <link rel="stylesheet" href="../css/main.css"> -->
    <link rel="stylesheet" href="../css/st1.css">
    <link rel="stylesheet" href="../css/main1.css">
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
    <div class="content">
        <div class="tt">
            <div class="topbox1">
                <div class="title">Add Prescription</div>
                <form action="addpres.php" method="POST" class="formclass">
                    enter start date:
                    <input type="date" name="startt" value="">
                    enter end date:
                    <input type="date" name="endd" value="">
                    medicines details:
                    <input type="text" name="mname" value="">
                    Patient name:
                    <input type="text" name="pname" value="">

                    <input type="hidden" name="dname" value="<?php echo $_SESSION['username']; ?>">
                    <input type="submit" name="submit" value="Save">
                </form>


            </div>
        </div>

        <div class="btnm"><a href="./home.php">Home Page</a></div>
    </div>
    <script type="text/javascript">
        window.addEventListener("scroll", function() {
            var nav = document.querySelector(".nav1");
            nav.classList.toggle("sticky", window.scrollY > 0);
        })
    </script>
</body>

</html>