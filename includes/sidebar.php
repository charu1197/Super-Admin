<style>
    /* User Profile Img */
    .neon-border {
        border: 2px solid #0B72BD;
        box-shadow: 0 0 10px #0B72BD;
    }

    .user-img img {
        width: 6rem;
        height: auto;
    }

    .profile-block {
        margin: 0 0 0 -2rem;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .user-role {
        margin-top: -1.5rem;
    }

    /* ACTIVE NAV STATE */
    .sample-active {
        background-color: #A88C0A;
    }

    /* LOGOUT */
    .out-container .out-button {
        position: fixed;
        bottom: 0;
        left: 0;
    }
</style>
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <!-- PROFILE -->
                <li class="profile-block">
                    <a href="#">
                        <span class="user-img d-inline-block position-relative">
                            <img src="img/doh.png" alt="User Picture" class="rounded-circle img-thumbnail neon-border">
                        </span>
                    </a>
                    <a href=" #"><span class="text-white h4">Super Admin</span></a>
                    <br>
                    <!-- <a href="#"><span class="text-white small user-role">Super Admin</span></a> -->
                </li>
                <hr class="bg-white w-100 mt-2">

                <!-- DASHBOARD -->
                <li><a href="index.php"><i class="la la-dashboard"></i> <span> Dashboard</span> </a></li>

                <!-- MANAGE EMPLOYEES REQUEST -->
                <li class="submenu">
                    <a href="#"> <i class="la la-users"></i> <span> Manage Accounts</span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a href="manage_account.php">Admin List</a></li>
                        <li><a href="add_admin.php">Create Account</a></li>
                        <!-- <li><a href="password_request.php">Change Password Request</a></li> -->
                    </ul>
                </li>

                <!-- ACTIVITY LOGS -->
                <!-- <li>
                    <a href="activity_log.php"><i class="la la-history"></i><span>Activity Logs</span></a>
                </li> -->

                <!-- LOGOUT -->
                <li class="out-container">
                    <a class="out-button" href="logout.php" onclick="confirmLogout(event)"><i class="la la-power-off"></i><span>Logout</span></a>
                </li>
            </ul>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Logout function using SweetAlert2
    function confirmLogout(event) {
        event.preventDefault(); // Prevent the default link behavior

        Swal.fire({
            title: 'Are you sure you want to logout?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, logout!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "logout.php";
            } else {
                console.log("Logout canceled");
            }
        });
    }
</script>