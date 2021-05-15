<?php include "../includes/session.php"; ?>
<?php include "db_link.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Contrace-Live Attendance</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/1ad43aed0a.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="main.css">
    <link rel="shortcut icon" href="./Contrace - 3.png" type="image/png">
</head>

<!-- <style>
    .navlinks{
        margin-top: 10px;
        margin-right: 15px;
    }
</style> -->

<body>
    <nav class="navbar">
        <div class="logo">
            <a href="#.php">Contrace</a>
        </div>

        <ul class="navlinks">
            <li>
                <a href="./create.php">Add</a>
            </li>
            <li>
                <a href="./view.php">View</a>
            </li>
            <li>
                <a href="../includes/logout.php">Logout</a>
            </li>
        </ul>

        <!--For responsiveness-->
        <div class="burger">
            <div class="line1"></div>
            <div class="line2"></div>
            <div class="line3"></div>
        </div>

    </nav>

    <div class="view-parent-container">
        <div class="view-container">

                <form action="view.php" method="POST" class="view_form" name="view_form">

                    <div class="view-control">
                        <label for="faculty_id">ID</label>
                        <input type="text" name="faculty_id" id="faculty_id" autocomplete="off" required>
                        <button name="find" type="submit" id="find">Find</button>
                    </div>
                
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Department</th>
                                    <th>Photo</th>
                                    <th>Gender</th>
                                    <th>Email</th>
                                    <th>Mobile No.</th>
                                    <th>Address</th>
                                    <th>Delete</th>
                                    <th>Update</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                //Fetching details from database for insertion in table
                                if(isset($_POST['find'])){
                                    $f_id = $_POST['faculty_id'];

                                    $query1 = "SELECT * FROM details WHERE faculty_id=$f_id";
                                    $result2 = $db->query($query1);
                                    while($row = $result2->fetchArray(SQLITE3_ASSOC)){
                                        $id = $row['id'];
                                        $name = $row['names'];
                                        $dept = $row['dept'];
                                        $photo = $row['photo'];
                                        $gender = $row['gender'];
                                        $email = $row['email'];
                                        $mobno = $row['mobno'];
                                        $address = $row['addr'];
                                        $fac_id = $row['faculty_id'];

                                        // Inserting rows in table
                                        echo "<tr>";
                                        echo "<td>{$fac_id}</td>";
                                        echo "<td>{$name}</td>";
                                        echo "<td>{$dept}</td>";
                                        echo "<td><img src='../user_images/$photo' alt='Photo' class='table-image'></td>";
                                        echo "<td>{$gender}</td>";
                                        echo "<td>{$email}</td>";
                                        echo "<td>{$mobno}</td>";
                                        echo "<td>{$address}</td>";
                                        echo "<td><a onClick=\"javascript: return confirm('Are you sure?')\" href='view.php?delete=$id' class='ps-3'><i class='far fa-trash-alt'></i></a></td>";
                                        echo "<td><a href='./update.php?edit=$id' class='ps-3'><i class='fas fa-pencil-alt'></i></a></td>";
                                        echo "</tr>";
                                    }

                                }
                                else{
                                    $query = "SELECT * FROM details ORDER BY faculty_id ASC";
                                    $result = $db->query($query);
                                    while($row = $result->fetchArray(SQLITE3_ASSOC)){
                                        $id = $row['id'];
                                        $name = $row['names'];
                                        $dept = $row['dept'];
                                        $photo = $row['photo'];
                                        $gender = $row['gender'];
                                        $email = $row['email'];
                                        $mobno = $row['mobno'];
                                        $address = $row['addr'];
                                        $fac_id = $row['faculty_id'];

                                        // Inserting rows in table
                                        echo "<tr>";
                                        echo "<td>{$fac_id}</td>";
                                        echo "<td>{$name}</td>";
                                        echo "<td>{$dept}</td>";
                                        echo "<td><img src='../user_images/$photo' alt='Photo' class='table-image'></td>";
                                        echo "<td>{$gender}</td>";
                                        echo "<td>{$email}</td>";
                                        echo "<td>{$mobno}</td>";
                                        echo "<td>{$address}</td>";
                                        echo "<td><a onClick=\"javascript: return confirm('Are you sure?')\" href='view.php?delete=$id' class='ps-3'><i class='far fa-trash-alt'></i></a></td>";
                                        echo "<td><a href='./update.php?edit=$id' class='ps-3'><i class='fas fa-pencil-alt'></i></a></td>";
                                        echo "</tr>";
                                    }
                                }

                            ?>
                            </tbody>
                        </table>
                    </div>
                    
                </form>
                <?php

                    // When the delete button will be pressed, the following code will execute
                    if(isset($_GET['delete']))
                    {
                        $the_id = $_GET['delete'];

                        $query = "SELECT photo FROM details WHERE id={$the_id}";
                        $result1 = $db->query($query);
                        while($row = $result->fetchArray(SQLITE3_ASSOC)){
                            $photo_name = $row['photo'];
                        }

                        // Deleting photo from user_images folder
                        unlink("../user_images/{$photo_name}.jpeg");
                        
                        // Deleting selected row from details table
                        $db->exec("DELETE FROM details WHERE id = {$the_id}");

                        // Executing database.py to update the ENCODINGS table
                        exec('python ../Contrace/database.py');

                        header("Location: ./view.php");
                    }
                ?>
                
        </div>
    </div>

</body>
<script src="./script.js"></script>
</html>