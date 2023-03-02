<?php
    require("dbconnect.php");

    $err = false;
    $success = false;

    if($_SERVER['REQUEST_METHOD']=='POST')
    {
        $name = $_POST['sname'];
        $roll_no = $_POST['rollno'];
        $age = $_POST['age'];
    
        if(empty($name) or empty($roll_no) or empty($age))
        {
            $err = true;            
        }
        else
        {
            $sql_query = "INSERT INTO `students` (`student_name`,`rollno`,`age`) VALUES ('$name','$roll_no','$age')";
            $result = mysqli_query($conn,$sql_query);

            if($result)
            {
                $success = true;
            } 
        }
    }
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap CRUD App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  </head>
  <body class="bg-primary">
    
    <div class="container my-5">
        <h2 class="text-white">CRUD App</h2>
        <hr>

        <?php
        
            if($err)
            {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>ERROR !</strong> Please fill the fields.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
            }
            if($success)
            {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>SUCCESS !</strong> A Student is added.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
            }
    
        ?>


        <a href="#" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#newStudentModal">Add New Student</a>
        

        <!-- New Student Modal -->
        <div class="modal fade" id="newStudentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="/crud_app/home.php" method="post">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Add a Student</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Student Name</label>
                                <input type="text" name="sname" class="form-control" id="exampleFormControlInput1">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput2" class="form-label">Roll Number</label>
                                <input type="text" name="rollno" class="form-control" id="exampleFormControlInput2">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput3" class="form-label">Age</label>
                                <input type="number" name="age" class="form-control" id="exampleFormControlInput3">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <br><br>

        <table class="table table-dark table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Student Name</th>
                    <th scope="col">Roll No</th>
                    <th scope="col">Age</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>

            <?php
                $sql_query = "SELECT * FROM `students`";
                $result = mysqli_query($conn,$sql_query);
                $counter = 1;

                while($rows = mysqli_fetch_assoc($result))
                {
                    echo '<tr>
                        <th scope="row">'.$counter.'</th>
                        <td>'.$rows["student_name"].'</td>
                        <td>'.$rows["rollno"].'</td>
                        <td>'.$rows["age"].'</td>
                        <td>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#editModal'.$rows['sno'].'">Edit</a>
                            /
                            <a href="/crud_app/delete.php?sno='.$rows['sno'].'">Delete</a>
                        </td>
                    </tr>';
                    
                    echo '<div class="modal fade" id="editModal'.$rows['sno'].'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="/crud_app/update.php?sno='.$rows['sno'].'" method="post">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Student</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="exampleFormControlInput1" class="form-label">Student Name</label>
                                                <input type="text" name="update_name" class="form-control" value="'.$rows['student_name'].'" id="exampleFormControlInput1">
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleFormControlInput2" class="form-label">Roll Number</label>
                                                <input type="number" name="update_rollno" class="form-control" value="'.$rows['rollno'].'" id="exampleFormControlInput2">
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleFormControlInput3" class="form-label">Age</label>
                                                <input type="number" name="update_age" class="form-control" value="'.$rows['age'].'" id="exampleFormControlInput3">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Edit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>';
                    $counter++;
                }
            
            ?>
                
            </tbody>
        </table>
    </div>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  </body>
</html>