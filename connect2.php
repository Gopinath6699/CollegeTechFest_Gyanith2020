<?php
$servername = "localhost";
$username = "gyanimzj_user";
$password = "Gyanith@20";
$dbname = "gyanimzj_gy20";
// Create connection
$con =  mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$con) {
    die("Connection failed: " . "some error occured :(");
}
?>