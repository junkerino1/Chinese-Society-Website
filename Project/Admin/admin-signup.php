<?php

include('includes/config.php');

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   


   $select = " SELECT * FROM admin WHERE name = '$name' && password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $error[] = 'user already exist!';

   }else{

      if($pass != $cpass){
         $error[] = 'password not matched!';
      }else{
         $insert = "INSERT INTO admin(name, password,email) VALUES('$name','$pass','$email')";
         mysqli_query($conn, $insert);
         header('location:admin-login.php');
      }
   }

};


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin Register</title>

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
                    <h5 class="card-title text-center pb-0 fs-4">Register Your Account</h5>
                    <p class="text-center small">Enter your username & password to sign up</p>
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
                      <label for="yourUsername" class="form-label">Username</label>
                      <div class="input-group has-validation">
                        <input type="text" name="name" class="form-control" id="yourUsername" required placeholder="Please enter your username.">
                        <div class="invalid-feedback"></div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Password</label>
                      <input type="password" name="password" class="form-control" id="yourPassword" required placeholder="Please enter your password!">
                      <div class="invalid-feedback"></div>
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Re-Enter Password</label>
                      <input type="password" name="cpassword" class="form-control" id="yourPassword" required placeholder="Please enter your password!">
                      <div class="invalid-feedback"></div>
                    </div>

                    
                    <div class="col-12">
                      <label for="yourEmail" class="form-label">Email</label>
                      <div class="input-group has-validation">
                        <input type="email" name="email" class="form-control" id="yourUsername" required placeholder="Please enter your Email Address.">
                        <div class="invalid-feedback"></div>
                      </div>
                    </div>

                    <div class="col-12">
                        <input type="submit" name="submit" value="Register" class="btn btn-primary w-100" type="button">
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

</body>
</html>