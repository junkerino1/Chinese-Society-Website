<?php
// Include your database configuration file
@include 'config.php';

session_start();

if (!isset($_SESSION['user_id'])) {
    header('location:login.php');
    exit(); // Prevent further execution if user is not logged in
}

// Query the database to retrieve eventIDs for the logged-in user
$userID = $_SESSION['user_id'];
$query = "SELECT eventID FROM event_user WHERE userID = '$userID'";
$result = mysqli_query($conn, $query);
$bookedEventIDs = array();
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $bookedEventIDs[] = $row['eventID'];
    }
}

// Function to check if an event is booked by the user
function isEventBooked($eventID, $bookedEventIDs) {
    return in_array($eventID, $bookedEventIDs);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History</title>
    <link href="includes/header-footer.css" rel="stylesheet">
    <link href="includes/history.css" rel="stylesheet">
    <script src="includes/script.js"></script>
    <link rel="icon" href="includes/image/logo.png" type="image/icon type">
</head>
<body>
<?php include 'header.php'; ?>
    <h2>Booking History</h2>
    <div class="col">
        <?php
        // Loop through each event and render the container if it's booked by the user
        $query = "SELECT * FROM event";
        $result = mysqli_query($conn, $query);
        if ($result) {
            while ($event = mysqli_fetch_assoc($result)) {
                if (isEventBooked($event['eventID'], $bookedEventIDs)) {
                    // Render the container for the booked event
                    ?>
                    <div class="container">
                        <div class="image-container">
                            <img src="../Admin/images/<?php echo $event['image']; ?>" alt="">
                        </div>
                        <div class="content">
                            <h3><?php echo $event['title']; ?></h3>
                            <h4><?php echo date('F j, Y', strtotime($event['eventDate'])); ?></h4>
                            <p><?php echo $event['description']; ?></p>
                        </div>
                        <button class="cancel-btn" onclick="cancelBooking(<?php echo $event['eventID']; ?>)">Cancel</button>
                    </div>
                    <?php
                }
            }
        }
        ?>
    </div>

    <script>
        function cancelBooking(eventID) {
            var confirmation = confirm("Are you sure you want to cancel?");
            if (confirmation) {
                // Send an AJAX request to delete the booking
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        // Reload the page after successful cancellation
                        location.reload();
                    }
                };
                xhttp.open("GET", "cancelbooking.php?eventID=" + eventID, true);
                xhttp.send();
            }
        }
</script>

    
<?php include 'footer.php'; ?>
</body>
</html>
