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
    <!-- <link rel="stylesheet" href="../css/main.css"> -->
    <link rel="stylesheet" href="../css/st1.css">
    <link rel="stylesheet" href="../css/main1.css">
</head>

<body onchange="reload()">
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
                <div class="title">View Prescription</div>
                <div classs='hhh'>
                    <table>
                        <thead>
                            <tr>
                                <!-- <th>Id</th> -->
                                <th>Sr. no.</th>
                                <th>PName</th>
                                <th>DName</th>
                                <th>Medicine Details</th>
                                <th>start date</th>
                                <th>End date</th>
                                <th>Request</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            @include './config.php';
                            $d = date("Y-m-d");
                            $ppp = $_SESSION['username'];
                            $sql = "select * from prescription where endd>='$d' and pname='$ppp'";
                            $result = $conn->query($sql);
                            if (!$result) {
                                die("Error in fetching details!");
                            }
                            $total_records = mysqli_num_rows($result);
                            if ($total_records == 0) {
                                echo "<tr class='stdd'><td conspan='6' class='text-center'> No Records found! </td></tr>";
                            }
                            $qlimit = "select * from prescription where endd>='$d' and pname='$ppp'";
                            $result_limit = mysqli_query($conn, $qlimit);
                            while ($row = $result_limit->fetch_assoc()) {
                                echo "
                                     <tr class=''>
                                     <th>$row[pid]</th>
                                     <td>$row[pname]</td>
                                     <td>$row[dname]</td>
                                     <td>$row[mname]</td>
                                     <td>$row[startt]</td>
                                     <td>$row[endd]</td>
                                     <td>";
                                if ($row['refill'] == '1') {
                                    echo "Refill request already sent!";
                                } else {
                                    echo "
                                     <a href='./requestpres.php?pid=$row[pid]'>Send Refill Request</a>";
                                }
                                echo "
                                     </td>
                                    </tr>
                                        ";
                            }
                            ?>
                        </tbody>
                    </table>

                </div>




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