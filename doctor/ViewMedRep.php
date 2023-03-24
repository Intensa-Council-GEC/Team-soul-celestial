<?php
include 'config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>medical report</title>
    <link rel="stylesheet" href="../css/st1.css">
    <link rel="stylesheet" href="../css/style3.css">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"> -->
</head>

<body>
    <div class="nav1 z-100 bg-black-500">
        <a href="#" class="logo">myhealthcompass</a>
        <ul>
            <li><a href="./home.php">home</a></li>
            <li><a href="./profile.php">Profile</a></li>
            <li><a href="../logout.php">Logout</a></li>
        </ul>
    </div>
    <div class="mt-5 container content">
        <div class="minbox">
            <div class="viewtable">
                <div class="title one">View Medical Reports</div>
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
                        $dname = $_SESSION['username'];
                        $sql = "select * from report where dname='$dname'";
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
                        <td><button class= "btn purplebtn"><a href="UpMedRep.php?updateid=' . $email . '" class="text-light">update</a></button>
                        </tr>';
                            }
                        }
                        ?>

                    </tbody>
                </table>
                <button class="btn my-5 title"><a href="AddMedRep.php" class="text-light">Add Medical Report</a></button>

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