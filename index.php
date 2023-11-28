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

$password = isset($_POST['password']) ? $_POST['password'] : '';
$itemId = isset($_POST['itemId']) ? $_POST['itemId'] : '';

     // Perform password validation logic
$sql = "SELECT * FROM admin_user WHERE sa_id = '$itemId' AND password = '$password'";
$result = $con->query($sql);

$response = array();

if ($result && $result->num_rows > 0) {
    // Password is valid
    $response['valid'] = true;
} else {
    // Password is invalid
    $response['valid'] = false;
}

// Return the response in JSON format
echo json_encode($response);

$search = isset($_GET['gsearch']) ? $_GET['gsearch'] : '';
$sortColumn = isset($_GET['sort']) ? $_GET['sort'] : 'id';
$sortOrder = isset($_GET['order']) ? $_GET['order'] : 'DESC';
$entriesPerPage = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $entriesPerPage;

$sql = "SELECT * FROM user_list WHERE 
        empID LIKE '%$search%' OR
        firstname LIKE '%$search%' OR
        department LIKE '%$search%' OR
        email LIKE '%$search%' OR
        contact LIKE '%$search%'
        ORDER BY $sortColumn $sortOrder LIMIT $start, $entriesPerPage";
        

$students = $con->query($sql) or die($con->error);
$row = $students->fetch_assoc();

$totalEntriesSql = "SELECT COUNT(*) as total FROM user_list";
$totalEntriesResult = $con->query($totalEntriesSql);
$totalEntries = $totalEntriesResult->fetch_assoc()['total'];

// Calculate the total number of pages
$totalPages = ceil($totalEntries / $entriesPerPage);
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
  <!-- <link rel="stylesheet" href="css/index.css"> -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <style>
    
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

<link rel="stylesheet" href="css/index2.css">
</head>
<body>
<!-- <div id="loading-screen">
    <img src="img/doh.png" alt="Logo">
    <div id="loading-bar"></div>
  </div> -->
  

<div class="main-wrapper">

<!-- Header -->
<?php include_once("includes/header.php"); ?>

<?php include_once("includes/sidebar.php"); ?>
  <div class="page-wrapper">
    <div class="content container-fluid">

    <div class="cont">

    <!-- page content goes here -->
    <h3>Manage Admin Accounts</h3>
    

    <br>
    <div class="search-ipt">
    <form action="" method="GET">
        <input type="search" id="gsearch" placeholder="Search Admin." name="gsearch" value="<?php echo $search; ?>">
        <input type="submit" id="btn" value="Search">
    </form>
    </div>
    

    <a href="add.php" class="button-link">
            <button class="custom-button">&#43; Add new Admin</button>
        </a>
        <br>
        
        <table>
            <thead>
            <tr>
        <th><a href="?sort=empID&order=<?php echo ($sortColumn == 'empID' && $sortOrder == 'ASC') ? 'DESC' : 'ASC'; ?>">Employee ID <img src="img/sort.png"></a></th>
        <th><a href="?sort=firstname&order=<?php echo ($sortColumn == 'firstname' && $sortOrder == 'ASC') ? 'DESC' : 'ASC'; ?>">Name <img src="img/sort.png"></a></th>
        <th><a href="?sort=department&order=<?php echo ($sortColumn == 'department' && $sortOrder == 'ASC') ? 'DESC' : 'ASC'; ?>">Department <img src="img/sort.png"></a></th>
        <th><a href="?sort=email&order=<?php echo ($sortColumn == 'email' && $sortOrder == 'ASC') ? 'DESC' : 'ASC'; ?>">Email <img src="img/sort.png"></a></th>
        <th><a href="?sort=contact&order=<?php echo ($sortColumn == 'contact' && $sortOrder == 'ASC') ? 'DESC' : 'ASC'; ?>">Phone Number <img src="img/sort.png"></a></th>
        <th>Action</th>
    </tr>
            </thead>
            <tbody>
            <?php do { ?>
                <tr>
                    <td><?php echo $row['empID']; ?></td>
                    <td><?php echo $row['firstname']; ?></td>
                    <td><?php echo $row['department']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['contact']; ?></td>
                    <td>
    <a href="details.php?ID=<?php echo $row['id'] ?>" class="button-link3"><button class="custom-button3" id="view-icon"><img src="img/view2.png" alt="View"></button></a>
    <a href="edit.php?ID=<?php echo $row['id'] ?>" class="button-link3"><button class="custom-button3" id="edit-icon"><img src="img/edit.png" alt="Edit"></button></a>
    <a href="#" class="button-link3" onclick="confirmDelete(<?php echo $row['id']; ?>)">
  <button class="custom-button3" id="del-icon">
    <img src="img/del.png" alt="Delete">
  </button>
</a>

</td>
                </tr>
            <?php } while ($row = $students->fetch_assoc()) ?>
        </tbody>

        
    </table>
    <br>
    <div class="pages">
  <?php if ($page > 1): ?>
    <a href="?page=<?php echo $page - 1; ?>"><button>Previous</button></a>
  <?php endif; ?>

  <?php for ($i = 1; $i <= $totalPages; $i++): ?>
    <a href="?page=<?php echo $i; ?>" <?php echo ($i == $page) ? 'class="active"' : ''; ?>><?php echo $i; ?></a>
  <?php endfor; ?>

  <?php if ($page < $totalPages): ?>
    <a href="?page=<?php echo $page + 1; ?>"><button>Next</button></a>
  <?php endif; ?>
</div>

</div>


  </div>

  <div id="notificationModal" class="modal">
  <div class="modal-content">
    <span class="close" onclick="closeModal()">&times;</span>
    <h2>Notifications</h2>
    <!-- Add your notification content here -->
    <p>You have new notifications!</p>
  </div>
</div>

<center>
<div id="passwordModal" class="modal">
  <div class="modal-content">
    <span class="close" onclick="closePasswordModal()">&times;</span>
    <h2>Password Confirmation</h2>
    <p>Please enter your password to confirm deletion:</p>
    <form action="delete.php" id="passwordForm" onsubmit="confirmPassword(); return false;">
    <input type="password" id="password" placeholder="Enter your password.">
    <input type="submit" value="Confirm">
</form>
  </div>
</div>
</center>

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

function confirmDelete(id) {
        var confirmDelete = confirm("Are you sure you want to delete this account?");
        if (confirmDelete) {
            window.location.href = "delete.php?id=" + id;
        }
    }

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

    var searchForm = document.querySelector('form');
    searchForm.addEventListener('submit', function (event) {
        event.preventDefault();
        var searchInput = document.getElementById('gsearch').value;
        window.location.href = "index.php?gsearch=" + searchInput;
    });

   
    





  function openPasswordModal(id) {
  var passwordModal = document.getElementById('passwordModal');
  passwordModal.style.display = 'block';
  // Store the ID of the item to be deleted
  document.getElementById('passwordForm').dataset.itemId = id;
}

function closePasswordModal() {
  var passwordModal = document.getElementById('passwordModal');
  passwordModal.style.display = 'none';
}

</script>
<script>
function confirmDelete(id) {
  // Open the password modal for confirmation
  openPasswordModal(id);
}

function confirmPassword() {
    var passwordInput = document.getElementById('password').value;
    var itemId = document.getElementById('passwordForm').dataset.itemId;

    if (!passwordInput.trim()) {
        alert("Please enter your password to confirm deletion.");
        return;
    }

    // Make an AJAX request to validate the password
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "delete.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4) {
            // Handle the response
            if (xhr.status == 200) {
                // Handle the success response
                alert(xhr.responseText);

                // Close the password modal
                closePasswordModal();

                // Redirect to the index page (or handle accordingly)
                window.location.href = "index.php";
            } else {
                // Handle the error response
                alert("Error: " + xhr.statusText);
            }
        }
    };

    // Send the password and item ID to the server for validation
    xhr.send("password=" + encodeURIComponent(passwordInput) + "&id=" + encodeURIComponent(itemId));
}



</script>


<script>
  function confirmDelete(id) {
    // Open the password modal for confirmation
    openPasswordModal(id);
  }
</script>

<!-- <script>
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

    </script> -->


</body>
</html>
