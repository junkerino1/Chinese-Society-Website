<?php 
include 'config.php'; 

session_start();

if (!isset($_SESSION['admin_id'])) {
    header('location:admin-login.php');
    exit(); // Prevent further execution if user is not logged in
}

// Fetch user profile data from the database
$adminID = $_SESSION['admin_id'];
$query = "SELECT * FROM admin WHERE adminID = '$adminID'";
$result = mysqli_query($conn, $query);

// Initialize $user array
$user = array();

if($result && mysqli_num_rows($result) > 0){
    $user = mysqli_fetch_assoc($result);
    $_SESSION['user_name'] = $user['name']; 
}
?>


<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
        <a href="index.php" class="logo d-flex align-items-center">
            <img src="includes/img/logo.png" alt="logo">
            <span class="d-none d-lg-block">Chinese Society</span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">
    

            <li class="nav-item dropdown pe-3">
                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                <img src="../Admin/images/<?php echo $user['pp']; ?>" alt="Profile" class="rounded-circle">

                    <span class="d-none d-md-block dropdown-toggle ps-2">
                    <?php 
                        // Check if the user is logged in
                        if (isset($_SESSION['admin_id'])) {
                            echo $_SESSION['user_name']; // Display user's name
                        } 
                    ?>
                    </span>
                </a><!-- End Profile Iamge Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <?php 
                            if (isset($_SESSION['admin_id'])) {
                                echo "<h6>{$_SESSION['user_name']}</h6>"; // Display user's name
                            } 
                        ?>
                        <span>Administrator</span>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="admin-profile.php">
                            <i class="bi bi-person"></i>
                            <span>My Profile</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex  align-items-center" href="admin-profile.php">
                            <i class="bi bi-gear"></i>
                            <span>Account Settings</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="adminlogout.php">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Sign Out</span></a>
                        </a>
                    </li>

                </ul><!-- End Profile Dropdown Items -->
            </li><!-- End Profile Nav -->

        </ul>
    </nav><!-- End Icons Navigation -->

</header><!-- End Header -->