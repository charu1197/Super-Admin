<?php

session_start();

if (!isset($_SESSION['UserLogin'])) {
    header("location: login.php");
    exit();
  }

if(isset($_SESSION['Access']) && $_SESSION['Access'] == "super_admin"){
    
}else{
    echo header("location: index.php");
}

include_once("connections/connection.php");
//include_once('uth.php');

$con = connection();

$id = $_GET['ID'];




$sql = "SELECT * FROM user_list WHERE id = '$id'";
$students = $con->query($sql) or die ($con->error);
$row = $students->fetch_assoc();

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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        .id-card-container{
            
            display: inline-block;
        }
        .page-wrapper{
  padding: 1.5em;
}
        .id-card {
      height: 600px ;
      width: 360px;
      background-color: #fff;
      border-radius: 15px;
      overflow: hidden;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      position: relative; 
      margin-right: 20px;
      margin-bottom: 1em;
      
    }

    .header11 {
      background-color: #D9DD2D;
      color: #806767;
      text-align: left;
      border-bottom-left-radius: 50%;
      border-bottom-right-radius: 50%;
      padding: 20px 0;
      
      height: 320px;
      padding-top: 1em;
      display: flex;
      align-items: left;
      justify-content: center;
      text-align: center;
    }
    .header11 img{
        height: 50px;
      width: 50px;
      margin-right:15px;

    }
    .header11 h2{
        font-size:35px;
        font-weight: bold;
        color:#806767;
    }
    .header11 h4{
        margin-top: -10px;
        font-size: 20px;
        margin-left: -.9em;
    }

    .profile-picture {
      text-align: center;
      padding: 20px;
      margin-top: -26em;
      margin-bottom: 7em;
    }

    .profile-picture img {
      width: 150px;
      height: 150px;
      border-radius: 50%;
      border: solid 3px green;
      object-fit: cover;
      margin-top: 11.5em;
    }

    .details {
      text-align: center;
      padding: 10px 50px;
    }
    .details p{
        font-weight: bold;
        font-size:40px;
        margin-top: -1.5em;
        letter-spacing:-2px;
    }

    .id-number {
        position: absolute;
  bottom: 0;
  left: 50%;
  transform: translateX(-50%);
  text-align: center;
  background-color: #806666;
  width: 60%;
  border-radius: 11px;
  color: #fff;
  padding: 10px ;
  margin-bottom: 30px;
      
    }
    .id-number p{
        font-size: 18px;
    }
    
    .sign{
        align-items: center;
      justify-content: center;
      text-align: center;
      
    }
    .sign{
        padding:30px;
        width: 70%;
        border: 1px solid black;
        background-color:#F9F9F9;
        border-radius: 8px;
    }

    .sign p{
        font-size: 18px;
        margin-top: 1em;
    }
    .backID{
        margin-left: 3.6em;
        
      margin-right: 30px;
        margin-top: 3em;
        font-size: 18px;
        margin-bottom: 5em;
    }

    .logoBack {
      background-color: #D9DD2D;
      color: #806767;
      text-align: left;
      margin-top:5em;
      padding: 20px 0;
      height: 200px;
      padding-top: 4em;
      display: flex;
      align-items: left;
      justify-content: center;
      text-align: center;
    }
    
    .logoBack img{
        height: 60px;
      width: 60px;
      margin-right:-7em;
      margin-top: -2.2em;
      margin-left: -10em;

    }
    
    .logoBack h4{
        margin-top: -10px;
        font-size: 10px;
        margin-left: -2.5em;
    }
    #backFoot{
        align-items: left;
      justify-content: left;
      text-align: left;
      margin-top: -2em;
      margin-left: 1em;
    }
    #backFoot h5{
      font-size: 12px;
    }

    
    .user-details img{
      height :120px;
      width :120px;
      border-radius: 50%;
      border: solid 2px green;
      object-fit: cover;
      margin-bottom: 4em;
      margin-right: 5em;
      
    }

    #ap{
      margin-bottom: 1em;
    }

    .back-btn{
      margin-top: -3.8em;
    }
    .details-container {
            width:1100px;
            margin: 20px auto;
            background-color: #fff;
            padding: 40 80px;
            border-radius: 8px;
            box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;
        }

        

        .details-container h2 {
            text-align: left;
            color: #333;
        }

        .details-container .user-details {
            margin-top: 20px;
        }

        .details-container h4 {
            margin-bottom: 10px;
            color: #555;
        }

        .details-container .profile-picture {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            margin: 0 auto 20px;
            display: block;
            border: 5px solid #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .print-button {
            background-color: #3498db;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .print-button:hover {
            background-color: #2980b9;
        }
        #phname{
          display: flex;
        }
        #phname img{
          transform: scaleX(-1) ;
    object-fit: cover;
        }
        
        
         #PI {
            font-size: 1.5em;
            margin-bottom: 2em;
        }

        .details-info {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        h4 {
            margin: 0;
            color: #555;
        }

        .print-button {
            background-color: #3498db;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .print-button:hover {
            background-color: #2980b9;
        }
        .c{
          display: block;
        }
        #FL{
          font-size: 30px;
        }
        .details-info h4{
          background-color: #f0f0f0;
          border-radius: 8px;
          width: 100%;
          padding: 10px;
        }
        .user-details{
          padding: 3.5em;
        }


        @media print {
        
        }
        #ap{
          padding: 30px;
          padding-left: 46px;
          margin-bottom: -1em;
          border-bottom: 1px solid #e3e3e3;
        }
        .print-button{
          margin-bottom: 3em;
          margin-top: -2em;
        }
        #pid{
          padding-left: 4em;
          padding-right: 4em;
        }
      .id-card-container, .id-card{
        display: inline-block;
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
            <h4><?php echo $row['empID']; ?></h4>
        </div>
    </div>

    <div class="right-col">
        <div>
            <label for="">Date Created:</label>
            <h4><?php echo $row['added_at']; ?></h4>
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
            <h5>company telephone number </h5>
            <h5>company address</h5>
            <h5>sampleemail.com</h5>

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

    <script>
    function openIDCardModal() {
        var idCardContent = document.getElementById("id-card-print").innerHTML;
        document.getElementById("idCardPreview").innerHTML = idCardContent;
        $('#idCardModal').modal('show');
    }

    function printIDCard() {
        var originalContent = document.body.innerHTML;
        var idCardContent = document.getElementById("idCardPreview").innerHTML;

        document.body.innerHTML = idCardContent;

        window.print();

        document.body.innerHTML = originalContent;
        $('#idCardModal').modal('hide');
    }
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