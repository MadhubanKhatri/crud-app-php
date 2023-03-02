<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "mady_ka_db";

$conn = mysqli_connect($servername,$username,$password,$database);

if(!$conn)
{
    die("Connection is not established".mysqli_error($conn));
}
?>