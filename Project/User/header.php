<section id="header">
    <a href="home.php"><img src="includes/image/logo.png" class="logo"></a>
    <div>
        <ul id="navbar">
            <li><a href="event.php">Event</a></li>
            <li><a href="history.php">History</a></li>
            <li><a href="about.php">About Us</a></li>
            <li><a href="contact.php">Contact Us</a></li>
            <li><a href="profile.php">Profile</a></li>
            <?php
            // Check if the user is logged in
            if (isset($_SESSION['user_id'])) {
                echo '<li><a href="logout.php">Logout</a></li>';
            } else {
                echo '<li><a href="login.php">Login</a></li>';
            }
            ?>
        </ul>
    </div>
</section>