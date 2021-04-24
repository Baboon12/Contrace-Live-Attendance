<?php include"db.php"; ?>
<?php session_start(); ?>

<?php
    if(isset($_POST['login'])){
        // Fetching details from Login Form
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Escaping string to prevent sql injection
        SQLite3::escapeString($email);
        SQLite3::escapeString($password);

        // Fetching details from database
        $query = "SELECT * FROM users WHERE email = '{$email}'";
        $result = $db->query($query);
        while($row = $result->fetchArray(SQLITE3_ASSOC)){
            $db_email = $row['email'];
            $db_password = $row['pwd'];
        }

        // Validating user details
        if($email === $db_email && $password === $db_password){
            $_SESSION['email'] = $email;
            $_SESSION['pwd'] = $password;

            header("Location: ../web_main/view.php");
        }
        else{
            echo "<script type='text/javascript'>
                    alert('Please Enter Correct Credentials');
                    window.location = '../index.html';
                </script>";
        }

    }
?>