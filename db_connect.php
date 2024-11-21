<!-- 
 * This code is written by NUR ATHIRAH BINTI HILALLUDDIN
 * Student ID: AM2307013911
 * Date: 11/9/2024
 * Purpose: This page connect with database
-->

<?php

    $hostname = "localhost";
    $uname = "root";
    $pass = "";
    $db_name = "technest1";

    // Create connection
    $conn = mysqli_connect($hostname, $uname, $pass, $db_name);

    // Check connection
    if (!$conn) {
        die("Connection Failed: " . mysqli_connect_error());
    }

?>