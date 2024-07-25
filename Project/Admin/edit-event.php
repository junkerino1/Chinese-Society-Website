<?php
$PAGE_TITLE = 'Edit Event';

include('includes/config.php');
include('includes/header.php');

// Check if eventID is provided
if (!isset($_GET['eventID'])) {
    header("Location: index.php");
    exit();
}

$eventID = $_GET['eventID'];

// Fetch event details from the database based on eventID
$query = "SELECT * FROM event WHERE eventID = $eventID";
$result = mysqli_query($conn, $query);

// Check if event exists
if (mysqli_num_rows($result) == 0) {
    echo "Event not found.";
    exit();
}

$event = mysqli_fetch_assoc($result);

// Update event details
if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $eventDate = $_POST['eventDate'];
    $eventTime = $_POST['eventTime'];

    // Check if a new image is uploaded
    if (!empty($_FILES['image']['name'])) {
        $file_name = $_FILES['image']['name'];
        $tempname = $_FILES['image']['tmp_name'];
        $folder = 'images/' . $file_name;

        // Create the directory if it doesn't exist
        if (!file_exists('images/')) {
            mkdir('images/', 0777, true);
        }

        // Move uploaded file to destination folder
        if (move_uploaded_file($tempname, $folder)) {
            // Update the image filename in the database
            $editEvent = "UPDATE event SET title = '$title', description = '$description', eventDate = '$eventDate', eventTime = '$eventTime', image = '$file_name' WHERE eventID = $eventID";
            $update_result = mysqli_query($conn, $editEvent);

            if ($update_result) {
                echo "<div class='alert alert-success' role='alert'>Event details updated successfully.</div>";
            } else {
                echo "<div class='alert alert-danger' role='alert'>Failed to update event details: " . mysqli_error($conn) . "</div>";
            }
        } else {
            echo "<div class='alert alert-danger' role='alert'>Failed to upload image.</div>";
        }
    } else {
        // If no new image is uploaded, keep the existing image filename
        $editEvent = "UPDATE event SET title = '$title', description = '$description', eventDate = '$eventDate', eventTime = '$eventTime' WHERE eventID = $eventID";
        $update_result = mysqli_query($conn, $editEvent);

        if ($update_result) {
            echo "<div class='alert alert-success' role='alert'>Event details updated successfully.</div>";
        } else {
            echo "<div class='alert alert-danger' role='alert'>Failed to update event details: " . mysqli_error($conn) . "</div>";
        }
    }
}
?>

<div class="pagetitle">
    <h1>Edit Event</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item"><a href="events.php">Events</a></li>
            <li class="breadcrumb-item active">Edit Event</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<div class="card">
    <div class="card-body">
        <h5 class="card-title">Event Details</h5>
        <form method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="title" class="form-label">Event Title</label>
                <input type="text" class="form-control" id="title" name="title" value="<?php echo $event['title']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="4" required><?php echo $event['description']; ?></textarea>
            </div>
            <div class="mb-3">
                <label for="eventDate" class="form-label">Date</label>
                <input type="date" class="form-control" id="eventDate" name="eventDate" value="<?php echo $event['eventDate']; ?>" style="width: 200px;" required>
            </div>
            <div class="mb-3">
                <label for="eventTime" class="form-label">Time</label>
                <input type="time" class="form-control" id="eventTime" name="eventTime" value="<?php echo $event['eventTime']; ?>"style="width: 200px;" required>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image Upload</label>
                <input type="file" class="form-control" id="image" name="image" style="width: 400px">
                <?php if (!empty($event['image'])) : ?>
                    <!-- Hidden input field to store the current image filename -->
                    <input type="hidden" name="current_image" value="<?php echo $event['image']; ?>">
                <?php endif; ?>
            </div>
            <a href="event-list.php">
                <button type="submit" class="btn btn-primary" name="submit">Save Changes</button>
            </a>
        </form>
    </div>
</div>

<?php require_once('includes/footer.php'); ?>