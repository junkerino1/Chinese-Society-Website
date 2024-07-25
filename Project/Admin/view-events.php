<?php
include('includes/config.php');
include('includes/header.php');
?>

<link rel="stylesheet" href="includes/css/pop-up.css">

<div class="pagetitle">
    <h1>Event Details</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active">Event Details</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <div class="d-grid gap-2 d-md-block">
                <a href="add-events.php">
                    <button type="button" class="btn btn-outline-success" style="font-size: 15px;">
                        <i class="bi bi-plus-circle-dotted"></i> Add New Event</button>
                </a>
            </div>
            <div class="container">
                <div class="categories">
                    <div class="row">
                        <?php
                        $query = "SELECT * FROM event";
                        $result = mysqli_query($conn, $query);

                        if (mysqli_num_rows($result) > 0) {
                            while ($event = mysqli_fetch_assoc($result)) {
                                $eventID = $event['eventID']; // Get the event ID
                                echo '<div class="column menu" data-name="p-' . $eventID . '">';
                                echo '<img src="images/' . $event['image'] . '" alt="">';
                                echo '<h2>' . $event['title'] . '</h2>';
                                echo '<p>' . date('j F Y', strtotime($event['eventDate'])) . '</p>';
                                // The button with the data-attribute to store the event ID
                                echo '<a href="edit-event.php?eventID=' . $event["eventID"] . '">';
                                echo '<button class="edit-btn" data-eventid="' . $event["eventID"] . '">Edit</button>';
                                echo '</a>';
                                // Delete button with event ID as URL parameter
                                echo '<a href="confirm-delete.php?eventID=' . $event["eventID"] . '">';
                                echo '<button class="delete-btn">Delete</button>';
                                echo '</a>';
                                echo '</div>';
                            }
                        } else {
                            echo "No events found.";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once('includes/footer.php'); ?>
