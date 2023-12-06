<?php
if (!isset($_SESSION)) {
    session_start();
}

include_once("connections/connection.php");


$con = connection();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if the form is submitted

    // Validate and sanitize email
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

    // Check if the email exists in the database
    $check_email_query = "SELECT * FROM super_admin_users WHERE email = '$email'";
    $check_email_result = pg_query($con, $check_email_query);

    if ($check_email_result && pg_num_rows($check_email_result) > 0) {
        // Generate a random password
        $new_password = generateRandomPassword();

        // Update the database with the new password
        $update_password_query = "UPDATE super_admin_users SET password = '$new_password' WHERE email = '$email'";
        $update_password_result = pg_query($con, $update_password_query);

        if ($update_password_result) {
            // Compose and send the email with the new password (you need to implement this part)
            $subject = "Password Reset";
            $message = "Your new password is: $new_password";

            // You can use mail() function or a third-party library to send emails
            // Example using mail() function (make sure your server supports mail())
            // mail($email, $subject, $message);

            // Display success message to the user
            echo "<script>alert('Password reset successfully!. Check your email for the new password.');</script>";
        } else {
            // Display an error message if the database update fails
            echo "<script>alert('Password reset failed. Please try again later.');</script>";
        }
    } else {
        // Display an error message if the email is not found in the database
        echo "<script>alert('Email not found. Please enter a valid email.');</script>";
    }
}

// Function to generate a random password
function generateRandomPassword($length = 8) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomPassword = '';
    for ($i = 0; $i < $length; $i++) {
        $randomPassword .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomPassword;
}
?>

<!DOCTYPE html>
<html lang="en">


</html>


<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="This is a Philippine Cancer Center HR Management System">
    <meta name="keywords" content="PCC-HRMS, HRMS, Human Resource, Capstone, System, HR">
    <meta name="author" content="Heionim">
    <meta name="robots" content="noindex, nofollow">
    <title>PCC Super Admin Login</title>
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">

	<!-- Fontawesome CSS -->
	<link rel="stylesheet" href="assets/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-..">

	<!-- Main CSS -->
	<link rel="stylesheet" href="assets/css/style.css">

	<link rel="stylesheet" href="css/signup2.css">

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11">

	<style>
		#access{
			display: none;
		}
		#date_created{
			display: none;
		}
		#link{
			margin-top: -5.5em;
            margin-left: 0px;
            display: none;
		}
		
        #back{
            margin-top: 5px;
            background: none;
            border: 1px solid green;
            color: green;

        }
        #back-btn{
           
            padding: 10px 150px 10px 155px;
            border: 1px solid green;
            border-radius: 8px;
            color: green;
        }
        .back{
            margin-top:1em;
        }
        #back-btn:hover{
            background-color: #208a46;  ;
            color: white;
            transition: .3s;
        }
	</style>
</head>

<body class="account-page">

	<div class="main-wrapper">
		<!-- LEFT SIDE CONTAINER -->
		<div class="left-side ">
			<div class="account-logo">
				<a href="index.php"><img src="img/My-Password.png" alt="Company Logo"></a>
			</div>
		</div>
		<!-- RIGHT SIDE CONTAINER -->
		<div class="account-content">
			<div class="account-wrapper">
				<h3 class="login-header">Forgot Password?</h3>
                <center><p>Enter your email</p></center>
                <br>

				<form method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <input class="form-control" type="text" name="email" placeholder="Email" id="email" required>
                    </div>
                    <br><br>
                        <div class="form-group text-center">
                            
                            <button class="btn btn-primary login-btn" name="signup" type="submit">Submit</button>
                            
                                <div class="back">
                                    <a href="login.php" id="back-btn">back</a>
                                </div>
                            
                        </div>
				</form>

			</div>
		</div>
		<!-- <div class="help-link">
			<a href="#"><span>Need Help?</span></a>
		</div> -->
	</div>


	<!-- jQuery -->
	<script src="assets/js/jquery-3.2.1.min.js"></script>

	<!-- Bootstrap Core JS -->
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>

	<!-- Custom JS -->
	<script src="assets/js/app.js"></script>





</body>

</html>