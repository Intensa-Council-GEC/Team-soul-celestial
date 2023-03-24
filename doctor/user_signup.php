<?php
$error = false;
$message = false;

if (isset($_POST['submit'])) {
    @include './config.php';

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = md5($_POST['password']);
    $cpassword = md5($_POST['cpassword']);

    $select = "select * from doctor where username='$username'";
    $result = mysqli_query($conn, $select);
    if (mysqli_num_rows($result) > 0) {
        $error = 'Username already exists!';
    } else {
        $check_email = mysqli_query($conn, "SELECT email FROM doctor where email = '" . $_POST['email'] . "' ");

        if ($_POST['password'] != $_POST['cpassword']) { //matching passwords
            $error = "Password do not match";
        } elseif (strlen($_POST['password']) < 6) //cal password length
        {
            $error = "Password Must be >=6";
        } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) // Validate email address
        {
            $error = "Invalid email address please type a valid email!";
        } elseif (mysqli_num_rows($check_email) > 0) //check email
        {
            $error = 'Email Already exists!';
        } else {

            $insert = "INSERT INTO `doctor` (`username`, `email`, `password`) VALUES ('$username', '$email', '$password')";
            $result = mysqli_query($conn, $insert);
            if ($result) {
               $_SESSION['username']= $username;
               $_SESSION['email']= $email ;
               $_SESSION['password']= $password;
                header('location:login.php');
            } else {
                $error = "Failed.";
            }
        }
    }
};

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User SignUp</title>
    <link rel="stylesheet" href="./style.css">
</head>

<body>

    <section class="content">
        <div class="box">
            <div class="square" style="--i:0"></div>
            <div class="square" style="--i:1"></div>
            <div class="square" style="--i:2"></div>
            <div class="square" style="--i:3"></div>
            <div class="square" style="--i:4"></div>
            <div class="container">
                <div class="form">
                    <div class="title sup">Sign Up</div>
                    <form action="" method="post">

                        <div>
                            <?php
                            if ($error) {
                                echo '<span class="errormsg">' . $error . '</span>';
                            } elseif (isset($_GET['message'])) {
                                $message = $_GET['message'];
                                echo '<span class="errormsg">' . $message . '</span>';
                            }
                            ?>
                        </div>
                        <div class="inputbox">
                            <input type="text" name="username" id="" required>
                            <label>Username</label>
                        </div>
                        <div class="inputbox">
                            <input type="email" name="email" id="" required>
                            <label>Email Id</label>
                        </div>
                        <div class="inputbox">
                            <input type="password" name="password" id="" required>
                            <label>Password</label>
                        </div>
                        <div class="inputbox">
                            <input type="password" name="cpassword" id="" required>
                            <label>Re-Enter Password</label>
                        </div>
                        <div class="inputbox ssbtn">
                            <input type="submit" name="submit" id="" value="Sign Up">
                        </div>

                        <p class="sign">
                            Already have an account?
                            <a href="./login.php">Log In</a>
                        </p>
                       
                    </form>
                </div>
            </div>
        </div>

    </section>


</body>

</html>