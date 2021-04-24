<?php include "db.php" ?>
<?php

    // Retrieving values from create.php form
    if(isset($_POST['submit'])){
        $name = $_POST['name'];
        $faculty_id = $_POST['faculty_id'];
        $department = $_POST['dept'];
        $gender = $_POST['gender'];
        $mobno = $_POST['mob'];
        $email = $_POST['email'];
        $address = $_POST['address'];

        $photo = $_FILES['filename']['name'];
        $photo_tmp = $_FILES['filename']['tmp_name'];
        move_uploaded_file($photo_tmp, "../user_images/$photo");

        SQLite3::escapeString($name);
        SQLite3::escapeString($faculty_id);
        SQLite3::escapeString($department);
        SQLite3::escapeString($gender);
        SQLite3::escapeString($mobno);
        SQLite3::escapeString($email);
        SQLite3::escapeString($address);
        

        // Inserting values into database
        $query = "INSERT INTO details (names, dept, photo, gender, email, mobno, addr, faculty_id)";
        $query .=" VALUES('$name', '$department', '$photo', '$gender', '$email', '$mobno', '$address', $faculty_id)";
        $result = $db->query($query);

        
        // Executing Python Script
        exec('python ../Contrace/database.py');

        header("Location: ../web_main/view.php");
    }
?>