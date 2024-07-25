<?php
    include('includes/config.php');
    include('includes/header.php');
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
                <a class="nav-link active" href="admin-profile.php">Overview</a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="admin-editprofile.php">Edit Profile</a>
              </li>

              <li>
                <a class="nav-link" href="resetpassword.php">Reset Password</a>
              </li>

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  <h5 class="card-title">About</h5>
                  <p class="small fst-italic"><?php echo $user['about']; ?></p>

                  <h5 class="card-title">Profile Details</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Full Name</div>
                    <div class="col-lg-9 col-md-8"><?php echo $user['name']; ?></div>
                  </div>


                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8"><?php echo $user['email']; ?></div>
                  </div>  

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Phone</div>
                    <div class="col-lg-9 col-md-8"><?php echo $user['phone']; ?></div>
                  </div>  

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Gender</div>
                    <div class="col-lg-9 col-md-8"><?php echo $user['gender']; ?></div>
                  </div>  

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Nationality</div>
                    <div class="col-lg-9 col-md-8"><?php echo $user['nationality']; ?></div>
                  </div>  
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