<?php

if (!isset($_SESSION)) {
	session_start();
}

include_once("connections/connection.php");

$con = connection();

if (!isset($_SESSION['login_attempts'])) {
	$_SESSION['login_attempts'] = 0;
}
if (!isset($_SESSION['last_attempt_time'])) {
	$_SESSION['last_attempt_time'] = 0;
}

$lockout_time = 900;
if ($_SESSION['login_attempts'] >= 5 && time() - $_SESSION['last_attempt_time'] < $lockout_time) {
	echo '<script>alert("Too many failed login attempts. Please try again later.")</script>';
} else {
	if (isset($_POST['login'])) {

		$username = $_POST['username'];
		$password = $_POST['password'];

		$sql = "SELECT * FROM super_admin_users WHERE username = '$username' AND password = '$password'";

		$user = $con->query($sql) or die($con->error);
		$row = $user->fetch_assoc();
		$total = $user->num_rows;

		if ($total > 0) {
			$_SESSION['UserLogin'] = $row['username'];
			$_SESSION['Access'] = $row['access'];

			// Reset login attempts on successful login
			$_SESSION['login_attempts'] = 0;

			echo header("location: index.php");
		} else {
			// Increment login attempts and update last attempt time
			$_SESSION['login_attempts']++;
			$_SESSION['last_attempt_time'] = time();

			// echo '<script>alert("Incorrect Credentials!")</script>';
		}
	} elseif (isset($_POST['forgot_password'])) {
		$email = $_POST['email'];
		echo '<script>alert("Password reset, instructions sent to your email.");</script>';
	}
}

?>

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

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11">

	<style>
		body {
			height: 100vh;
			margin: 0;
			padding: 0;
		}

		.main-wrapper {
			width: 100%;
			height: 100%;
			display: flex;
			overflow: hidden;
		}

		.slanted-divider::before {
			content: '';
			position: absolute;
			top: 0;
			bottom: 0;
			right: -90%;
			width: 200%;
			transform: translateX(50%) skewX(-6deg);
			background: #fff;
			z-index: -1;
		}

		.left-side,
		.account-content {
			flex: 1;
			position: relative;
		}

		.left-side {
			background: linear-gradient(31.69deg,
					rgba(29, 53, 39, 0.54) -4.28%,
					rgba(24, 47, 33, 0.54) 46.44%,
					rgba(4, 41, 19, 0.54) 100.43%),
				url('img/login-img.jpg') center/cover no-repeat;
			display: flex;
			align-items: center;
			justify-content: center;
			z-index: -2;
		}

		.account-logo img {
			max-width: 100%;
			width: 250px;
			height: auto;
		}

		.account-wrapper {
			max-width: 400px;
			width: 100%;
		}

		.account-content {
			display: flex;
			align-items: center;
			justify-content: center;
			padding: 20px;
		}

		.login-header {
			text-align: center;
			margin-bottom: 0.6rem;
			font-size: 2.2rem;
			font-weight: 700;
		}

		.login-subheader {
			font-size: 0.8rem;
			text-align: center;
			padding-bottom: 3rem;
		}

		.form-group {
			margin-bottom: 10px;
			position: relative;
		}

		.form-control {
			width: calc(100% - 40px);
			border: none;
			border-bottom: 1px solid #ccc;
			border-radius: 0;
			outline: none;
			background: none;
			padding-left: 20px;
			transition: border-bottom 0.3s ease;
		}

		.form-control:focus {
			border-bottom: 2px solid #204A31;
		}

		.form-control::placeholder {
			color: #999;
		}

		.icon {
			position: absolute;
			top: 50%;
			font-size: 16px;
			transform: translateY(-50%);
			color: #999;
		}

		.forgot-password {
			font-size: 10px;
			margin: 0 0 2rem 0;
			color: #0B72BD;
			margin-left: -1rem;
		}

		.login-btn {
			width: 100%;
			border-radius: 10rem;
		}

		.help-link a span {
			position: fixed;
			bottom: 20px;
			right: 20px;
			text-align: right;
			font-size: 12px;
			color: #000;
		}
	</style>
</head>

<body class="account-page">

	<div class="main-wrapper">
		<!-- LEFT SIDE CONTAINER -->
		<div class="left-side slanted-divider">
			<div class="account-logo">
				<a href="index.php"><img src="img/doh.png" alt="Company Logo"></a>
			</div>
		</div>
		<!-- RIGHT SIDE CONTAINER -->
		<div class="account-content">
			<div class="account-wrapper">
				<h3 class="login-header">Welcome!</h3>
				<p class="login-subheader">Please enter your details</p>

				<!-- Display Bootstrap alert for incorrect credentials -->
				<?php
				if (isset($_POST['login']) && $total === 0) {
					echo '<div class="alert alert-danger" role="alert">Incorrect Credentials!</div>';
				}
				?>

				<form method="POST" enctype="multipart/form-data">
					<div class="form-group">
						<i class="fas fa-user icon"></i>
						<input class="form-control" type="text" name="username" placeholder="username" id="username" required>
					</div>

					<div class="form-group">
						<i class="fas fa-lock icon"></i>

						<input class="form-control" type="password" name="password" placeholder="password" id="password" required>
					</div>

					<div class="form-group text-center">
						<div class="col-auto pt-2">
							<a class="float-left forgot-password" href="forgot-password.php">
								Forgot password?
							</a>
						</div>
						<button class="btn btn-primary login-btn" name="login" type="submit">Login</button>
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
		// JavaScript functions to show and hide the modal
		function openModal() {
			document.getElementById('forgotPasswordModal').style.display = 'flex';
		}

		function closeModal() {
			document.getElementById('forgotPasswordModal').style.display = 'none';
			// Clear the input field when the modal is closed
			document.getElementById('email').value = '';
		}
	</script>
</body>

</html>