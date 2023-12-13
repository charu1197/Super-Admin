<?php
    include "functions/request-check.php";
    ?>
   <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $_SESSION['admin_name']?>, Verify your account</title>
	    <link rel="shortcut icon" type="image/x-icon" href="assets/img/pcc-logo.svg">
        <link rel="stylesheet" href="css/authentication.css"> 
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@latest/dist/sweetalert2.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" />
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@latest"></script>
            <!-- Main CSS -->
    <link rel="stylesheet" href="assets/css/style.css">

        <!-- Add the input validation script -->
      
        <script>
        function moveToNextOrBackspace(event, currentInput, nextInputId, prevInputId) {
            const key = event.data || event.inputType;

            // If the key is backspace and the input is empty, move focus to the previous input
            if ((key === 'deleteContentBackward' || key === 'Backspace') && currentInput.value.length === 0 && prevInputId) {
                const prevInput = document.getElementById(prevInputId);
                if (prevInput) {
                    prevInput.focus();
                }
                return;
            }

            // If the input is filled, move focus to the next input
            if (currentInput.value.length === currentInput.maxLength && nextInputId) {
                const nextInput = document.getElementById(nextInputId);
                if (nextInput) {
                    nextInput.focus();
                }
            }
        }
    </script>
    </head>

    <body>
    <div class="left-side">

    <?php

// Check for error messages in the session
if (isset($_SESSION['error'])) {
    $error = $_SESSION['error'];
    // Clear the session error variable
    unset($_SESSION['error']);
    ?>

      <script>
        Swal.fire(
            'Error!',
            'Incorrect verification code',
            'error'
        )

        
    </script>
  
<?php } ?>

<?php
  // Check if verification is successful
  if (isset($_SESSION['request_success']) && $_SESSION['request_success']) {
      // Display SweetAlert to ask the user whether they want to save data
      ?>
      <script>
         // Display a success message using SweetAlert
         Swal.fire({
             icon: 'success',
             title: 'You have just submitted a password change request',
             text: 'Be patient while we dispatch the recovery email to your provided email address.',
         }).then(function() {
             // Redirect to login.php after clicking OK
             window.location.href = 'login.php';
         });
      </script>
      <?php
      // Reset the session variable
      $_SESSION['request_success'] = false;
  }
?>

                              <!-- Content for the authentication side goes here -->
        
                <span class="align-1">Two Factor Authentication</span>
        <div class="align-2">
               <!-- Content for the authentication side goes here -->
    <span >We sent a code to <strong><?php echo $_SESSION['admin_email'];?></strong></span>

      </div>
                       

    <div class="col-md-6 side-image factor">
        <div class="input-box">
                <form action="functions/request-verify.php" method="post" class="factor">

                <div class="row">
        <div class="input-field">
               <!-- Content for the authentication side goes here -->
                    <input type="text" maxlength="1" pattern="\d" oninput="moveToNextOrBackspace(event, this, 'input2', null)" name="request_code[]" required>
                    <input type="text" maxlength="1" pattern="\d" id="input2" oninput="moveToNextOrBackspace(event, this, 'input3', 'input1')" name="request_code[]" required>
                    <input type="text" maxlength="1" pattern="\d" id="input3" oninput="moveToNextOrBackspace(event, this, 'input4', 'input2')" name="request_code[]" required>
                    <input type="text" maxlength="1" pattern="\d" id="input4" oninput="moveToNextOrBackspace(event, this, 'input5', 'input3')" name="request_code[]" required>
                    <input type="text" maxlength="1" pattern="\d" id="input5" oninput="moveToNextOrBackspace(event, this, null, 'input4')" name="request_code[]" required>
                
                    <div class="card__form">
            <button type="submit" class="sign-up">Continue</button>
          </div>
            
          <div class="resend-design">
            <span>Didn't receive an email?<button type="button" id="resendBtn"><strong>Click to resend</strong></button><span>
            <div class="backsgnin">
            <a href="forgot-section.php" class="arrow-sign"><i class="fas fa-long-arrow-alt-left"></i>&nbsp; Back to forgot section</a>
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
    <img src="assets/img/2FA_img.png" alt="Two-Factor Authentication Image">
  </div>
</body>
</html>
