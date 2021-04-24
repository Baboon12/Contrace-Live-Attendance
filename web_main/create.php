<?php include "../includes/session.php" ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contrace-Live Attendance</title>
    <link rel="stylesheet" href="./main.css">
    <link rel="shortcut icon" href="./Contrace - 3.png" type="image/png">
</head>
<body>
    <nav class="navbar">
        <div class="logo">
           <a href="#">Contrace</a>
        </div>

        <ul class="navlinks">
            <li>
                <a href="#">Add</a>
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

    
    <div class="parent-container">
        <div class="container">
            <div class="header">
                <h2>Add User Details</h2>
            </div>

            <form action="../includes/add_details.php" method="post" class="create_form" enctype="multipart/form-data">
                <div class="form-control">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" autocomplete="off" required>
                </div>
    
                <div class="form-control">
                    <label for="faculty_id">ID</label>
                    <input type="text" name="faculty_id" id="faculty_id" autocomplete="off" required>
                </div>
    
                <div class="form-control">
                    <label for="dept">Department</label>
                    <input type="text" name="dept" id="dept" autocomplete="off" required>
                </div>
    
                <div class="form-control">
                    <label for="gender">Gender</label>
                    <select name="gender" id="gender required">
                        <option value="select a gender">Select Your Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                <div class="form-control">
                    <label for="mob">Mobile Number</label>
                    <input type="tel" name="mob" id="mob" autocomplete="off" required> 
                </div>
    
                <div class="form-control">
                    <label for="email">Email ID</label>
                    <input type="email" name="email" id="email" autocomplete="off" required>
                </div>
    
                <div class="form-control">
                    <label for="address">Residential Address</label>
                    <input type="text" name="address" id="address" autocomplete="off" required>                   
                </div>
                
                <div class="form-control">
                    <label for="photo">Photo</label>
                    <input type="file" id="file" name="filename" required>
                </div>
    
                <button type="submit" name="submit">Submit</button>
            </form>
    
        </div>
    </div>
</body>

<script src="script.js"> </script>
</html>