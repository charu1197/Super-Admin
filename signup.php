<?php
if (!isset($_SESSION)) {
    session_start();
}

include_once("connections/connection.php");

$con = connection();

if (isset($_POST['signup'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $middlename = $_POST['middlename'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $address = $_POST['address'];
    $access = $_POST['access'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $date_created = date('Y-m-d');
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $sql = "INSERT INTO super_admin_users (firstname, lastname, middlename, gender, age, address, access, email, contact, date_created, password)
        VALUES ('$firstname', '$lastname', '$middlename', '$gender', '$age', '$address', '$access', '$email', '$contact', '$date_created', '$password')";

    $result = pg_query($con, $sql) or die(pg_last_error($con));

    if ($result) {
        echo '<div class="alert alert-success" role="alert">Signup successful!</div>';
		header("location: login.php");
		exit();

    } else {
        echo '<div class="alert alert-danger" role="alert">Error during signup. Please try again.</div>';
    }
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
			margin-top: -7em;
		}
		button{
			margin-top: -3em;
		}
	</style>
</head>

<body class="account-page">

	<div class="main-wrapper">
		<!-- LEFT SIDE CONTAINER -->
		<div class="left-side ">
			<div class="account-logo">
				<a href="index.php"><img src="img/signup-bg.png" alt="Company Logo"></a>
			</div>
		</div>
		<!-- RIGHT SIDE CONTAINER -->
		<div class="account-content">
			<div class="account-wrapper">
				<h3 class="login-header">Sign up</h3>
                <br>

				<form method="POST" enctype="multipart/form-data" onsubmit="return validatePasswords()">
				
				<div class="row">
					<div class="column">
						<div class="form-group">
							<input class="form-control" type="text" name="firstname" placeholder="Firstname" id="firstname" required>
						</div>

						<div class="form-group">
							<input class="form-control" type="text" name="lastname" placeholder="Lastname" id="lastname" required>
						</div>
						<div class="form-group">
							<input class="form-control" type="text" name="middlename" placeholder="Middlename" id="middlename" required>
						</div>
						

						<div class="form-group">
						<select name="gender" id="gender" required>
							<option value="" disabled selected>Select a gender</option>
							<option id="options" value="Male">Male</option>
							<option id="options" value="Female">Female</option>
						</select>
						</div>
						<div class="form-group">
							<input class="form-control" type="text" name="age" placeholder="Age" id="age" required>
						</div>
						
					</div>

					<div class="column">
					<div class="form-group">
							<input class="form-control" type="text" name="contact" placeholder="contact" id="contact" required>
						</div>
						<div class="form-group">
							<input class="form-control" type="text" name="address" placeholder="Address" id="address" required>
						</div>
						<div class="form-group">
							<input class="form-control" type="date" name="date_created" placeholder="date_created" id="date_created">
						</div>
						<div class="form-group">
							<input class="form-control" type="text" name="email" placeholder="Email" id="email" required>
						</div>
						<div class="form-group">
							<input class="form-control" type="text" name="access" Value="Super Admin" id="access" required>
						</div>
						

						<div class="form-group">
							<input class="form-control" type="password" name="password" placeholder="Password" id="password" required>
						</div>

						<div class="form-group">
							<input class="form-control" type="password" name="confirmpassword" placeholder="Confirm password" id="confirmpassword" required oninput="validatePasswords()">
						</div>

						</div>
					</div>
					<br><br>
						<!-- Indication messages -->
						<div id="passwordMatch"></div>
						<div id="passwordNotMatch"></div>
						

					<div class="form-group text-center">
						<div class="col-auto pt-2">
							<a class="float-left forgot-password" id="link" href="Login.php">
								Already an account?
							</a>
						</div>
						<button class="btn btn-primary login-btn" name="signup" type="submit">Sign up</button>
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



	<script>
    function validatePasswords() {
        var password = document.getElementById("password").value;
        var confirmPassword = document.getElementById("confirmpassword").value;

        var passwordMatch = document.getElementById("passwordMatch");
        var passwordNotMatch = document.getElementById("passwordNotMatch");

        // Get references to the password input fields
        var passwordInput = document.getElementById("password");
        var confirmPasswordInput = document.getElementById("confirmpassword");

        if (password === confirmPassword) {
            passwordMatch.innerHTML = "Password match";
            passwordNotMatch.innerHTML = "";

            // Reset border color when passwords match
            passwordInput.style.border = "";
            confirmPasswordInput.style.border = "";

            return true; // Allow form submission
        } else {
            passwordMatch.innerHTML = "";
            passwordNotMatch.innerHTML = "Passwords do not match";

            // Set border color to red when passwords do not match
            passwordInput.style.border = "";
            confirmPasswordInput.style.border = "1px solid red";

            return false; // Prevent form submission
        }
    }
</script>




</body>

</html>