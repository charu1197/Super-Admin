<?php

function connection()
{
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "super_admin";

    $con = new mysqli($host, $username, $password, $database);

    // Check connection
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    } else {
        return $con;
    }
}

?>

<!-- END -->