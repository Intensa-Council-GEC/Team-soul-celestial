<?php

include('config.php');

if(isset($_SESSION['code'])){
$google_client->revokeToken(['refresh_token' => 'xxx']);
session_destroy();
header('location:main.php');
}

else{
session_start();
session_unset();
session_destroy();

header('location:main.php');
}
?>