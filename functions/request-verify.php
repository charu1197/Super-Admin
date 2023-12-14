<?php
session_start();
require_once "../connections/connection.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['request_code'])) {
    $connection = connection();

    // Retrieve the array of verification codes
    $enteredCodes = isset($_POST['request_code']) ? $_POST['request_code'] : [];
    // Concatenate the codes to form the entered verification code
    $enteredCode = implode('', $enteredCodes);

    $storedCode = isset($_SESSION['request_code']) ? trim($_SESSION['request_code']) : '';

    if (!empty($storedCode) && password_verify($enteredCode, $storedCode)) {
        // Verification code is correct, select the user based on code
        $email = isset($_SESSION['admin_email']) ? $_SESSION['admin_email'] : '';

        $stmtSelectUser = pg_prepare($connection, 'select_user_query', 'SELECT * FROM super_admin_users WHERE email = $1 AND request_code = $2');
        $result = pg_execute($connection, 'select_user_query', array($email, $enteredCode));

        $user = pg_fetch_assoc($result);

        if ($user) {
            // User found, update the status
            $status = 'pending';

            $stmtUpdateStatus = pg_prepare($connection, 'update_status_query', 'UPDATE super_admin_users SET request_status = $1 WHERE email = $2');
            pg_execute($connection, 'update_status_query', array($status, $email));

            // Assuming $_SESSION['user_id'] is set
            $_SESSION['admin_name'] = $user['lastname'];

            // Set the session variable to indicate successful verification
            $_SESSION['request_success'] = true;

            // Redirect to verify.php to display the SweetAlert
            header("location: ../forgot-request.php");
            exit();
        }
    } else {
        // Incorrect verification code
        $error = "Incorrect verification code";
        $_SESSION['error'] = $error;
        header("location: ../forgot-request.php");
        exit();
    }

    // Close the connection
    pg_close($connection);
}
?>
