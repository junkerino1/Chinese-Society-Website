<?php
include('includes/config.php');
include('includes/header.php');

// Query to get the total number of events created
$queryTotalEvents = "SELECT COUNT(*) AS total_events FROM event";
$resultTotalEvents = mysqli_query($conn, $queryTotalEvents);
$rowTotalEvents = mysqli_fetch_assoc($resultTotalEvents);
$totalEvents = $rowTotalEvents['total_events'];

// Query to get the total number of members registered
$queryTotalMembers = "SELECT COUNT(*) AS total_members FROM user";
$resultTotalMembers = mysqli_query($conn, $queryTotalMembers);
$rowTotalMembers = mysqli_fetch_assoc($resultTotalMembers);
$totalMembers = $rowTotalMembers['total_members'];

?>

<div class="pagetitle">
  <h1>Dashboard</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item active">Dashboard</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section dashboard">
  <div class="row">

    <!-- Left side columns -->
    <div class="col-lg-8">
      <div class="row">

        <!-- Sales Card -->
        <div class="col-xxl-6 col-md-12">
          <div class="card info-card sales-card">

            <div class="card-body">
              <h5 class="card-title">Events Created</h5>

              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-calendar2-event"></i>
                </div>
                <div class="ps-3">
                  <h6 class="card-text"><?php echo $totalEvents; ?> Events.</h6>
                </div>
              </div>
            </div>

          </div>
        </div><!-- End Sales Card -->

        <!-- Customers Card -->
        <div class="col-xxl-6 col-xl-12">

          <div class="card info-card customers-card">


            <div class="card-body">
              <h5 class="card-title">Registered Members</h5>

              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-people"></i>
                </div>
                <div class="ps-3">
                  <h6 class="card-text"><?php echo $totalMembers; ?> Members</h6>
                </div>
              </div>

            </div>
          </div>

        </div><!-- End Customers Card -->

        <!-- Reports -->
        <!-- End Reports -->

        <!-- Top Selling -->
        <div class="col-12">
          <div class="card top-selling overflow-auto">

            <div class="card-body pb-0">
              <h5 class="card-title">Top Events</span></h5>

              <table class="table table-borderless">
                <thead>
                  <tr>
                    <th scope="col">Event ID</th>
                    <th scope="col">Title</th>
                    <th scope="col">Seats Availability</th>
                    <th scope="col">Participant</th>
                    <th scope="col">Date</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  // Query to retrieve event information along with participant count
                  $query = "SELECT e.eventID, e.title, e.seatAvailability, COUNT(eu.userID) AS participant_count, e.eventDate FROM event e LEFT JOIN event_user eu ON e.eventID = eu.eventID GROUP BY e.eventID ORDER BY participant_count DESC";

                  $result = mysqli_query($conn, $query);

                  if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                      echo '<tr>';
                      echo '<th scope="row">' . $row['eventID'] . '</th>';
                      echo '<td><a href="participant-list.php?eventID=' . $row['eventID'] . '" class="text-primary fw-bold">' . $row['title'] . '</a></td>';
                      echo '<td>' . $row['seatAvailability'] . '</td>';
                      echo '<td class="fw-bold">' . $row['participant_count'] . '</td>';
                      echo '<td>' . $row['eventDate'] . '</td>';
                      echo '</tr>';
                    }
                  } else {
                    echo '<tr><td colspan="5">No events found</td></tr>';
                  }
                  ?>
                </tbody>
              </table>

            </div>

          </div>
        </div><!-- End Top Selling -->

      </div>
    </div><!-- End Left side columns -->

    <!-- Right side columns -->
    <div class="col-lg-4">

      

    </div><!-- End Right side columns -->

  </div>
</section>

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

</main><!-- End #main -->

<?php require_once('includes/footer.php'); ?>