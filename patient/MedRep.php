<?php
include 'config.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical Report</title>
    <link rel="stylesheet" href="../css/st1.css">
    <link rel="stylesheet" href="../css/medrep.css">
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
    <div class="content container">
        <div class="medminitable">
            <div class="title">Medical Record Table</div>

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">email</th>
                        <th scope="col">patientName</th>
                        <th scope="col">doctorsName</th>
                        <th scope="col">age</th>
                        <th scope="col">date</th>
                        <th scope="col">diagnosis</th>
                        <th scope="col">med history</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $email = $_SESSION['email'];
                    $sql = "select * from report where email='$email'";
                    $result = mysqli_query($conn, $sql);
                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $email = $row['email'];
                            $pname = $row['pname'];
                            $dname = $row['dname'];
                            $age = $row['age'];
                            $date = $row['date'];
                            $diagnosis = $row['diagnosis'];
                            $medhistory = $row['medhistory'];
                            echo '<tr>
                    <th scope="row">' . $email . '</th>
                    <td>' . $pname . '</td>
                    <td>' . $dname . '</td>
                    <td>' . $age . '</td>
                    <td>' . $date . '</td>
                    <td>' . $diagnosis . '</td>
                    <td>' . $medhistory . '</td>
                    </tr>';
                        }
                    }
                    ?>
                </tbody>
            </table>
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