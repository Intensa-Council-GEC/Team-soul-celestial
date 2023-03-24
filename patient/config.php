<?php

ob_start();
session_start();

require_once '../vendor/autoload.php';
$clientid = "76868222947-mvv71knpp9hfcg4hmpl6jpcgv3g3ni63.apps.googleusercontent.com";
$clientsecret = "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";
$redirecturl = "http://localhost/soul_celestia/patient/login.php";

$google_client = new Google_Client();
$google_client->setClientId($clientid);
$google_client->setClientSecret($clientsecret);
$google_client->setRedirectUri($redirecturl);

$google_client->addScope('email');
$google_client->addScope('profile');




define('DB_HOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'soul_celestial');
define('DB_USER_TBL', 'users');

$conn=mysqli_connect('localhost','root','','soul_celestial');

if($conn->connect_error){
    echo "Conncetion failed. Error is connecting to the database.";
}
?>