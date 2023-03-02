<?php
    require("dbconnect.php");

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $name = $_POST['update_name'];
        $rollno = $_POST['update_rollno'];
        $age = $_POST['update_age'];

        $sno = $_GET['sno'];
        
        $update_query = "UPDATE `students` SET `student_name` = '$name',`rollno` = '$rollno', `age` = '$age' WHERE `sno` = '$sno'";
        $result = mysqli_query($conn, $update_query);
        
        header("location: home.php");
    }

?>