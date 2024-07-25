<?php
@include 'config.php';

session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="includes/header-footer.css" rel="stylesheet">
    <link href="includes/homepage style.css" rel="stylesheet">
    <link rel="icon" href="includes/image/logo.png" type="includes/image/icon type">
</head>

<body>

<?php include 'header.php'; ?>

    <section id="poster">

    </section>

    <section class="product" id="product">
        <h1 class="title">Featured Event!</h1>
        <div class="categories">
            <div class="row">
                <div class="column">
                    <a href="event.php#cultural"><img src="includes/image/event1.jpg"></a>
                    <h2>Cultural Festival</h2>
                    <p>"Community-centered events with dragon dances, lantern displays, and fireworks celebrate rich Chinese cultural traditions."</p>
                </div>
                <div class="column">
                    <a href="event.php#community"><img src="includes/image/event4.png" alt=""></a>
                    <h2>Community Services</h2>
                    <p>"Participation in societal welfare through volunteer work, charitable actions, and collaborative initiatives for community progress."</p>
                </div>
                <div class="column">
                    <a href="event.php#competition"><img src="includes/image/event5.jpg" alt=""></a>
                    <h2>Competition</h2>
                    <p>"Participants showcasing their mastery of brushwork, composition, and artistic expression in written characters."</p>
                </div>
            </div>
        </div>
    </section>
</body>

<?php include 'footer.php'; ?>

</html>