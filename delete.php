<?php 

// if( isset($_GET['id'])){
//     $id = $_GET['id'];

//     $host = "localhost";
//     $username = "root";
//     $password = "12345";
//     $database = "super_admin";

//     $connection = new mysqli($host, $username, $password, $database);

//     $sql = " DELETE FROM user_list WHERE id=$id";
//     $connection->query($sql);

// }

// header("location: index.php");
// exit;

include_once("connections/connection.php");

if (isset($_POST['password']) && isset($_POST['id'])) {
    $password = $_POST['password'];
    $id = $_POST['id'];


    // Validate the password against the super admin's password
    $validateSql = "SELECT * FROM admin_user WHERE sa_id = '$id' AND password = '$password'";
    $validateResult = $connection->query($validateSql);

    if ($validateResult === FALSE) {
        die("Error in validation query: " . $connection->error);
    }

    if ($validateResult && $validateResult->num_rows > 0) {
        // Password is valid, proceed with deletion
        $deleteSql = "DELETE FROM user_list WHERE id=$id";
        $deleteResult = $connection->query($deleteSql);

        if ($deleteResult === FALSE) {
            die("Error in delete query: " . $connection->error);
        }
    } else {
        // Incorrect password, handle accordingly (e.g., show an error message)
        echo "Incorrect password. Deletion canceled.";
    }

    $connection->close();
}

header("location: index.php");
exit;

?>