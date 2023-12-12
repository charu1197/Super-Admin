<?php
session_start();
require_once "../connections/connection.php";
require_once "vendor/autoload.php"; // Assuming PHPMailer is installed via Composer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $connection = connection();

    // Handle resend action
    $email = isset($_SESSION['admin_email']) ? $_SESSION['admin_email'] : '';
    $newVerificationCode = rand(10000, 99999); // Generate a new code

    $stmtUpdateCode = pg_prepare($connection, 'update_code_query', 'UPDATE super_admin_users SET verification_code = $1 WHERE email = $2');
    pg_execute($connection, 'update_code_query', array($newVerificationCode, $email));

    // Update the session variable with the new verification code
    $_SESSION['verification_code'] = password_hash($newVerificationCode, PASSWORD_DEFAULT); // Updated this line

    // Send email with the verification code
    $subject = ucfirst($_SESSION['admin_name']) . ', here\'s your verification code:';
    $message = '<!DOCTYPE html>
    <html lang="en">
    <head>
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <title>Email Template</title>
    </head>
    <body style="font-family: sans-serif; background-color: #e5e6e6; font-size: 15px; max-width: 500px; margin: 0 auto; padding: 3%; width: 100%;">
      <div style="background-color: #f0f6fb; padding: 3%;">
        <header style="width: 100%; display: flex; justify-content: center; align-items: center; max-width: 400px; margin: 0 auto;">
          <div style="max-width: 90px; display: block;
          margin-left: auto;
          margin-right: auto;
          width: 50%;">
          <img src="https://scontent.fmnl25-1.fna.fbcdn.net/v/t1.15752-9/252886612_256735746427586_7182999434579212748_n.png?_nc_cat=108&ccb=1-7&_nc_sid=8cd0a2&_nc_eui2=AeHtYI1q7JwWlH56E17XOzQbponiEfJxo3umieIR8nGje3DEsZex004VfUKiUTjFP1qten1ARjntEBwWsufCYMIu&_nc_ohc=5ECfnLfH8e4AX8rJ0id&_nc_ht=scontent.fmnl25-1.fna&oh=03_AdRJKGihLEO5szcROVytb5thunrm8KqvrfDNz6xGphbPmw&oe=65952504" alt="" style="max-width: 100%; display: block; margin: 0 auto; margin-bottom: 10px;">
          </div>
          <div>
            <ul style="float: right; margin: 0; padding: 0; list-style-type: none;">
              <!-- Add your social links here -->
            </ul>
          </div>
        </header>
        <div style="padding: 0 0 3% 0;">
          <hr style="background-color: #d8dada; margin: auto;">
          <div style="margin: 3%;">
          <h1 style="font-weight: bold; margin: 3%; font-style: normal;">Hi ' . ucfirst($_SESSION['admin_name']) . ',</h1>
            <p style="margin: 3%; font-style: normal;">We received a request for user login on your PCC Account.</p>
            <h1 style="margin: 3%; font-style: normal;"> ' . $newVerificationCode . ' </h1>
            <p style="margin: 3%; font-style: normal;">Enter this code to complete the login process.</p>
            <p style="margin: 3%; font-style: normal;">Thanks for helping us keep your account secure.</p>
            <p style="margin: 3%; font-style: normal;">The PCC Team.</p>
            <hr style="background-color: #d8dada; margin: auto;">
            <div style="text-align: center; color: red; margin: 3%; font-style: normal;">
              Note: This message is system-generated. Please do not reply.
            </div>
            <footer style="text-align: center; padding-bottom: 3%; line-height: 16px; font-size: 12px; color: #303840;">
              <p>
                @2023 Philippine Cancer Center <br />
                6512 Quezon Avenue, Lung Center<br />
                of the Philippines Compound Diliman,<br />
                Quezon City, 1011
              </p>
            </footer>
          </div>
        </div>
      </div>
    </body>
    </html>       
    ';

    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->SMTPAuth = true;

    $mail->Host = "smtp.gmail.com";
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->Username = "noreplyphilippinecancercenter@gmail.com";
    $mail->Password = "hxrywczoqmcjqdhe";

    $mail->setFrom("noreplyphilippinecancercenter@gmail.com", "PCC");
    $mail->addAddress($_SESSION['admin_email']);

    $mail->isHTML(true);

    $mail->Subject = $subject;
    $mail->Body = $message;

    try {
        $mail->send();
        // Respond with a success message
        echo json_encode(['status' => 'success']);
    } catch (Exception $e) {
        // Handle email sending error
        echo json_encode(['status' => 'error', 'message' => 'Failed to send verification code email']);
        // You might also log the error for further analysis
        // error_log("Email sending failed: " . $e->getMessage());
    }

    // Close the connection
    pg_close($connection);

    // Respond with a success message
    echo json_encode(['status' => 'success']);
    exit();
}

