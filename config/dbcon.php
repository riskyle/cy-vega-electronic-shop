<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "elec";

//Creating database Connection
$con = mysqli_connect($host, $username, $password, $database);

//Checking database Connection
if (!$con) {
    die("Connection Failed!!: " . mysqli_connect_error());
}
