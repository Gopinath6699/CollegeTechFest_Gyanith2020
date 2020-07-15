<?php

// Create connection
$con=new PDO("mysql:host=localhost;port=3306;dbname=gyanimzj_gy20","gyanimzj_user","Gyanith@20");

// Check connection
if (!$con) {
    die("Connection failed: " . "some error occured :(");
}
?>