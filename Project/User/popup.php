<?php
@include 'config.php';

session_start();

if (!isset($_SESSION['user_name'])) {
    header('location:login_form.php');
}

// Retrieve events data from the database
$query = "SELECT * FROM event";
$result = mysqli_query($conn, $query);

// Fetch data and store it in an array
$events = [];
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $events[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Popup with PHP</title>
    <style>
        /* CSS for Popup */
        .popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            z-index: 9999;
        }
    </style>
</head>
<body>

<!-- Button to Open Popup -->
<button onclick="openPopup()">Open Popup</button>

<!-- Popup -->
<div id="popup" class="popup">
    <?php foreach ($events as $event): ?>
        <div>
            <h2><?php echo $event['title']; ?></h2>
            <p><?php echo date('j F Y', strtotime($event['eventDate'])); ?></p>
            <!-- Add more content here as needed -->
        </div>
    <?php endforeach; ?>
    <button onclick="closePopup()">Close</button>
</div>

<!-- JavaScript -->
<script>
    function openPopup() {
        document.getElementById('popup').style.display = 'block';
    }

    function closePopup() {
        document.getElementById('popup').style.display = 'none';
    }
</script>

</body>
</html>
