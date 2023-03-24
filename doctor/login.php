<?php

include('config.php');
require_once '../User.class.php';
$login_button = '';
$user = new User();


$message = false;
$error = false;
if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = md5($_POST['password']);

    $select = "select * from doctor where username='$username' && password ='$password'";
    $result = mysqli_query($conn, $select);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        session_start();
        $_SESSION['username'] = $row['username'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['password'] = $row['password'];
        $message = "Succesfully logged in.";
        $_SESSION['type'] = 'doctor';
        header('location: home.php');
    } else {
        $error = 'Incorrect username or password!';
    }
};


if (isset($_GET["code"])) {
    $_SESSION['code'] = $_GET['code'];
    $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);
    if (!isset($token['error'])) {
        $google_client->setAccessToken($token['access_token']);
        $_SESSION['access_token'] = $token['access_token'];

        $google_service = new Google_Service_Oauth2($google_client);
        $data = $google_service->userinfo->get();
        if (!empty($data['given_name'])) {
            $_SESSION['first_name'] = $data['given_name'];
        }
        if (!empty($data['family_name'])) {
            $_SESSION['last_name'] = $data['family_name'];
        }
        $_SESSION['username'] = $data['given_name'] . " " . $data['family_name'];
        if (!empty($data['email'])) {
            $_SESSION['email'] = $data['email'];
        }
        if (!empty($data['picture'])) {
            $_SESSION['picture'] = $data['picture'];
        }
        $_SESSION['type'] = 'doctor';
        $UserData = array();
        $UserData['oauth_uid'] = 255;
        $UserData['username'] = !empty($data['given_name']) ? $data['given_name'] : '';
        $UserData['email'] = !empty($data['email']) ? $data['email'] : '';
        $UserData['picture'] = !empty($data['picture']) ? $data['picture'] : '';

        $UserData['oauth_provider'] = 'google';
        $userData = $user->checkUser($UserData);
    }
}


if (!isset($_SESSION['access_token'])) {

    $login_button = '
    <br>Login with Google:
    <a href="' . $google_client->createAuthUrl() . '" class="boxx">Login as a Doctor</a>';

    // $login_button = '<a href="' . $google_client->createAuthUrl() . '">Login With Google</a>';
}


?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Log In</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <link rel='stylesheet' href='css/style.css'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="./style.css">

</head>

<body>
    <?php
    if ($login_button == '') {
        header('Location: home.php');
    } else {
        echo '
        <section class="content">
        <div class="box">
            <div class="square" style="--i:0"></div>
            <div class="square" style="--i:1"></div>
            <div class="square" style="--i:2"></div>
            <div class="square" style="--i:3"></div>
            <div class="square" style="--i:4"></div>
            <div class="container">
                <div class="form">
                    <div class="title">LogIn</div>
                    <form action="" method="post">'; ?>


        <?php
        if ($error) {
            echo '<span class="errormsg">' . $error . '</span>';
        } elseif (isset($_GET['message'])) {
            $message = $_GET['message'];
            echo '<span class="errormsg">' . $message . '</span>';
        };
        ?>

    <?php echo '
                        <div class="inputbox">
                            <input type="text" name="username" id="" required>
                            <label>Username</label>
                        </div>
                        <div class="inputbox">
                            <input type="password" name="password" id="" required>
                            <label>Password</label>
                        </div>
                        <div class="inputbox ssbtn">
                            <input type="submit" name="submit" id="" value="LogIn">
                        </div>


                        <p class="sign">
                            Don"t have an account?
                            <a href="./user_signup.php">Sign Up</a>
                 
        <div class="btnn">
       ' . $login_button . '
        </div>

                        </p>
                    </form>
                </div>

            </div>


        </div>
    </section>';

        echo '
                <div class="btnn">
               ' . $login_button . '
                </div>
';
    }
    ?>

</body>

</html>