<?php
session_start();

if (!isset($_SESSION['UserLogin'])) {
    header("location: login.php");
    exit();
  }

include_once("connections/connection.php");
//include_once('uth.php');

$con = connection();


?>

<!DOCTYPE html>


<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/activity.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <style>
    .page-wrapper{
      padding: 2em;
      
    }
    .cont{
  padding: 2em;
  padding-bottom: 3em;
  border-radius: 10px;
  background-color: white;
  width: 100%;
  box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
}
thead th {
background-color: white;
border-top: 1px solid #18372E;
border-bottom: 1px solid #18372E;
color: #18372E;
font-size:13px;
padding-top: 1.3em;
padding-bottom: 1.3em;


}
thead th a{
color: #18372E;
}
tbody td{
font-size: 14px;
border-bottom: 1px solid #d3ede6;
background-color: #f2f7f6;
}
tbody tr{
  cursor: pointer;
}


tbody tr:hover {
background-color: #edf5f0;
transition: .3s;
}
thead tr th img{
  width: 17px;
  height: 17px;
  float: right;
}
#view-icon1{
    background-color: #fa3628;
}
#view-icon2{
    background-color: #2cd152;
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

    <!-- page content goes here -->
    
    <h3>Change Password Request</h3>
    <br>
    
    <table>
        <thead>
            <tr>
                <th>Name <img src="img/sort.png"></th>
                <th>Date of Request <img src="img/sort.png"></th>
                <th>Department <img src="img/sort.png"></th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
        
        <tr>
            <td></td>
            <td></td>
            <td></td>
            
            <td id="action-btn">
            <a href="#" class="button-link2">
                    <button class="custom-button3" id="view-icon1">
                        <img src="img/cross.png" alt="View"> Decline
                    </button>
                </a>
                <a href="#" class="button-link3">
                    <button class="custom-button3" id="view-icon2">
                        <img src="img/check.png" alt="View"> Accept
                    </button>
                </a>
            </td>
        </tr>
        
    </tbody>
    </table>





  </div>
  </div>
  <!-- Add this code at the end of your body tag -->
<div id="notificationModal" class="modal">
  <div class="modal-content">
    <span class="close" onclick="closeModal()">&times;</span>
    <h2>Notification</h2>
    <!-- Add your notification content here -->
    <p>You have new notifications!</p>
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
    // Add these functions to the end of your script tag
function openModal() {
  var modal = document.getElementById('notificationModal');
  modal.style.display = 'block';
}

function closeModal() {
  var modal = document.getElementById('notificationModal');
  modal.style.display = 'none';
}

// Close modal if the user clicks outside of it
window.onclick = function(event) {
  var modal = document.getElementById('notificationModal');
  if (event.target == modal) {
    modal.style.display = 'none';
  }
};

      
 
</script>


</body>
</html>
