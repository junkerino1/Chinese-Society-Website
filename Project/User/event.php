<?php
@include 'config.php';

session_start();

if (!isset($_SESSION['user_id'])) {
    header('location:login.php');
    exit(); // Prevent further execution if user is not logged in
}

if (isset($_POST['submit'])) {
    // Get the user ID from the session
    $userID = $_SESSION['user_id'];
    // Get the event ID from the form submission
    $eventID = $_POST['event_id'];

    // Check if the user has already registered for this event
    $check_registration_query = "SELECT COUNT(*) FROM event_user WHERE eventID = '$eventID' AND userID = '$userID'";
    $check_registration_result = mysqli_query($conn, $check_registration_query);

    if ($check_registration_result && mysqli_fetch_array($check_registration_result)[0] > 0) {
        // Display alert
        echo "<script>alert('You have already registered for this event.');</script>";
    } else {
        // Check seat availability
        $availability_query = "SELECT seatAvailability FROM event WHERE eventID = '$eventID'";
        $availability_result = mysqli_query($conn, $availability_query);
        
        if ($availability_result && mysqli_num_rows($availability_result) > 0) {
            $seatAvailability = mysqli_fetch_assoc($availability_result)['seatAvailability'];
            // Check if there are available seats
            if ($seatAvailability <= 0) {
                // Display alert
                echo "<script>alert('Sorry, there are no available seats for this event.');</script>";
            } else {
                // Insert into event_user table
                $insert_query = "INSERT INTO event_user (eventID, userID) VALUES ('$eventID', '$userID')";
                mysqli_query($conn, $insert_query);

                // Update seat availability in event table
                $update_query = "UPDATE event SET seatAvailability = seatAvailability - 1 WHERE eventID = '$eventID'";
                mysqli_query($conn, $update_query);

                // Get event name for the alert message
                $event_query = "SELECT title FROM event WHERE eventID = '$eventID'";
                $event_result = mysqli_query($conn, $event_query);
                $event_name = mysqli_fetch_assoc($event_result)['title'];

                // Display alert
                echo "<script>alert('" . $_SESSION['user_name'] . " has successfully registered for $event_name.');</script>";
            }
        } else {
            // Error retrieving seat availability
            echo "<script>alert('Error retrieving seat availability for this event.');</script>";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event</title>
    <link href="includes/header-footer.css" rel="stylesheet">
    <link href="includes/homepage style.css" rel="stylesheet">
    <link href="includes/event.css" rel="stylesheet">
    <link rel="icon" href="includes/image/logo.png" type="includes/image/icon type">
    <!-- Font Awesome CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
</head>
<body>

<?php include 'header.php'; ?>

<div class="container">
    <h1 class="title">Events !</h1>
    <div class="search">
        <h1>Search: </h1>
        <input type="text" id="find" placeholder="search here....">
    </div>
    <div class="categories">
        <div class="row">
            <?php
            $query = "SELECT * FROM event";
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) > 0) {
                $events = mysqli_fetch_all($result, MYSQLI_ASSOC);

                foreach ($events as $event) {
                    $eventID = $event['eventID']; // Get the event ID
                    ?>
                    <div class="column menu" data-name="p-<?php echo $eventID; ?>">
                        <img src="../Admin/images/<?php echo $event['image']; ?>" alt="">
                        <h2><?php echo $event['title']; ?></h2>
                        <p><?php echo date('j F Y', strtotime($event['eventDate'])); ?></p>
                        <!-- The button with the data-attribute to store the event ID -->
                        <button class="join-btn" data-eventid="<?php echo $eventID; ?>">Join</button>
                    </div>
                    <!-- The popup content with an initial hidden state -->
                    <div class="menu-preview" id="preview-<?php echo $eventID; ?>" style="display: none;">
                        <div class="preview">
                            <img src="../Admin/images/<?php echo $event['image']; ?>" alt="">
                            <h3><?php echo $event['title']; ?></h3>
                            <h4><?php echo date('j F Y', strtotime($event['eventDate'])); ?></h4>
                            <h4><?php echo date('g:i A', strtotime($event["eventTime"])); ?></h4>
                            <p><?php echo $event['description']; ?></p>
                            <p>Remaining seat: <?php echo $event['seatAvailability']; ?></p>
                            <h3>Join as: <span><?php echo $_SESSION['user_name']; ?></span></h3>
                            <!-- Form for submitting registration -->
                            <form class="registration-form" method="post">
                                <input type="hidden" name="event_id" value="<?php echo $eventID; ?>">
                                <!-- The submit button -->
                                <button type="submit" name="submit" class="submit-btn">Submit</button>
                            </form>
                            <!-- Close button -->
                            <i class="fas fa-times"></i>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "No events found.";
            }
            ?>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Select all buttons with class "join-btn"
        var joinButtons = document.querySelectorAll(".join-btn");
        
        // Loop through each button
        joinButtons.forEach(function(button) {
            // Add click event listener to each button
            button.addEventListener("click", function() {
                // Get the event ID from the data-eventid attribute
                var eventID = this.getAttribute("data-eventid");
                // Toggle the visibility of the corresponding popup
                togglePopup(eventID);
            });
        });
        
        // Function to toggle the visibility of the popup
        function togglePopup(eventID) {
            // Get the popup element by ID
            var popup = document.getElementById("preview-" + eventID);
            // Toggle the display property to show/hide the popup
            popup.style.display = (popup.style.display === "none") ? "block" : "none";
        }

        // Add event listener for close buttons
        var closeButtons = document.querySelectorAll(".menu-preview .fa-times");
        closeButtons.forEach(function(closeButton) {
            closeButton.addEventListener("click", function() {
                // Hide the corresponding popup
                this.closest(".menu-preview").style.display = "none";
            });
        });
    });

    function search() {
    let filter = document.getElementById('find').value.toUpperCase();
    let columns = document.querySelectorAll('.column.menu'); // corrected selector
    for (let i = 0; i < columns.length; i++) {
        let heading = columns[i].querySelector('h2');
        let value = heading.textContent.toUpperCase();
        if (value.indexOf(filter) > -1) {
            columns[i].style.display = "";
        } else {
            columns[i].style.display = "none";
        }
    }
}

// Add event listener to trigger search function
document.getElementById('find').addEventListener('keyup', search);
</script>

<?php include 'footer.php'; ?>
</body>
</html>
