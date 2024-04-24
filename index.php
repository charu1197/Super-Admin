<?php
session_start();
include_once("connections/connection.php");

$db_connection = pg_connect("user=postgres.tcfwwoixwmnbwfnzchbn password=sbit4e-4thyear-capstone-2023 host=aws-0-ap-southeast-1.pooler.supabase.com port=5432 dbname=postgres");

// Queries for Total Users in Metrics
$sql = "SELECT 
            (SELECT COUNT(*) FROM admin_users WHERE department = 'HR') as total_hr,
            (SELECT COUNT(*) FROM admin_users WHERE department = 'Repository') as total_repository,
            (SELECT COUNT(*) FROM admin_users WHERE department = 'Inventory') as total_inventory";

$result = pg_query($db_connection, $sql);
$row = pg_fetch_assoc($result);

$totalHR = $row['total_hr'];
$totalRepository = $row['total_repository'];
$totalInventory = $row['total_inventory'];


$sql = "SELECT * FROM admin_users ORDER BY admin_id DESC";
$students = pg_query($db_connection, $sql) or die("SQL Error: " . pg_last_error($db_connection));
$row = pg_fetch_assoc($students);
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

    <style>
        body {
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

        #dash {
            font-size: 20px;
            font-weight: bold;
            color: #4d4d4d;
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
            z-index: 9999;
            /* Ensure the loading screen is on top */
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
            display: none;
            /* Initially hide the main content */
        }

        .card-align {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .card-height {
            height: 160px;

        }
    </style>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/pcc-logo.svg">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">

    <!-- Lineawesome CSS -->
    <link rel="stylesheet" href="assets/css/line-awesome.min.css">

    <!-- Chart CSS -->
    <link rel="stylesheet" href="assets/plugins/morris/morris.css">

    <!-- Main CSS -->
    <link rel="stylesheet" href="assets/css/style.css">

    <!-- BAR CHART -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <!-- Main Wrapper -->
    <div class="main-wrapper">

        <?php include_once("includes/header.php"); ?>
        <?php include_once("includes/sidebar.php"); ?>

        <div class="page-wrapper">
            <div class="content container-fluid">

                <!-- METRICS -->
                <div class="row">
                    <!-- <div class="col-md-3 col-sm-3 col-lg-3 col-xl-3">
                        <div class="card dash-widget card-height">
                            <div class="card-body card-align">
                                <span class="dash-widget-icon"><i class="fa fa-users"></i></span>
                                <div class="dash-widget-info">
                                    <h3><?php echo $totalHR; ?></h3>
                                    <span>Total HR<br>Users</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-3 col-lg-3 col-xl-3">
                        <div class="card dash-widget card-height">
                            <div class="card-body card-align">
                                <span class="dash-widget-icon"><i class="fa fa-users"></i></span>
                                <div class="dash-widget-info">
                                    <h3><?php echo $totalInventory; ?></h3>
                                    <span>Total Inventory<br>Users</span>
                                </div>
                            </div>
                        </div>
                    </div> -->

                    <div class="col-md-3 col-sm-3 col-lg-3 col-xl-3">
                        <div class="card dash-widget card-height">
                            <div class="card-body card-align">
                                <span class="dash-widget-icon"><i class="fa fa-users"></i></span>
                                <div class="dash-widget-info">
                                    <h3><?php echo $totalRepository; ?></h3>
                                    <span>Total Repository<br>Users</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="col-md-3 col-sm-3 col-lg-3 col-xl-3">
                        <div class="card dash-widget card-height">
                            <div class="card-body card-align">
                                <span class="dash-widget-icon"><i class="fa fa-user"></i></span>
                                <div class="dash-widget-info">
                                    <?php echo $totalActivities; ?>
                                    <span>Today's Activity</span>
                                </div>
                            </div>
                        </div>
                    </div> -->
                </div>

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12">
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
                                            <td>John Doe</td>
                                            <td>09:00 AM</td>
                                            <td>05:00 PM</td>
                                            <td>Present</td>
                                        </tr>
                                        <tr>
                                            <td>Jane Doe</td>
                                            <td>09:30 AM</td>
                                            <td>04:45 PM</td>
                                            <td>Present</td>
                                        </tr>
                                        <tr>
                                            <td>Alice Smith</td>
                                            <td>10:00 AM</td>
                                            <td>05:30 PM</td>
                                            <td>Absent</td>
                                        </tr>
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

                </div>
            </div>

            <!-- ABSENCE RATE CHART -->
            <div class="row">
                <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12">
                    <div class="container mt-2">
                        <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12">
                            <div id="chartContainer" style="width: 100%; height: 530px;">
                                <center><canvas id="absenceChart"></canvas></center>
                            </div>
                        </div>
                    </div>
                    <?php
                    $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
                    $absence_rate = [42, 33, 25, 17, 22, 32, 18, 18, 43, 29, 0, 0, 0];
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
                                    backgroundColor: '#31A544'
                                }]
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true,
                                        max: 100
                                    }
                                }
                            }
                        });
                    </script>
                </div>
            </div>

        </div>
    </div>


    <!-- SWEET ALERT 2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- jQuery -->
    <script src="assets/js/jquery-3.2.1.min.js"></script>

    <!-- Bootstrap Core JS -->
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <!-- Slimscroll JS -->
    <script src="assets/js/jquery.slimscroll.min.js"></script>

    <!-- Custom JS -->
    <script src="assets/js/app.js"></script>
</body>

</html>