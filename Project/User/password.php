<?php
@include 'config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('location:login.php');
    exit();
}

$userID = $_SESSION['user_id'];
$query = "SELECT * FROM user WHERE userID = '$userID'";
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

                $updateQuery = "UPDATE user SET password = '$hashedPassword' WHERE userID = '$userID'";
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

<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Profile</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <link href="includes/header-footer.css" rel="stylesheet">
  <link rel="icon" href="includes/image/logo.png" type="image/icon type">
  
  <!-- Favicons -->
  <link href="includes/assets/img/favicon.png" rel="icon">
  <link href="includes/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="includes/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="includes/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="includes/assets/css/style.css" rel="stylesheet">
</head>


<body>

   <!--header Start-->

   <?php include 'header.php'; ?>

    <!--header End-->
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Profile</h1>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

            <img src="includes/img/<?php echo $user['pp']; ?>" alt="Profile" class="rounded-circle">
              <h2><?php echo $user['name']; ?></h2>
              <h3><?php echo $user['programme']; ?></h3>
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
                    <a class="nav-link" href="profile.php">Overview</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="editprofile.php">Edit Profile</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link active" href="password.php">Change Password</a>
                </li>

              </ul><br>                
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
    </section>
  </main><!-- End #main -->

</body>
<!-- Footer Start -->

<?php include 'footer.php'; ?>
    <!-- Footer End -->
</html>