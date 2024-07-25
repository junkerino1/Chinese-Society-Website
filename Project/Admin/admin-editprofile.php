<?php
include('includes/config.php');
include('includes/header.php');

// Update user profile if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Retrieve form data
  $file_name = $_FILES['pp']['name'];
  $tempname = $_FILES['pp']['tmp_name'];
  $folder = 'images/' . $file_name;

  if (!file_exists('images/')) {
    mkdir('images/', 0777, true);
  }

  $name = $_POST['name'];
  $email = $_POST['email'];
  $about = $_POST['about'];
  $phone = $_POST['phone'];
  $gender = $_POST['gender'];
  $nationality = $_POST['nationality'];

  if (move_uploaded_file($tempname, $folder)) {
    // Update user details in the database
    $update_query = "UPDATE admin SET name = '$name', email = '$email', about = '$about',phone = '$phone', gender = '$gender',nationality = '$nationality', pp = '$file_name' WHERE adminID = '$adminID'";
    $update_result = mysqli_query($conn, $update_query);
  } else {
    $update_query = "UPDATE admin SET name = '$name', email = '$email', about = '$about',phone = '$phone', gender = '$gender',nationality = '$nationality' WHERE adminID = '$adminID'";
    $update_result = mysqli_query($conn, $update_query);
    echo "Profile updated successfully!";
  }

  // Check if the update was successful
  if ($update_result) {
    // If update was successful, fetch updated user data
    $query = "SELECT * FROM admin WHERE adminID = '$adminID'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
      // Populate $user array with updated data
      $user = mysqli_fetch_assoc($result);
      $success_message = "Profile updated successfully.";
    } else {
      $error_message = "Failed to fetch updated profile data.";
    }
  } else {
    $error_message = "Failed to update profile.";
  }
}
?>


<div class="pagetitle">
  <h1>Profile</h1>
</div><!-- End Page Title -->

<section class="section profile">
  <div class="row">
    <div class="col-xl-4">

      <div class="card">
        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
          <!-- Display profile picture -->
          <img src="images/<?php echo $user['pp']; ?>" alt="Profile" class="rounded-circle">
          <!-- Display user name and programme -->
          <h2><?php echo $user['name']; ?></h2>
          <!-- Social links -->
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
              <a class="nav-link active" href="admin-editprofile.php">Edit Profile</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="resetpassword.php">Reset Password</a>
            </li>

          </ul>

          <!-- Profile Edit Form -->

          <?php if (isset($error_message)) : ?>
            <p><?php echo $error_message; ?></p>
          <?php elseif (isset($success_message)) : ?>
            <p><?php echo $success_message; ?></p>
          <?php endif; ?>
          <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">

            <label for="pp" class="col-md-4 col-lg-3 col-form-label">Profile Picture:</label><br>
            <div class="col-md-8 col-lg-9">
              <input type="file" id="pp" name="pp" class="form-control">
            </div>
            <label for="name" class="col-md-4 col-lg-3 col-form-label">Name:</label><br>
            <div class="col-md-8 col-lg-9">
              <input type="text" id="name" name="name" value="<?php echo $user['name']; ?>" class="form-control">
            </div>
            <label for="email" class="col-md-4 col-lg-3 col-form-label">Email:</label><br>
            <div class="col-md-8 col-lg-9">
              <input type="email" id="email" name="email" value="<?php echo $user['email']; ?>" class="form-control">
            </div>
            <label for="about" class="col-md-4 col-lg-3 col-form-label">About:</label><br>
            <div class="col-md-8 col-lg-9">
              <textarea id="about" name="about" class="form-control"><?php echo $user['about']; ?></textarea>
            </div>

            <label for="phone" class="col-md-4 col-lg-3 col-form-label">Phone:</label><br>
            <div class="col-md-8 col-lg-9">
              <input type="tel" id="phone" name="phone" value="<?php echo $user['phone']; ?>" class="form-control">
            </div>
            <label for="gender" class="col-md-4 col-lg-3 col-form-label">Gender:</label><br>
            <div class="col-md-8 col-lg-9">
              <select id="gender" name="gender" class="form-control">
                <option value="Male" <?php if ($user['gender'] == 'Male') echo 'selected'; ?>>Male</option>
                <option value="Female" <?php if ($user['gender'] == 'Female') echo 'selected'; ?>>Female</option>
              </select>
            </div>

            <label for="nationality" class="col-md-4 col-lg-3 col-form-label">Nationality:</label><br>
            <div class="col-md-8 col-lg-9">
              <input type="text" id="nationality" name="nationality" value="<?php echo $user['nationality']; ?>" class="form-control"><br><br>
            </div>
            <input type="submit" value="Update Profile" class="btn btn-primary">
          </form>
        </div>


      </div>

    </div><!-- End Bordered Tabs -->

  </div>
  </div>

  </div>
  </div>
</section>

<?php
include('includes/footer.php');
?>