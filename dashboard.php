<?php

// if (!isset($_SESSION)) {
//     session_start();
// }

session_start();

if (!isset($_SESSION['UserLogin'])) {
    header("location: login.php");
    exit();
  }


include_once("connections/connection.php");
//include_once('uth.php');


$con = connection();

$sql = "SELECT COUNT(*) as totalAdmins FROM user_list WHERE department IN ('HR', 'INVENTORY', 'REPOSITORY')";
$result = $con->query($sql) or die($con->error);
$row = $result->fetch_assoc();
$totalAdmins = $row['totalAdmins'];

$today = date('Y-m-d'); // Get the current date
$sqlActivity = "SELECT COUNT(*) as totalActivities FROM activity_logs WHERE DATE(date_change) = '$today' AND status IN ('active', 'inactive')";
$resultActivity = $con->query($sqlActivity) or die($con->error);
$rowActivity = $resultActivity->fetch_assoc();
$totalActivities = $rowActivity['totalActivities'];


$sql = "SELECT * FROM user_list ORDER BY id DESC";
$students = $con->query($sql) or die($con->error);
$row = $students->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<style>
    body{
        padding-left: 2em;
        padding-right: 2em;
    }
        .page-header {
            background-color: #204A3D;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 5px;
            color: #fff;
        }

        .page-header .breadcrumb-item.active,
        .page-header .welcome h3,
        .page-header .close {
            color: #F0F0F0;
        }

        /* ATTENDANCE TABLE */
        .container {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 1rem 0.5rem;

        }

        h2 {
            font-size: 1rem;
            border-bottom: 2px solid #ccc;
            padding: 0.5rem;
        }

        thead,
        tbody {
            background-color: #d9d9d9;
            color: #204A3D;
            font-size: 0.8rem;
            text-align: center;
        }

        /* CALENDAR CHART */
        #calendar {
            max-width: 600px;
            margin: 0 auto;
            border-collapse: collapse;
        }

        #calendar th,
        #calendar td {
            width: 14.28%;
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
        }

        #calendar th {
            background-color: #f2f2f2;
        }

        .event {
            background-color: #4CAF50;
            color: #fff;
            padding: 2px;
            border-radius: 4px;
            display: block;
            margin-top: 5px;
        }

        #month-year {
            text-align: center;
            margin-bottom: 10px;
        }
        #dash{
            font-size: 20px;
            font-weight: bold;
            color :#4d4d4d;
            letter-spacing: -.3px;
        }
  #loading-screen {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: #fff;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  z-index: 9999; /* Ensure the loading screen is on top */
}

#loading-bar {
  width: 0;
  height: 5px;
  background-color: #204A3D;
  margin-top: 20px;
  transition: width 0.5s ease;
}

#loading-screen img {
  max-width: 10%;
  height: auto;
}

#main-wrapper {
  display: none; /* Initially hide the main content */
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
<div id="loading-screen">
    <img src="img/doh.png" alt="Logo">
    <div id="loading-bar"></div>
  </div>

    <!-- Main Wrapper -->
    <div class="main-wrapper">

        <!-- Header -->
        <?php include_once("includes/header.php"); ?>

        <!-- Sidebar -->
        <?php include_once("includes/sidebar.php"); ?>

        <div class="page-wrapper">
            <div class="content container-fluid">

                <!-- WELCOME MESSAGE -->
                <p id="dash">Dashboard</p>
                

                <!-- METRICS -->
                <div class="row">
                        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-6">
                            <div class="card dash-widget">
                                <div class="card-body">
                                    <span class="dash-widget-icon"><i class="fa fa-users"></i></span>
                                    <div class="dash-widget-info">
                                        <h3><?php echo $totalAdmins; ?></h3>
                                        <span>Total Admins</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-6">
                        <div class="card dash-widget">
                            <div class="card-body">
                                <span class="dash-widget-icon"><i class="fa fa-user"></i></span>
                                <div class="dash-widget-info">
                                    <h3><?php echo $totalActivities; ?></h3>
                                    <span>Today's Activity</span>
                                </div>
                            </div>
                        </div>
                    </div>
                   
                </div>


                <div class="row">
                    <!-- ATTENDANCE TABLE -->
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-6">
                        <div class="container">
                            <h2 class="mt-3 mb-4">Today's Attendance</h2>

                            <div class="table-responsive">
                                <table class="table table-bordered border-primary">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Time In</th>
                                            <th>Time Out</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- CALENDAR EVENTS SAMPLE -->
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-6">
                        
                        <div class="container">
                            
                            <div class="row">
                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-12">
                        <div class="container mt-2">
                            <div class="row">
                                <div class="col-md-16 mx-auto">
                                    <div id="chartContainer" style="width: 400px; max-height: 500px;">
                                        <canvas id="absenceChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
                        $absence_rate = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
                        ?>

                        <!-- RENDER CHART JS -->
                        <script>
                            let months = <?php echo json_encode($months); ?>;
                            let absenceRate = <?php echo json_encode($absence_rate); ?>;

                            let ctx = document.getElementById('absenceChart').getContext('2d');
                            let myChart = new Chart(ctx, {
                                type: 'bar',
                                data: {
                                    labels: months,
                                    datasets: [{
                                        label: 'Absence Rate (%)',
                                        data: absenceRate,
                                        backgroundColor: '#FCD937',
                                    }]
                                },
                                options: {
                                    scales: {
                                        y: {
                                            beginAtZero: true,
                                            max: 10
                                        }
                                    }
                                }
                            });
                        </script>
                    </div>
                </div>
                        </div>
                    </div>
                </div>


                <!-- ABSENCE RATE CHART -->
                


            </div>
        </div>

    </div>
    

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                        
    <!-- jQuery -->
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
        document.addEventListener("DOMContentLoaded", function() {
  const loadingBar = document.getElementById("loading-bar");

  let progress = 0;
  const interval = setInterval(function() {
    if (progress < 100) {
      progress += 1;
      loadingBar.style.width = progress + "%";
    } else {
      clearInterval(interval);
      
      // You can add code here to hide the loading screen or navigate to the next page
      document.getElementById("loading-screen").style.display = "none";
    }
  }, 20);
});

    </script>
</body>

</html>
