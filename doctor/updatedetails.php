<?php
require "./config.php";
if (!isset($_SESSION['username'])) {
    header('location:main.php');
}
if (isset($_POST['submit'])) {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    if ($password == "" || $password == null) {
        $sql = "UPDATE `doctor` SET `email`='$email' WHERE username='$_SESSION[username]'";
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            $error = "Failed to update into the database.";
        } else {
            $_SESSION['email'] = $email;
            header("Location: profile.php");
        }
    } else {
        $password = md5($_POST['password']);
        $sql = "UPDATE `doctor` SET `username`='$username',`password`='$password' WHERE email='$_SESSION[email]'";
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            $error = "Failed to update into the database.";
        } else {
            $_SESSION['username'] = $username;
            header("Location: profile.php");
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
    <title>Update Profile </title>

    <!-- bootstrap 5 linking file -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- material icon stylesheet -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Symbols+Sharp">
    <!-- daisyui linking file -->
    <link href="https://cdn.jsdelivr.net/npm/daisyui@2.42.1/dist/full.css" rel="stylesheet" type="text/css" />
    <!-- stylesheet css file -->
    <link rel="stylesheet" href="../css/main2.css">
    <link rel="stylesheet" href="../css/st1.css">
    <link rel="stylesheet" href="../css/profile.css">
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
        <div class="main">

            <div class="pprofile ss">
            <div class="mainss">Update Page</div>

                <form method="POST" enctype="multipart/form-data">
                    <div class="box">

                        <?php
                        $sql = "select * from doctor where username='$_SESSION[username]' limit 1";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) == 0) {
                            $error = "Error in fetching details!";
                        }
                        $row = mysqli_fetch_assoc($result);
                        ?>

                        <div class="right">
                            <div class="main">
                                <div class="input-box">
                                    <label>Username:</label>
                                    <input type="text" name="username" value="<?php echo $_SESSION['username']; ?>" class="inputt">
                                </div>
                                <div class="input-box">
                                    <label>EmailId:</label>
                                    <input type="email" name="emailid" value="<?php echo $_SESSION['email']; ?>" class="inputt">
                                </div>
                                <div class="input-box">
                                    <label>Password:</label>
                                    <input type="text" name="password" value="" minlength="6" class="inputt">
                                </div>


                                <div class="input-b">
                                    <a href="" class=" text-center">
                                        <input type="submit" name="submit" value="Update Profile" class="inputt">
                                    </a>
                                </div>
                            </div>
                        </div>


                    </div>
                </form>


            </div>
        </div>
        <div></div>
        <!-- bootstrap 5 linking js file -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

        <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous"></script>
        <!-- tailwind css -->
        <script src="https://cdn.tailwindcss.com"></script>
        <script type="text/javascript">
            window.addEventListener("scroll", function() {
                var nav = document.querySelector(".nav1");
                nav.classList.toggle("sticky", window.scrollY > 0);
            })
        </script>
</body>

</html>