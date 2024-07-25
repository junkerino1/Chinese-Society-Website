<?php
// Include your database configuration file
include('includes/config.php');
include('includes/header.php');

function backButton() {
    echo '<a href="view-events.php" style="color:gray;"><em><i class="bi bi-arrow-left-short"></i>Back</em></a>';
}

$loggedInAdmin = $_SESSION['admin_id'];

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if eventID and password are provided
    if (isset($_POST['eventID'], $_POST['password'])) {
        // Get the eventID and password from the form
        $eventID = $_POST['eventID'];
        $password = md5($_POST['password']);

        // Retrieve the encrypted password from the database
        $query = "SELECT password FROM admin WHERE adminID = $loggedInAdmin"; // Assuming the admin's userID is 1
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        $encryptedPassword = $row['password'];

        // Check if the decrypted password matches the input password
        if ($password == $encryptedPassword) {
            // Perform the deletion query
            $query = "DELETE FROM event WHERE eventID = '$eventID'";
            try {
                $result = mysqli_query($conn, $query);
                if ($result) {
                    // Event deleted successfully, redirect to the event list page
                    echo "Event deleted successfully."; backButton(); 
                    exit();
                } else {
                    echo "Error deleting event.";
                }
            } catch (mysqli_sql_exception $e) {
                // Check if the error is due to foreign key constraint
                if ($e->getCode() == 1451) {
                    echo "Error: Cannot delete the event because it has participants.";backButton(); 
                    exit();
                } else {
                    echo "Error deleting event: " . $e->getMessage();
                }
            }
        } else {
            echo "Incorrect password.";
        }
    } else {
        echo "Error: Event ID or password not provided.";
    }
}

// Display the form for password input
?>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <input type="hidden" name="eventID" value="<?php echo isset($_GET['eventID']) ? $_GET['eventID'] : ''; ?>">
    <label for="password">Enter Admin Password:</label>
    <input type="password" id="password" name="password" required>
    <button type="submit">Confirm Delete</button>
</form>
<?php

require_once('includes/footer.php');
?>
