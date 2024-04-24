<?php
session_start();

if (!isset($_SESSION['admin_name'])) {
    header("location: login.php");
    exit();
}

include_once("connections/connection.php");

ini_set('display_errors', 1);
error_reporting(E_ALL);

$db_connection = pg_connect("host=aws-0-ap-southeast-1.pooler.supabase.com port=5432 dbname=postgres user=postgres.tcfwwoixwmnbwfnzchbn password=sbit4e-4thyear-capstone-2023");

if (isset($_POST['submit'])) {
    // Check if password is provided
    if (empty($_POST['password'])) {
        die('Password is required.');
    }

    $fname = pg_escape_string($db_connection, $_POST['firstname']);
    $lname = pg_escape_string($db_connection, $_POST['lastname']);
    $mname = pg_escape_string($db_connection, $_POST['middlename']);
    $gender = pg_escape_string($db_connection, $_POST['gender']);
    $age = pg_escape_string($db_connection, $_POST['age']);
    $email = pg_escape_string($db_connection, $_POST['email']);
    $contact = pg_escape_string($db_connection, $_POST['contact']);
    $address = pg_escape_string($db_connection, $_POST['address']);
    $department = pg_escape_string($db_connection, $_POST['department']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);  // Hash the password

    $empID = date("Y") . '-' . str_pad(rand(0, 99999999), 8, '0', STR_PAD_LEFT);
    $date = date("Y-m-d");
    $img = $_POST['image'];
    $folderPath = "./uploads/";

    $image_parts = explode(";base64,", $img);
    $image_base64 = base64_decode($image_parts[1]);
    $fileName = uniqid() . '.jpeg';
    $file = $folderPath . $fileName;
    file_put_contents($file, $image_base64);

    $check_sql = "SELECT * FROM admin_users WHERE email='$email'";
    $result = pg_query($db_connection, $check_sql);

    if (pg_num_rows($result) > 0) {
        echo '<script>alert("Account already existed.");</script>';
    } else {
        $sql = "INSERT INTO admin_users (firstname, lastname, middlename, gender, age, email, contact, address, department, emp_id, date_created, password, photo) VALUES ($1, $2, $3, $4, $5, $6, $7, $8, $9, $10, $11, $12, $13)";
        $params = array($fname, $lname, $mname, $gender, $age, $email, $contact, $address, $department, $empID, $date, $password, $fileName);
        if ($stmt = pg_prepare($db_connection, "", $sql)) {
            pg_execute($db_connection, "", $params);
            echo '<script>alert("Registration Successful!");</script>';
        } else {
            echo '<script>alert("Error in registration.");</script>';
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/add.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="js/sweetalert.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11">

    <style>
        .page-wrapper {
            padding: 7em;
        }

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

        .contentarea #video {
            border: 1px solid green;

            width: 320px;
            height: 240px;
        }


        .contentarea #photo {
            border: 1px solid green;
            border-radius: 50%;
            width: 240px;
            height: 240px;
            object-fit: cover;
            transform: scaleX(-1);
        }

        .contentarea #canvas {
            display: none;
        }

        .contentarea .camera {
            width: 340px;
            display: inline-block;
            transform: scaleX(-1);
        }

        #preview {
            transform: scaleX(-1);
        }

        .contentarea .output {
            width: 340px;
            border-radius: 50%;
            display: inline-block;
            vertical-align: top;
        }

        .contentarea #startbutton {
            display: block;
            position: relative;
            margin-left: auto;
            margin-right: auto;
            bottom: 32px;
            font-size: 14px;
            font-family: "Lucida Grande", "Arial", sans-serif;
            color: rgba(255, 255, 255, 1);
        }

        .contentarea {
            font-size: 16px;
            font-family: "Lucida Grande", "Arial", sans-serif;
            width: 760px;
        }

        .contentarea .camera img {
            width: 50px;
            height: 50px;
            cursor: pointer;
        }

        #results {
            transform: scale(1.1);
            object-fit: cover;
        }

        #my_camera {
            transform: scale(1.1);
            object-fit: cover;
        }

        .contentarea .camera img:hover {
            transform: scale(1.1);
            transition: .2s;
        }

        .modal {
            width: 700px;
        }

        .cap-photo img {
            width: 150px;
            height: 150px;
            border: solid 2px green;
            border-radius: 50%;
            object-fit: cover;
            transform: scaleX(-1);
            margin-top: -3.5em;
        }

        .modal-camera button {
            width: 20%;
            border-radius: 3em;
            background: none;
            color: black;
            outline: none;
            border: solid 2px #46a362;
        }

        .modal button {
            width: 30%;
            border-radius: 3em;
            border: none;
            background-color: #46a362;
            color: white;
            padding: 13px;
            outline: none;

        }

        .modal-camera button:hover {
            background-color: #46a362;
            color: white;
        }

        .modal button:hover {
            background-color: #5bc27a;
            color: white;
            transition: .3s;
        }

        .modal .modal-content {
            max-width: 900px;
            align-items: center;
            justify-content: center;
            text-align: center;
            margin-top: 7em;

        }

        .modal .camera video {
            border-radius: 10px;
            border: none;
            outline: none;
        }

        .modal .output img {
            border-radius: 10px;
            width: 300px;
            height: 300px;
            border: none;
            outline: none;
        }

        #cambtn {
            width: 30px;
        }

        #results {
            border: 1px solid green;
            transform: scaleX(-1);
            object-fit: cover;
            width: 360px;
            height: 260px;

        }

        #my_camera {
            border: 1px solid green;
            transform: scaleX(-1);
            object-fit: cover;
            width: 360px;
            height: 260px;

        }

        #shot:hover {
            transform: scale(0.9);
            transition: .2s;
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
            padding-top: 3em;
        }

        #firstname {
            margin-top: 9px;
        }
    </style>

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">

    <!-- Lineawesome CSS -->
    <link rel="stylesheet" href="assets/css/line-awesome.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />

    <!-- Main CSS -->
    <link rel="stylesheet" href="assets/css/style.css">

    <script>
        function confirmSubmission() {
            var confirmation = confirm("Are you sure that the information details are correct? before you want to submit the information?");
            return confirmation;
        }
    </script>
    <!-- <script>
    function confirmSubmission() {
        Swal.fire({
            title: "Confirmation",
            text: "Are you sure that the information details are correct?",
            icon: "question",
            showCancelButton: true,
            confirmButtonText: "Yes, submit",
            cancelButtonText: "No, cancel"
        }).then((result) => {
            if (result.isConfirmed) {
                document.forms[0].submit();
            }
        });
        return false;
    }
    </script> -->


</head>

<body>

    <div class="main-wrapper">

        <?php include_once("includes/header.php"); ?>
        <?php include_once("includes/sidebar.php"); ?>

        <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="cont">

                    <!-- <div class="back-btn">
    <a href="index.php" class="button-link2">
    <button class="custom-button2">&larr; Back</button>
     </a>
    </div> -->

                    <!-- <div class="back-btn1">
        <a href="#" class="button-link3">
            <button class="custom-button2" onclick="openModal()">Unregistered Biometric</button>
        </a>
    </div> -->
                    <h2 id="info-txt">Add new Admin</h2>
                    <hr>

                    <div class="biom">

                        <div id="unregisteredBiometricModal" class="modal">
                            <div class="modal-content">
                                <span class="close" onclick="closeModal()">&times;</span>
                                <h2>Unregistered Biometric</h2>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Employee ID</th>
                                            <th>Date of Registration</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="container">
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" class="minimal-form" method="post" onsubmit="return confirmSubmission();" enctype="multipart/form-data">

                            <!-- <form action="" class="minimal-form" method="post" onsubmit="confirmSubmission(event);"> -->
                            <br><br><br>
                            <center>
                                <div class="cap-photo">
                                    <img src="" alt="" name="images" id="images">
                                </div>
                                <br>
                                <div class="modal-camera">
                                    <!-- Change the button type to "button" -->
                                    <button type="button" id="photoCaptureButton">Take a Photo</button>
                                </div>
                            </center>
                            <div class="row">

                                <!-- Left Column -->
                                <div class="col-md-6">

                                    <h3 id="info-txt">Personal Information</h3>
                                    <br>

                                    <label>Given name<span style="color: red;">*</span></label>
                                    <input type="text" name="firstname" id="firstname" required>

                                    <label>Surname<span style="color: red;">*</span></label>
                                    <input type="text" name="lastname" id="lastname" required>

                                    <label>Middle name<span style="color: red;">*</span></label>
                                    <input type="text" name="middlename" id="middlename" required>

                                    <label>Gender<span style="color: red;">*</span></label>

                                    <select name="gender" id="gender" required>
                                        <option value="" disabled selected>Select a gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>

                                    <label>Age<span style="color: red;">*</span></label>
                                    <input type="text" name="age" id="age" required>

                                    <label>Email Address<span style="color: red;">*</span></label>
                                    <input type="email" name="email" placeholder="@gmail.com" id="email" required>

                                    <script>
                                        // Function to update the "Email" field based on the "Email Address" field
                                        function updateEmail() {
                                            var emailAddress = document.getElementById('email').value;
                                            document.getElementById('auto-email').value = emailAddress;
                                        }

                                        // Attach the function to the "input" event of the "Email Address" field
                                        document.getElementById('email').addEventListener('input', updateEmail);
                                    </script>

                                    <label>Contact Number<span style="color: red;">*</span></label>
                                    <input type="text" name="contact" id="contact" required>

                                </div>

                                <!-- Right Column -->
                                <div class="col-md-6">

                                    <br><br><br>
                                    <label>Address<span style="color: red;">*</span></label>
                                    <input type="text" name="address" id="address" required>


                                    <label>Department<span style="color: red;">*</span></label>
                                    <select name="department" id="department" required>
                                        <option value="" disabled selected>Select a department</option>
                                        <option value="HR">HR</option>
                                        <option value="Inventory">INVENTORY</option>
                                        <option value="Repository">REPOSITORY</option>
                                    </select>

                                    <label>Auto Generated Employee ID</label>
                                    <input type="text" name="empID" placeholder="you don't have to type here... " id="empID" readonly>

                                    <div class="dateee">
                                        <label>Auto Date Create Today</label>
                                        <input type="date" name="date" id="date" readonly value="<?php echo $date; ?>">
                                    </div>
                                    <br>
                                    <br>
                                    <br>
                                    <br>


                                    <h3 id="info-txt">Account Information</h3>

                                    <label>Email</label>
                                    <input type="text" name="auto-email" value=" " id="auto-email" readonly>

                                    <label>Password</label>
                                    <input type="text" name="password" placeholder="type your password..." required>

                                </div>

                                <!-- New Row for Gender -->

                            </div>

                            <!-- Centered Submit Button -->
                            <div class="col-md-12 text-center">
                                <br>


                                <div class="submit-btn">
                                    <input type="submit" name="submit" value="&#10004; Register" required>
                                </div>
                            </div>

                            <div id="photoCaptureModal" class="modal">
                                <div class="modal-content">
                                    <span class="close" onclick="closePhotoCaptureModal()">&times;</span>

                                    <div class="row">

                                        <div class="col-md-6">
                                            <p>Webcam</p>
                                            <div id="my_camera"></div>

                                            <br />

                                            <input type=button id="shot" value="Take Snapshot" onClick="take_snapshot()">

                                            <input type="hidden" name="image" class="image-tag" required>

                                        </div>

                                        <div class="col-md-6">
                                            <p>Preview</p>
                                            <div id="results"></div>

                                        </div>

                                        <div class="col-md-12 text-center">

                                            <br />

                                            <button class="btn btn-success" onclick=closePhotoCaptureModal()>Save</button>
                                            <!-- <input type="submit" value="save" onclick=closePhotoCaptureModal()> -->

                                        </div>

                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>

                </div>


            </div>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery-3.2.1.min.js"></script>

    <!-- Bootstrap Core JS -->
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <!-- Slimscroll JS -->
    <script src="assets/js/jquery.slimscroll.min.js"></script>

    <!-- Chart JS -->
    <script src="assets/plugins/morris/morris.min.js"></script>
    <script src="assets/plugins/raphael/raphael.min.js"></script>


    <!-- Custom JS -->
    <script src="assets/js/app.js"></script>

    <script language="JavaScript">
        Webcam.set({

            width: 360,

            height: 260,

            image_format: 'jpeg',

            jpeg_quality: 90

        });



        Webcam.attach('#my_camera');



        function take_snapshot() {

            Webcam.snap(function(data_uri) {

                $(".image-tag").val(data_uri);



                document.getElementById('results').innerHTML = '<img src="' + data_uri + '"/>';
                //document.getElementById('photos').innerHTML = '<img src="'+data_uri+'"/>';

                var myImage = document.getElementById('images');

                // Set the src attribute
                myImage.setAttribute('src', data_uri);

            });

        }
    </script>




    <script>
        //     function confirmSubmission(event) {
        //     event.preventDefault(); // Prevent the default form submission

        //     Swal.fire({
        //         title: 'Are you sure the information is correct?',
        //         icon: 'question',
        //         showCancelButton: true,
        //         confirmButtonColor: '#3085d6',
        //         cancelButtonColor: '#d33',
        //         confirmButtonText: 'Yes, submit!',
        //         cancelButtonText: 'Cancel'
        //     }).then((result) => {
        //         if (result.isConfirmed) {
        //             Swal.fire('Done!', 'Information submitted successfully', 'success');
        //             // Trigger the form submission directly
        //             document.querySelector('.minimal-form').submit();
        //         } else {
        //             console.log("Submission canceled");

        //         }
        //     });
        // }


        document.getElementById('photoCaptureButton').addEventListener('click', function() {
            openPhotoCaptureModal();
        });

        // ... (your existing script) ...

        function openPhotoCaptureModal() {
            document.getElementById('photoCaptureModal').style.display = 'block';
        }

        function closePhotoCaptureModal() {
            document.getElementById('photoCaptureModal').style.display = 'none';
        }



        function openModal() {
            document.getElementById('unregisteredBiometricModal').style.display = 'block';
        }

        // Function to close the modal
        function closeModal() {
            document.getElementById('unregisteredBiometricModal').style.display = 'none';
        }

        // Close the modal if the user clicks outside of it
        window.onclick = function(event) {
            var modal = document.getElementById('unregisteredBiometricModal');
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        }
    </script>


</body>

</html>