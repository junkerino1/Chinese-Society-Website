<?php
include('includes/config.php');
include('includes/header.php');

    $loggedInUserId = $_SESSION['admin_id'];

    // Fetch staff members other than the currently logged-in user
    $admin_query = "SELECT * FROM admin WHERE email != $loggedInUserId";
    $query_result = mysqli_query($conn, $admin_query);

    if (mysqli_num_rows($query_result) > 0) {
        echo '
            <div class="pagetitle">
                <h1>Staff List</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item">Staff Members</li>
                    </ol>
                </nav>
            </div><!-- End Page Title -->

            <section class="section">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"> Staff  ';
        echo '</h5> 
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Phone</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Gender</th>
                                        </tr>
                                    </thead>
                                    <tbody>';

        $count = 1;
        while ($row = mysqli_fetch_assoc($query_result)) {
            echo '<tr>';
            echo '<th scope="row">' . $count . '</th>';
            echo '<td>' . $row['name'] . '</td>';
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
        // No staff members found
        echo '<div class="alert alert-warning" role="alert">No staff members found other than you. ';
        backButton();
        echo '</div>';
    }

    


require_once('includes/footer.php');
?>
