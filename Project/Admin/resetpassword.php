<?php
include('includes/config.php');
include('includes/header.php');

$adminID = $_SESSION['admin_id'];
$query = "SELECT * FROM admin WHERE adminID = '$adminID'";
$result = mysqli_query($conn, $query);

$user = array();

if ($result && mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['currentPassword']) && isset($_POST['newPassword']) && isset($_POST['renewPassword'])) {
        $currentPassword = $_POST['currentPassword'];
        $newPassword = $_POST['newPassword'];
        $renewPassword = $_POST['renewPassword'];

        // Since passwords in the database are encrypted using MD5, hash the current password input with MD5
        $currentPasswordMD5 = md5($currentPassword);

        if ($currentPasswordMD5 === $user['password']) {
            if ($newPassword === $renewPassword) {
                // Hash the new password with MD5
                $hashedPassword = md5($newPassword);

                $updateQuery = "UPDATE admin SET password = '$hashedPassword' WHERE adminID = '$adminID'";
                if (mysqli_query($conn, $updateQuery)) {
                    echo "Password updated successfully!";
                } else {
                    echo "Error updating password: " . mysqli_error($conn);
                }
            } else {
                echo "New password and re-entered password do not match.";
            }
        } else {
            echo "Current password is incorrect.";
        }
    } else {
        echo "Please fill out all fields.";
    }
}
?>


<div class="pagetitle">
    <h1>Profile</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active">Admin Profile</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section profile">
    <div class="row">
        <div class="col-xl-4">
            <div class="card">
                <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                    <img src="images/<?php echo $user['pp']; ?>" alt="Profile" class="rounded-circle">
                    <h2><?php echo $user['name']; ?></h2>
                    <h3>Administration</h3>
                    <div class="social-links mt-2">
                        <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                        <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-xl-8">

            <div class="card">
                <div class="card-body pt-3">
                    <!-- Bordered Tabs -->
                    <ul class="nav nav-tabs nav-tabs-bordered">

                        <li class="nav-item">
                            <a class="nav-link" href="admin-profile.php">Overview</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="admin-editprofile.php">Edit Profile</a>
                        </li>

                        <li>
                            <a class="nav-link active" href="resetpassword.php">Reset Password</a>
                        </li>

                    </ul>


                    <div class="tab-content pt-2">
                        <form method="post">
                            <div class="row mb-3">
                                <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                                <div class="col-md-8 col-lg-9">
                                    <input name="currentPassword" type="password" class="form-control" id="currentPassword" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                                <div class="col-md-8 col-lg-9">
                                    <input name="newPassword" type="password" class="form-control" id="newPassword" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                                <div class="col-md-8 col-lg-9">
                                    <input name="renewPassword" type="password" class="form-control" id="renewPassword" required>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Change Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>
</section>

<?php
include('includes/footer.php');
?>