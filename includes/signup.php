<?php include"db.php"; ?>

<?php
    if(isset($_POST['signup'])){

        // Fetching details from Login Form
        $email = $_POST['email'];
        $password = $_POST['password'];


        // Escaping string to prevent sql injection
        SQLite3::escapeString($email);
        SQLite3::escapeString($password);


        // Inserting values into Database
        $query = "INSERT INTO users (email,pwd) VALUES('$email','$password')";
        $db->exec($query);

        header("Location: ../index.html");
    }

?>