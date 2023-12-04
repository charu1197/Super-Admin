<?php

// function connection()
// {
//     $host = "localhost";
//     $username = "root";
//     $password = "";
//     $database = "super_admin";

//     $con = new mysqli($host, $username, $password, $database);

   
//     if ($con->connect_error) {
//         die("Connection failed: " . $con->connect_error);
//     } else {
//         return $con;
//     }
// }

function connection()
{
    $host = "user=postgres password=[sbit4e-4thyear-capstone-2023] host=db.tcfwwoixwmnbwfnzchbn.supabase.co port=5432 dbname=postgres";
    $port = 5432;
    $username = "postgres";
    $password = "sbit4e-4thyear-capstone-2023";
    $database = "postgres";

    $con = pg_connect("host=$host port=$port dbname=$database user=$username password=$password");

    // Check connection
    if (!$con) {
        die("Connection failed: " . pg_last_error());
    } else {
        return $con;
    }
}

?>

