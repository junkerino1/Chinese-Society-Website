<?php
include('includes/config.php');
include('includes/header.php');

// Function to generate a back button
function backButton() {
    echo '<a href="javascript:history.go(-1)" style="color:gray;"><em><i class="bi bi-arrow-left-short"></i>Back</em></a>';
}

// Check if event ID is provided
if (isset($_GET['eventID'])) {
    // Retrieve the event ID from the URL parameter
    $eventID = $_GET['eventID'];

    // Fetch event name for the specified event ID
    $query_event = "SELECT title FROM event WHERE eventID = $eventID";
    $result_event = mysqli_query($conn, $query_event);

    if (mysqli_num_rows($result_event) > 0) {
        // Fetch the event name
        $eventRow = mysqli_fetch_assoc($result_event);
        $eventName = $eventRow['title'];

        // Fetch participant details for the specified event ID using JOIN
        $query_participants = "SELECT u.* FROM user u 
                                JOIN event_user eu ON u.userID = eu.userID 
                                WHERE eu.eventID = $eventID";
        $result_participants = mysqli_query($conn, $query_participants);

        if (mysqli_num_rows($result_participants) > 0) {
            // Display event name and participant details in a table
            echo '
                <div class="pagetitle">
                    <h1>Event Participants</h1>
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active">Event Participants</li>
                        </ol>
                    </nav>
                </div><!-- End Page Title -->

                <section class="section">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">' . $eventName . ' Participants  '; backButton(); echo '</h5> 
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">ID</th>
                                                <th scope="col">Phone</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Gender</th>
                                            </tr>
                                        </thead>
                                        <tbody>';

            $count = 1;
            while ($row = mysqli_fetch_assoc($result_participants)) {
                echo '<tr>';
                echo '<th scope="row">' . $count . '</th>';
                echo '<td>' . $row['name'] . '</td>';
                echo '<td>' . $row['studentID'] . '</td>';
                echo '<td>' . $row['phone'] . '</td>';
                echo '<td>' . $row['email'] . '</td>';
                echo '<td>' . $row['gender'] . '</td>';
                echo '</tr>';
                $count++;
            }

            echo '
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>';

        } else {
            // No participants found for the specified event
            echo '<div class="alert alert-warning" role="alert">No participants found for this event. '; backButton(); echo '</div>';
        }
    } else {
        // Event not found for the specified ID
        echo '<div class="alert alert-danger" role="alert">Event not found for the specified ID.' ; backButton(); echo '</div>';
    }
} else {
    // Event ID not provided in the URL
    echo '<div class="alert alert-danger" role="alert">Event ID not provided. '; backButton(); echo '</div>';
}
?>

<?php require_once('includes/footer.php');?>  
