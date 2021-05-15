<?php include "../includes/session.php"; ?>
<?php include "db_link.php"; ?>
<?php
    // When edit button is pressed
    if(isset($_GET['edit']))
    {
        $the_id = $_GET['edit'];
        
        // Extracting data to be used in the form
        $query = "SELECT * FROM details WHERE id=$the_id";
        $result = $db->query($query);
        while($row = $result->fetchArray(SQLITE3_ASSOC)){
            $name = $row['names'];
            $dept = $row['dept'];
            $photo = $row['photo'];
            $gender = $row['gender'];
            $email = $row['email'];
            $mobno = $row['mobno'];
            $address = $row['addr'];
            $fac_id = $row['faculty_id'];
        }
    }
    

    // When submit button is pressed
    if(isset($_POST['submit'])){
        $name1 = $_POST['name'];
        $faculty_id1 = $_POST['faculty_id'];
        $department1 = $_POST['dept'];
        $gender1 = $_POST['gender'];
        $mobno1 = $_POST['mob'];
        $email1 = $_POST['email'];
        $address1 = $_POST['address'];

        $photo1 = $_FILES['filename']['name'];
        $photo_tmp1 = $_FILES['filename']['tmp_name'];
        move_uploaded_file($photo_tmp1, "../user_images/$photo1");

        if(!empty($photo1)){
            unlink("../user_images/{$photo}");
        }
        
        if(empty($photo1)){
            $photo1 = $photo;
        }

        SQLite3::escapeString($name1);
        SQLite3::escapeString($faculty_id1);
        SQLite3::escapeString($department1);
        SQLite3::escapeString($gender1);
        SQLite3::escapeString($mobno1);
        SQLite3::escapeString($email1);
        SQLite3::escapeString($address1);

        // Updating database
        $query1 = "UPDATE details SET ";
        $query1 .= "names='$name1', ";
        $query1 .= "dept='$department1', ";
        $query1 .= "photo='$photo1', ";
        $query1 .= "gender='$gender1', ";
        $query1 .= "email='$email1', ";
        $query1 .= "mobno='$mobno1', ";
        $query1 .= "addr='$address1', ";
        $query1 .= "faculty_id=$faculty_id1 ";
        $query1 .= "WHERE id=$the_id";
        $result1 = $db->query($query1);

        exec('python ../Contrace/database.py');

        header("Location: ./view.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contrace-Live Attendance</title>
    <link rel="stylesheet" href="main.css">
    <link rel="shortcut icon" href="./Contrace - 3.png" type="image/png">
</head>
<body>
    <nav class="navbar">
        <div class="logo">
            <a href="#">Contrace</a>
        </div>

        <ul class="navlinks">
            <li>
                <a href="create.php">Add</a>
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

    <!-- <marquee width="100%" direction="left" height="100px">
        If there is no change in a specific field. Enter the existing detail!  
    </marquee> -->

    <!-- <h3>If there is no change in a specific field. Enter the existing detail! </h3> -->

    <div class="parent-container">
        <div class="container">
            <div class="header">
                <h2>Update User Details</h2>
                <small>If there is no change in a specific field, enter the existing detail</small>
            </div>

            <form action="#" method="post" class="create_form" enctype="multipart/form-data">
                <div class="form-control">
                    <label for="name">Name</label>
                    <input value="<?php echo $name; ?>" type="text" name="name" id="name" autocomplete="off" required>
                </div>
    
                <div class="form-control">
                    <label for="faculty_id">ID</label>
                    <input value="<?php echo $fac_id; ?>" type="text" name="faculty_id" id="faculty_id" autocomplete="off" required>
                </div>
    
                <div class="form-control">
                    <label for="dept">Department</label>
                    <input value="<?php echo $dept; ?>" type="text" name="dept" id="dept" autocomplete="off" required>
                </div>
    
                <div class="form-control">
                    <label for="gender">Gender</label>
                    <select name="gender" id="gender required">
                        <option value="<?php echo $gender; ?>" ><?php echo $gender; ?></option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>
                    </select>
                </div>
    
                <div class="form-control">
                    <label for="mob">Mobile Number</label>
                    <input value="<?php echo $mobno; ?>" type="tel" name="mob" id="mob" autocomplete="off" required> 
                </div>
    
                <div class="form-control">
                    <label for="email">Email ID</label>
                    <input value="<?php echo $email; ?>" type="email" name="email" id="email" autocomplete="off" required>
                </div>
    
                <div class="form-control">
                    <label for="address">Residential Address</label>
                    <input value="<?php echo $address; ?>" type="text" name="address" id="address">                    
                </div>
                
                <div class="form-control">
                    <label for="photo">Photo</label><br>
                    <img src='../user_images/<?php echo $photo; ?>' alt='Photo' class='table-image'>
                    <input value="<?php echo $name; ?>" type="file" id="file" name="filename">
                </div>
    
                <button type="submit" name="submit" onclick="<?php exec('python ../Contrace/database.py') ?>">Update</button>
            </form>
    
        </div>
    </div>

</body>
<script src="script.js"></script>
</html>