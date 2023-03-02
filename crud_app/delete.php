<?php
    require("dbconnect.php");

    $sno = $_GET['sno'];
    $delete_sql_query = "DELETE FROM `students` WHERE `sno` = '$sno'";
    $result = mysqli_query($conn, $delete_sql_query);

    header("location: home.php");
?>