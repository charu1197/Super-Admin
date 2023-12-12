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
	<link rel="shortcut icon" type="image/x-icon" href="assets/img/pcc-logo.svg">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@latest/dist/sweetalert2.min.css">
    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-..">
    <!-- Include SweetAlert2 stylesheet -->

    <!-- Main CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="css/login.css">

	   <!-- jQuery -->
<script src="assets/js/jquery-3.2.1.min.js"></script>

<!-- SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@latest"></script>

<!-- Bootstrap Core JS -->
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>

<!-- Custom JS -->
<script src="assets/js/app.js"></script>
</head>

<body class="account-page">

    <?php
    session_start();

    // Check for error messages in the session
    if (isset($_SESSION['emptyfields'])) {
        $error = $_SESSION['emptyfields'];
        // Clear the session error variable
        unset($_SESSION['emptyfields']);

        // Display the error for empty fields
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '$error',
            });
        </script>";
    }

    // Check for error messages in the session
    if (isset($_SESSION['notregistered'])) {
        $error = $_SESSION['notregistered'];
        // Clear the session error variable
        unset($_SESSION['notregistered']);

        // Display the error for not registered emails
        echo "<script>
            Swal.fire(
                'Error!',
                '$error',
                'error'
            );
        </script>";
    }

    if (isset($_SESSION['incorrectpass'])) {
        $error = $_SESSION['incorrectpass'];
        // Clear the session error variable
        unset($_SESSION['incorrectpass']);

        // Display the error for incorrect password 
        echo "<script>
            Swal.fire(
                'Error!',
                '$error',
                'error'
            );
        </script>";
    }
    ?>

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

                <form action="functions/login-function.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <i class="fas fa-user icon"></i>
                        <input class="form-control" type="email" name="email" placeholder="email" id="email">
                    </div>

                    <div class="form-group">
                        <i class="fas fa-lock icon"></i>
                        <input class="form-control" type="password" name="password" placeholder="password" id="password">
                    </div>

                    <div class="form-group text-center">
                        <div class="col-auto pt-2">
                            <!-- forget pass -->
                            <a class="float-left forgot-password" href="forgot-section.php">
                                Forgot password?
                            </a>
                            <!-- sign up -->
                            <a class="float-right forgot-password" href="signup.php">
                                Sign up
                            </a>
                        </div>
                        <button class="btn btn-primary login-btn" name="login" type="submit">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



</body>

</html>
