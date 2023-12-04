<?php

session_start();

if (!isset($_SESSION['UserLogin'])) {
  header("location: login.php");
  exit();
}

include_once("connections/connection.php");
$con = connection();
$id = $_GET['ID'];

$sql = "SELECT * FROM admin_users WHERE id = '$id'";
$students = $con->query($sql) or die($con->error);
$row = $students->fetch_assoc();

if (isset($_POST['submit'])) {

  $fname = $_POST['firstname'];
  $lname = $_POST['lastname'];
  $mname = $_POST['middlename'];
  $gender = $_POST['gender'];
  $age = $_POST['age'];
  $email = $_POST['email'];
  $contact = $_POST['contact'];
  $address = $_POST['address'];
  $department = $_POST['department'];
  $empID = $_POST['empID'];
  $date = $_POST['date'];
  $password = $_POST['password'];

  $sql = "UPDATE admin_users SET firstname = '$fname', lastname = '$lname', middlename = '$mname', age = '$age', email = '$email', contact = '$contact', address = '$address', department = '$department', empID = '$empID', added_at = '$date', password = '$password' WHERE id = '$id'";

  $con->query($sql) or die($con->error);

  // echo header("location: details.php?ID=" . $id);
  echo '<script>
    setTimeout(function(){
        Swal.fire({
            title: "Success!",
            text: "Admin Update successfully",
            icon: "success",
            confirmButtonText: "OK"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "details.php?ID=' . $id . '";
            }
        });
    }, 500);
</script>';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/edit.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <style>
    .container input {
      border-radius: 3em;
      border: 1px solid #b8b8b8;
      outline: none;
      background-color: #ebf5ee;
      padding: 12px;
      width: 100%;
      padding-left: 20px;
    }

    .container select {
      border-radius: 3em;
      border: 1px solid #b8b8b8;
      outline: none;
      background-color: #ebf5ee;
      padding: 12px;
      width: 100%;
      margin-bottom: 1em;
    }

    .submit-btn input {
      background-color: #46a362;
      color: white;
      font-weight: bold;
      border: none;
    }

    .page-wrapper {
      padding: 2em;

    }

    .cont {
      padding: 2em;
      padding-bottom: 3em;
      border-radius: 10px;
      background-color: white;
      width: 100%;
      box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
    }

    #address {
      margin-top: 11px;
    }
  </style>
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">

  <!-- Fontawesome CSS -->
  <link rel="stylesheet" href="assets/css/font-awesome.min.css">

  <!-- Lineawesome CSS -->
  <link rel="stylesheet" href="assets/css/line-awesome.min.css">

  <!-- Chart CSS -->
  <link rel="stylesheet" href="assets/plugins/morris/morris.css">

  <!-- Main CSS -->
  <link rel="stylesheet" href="assets/css/style.css">

  <!-- SweetAlert2 CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

  <!-- SweetAlert2 JS -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

</head>

<body>

  <div class="main-wrapper">

    <!-- Header -->
    <?php include_once("includes/header.php"); ?>

    <!-- Sidebar -->
    <?php include_once("includes/sidebar.php"); ?>
    <div class="page-wrapper">
      <div class="content container-fluid">
        <div class="cont">

          <!-- <div class="back-btn">
    <a href="index.php" class="button-link2">
    <button class="custom-button2">&larr; Back</button>
     </a>
    </div> -->
          <h2 id="info-txt">Edit Admin</h2>
          <hr>

          <div class="container">
            <form action="" class="minimal-form" method="post" onsubmit="return confirmSubmission();">
              <div class="row">
                <!-- Left Column -->
                <div class="col-md-6">
                  <br><br><br>
                  <h3 id="info-txt">Personal Information</h3>
                  <br>

                  <label>Given name</label>
                  <input type="text" name="firstname" id="firstname" value="<?php echo $row['firstname']; ?>">

                  <label>Surname</label>
                  <input type="text" name="lastname" id="lastname" value="<?php echo $row['lastname']; ?>">

                  <label>Middle name</label>
                  <input type="text" name="middlename" id="middlename" value="<?php echo $row['middlename']; ?>">

                  <!-- <label>Year</label>
        <input type="number" id="year" name="year" min="1900" max="2100"> -->
                  <label>Gender</label>
                  <select name="gender" id="gender">
                    <option value="Male" <?php echo ($row['gender'] == 'Male') ? 'selected' : ''; ?>>Male</option>
                    <option value="Female" <?php echo ($row['gender'] == 'Female') ? 'selected' : ''; ?>>Female</option>
                  </select>


                  <label>Age</label>
                  <input type="text" name="age" id="age" value="<?php echo $row['age']; ?>">

                  <label>Email Address</label>
                  <input type="email" name="email" id="email" value="<?php echo $row['email']; ?>">
                  <script>
                    // Function to update the "Email" field based on the "Email Address" field
                    function updateEmail() {
                      var emailAddress = document.getElementById('email').value;
                      document.getElementById('auto-email').value = emailAddress; // Fix the ID here
                    }

                    // Attach the function to the "input" event of the "Email Address" field
                    document.getElementById('email').addEventListener('input', updateEmail);
                  </script>

                  <label>Contact Number</label>
                  <input type="text" name="contact" id="contact" value="<?php echo $row['contact']; ?>">
                </div>

                <!-- Right Column -->
                <div class="col-md-6">
                  <br><br><br><br><br>
                  <label>Address</label>
                  <input type="text" name="address" id="address" value="<?php echo $row['address']; ?>">

                  <label>Department</label>
                  <select name="department" id="department">
                    <option value="HR" <?php echo ($row['department'] == 'HR') ? 'selected' : ''; ?>>HR</option>
                    <option value="Inventory" <?php echo ($row['department'] == 'Inventory') ? 'selected' : ''; ?>>INVENTORY</option>
                    <option value="Repository" <?php echo ($row['department'] == 'Repository') ? 'selected' : ''; ?>>REPOSITORY</option>
                  </select>

                  <label>From Auto Generated Employee ID</label>
                  <input type="text" name="empID" placeholder="you don't have to type here... " id="empID" value="<?php echo $row['empID']; ?>">


                  <label>From Auto Date Created</label>
                  <input type="date" name="date" id="date" readonly value="<?php echo date('Y-m-d', strtotime($row['added_at'])); ?>">
                  <br>
                  <br>
                  <br>
                  <br>

                  <h3 id="info-txt">Account Information</h3>

                  <label>Email Address</label>
                  <input type="text" name="auto-email" id="auto-email" value="<?php echo $row['email']; ?>" readonly>

                  <label>From Auto Generated Password</label>
                  <input type="text" name="password" placeholder="you don't have to type here... " id="password" value="<?php echo $row['password']; ?>">
                </div>

                <!-- New Row for Gender -->

              </div>

              <!-- Centered Submit Button -->
              <div class="col-md-12 text-center">


                <br>
                <div class="submit-btn">
                  <input type="submit" name="submit" value="&#10004; Update" required>
                </div>
              </div>
            </form>
          </div>
        </div>


      </div>
    </div>

  </div>



  <script src="assets/js/jquery-3.2.1.min.js"></script>

  <!-- Bootstrap Core JS -->
  <script src="assets/js/popper.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>

  <!-- Slimscroll JS -->
  <script src="assets/js/jquery.slimscroll.min.js"></script>

  <!-- Chart JS -->
  <script src="assets/plugins/morris/morris.min.js"></script>
  <script src="assets/plugins/raphael/raphael.min.js"></script>
  <script src="assets/js/chart.js"></script>

  <!-- Custom JS -->
  <script src="assets/js/app.js"></script>

  <script>
    function confirmSubmission() {
      var confirmation = confirm("Are you sure that the information details are correct? Before you update the information");
      return confirmation;
    }
  </script>


</body>

</html>