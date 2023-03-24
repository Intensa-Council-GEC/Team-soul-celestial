<?php
include 'config.php';
if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $pname = $_POST['pname'];
    $dname = $_SESSION['username'];
    $age = $_POST['age'];
    $date = $_POST['date'];
    $diagnosis = $_POST['diagnosis'];
    $medhistory = $_POST['medhistory'];
    $sql = "insert into report (email,pname,dname,age,date,diagnosis,medhistory) values ('$email', '$pname', '$dname', '$age', '$date', '$diagnosis', '$medhistory')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        // echo "data inserted succesfully";
        header('location:ViewMedRep.php');
    } else {
        die(mysqli_error($conn));
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../css/st1.css">
    <link rel="stylesheet" href="../css/style2.css">
    <!-- Bootstrap CSS -->

    <title>Add Medical Report</title>
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
    <div class="content container my-5">
        <div class="tst">
            <div class="title">Create Medical Report</div>
            <form method="post" class="boxx">
                <div class="form-group">
                    <label>Email:</label>
                    <input type="text" class="form-control" placeholder="enter patients email" name="email">
                </div>

                <div class="form-group">
                    <label>patients name:</label>
                    <input type="pname" class="form-control" placeholder="enter patients name" name="pname">
                </div>
                <div class="form-group">
                    <label>Age:</label>
                    <input type="text" class="form-control" placeholder="enter age" name="age">
                </div>
                <div class="form-group">
                    <label>Date:</label>
                    <input type="date" class="form-control" placeholder="enter todays date:" name="date">
                </div>
                <div class="form-group">
                    <label>diagnosis:</label>
                    <textarea type="text" class="form-control" placeholder="enter the diagnosis" name="diagnosis"></textarea>
                </div>
                <div class="form-group">
                    <label>medical history:</label>
                    <textarea type="text" class="form-control" placeholder="enter medical history of the patient" name="medhistory"></textarea>
                </div>
                <div class="sssub">
                    <button type="submit" class="btn sss form-control" name="submit">Submit</button>
                </div>
            </form>
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