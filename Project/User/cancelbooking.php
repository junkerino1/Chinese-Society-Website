<?php
// Include your database configuration file
@include 'config.php';

session_start();

// Check if eventID is set and user is logged in
if (isset($_GET['eventID']) && isset($_SESSION['user_id'])) {
    // Get the eventID from the request
    $eventID = $_GET['eventID'];
    $userID = $_SESSION['user_id'];

    // Perform the deletion query
    $query = "DELETE FROM event_user WHERE userID = '$userID' AND eventID = '$eventID'";
    $result = mysqli_query($conn, $query);

    $update_query = "UPDATE event SET seatAvailability = seatAvailability + 1 WHERE eventID = '$eventID'";
    mysqli_query($conn, $update_query);

    // Check if the query was successful
    if ($result) {
        echo "Booking cancelled successfully.";
    } else {
        echo "Error cancelling booking: " . mysqli_error($conn);
    }
} else {
    // If eventID is not set or user is not logged in, return an error message
    echo "Error: Event ID not provided or user not logged in.";
}
?>
