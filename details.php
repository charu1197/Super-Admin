<?php

session_start();

if (!isset($_SESSION['admin_name'])) {
    header("location: login.php");
    exit();
}

include_once("connections/connection.php");

$con = connection();

$id = $_GET['ID'];

$sql = "SELECT * FROM admin_users WHERE admin_id = $1";
$result = pg_query_params($con, $sql, array($id)) or die(pg_last_error($con));

$row = pg_fetch_assoc($result);

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
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/details">
    <link rel="stylesheet" href="css/details2.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
      #backFoot h5{
font-size: 8px;
margin-left: 2em;
}
.logoBack img{
height: 55px;
width: 55px;
margin-right:-7em;
margin-top: -2.2em;
margin-left: -8em;

}
.id-card{
  border: 1px solid #e8e8e8;
}
.print-button{
    display: none;
}
         @media print {
        body {
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        /* Add any additional print styles here */
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
    
        
    <!-- <div class="back-btn"><br><br>
    <a href="index.php" class="button-link2">
    <button class="custom-button2">&larr; Back</button>
     </a>
    </div> -->


    <div class="details-container" id="details-view">
    

        
            <h2 id="ap">Account Profile</h2>
        

    <div class="user-details">
      <div id="phname">
        <img src="<?php echo $row['photo']; ?>" alt="User Photo">
            <div class="c">
                <h4 id="FL"><?php echo $row['firstname'] . ' ' . $row['middlename'] . ' ' . $row['lastname']; ?></h4>
                <h4><?php echo $row['department']; ?> Admin</h4>
            </div>
      </div>
                
            <p id="PI">Personal Information</p>

            <div class="details-info">
    <div class="left-col">
        <div>
          
            <label for="">Gender:</label>
            <h4><?php echo $row['gender']; ?></h4>
        </div>
        <div>
            <label for="">Age:</label>
            <h4><?php echo $row['age']; ?></h4>
        </div>
        <div>
            <label for="">Email:</label>
            <h4><?php echo $row['email']; ?></h4>
        </div>
    </div>

    <div class="middle-col">
        <div>
            <label for="">Contact:</label>
            <h4><?php echo $row['contact']; ?></h4>
        </div>
        <div>
            <label for="">Address:</label>
            <h4><?php echo $row['address']; ?></h4>
        </div>
        <div>
            <label for="">Employee ID:</label>
            <h4><?php echo $row['emp_id']; ?></h4>
        </div>
    </div>

    <div class="right-col">
        <div>
            <label for="">Date Created:</label>
            <h4><?php echo $row['date_created']; ?></h4>
        </div>
        <div>
            <label for="">Password:</label>
            <h4><?php echo $row['password']; ?></h4>
        </div>
    </div>

    <div style="clear:both;"></div>

    
</div>

           
        </div>

         <center>
         <br><br>
         <button class="print-button" id="pid" onclick="openIDCardModal()">Print ID Card</button>
         </center>       
       

    </div>


    <div class="modal fade" id="idCardModal" tabindex="-1" role="dialog" aria-labelledby="idCardModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="idCardModalLabel">ID Card Preview</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="idCardPreview">
                <!-- ID Card content will be displayed here -->
                <!-- ID Card -->
                
    <div class="id-card-container" id="id-card-print">
    <div class="id-card">
  <div class="header11">
        <div>
            <img src="img/doh.png" alt="">
        </div>
        <div>
            <h2>Philippine </h2>
            <h4>Cancer Center</h4>
        </div>
        

  </div>

  <div class="profile-picture">
    <img src="<?php echo $row['photo']; ?>" alt="">
  </div>

  <div class="details">
    <p><?php echo $row['firstname'] . ' ' . $row['lastname']; ?></p>
    <hr>
    <h4><?php echo $row['department']; ?> Admin</h4>
  </div>
  
<center>
<div class="id-number">
    <p><strong>ID No. </strong><?php echo $row['empID']; ?></p>
  </div>
</center>
  
    </div>



 <!-- ID back -->


    <div class="id-card">
  
    <div class="backID">
    <p><strong>Address: </strong> <?php echo $row['address']; ?></p>
    <p><strong>Email: </strong> <?php echo $row['email']; ?></p>
    <p><strong>Contact No.: </strong> <?php echo $row['contact']; ?></p>
    <p><strong>Valid Until: </strong> <?php echo date("F, Y", strtotime("+365 days")); ?></p>
    </div>
   
<center>
    <div class="sign">
    </div>
    
    <p>Signature</p>
    </center>
    <div class="logoBack">
        <div>
            <img src="img/doh.png" alt="">
        </div>
        <div id="backFoot">
            <h5>(02) 8995 3846</h5>
            <h5>6512 Quezon Avenue, Lung Center of the Philippines Compound <br>
            Diliman, Quezon City, 1101</h5>
            <h5>pccmo@doh.gov.ph</h5>

        </div>
        
  </div>
  
  
    </div>
           <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="printIDCard()">Print</button>
            </div>
            </div>
            
        </div>
    </div>
</div>

    <!-- ID back -->

    
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

   <!-- Add this script block after your existing script block -->

<script>
    function openIDCardModal() {
        // Clone the modal content and append it to the preview area
        var idCardContent = document.getElementById("id-card-print").cloneNode(true);
        document.getElementById("idCardPreview").innerHTML = "";
        document.getElementById("idCardPreview").appendChild(idCardContent);
        // Show the modal
        $('#idCardModal').modal('show');
    }

    function printIDCard() {
        // Get the original content of the body
        var originalContent = document.body.innerHTML;
        // Get the content of the modal preview
        var idCardContent = document.getElementById("idCardPreview").innerHTML;

        // Set the body content to the modal preview content
        document.body.innerHTML = idCardContent;

        // Print the ID card
        window.print();

        // Reset the body content to the original content
        document.body.innerHTML = originalContent;

        // Hide the modal
        $('#idCardModal').modal('hide');
        
        // Clear the modal preview content
        document.getElementById("idCardPreview").innerHTML = "";
    }

    // Add an event listener to reset the modal content when it is closed
    $('#idCardModal').on('hidden.bs.modal', function () {
        document.getElementById("idCardPreview").innerHTML = "";
    });
</script>


  

    <script>
        

    //     function printCertificate() {
    //     var certificateContent = document.getElementById("certificate-print").innerHTML;
    //     var originalContent = document.body.innerHTML;

    //     document.body.innerHTML = certificateContent;

    //     window.print();

    //     document.body.innerHTML = originalContent;
    // }

    function printIDCard() {
        var idCardContent = document.getElementById("id-card-print").innerHTML;
        var originalContent = document.body.innerHTML;

        document.body.innerHTML = idCardContent;

        window.print();

        document.body.innerHTML = originalContent;
    }
    </script>

</body>
</html>