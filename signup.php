<?php

if (!isset($_SESSION)) {
	session_start();
}

include_once("connections/connection.php");

$con = connection();

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
            background-color: #101414;
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
			background: 
				url('img/signup.jpg') center/cover no-repeat;
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
			border-radius: 8px;
            background-color: #1a9635;
            border: 1px solid #2ab548;
		}

		.help-link a span {
			position: fixed;
			bottom: 20px;
			right: 20px;
			text-align: right;
			font-size: 12px;
			color: #000;
		}
        .form-group input{
            background-color: #292929;
            padding: 12px;
            font-size: 12px;
            color: white;
            border: 1px solid #565657;
            border-radius: 8px;
            width: 100%;
        }
        .account-wrapper h3, p{
            color: #ebebeb;
        }
	</style>
</head>

<body class="account-page">

	<div class="main-wrapper">
		<!-- LEFT SIDE CONTAINER -->
		<!-- <div class="left-side ">
			<div class="account-logo">
				<a href="index.php"><img src="img/doh.png" alt="Company Logo"></a>
			</div>
		</div> -->
		<!-- RIGHT SIDE CONTAINER -->
		<div class="account-content">
			<div class="account-wrapper">
				<h3 class="login-header">Sign up</h3>
				<p class="login-subheader">Please enter your information</p>

				<!-- Display Bootstrap alert for incorrect credentials -->
				<?php
				if (isset($_POST['login']) && $total === 0) {
					echo '<div class="alert alert-danger" role="alert">Incorrect Credentials!</div>';
				}
				?>

				<form method="POST" enctype="multipart/form-data">
					<div class="form-group">
						<input class="form-control" type="text" name="username" placeholder="Firstname" id="username" required>
					</div>

					<div class="form-group">
						<input class="form-control" type="password" name="password" placeholder="Lastname" id="password" required>
					</div>
                    <div class="form-group">
						<input class="form-control" type="text" name="username" placeholder="Middlename" id="username" required>
					</div>

					<div class="form-group">
						<input class="form-control" type="password" name="password" placeholder="Gender" id="password" required>
					</div>
                    <div class="form-group">
						<input class="form-control" type="text" name="username" placeholder="Age" id="username" required>
					</div>

					<div class="form-group">
						<input class="form-control" type="password" name="password" placeholder="Address" id="password" required>
					</div>
                    <div class="form-group">
						<input class="form-control" type="text" name="username" placeholder="Email" id="username" required>
					</div>

					<div class="form-group">
						<input class="form-control" type="password" name="password" placeholder="password" id="password" required>
					</div>

					<div class="form-group text-center">
						<div class="col-auto pt-2">
							<a class="float-left forgot-password" href="Login.php">
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