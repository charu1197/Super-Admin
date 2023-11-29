<?php
session_start();

// if (!isset($_SESSION['UserLogin'])) {
//   header("location: login.php");
//   exit();
// }

include_once("connections/connection.php");
$conn = connection();

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
                        <a href="#" data-toggle="modal" data-target="#decline_password_request" title="Decline" class="btn text-xs text-white btn-danger action-icon">
                          <i class="fa fa-times"></i> Decline
                        </a>
                        <a href="#" data-toggle="modal" data-target="#change_password" title="Change" class="btn text-xs text-white btn-success action-icon">
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
</body>

</html>