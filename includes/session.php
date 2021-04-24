<?php
    session_start();
    if(!isset($_SESSION['email'])){
        echo "<script type='text/javascript'>
                    alert('Please Login First');
                    window.location = '../index.html';
                </script>";
    }
?>