<?php
session_start();
require_once "../connections/connection.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['verification_code'])) {
    // $connection = pg_connect();
    $db_connection = pg_connect("user=postgres.tcfwwoixwmnbwfnzchbn password=sbit4e-4thyear-capstone-2023 host=aws-0-ap-southeast-1.pooler.supabase.com port=5432 dbname=postgres");

    // Retrieve the array of verification codes
    $enteredCodes = isset($_POST['verification_code']) ? $_POST['verification_code'] : [];
    // Concatenate the codes to form the entered verification code
    $enteredCode = implode('', $enteredCodes);

    $storedCode = isset($_SESSION['verification_code']) ? trim($_SESSION['verification_code']) : '';

    if (!empty($storedCode) && password_verify($enteredCode, $storedCode)) {
        // Verification code is correct, select the user based on code
        $email = isset($_SESSION['admin_email']) ? $_SESSION['admin_email'] : '';

        $stmtSelectUser = pg_prepare($connection, 'select_user_query', 'SELECT * FROM super_admin_users WHERE email = $1 AND verification_code = $2');
        $result = pg_execute($connection, 'select_user_query', array($email, $enteredCode));

        $user = pg_fetch_assoc($result);

        if ($user) {
            // User found, update the status
            $status = 'verified';

            $stmtUpdateStatus = pg_prepare($connection, 'update_status_query', 'UPDATE super_admin_users SET status = $1 WHERE email = $2');
            pg_execute($connection, 'update_status_query', array($status, $email));

            // Assuming $_SESSION['user_id'] is set
            $_SESSION['admin_name'] = $user['lastname'];

            // Set the session variable to indicate successful verification
            $_SESSION['verification_success'] = true;

            // Redirect to verify.php to display the SweetAlert
            header("location: ../verify.php");
            exit();
        }
    } else {
        // Incorrect verification code
        $error = "Incorrect verification code";
        $_SESSION['error'] = $error;
        header("location: ../verify.php");
        exit();
    }

    // Close the connection
    pg_close($connection);
}
?>
