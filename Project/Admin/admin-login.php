<?php
  include('includes/config.php');

  session_start();

if(isset($_POST['submit'])){

  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $pass = md5($_POST['adminPass']);

  $select = " SELECT * FROM admin WHERE email = '$email' && password = '$pass' ";

 $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $row = mysqli_fetch_array($result); 
      $_SESSION['admin_id'] = $row['adminID'];
         header('location:index.php');

   }else{
      $error[] = 'Incorrect Email or password!';
   }

};
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Admin Login</title>
  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="includes/css/bootstrap.min.css" rel="stylesheet">
  <link href="includes/css//bootstrap-icons.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="includes/css/style.css" rel="stylesheet">

</head>

<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="#" class="logo d-flex align-items-center w-auto"> <!-- CONNECT TO USER MAIN PAGE -->
                  <img src="includes/img/logo.png" alt="">
                  <span class="d-none d-lg-block">Chinese Society</span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                    <p class="text-center small">Enter your Email & password to login</p>
                  </div>

                  <form class="row g-3 needs-validation" action="" method="POST">
                    <?php
                    if(isset($error)){
                      foreach($error as $error){
                        echo '<span class="error-msg">'.$error.'</span>';
                      }
                    }
                    ?>

                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Email</label>
                      <div class="input-group has-validation">
                        <input type="text" name="email" class="form-control" id="yourUsername" required placeholder="Please enter your email.">
                        <div class="invalid-feedback">Please enter your email.</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Password</label>
                      <input type="password" name="adminPass" class="form-control" id="yourPassword" required placeholder="Please enter your password!">
                      <div class="invalid-feedback">Please enter your password!</div>
                    </div>

                    <div class="col-12">
                        <input type="submit" name="submit" value="Login" class="btn btn-primary w-100" type="button">
                      </a>
                    </div>
                  </form>

                </div>
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>


  </main><!-- End #main -->

