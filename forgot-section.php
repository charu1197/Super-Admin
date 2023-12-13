<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Forgot password</title>
        <!-- Include SweetAlert library -->
        	<!-- Favicon -->
	    <link rel="shortcut icon" type="image/x-icon" href="assets/img/pcc-logo.svg">
        <link rel="stylesheet" href="css/fortgot-pass.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" />
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@latest"></script>

                  <!-- Main CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
   
    </head>

    <body>
    <div class="left-side">
                  <!-- Content for the authentication side goes here -->
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

                      ?>
                <span class="align-1">Forgot Password</span>
        <div class="align-2">
               <!-- Content for the authentication side goes here -->
    <span>No worries, we'll send you reset instructions</span>

      </div>
                       

    <div class="col-md-6 side-image factor">
        <div class="input-box">
                <form action="functions/forgotpass-function.php" method="post" class="factor">
                <div class="form-group">
						<i class="fas fa-envelope icon"></i>
						<input class="form-control" name="email"  type="text" placeholder="Email">
					</div>
                
          <div class="card__form">
            <button type="submit" class="sign-up">Reset password</button>
          </div>
            
          <div class="resend-design">
            <div class="backsgnin">
            <a href="login.php" class="arrow-sign"><i class="fas fa-long-arrow-alt-left"></i>&nbsp; Back to Log in</a>
            </div>
        </div>

        
       
        </form>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>

  <div class="right-side">
    <div class="upper-side">
      <!-- Add your logo for the upper right side -->
      <img src="assets/img/Logo.png" alt="Logo">
    </div>
    <!-- Add your image for the right side -->
    <img src="assets/img/Forgot_img.png" alt="Two-Factor Authentication Image">
  </div>
</body>

</html>
