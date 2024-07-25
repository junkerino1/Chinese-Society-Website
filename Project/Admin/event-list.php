<?php
include('includes/config.php');
include('includes/header.php');


function backButton() {
  echo '<a href="javascript:history.go(-1)" style="color:gray;"><em><i class="bi bi-arrow-left-short"></i>Back</em></a>';
}

?>

<div class="pagetitle">
  <h1>Event Lists</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.php">Event</a></li>
      <li class="breadcrumb-item active">Participant List</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section">
  <div class="row">
    <div class="col-lg-12">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Event Lists</h5>

          <table class="table datatable">
            <thead>
              <tr>
                <th>ID</th>
                <th>Event Name</th>
                <th data-type="date" data-format="YYYY/DD/MM">Date</th>
                <th data-type="time" data-format="hh:mm">Time</th>
                <th>Total Participants</th>
                <th>View More</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $query = "SELECT e.eventID, e.title, e.eventDate, e.eventTime, COUNT(p.userID) AS totalParticipants
                        FROM event e
                        LEFT JOIN event_user p ON e.eventID = p.eventID
                        GROUP BY e.eventID";
              $result = mysqli_query($conn, $query);

              if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                  echo "<tr>";
                  echo "<td>" . $row["eventID"] . "</td>";
                  echo "<td>" . $row["title"] . "</td>";
                  echo "<td>" . date('d/m/Y', strtotime($row["eventDate"])) . "</td>";
                  echo "<td>" . date('g:i A', strtotime($row["eventTime"])) . "</td>";
                  echo "<td>" . $row["totalParticipants"] . "</td>";
                  echo "<td><a href='participant-list.php?eventID=" . $row["eventID"] . "' style='color: black;'><i class='bi bi-eye'></i> View</a></td>";
                  echo "</tr>";
                }
              } else {
                echo "<tr><td colspan='6'>No events found</td></tr>";
              }
              ?>

            </tbody>
          </table>
          <!-- End Table with stripped rows -->

        </div>
      </div>

    </div>
  </div>
</section>

<?php include('includes/footer.php') ?>
