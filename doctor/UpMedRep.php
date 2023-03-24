<?php
include 'config.php';
$email = $_GET['updateid'];
$sql = "select * from report where email='$email'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$email = $row['email'];
$pname = $row['pname'];
$dname = $row['dname'];
$age = $row['age'];
$date = $row['date'];
$diagnosis = $row['diagnosis'];
$medhistory = $row['medhistory'];
if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $pname = $_POST['pname'];
    $dname = $_SESSION['username'];
    $age = $_POST['age'];
    $date = $_POST['date'];
    $diagnosis = $_POST['diagnosis'];
    $medhistory = $_POST['medhistory'];

    $sql = "update report set email='$email', pname='$pname',dname='$dname', age='$age', date='$date',diagnosis='$diagnosis', medhistory='$medhistory' where email='$email'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        //echo "data updated succesfully";
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
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <title>Update Medical report</title>
</head>

<body>
    <div class="nav1">
        <a href="#" class="logo">myhealthcompass</a>
        <ul>
            <li><a href="./home.php">home</a></li>
            <li><a href="./profile.php">profile</a></li>
            <li><a href="../logout.php">Logout</a></li>
        </ul>
    </div>
    <div class="container my-5">
        <form method="post">
            <div class="form-group">
                <label>Email</label>
                <input type="text" class="form-control" placeholder="enter patients email" name="email" value=<?php echo $email ?>>
            </div>
            <div class="form-group">
                <label>patients name</label>
                <input type="pname" class="form-control" placeholder="enter patients name" name="pname" value=<?php echo $pname ?>>
            </div>
            <div class="form-group">
                <label>Age</label>
                <input type="text" class="form-control" placeholder="enter age" name="age" value=<?php echo $age ?>>
            </div>
            <div class="form-group">
                <label>Date</label>
                <input type="date" class="form-control" placeholder="enter todays date:" name="date" value=<?php echo $date ?>>
            </div>
            <div class="form-group">
                <label>diagnosis</label>
                <textarea type="text" class="form-control" name="diagnosis"><?php echo $diagnosis ?></textarea>
            </div>
            <div class="form-group">
                <label>medical history</label>
                <textarea type="text" class="form-control" name="medhistory"><?php echo $medhistory ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </form>
    </div>
    <script type="text/javascript">
        window.addEventListener("scroll", function() {
            var nav = document.querySelector(".nav1");
            nav.classList.toggle("sticky", window.scrollY > 0);
        })
    </script>
</body>

</html>