<?php
$PAGE_TITLE = 'Add Events';

include('includes/config.php');
include('includes/header.php');
?>
<div class="pagetitle">
    <h1>Event Details</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active">Add Event</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<div class="card">
    <div class="card-body">
        <h5 class="card-title" href="">Add New Event</h5>
        <?php
    include('../User/config.php');
    if (isset($_POST['submit'])){
        $file_name = $_FILES['image']['name'];
        $tempname = $_FILES['image']['tmp_name'];
        $folder = 'images/'.$file_name;

        // Create the directory if it doesn't exist
        if (!file_exists('images/')) {
            mkdir('images/', 0777, true);
        }

        $title = $_POST['title'];
        $description = $_POST['description'];
        $eventDate = $_POST['eventDate'];
        $eventTime = $_POST['eventTime'];
        $seatAvailability = $_POST['seatAvailability'];

        // Insert data into the database
        $query = mysqli_query($conn, "INSERT INTO event (title, description, eventDate, eventTime, seatAvailability, image) 
        VALUES ('$title', '$description', '$eventDate', '$eventTime', '$seatAvailability', '$file_name')");
    

        
        // Move uploaded file to destination folder
        if(move_uploaded_file($tempname, $folder)){
            echo "<h2>File uploaded successfully</h2>";
        }
        else{
            echo "<h2>File not uploaded</h2>";
        }
    }
?>

        <!-- General Form Elements -->
        <form method="post" enctype="multipart/form-data" >
            <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Event Title</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="title" name="title" required>
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputEmail" class="col-sm-2 col-form-label">Description</label>
                <div class="col-sm-10">
                <textarea class="form-control" id="description" name="description" style="height: 100px" required placeholder="Atleast 15 words and not more than 350 words." minlength="15" maxlength="350"></textarea>
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputDate" class="col-sm-2 col-form-label">Date</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" id="eventDate" name="eventDate" style="width: 180px;" required >
                 </div>
            </div>
            <div class="row mb-3">
                <label for="inputTime" class="col-sm-2 col-form-label">Time</label>
                <div class="col-sm-10">
                <input type="time" class="form-control" id="eventTime" name="eventTime" style="width: 180px;" required>
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputNumber" class="col-sm-2 col-form-label">Image Upload</label>
                <div class="col-sm-10">
                <input type="file" class="form-control" id="image" name="image" style="width: 400px" required>
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Number of Pax</label>
                <div class="col-sm-10">
                <input type="number" min="0" class="form-control" id="seatAvailability" name="seatAvailability" style="width: 100px;" required>
                 </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label"></label>
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary" name="submit">Submit Form</button>
                </div>
            </div>

        </form>

        <?php require_once ('includes/footer.php'); ?>