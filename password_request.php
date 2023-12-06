<?php
session_start();

include_once("connections/connection.php");
$con = connection();
$id = $_GET['admin_id'];

$sql = "SELECT * FROM admin_users WHERE admin_id = '$id'";
$students = $con->query($sql) or die($con->error);
// Check if the query returned any results
if ($students->num_rows > 0) {
  $row = $students->fetch_assoc();

  // Check if the 'password' key exists in $row before trying to access it
  $currentPasswordValue = isset($row['password']) ? $row['password'] : '';
} else {
  // Handle the case where no results were found (optional)
  $currentPasswordValue = '';
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Assuming you have the user ID available
  $userID = $_POST['userID'];
  $currentPassword = $_POST['currentPassword'];
  $newPassword = $_POST['newPassword'];

  // Perform your database update logic here
  // Example: Update the password in the user_list table
  $query = "UPDATE admin_users SET password = '$newPassword' WHERE id = $userID AND password = '$currentPassword'";
  $result = mysqli_query($con, $query);

  if ($result) {
    echo "Password changed successfully!";
  } else {
    echo "Error changing password!";
  }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $userID = $_POST['userID'];

  // Perform your database deletion logic here
  $query = "DELETE FROM user_list WHERE id = $userID";
  $result = mysqli_query($con, $query);

  if ($result) {
    echo "Row deleted successfully!";
  } else {
    echo "Error deleting row!";
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
  <title>PCC HRMS</title>

  <!-- Favicon -->
  <link rel="shortcut icon" type="image/x-icon" href="assets/img/pcc-logo.svg">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">

  <!-- Fontawesome CSS -->
  <link rel="stylesheet" href="assets/css/font-awesome.min.css">

  <!-- Lineawesome CSS -->
  <link rel="stylesheet" href="assets/css/line-awesome.min.css">

  <!-- Datatable CSS -->
  <link rel="stylesheet" href="assets/css/dataTables.bootstrap4.min.css">

  <!-- Select2 CSS -->
  <link rel="stylesheet" href="assets/css/select2.min.css">

  <!-- Datetimepicker CSS -->
  <link rel="stylesheet" href="assets/css/bootstrap-datetimepicker.min.css">

  <!-- Main CSS -->
  <link rel="stylesheet" href="assets/css/style.css">

  <style>
    body {
      background-color: #D4DEDB;
    }

    .body-container {
      background-color: #FAFAFA;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
    }

    table {
      text-align: center;
      border: 1px solid #285D4D;
    }

    .page-title {
      font-size: 1.3rem;
      color: #204A3D;
    }
  </style>
</head>

<body>
  <div class="main-wrapper">

    <?php include_once("includes/header.php"); ?>
    <?php include_once("includes/sidebar.php"); ?>

    <div class="page-wrapper">
      <div class="content container-fluid">
        <div class="body-container">


          <div class="page-header">
            <div class="row align-items-center">
              <div class="col">
                <h3 class="page-title">CHANGE PASSWORD REQUEST</h3>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="table-responsive">
                <table class="table table-striped custom-table datatable">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Date of Request</th>
                      <th>Department</th>
                      <th class="text-right no-sort">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Heionim</td>
                      <td>11-22-23</td>
                      <td>Human Resource</td>
                      <td class="text-right">
                      <a href="#" data-toggle="modal" name="id" data-target="#decline_password_request" data-id="<?php echo $row['id']; ?>" title="Decline" class="btn text-xs text-white btn-danger action-icon decline-password-btn">
                        <i class="fa fa-times"></i> Decline
                      </a>

                        <a href="#" data-toggle="modal" data-target="#change_password" title="Change" class="btn text-xs text-white btn-success action-icon change-password-btn">
                          <i class="fa fa-check"></i> Change
                        </a>

                      </td>

                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- FOR MODAL PURPOSES -->

                <!-- Modal for Change Password -->
          <div id="change_password" class="modal fade" role="dialog">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Change Password</h5>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                  <form id="changePasswordForm">
                    <div class="form-group">
                      <label for="currentPassword">Current Password:</label>
                      <input type="text" class="form-control" id="currentPassword" value="<?php echo $currentPasswordValue; ?>" name="currentPassword" readonly>
                    </div>
                    <div class="form-group">
                      <label for="newPassword">New Password:</label>
                      <input type="text" class="form-control" id="newPassword" name="newPassword" readonly>
                    </div>
                    <button type="submit" class="btn btn-success">Change Password</button>
                  </form>
                </div>
              </div>
            </div>
          </div>


    </div>
  </div>


  <!-- jQuery -->
  <script src=" assets/js/jquery-3.2.1.min.js"></script>

  <!-- Bootstrap Core JS -->
  <script src="assets/js/popper.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>

  <!-- Slimscroll JS -->
  <script src="assets/js/jquery.slimscroll.min.js"></script>

  <!-- Select2 JS -->
  <script src="assets/js/select2.min.js"></script>

  <!-- Datetimepicker JS -->
  <script src="assets/js/moment.min.js"></script>
  <script src="assets/js/bootstrap-datetimepicker.min.js"></script>

  <!-- Datatable JS -->
  <script src="assets/js/jquery.dataTables.min.js"></script>
  <script src="assets/js/dataTables.bootstrap4.min.js"></script>

  <!-- Custom JS -->
  <script src="assets/js/app.js"></script>

  <!-- <script>
$(document).ready(function () {
  // Handle decline password button click
  $('.decline-password-btn').on('click', function () {
    // Get the ID of the row to be deleted
    var userID = $(this).data('id');

    // Reference to the clicked button for later use inside AJAX success callback
    var clickedButton = $(this);

    // Perform an AJAX request to delete the row
    $.ajax({
      type: 'POST',
      url: 'password_request.php', // Replace with the actual backend script
      data: { userID: userID },
      success: function (response) {
        // Handle the response from the server
        console.log(response);

        // Check if the row was deleted successfully before removing it from the table
        if (response.trim() === 'Row deleted successfully!') {
          // Remove the corresponding row from the table
          clickedButton.closest('tr').remove();
        } else {
          // Handle the case where the row deletion was not successful (optional)
          console.error("Error deleting row:", response);
        }
      },
      error: function (error) {
        // Handle the error
        console.error(error);
      }
    });
  });
});
</script> -->



  <!-- <script>
  $(document).ready(function () {
    // Password generation function
    function generatePassword(fname, lname, empID) {
      return fname.substring(0, 3) + lname.slice(-3) + empID.slice(-4);
    }

    // Handle change password button click
    $('.change-password-btn').on('click', function () {
      // Assuming you have the user data available, replace these values accordingly
      var fname = 'UserFirstName';
      var lname = 'UserLastName';
      var empID = 'UserEmpID';

      // Generate a new password
      var newPassword = generatePassword(fname, lname, empID);

      // Update the value in the modal input field
      $('#newPassword').val(newPassword);
    });

    // Handle form submission for password change
    $('#changePasswordForm').submit(function (event) {
      event.preventDefault();

      // Perform AJAX request to update the password in the database
      var currentPassword = $('#currentPassword').val();
      var newPassword = $('#newPassword').val();

      // Assuming you have the user ID available, replace 'userID' with the actual user ID
      var userID = 1; // Replace with the actual user ID

      // Perform an AJAX request to update the password in the database
      $.ajax({
        type: 'POST',
        url: 'change_password_backend.php', // Replace with the actual backend script
        data: {
          userID: userID,
          currentPassword: currentPassword,
          newPassword: newPassword
        },
        success: function (response) {
          // Handle the response from the server
          console.log(response);

          // Close the modal
          $('#change_password').modal('hide');
        },
        error: function (error) {
          // Handle the error
          console.error(error);
        }
      });
    });
  });
</script> -->


</body>

</html>