<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link collapsed" href="index.php">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="view-events.php">
            <i class="bi bi-list-ol"></i>
                <span>View Events</span>
            </a>
        </li><!-- End Dashboard Nav -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="add-events.php">
            <i class="bi bi-plus-square"></i>
                <span>Add Events</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="event-list.php">
                <i class="bi bi-people"></i>
                <span>Participant List</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="staff-list.php">
                <i class="bi bi-person"></i>
                <span>Staff List</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="member-list.php">
                <i class="bi bi-person"></i>
                <span>Member List</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-heading">Account Settings</li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="admin-profile.php">
                <i class="bi bi-person-vcard"></i>
                <span>Profile</span>
            </a>
        </li><!-- End Profile Page Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed " href="admin-login.php">
                <i class="bi bi-box-arrow-in-right"></i>
                <span>Logout</span>
            </a>
        </li><!-- End Login Page Nav -->

    </ul>

</aside><!-- End Sidebar-->

<main id="main" class="main">

    <script type="text/javascript">
        var page = "<?php echo $page; ?>";
        var eventsPages = ["view-events.php", "add-events.php"];
        if (eventsPages.indexOf(page) > -1) {
            $("#event-nav-link").removeClass("collapsed").addClass("show");
            $("#components-nav").addClass("show");
        }
    </script>