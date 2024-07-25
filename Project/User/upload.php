<?php
    include('config.php');
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
        $seatAvailability = $_POST['seatAvailability'];

        // Insert data into the database
        $query = mysqli_query($conn, "INSERT INTO event (title, description, eventDate, seatAvailability, image) VALUES ('$title', '$description', '$eventDate', '$seatAvailability', '$file_name')");
    
        // Move uploaded file to destination folder
        if(move_uploaded_file($tempname, $folder)){
            echo "<h2>File uploaded successfully</h2>";
        }
        else{
            echo "<h2>File not uploaded</h2>";
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Event</title>
</head>
<body>
    <h1>Upload Event</h1>
    <form method="post" enctype="multipart/form-data">
        <label for="title">Title:</label><br>
        <input type="text" id="title" name="title"><br><br>
        
        <label for="description">Description:</label><br>
        <textarea id="description" name="description"></textarea><br><br>

        <label for="eventDate">Event Date:</label><br>
        <input type="date" id="eventDate" name="eventDate"><br><br>

        <label for="seatAvailability">Seat Availability:</label><br>
        <input type="number" id="seatAvailability" name="seatAvailability"><br><br>

        <label for="image">Image:</label><br>
        <input type="file" id="image" name="image" /><br><br>
        
        <button type="submit" name="submit">Submit</button>
    </form>
</body>
</html>