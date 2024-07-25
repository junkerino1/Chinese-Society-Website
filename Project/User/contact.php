<?php
@include 'config.php';

session_start();

if (!isset($_SESSION['user_id'])) {
    header('location:login.php');
    exit(); // Prevent further execution if user is not logged in
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Contact</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="includes/img/favicon.ico" rel="icon">
    <link rel="icon" href="includes/image/logo.png" type="image/icon type">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&family=Roboto:wght@500;700;900&display=swap" rel="stylesheet"> 

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="includes/lib/animate/animate.min.css" rel="stylesheet">
    <link href="includes/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="includes/lib/lightbox/css/lightbox.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="includes/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="includes/css/style.css" rel="stylesheet">
    <link href="includes/header-footer.css" rel="stylesheet">
</head>

<body>
   <!--header Start-->
   <?php include 'header.php'; ?>
    <!--header End-->

    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 mb-5">
        <div class="container py-5">
            <h1 class="display-3 text-white mb-3 animated slideInDown">Contact</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                    <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                    <li class="breadcrumb-item text-white active" aria-current="page">Contact</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Contact Start -->
    <div class="container">
    <hr>
        <div class="row">
            <div class="col-sm-8">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1546.0064404899297!2d101.72919179674062!3d3.2174265847387606!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31cc3917b62f567b%3A0x2390287c959cd52e!2z5pKe6L2m6LeR5YGc6L2m5Zy6KEhpdCZSdW4gQ2FycGFyayk!5e0!3m2!1sen!2smy!4v1711692318836!5m2!1sen!2smy" width="100%" height="420" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>

            <div class="col-sm-4" id="contact2">
                <h3>Leave Us a Message!</h3>
                <hr align="left" width="50%">
                <h4 class="pt-2" style="color:black;">Website</h4>
                <i class="fas fa-globe"></i> TarumtChineseSociety.com<br>
                <br>
                <h4 class="pt-2" style="color:black;">Contact</h4>
                <i class="fas fa-phone"></i> <a href="tel:+"> 0123456789 </a><br>
                <i class="fab fa-whatsapp"></i><a href="tel:+"> 0123456789 </a><br>
                <br>
                <h4 class="pt-2" style="color:black;">Email</h4>
                <i class="fa fa-envelope"></i> <a href="">chinesesocietytar@gmail.com</a><br>
            </div>
        </div>
    </div>
    <!-- Contact End -->


    <!-- Footer Start -->
    <?php include 'footer.php'; ?>
    <!-- Footer End -->

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="includes/lib/wow/wow.min.js"></script>
    <script src="includes/lib/easing/easing.min.js"></script>
    <script src="includes/lib/waypoints/waypoints.min.js"></script>
    <script src="includes/lib/counterup/counterup.min.js"></script>
    <script src="includes/lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="includes/js/main.js"></script>
</body>

</html>

