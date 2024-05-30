<?php include "header.php" ?>


<?php if ($_SESSION['user_type'] !== 'user'): ?>

    <style>
        html,body,h1,h2,h3,h4,h5,h6 {font-family: "Roboto", sans-serif;}
        .w3-sidebar {
            z-index: 3;
            width: 250px;
            top: 43px;
            bottom: 0;
            height: inherit;
        }
    </style>

    <!-- Sidebar -->
    <nav class="w3-sidebar w3-bar-block w3-collapse w3-large w3-theme-l5 w3-animate-left" id="mySidebar" style="background: #657d19;">
        <a href="javascript:void(0)" onclick="w3_close()" class="w3-right w3-xlarge w3-padding-large w3-hover-black w3-hide-large" title="Close Menu">
            <i class="fa fa-remove"></i>
        </a>
        <h4 class="w3-bar-item"><b>Menu</b></h4>
        <a class="w3-bar-item w3-button w3-hover-black" href="../pages/dashboard.php">Dashboard</a>

        <?php if ($_SESSION['user_type'] == 'admin'): ?>
            <a class="w3-bar-item w3-button w3-hover-black" href="../pages/membership_request_list.php">Membership Requests</a>
        <?php endif; ?>
        <?php if ($_SESSION['user_type'] == 'client'): ?>
            <a class="w3-bar-item w3-button w3-hover-black" href="../pages/facilities_list.php">Facilities</a>
            <a class="w3-bar-item w3-button w3-hover-black" href="../pages/add-facilities.php">Add Facilities</a>
            <a class="w3-bar-item w3-button w3-hover-black" href="#">View booked Facilities</a>
        <?php endif; ?>
        <a class="w3-bar-item w3-button w3-hover-black" href="../controllers/logoutController.php">Log out</a>
    </nav>

    <!-- Overlay effect when opening sidebar on small screens -->
    <div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

    <!-- Main content: shift it to the right by 250 pixels when the sidebar is visible -->
    <div class="w3-main" style="margin-left:250px">

    </div>

<?php endif; ?>
