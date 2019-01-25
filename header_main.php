<?php
require_once 'initialize.php';
?>
<!doctype html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>fee</title>

    <!-- Bootstrap || with Data Tables CSS -->
    <link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css"/>

    <!-- FontAwesome CSS -->
    <link rel="stylesheet" href="./css/all.min.css"/>
    <link rel="stylesheet" href="./css/form.css">
    <!-- Custom CSS-->
    <link rel="stylesheet" href="./css/main.css"/>
    <!-- Bootstrap Javascript -->
    <script src="js/jquery-3.3.1.slim.min.js"></script>
    <script defer src="js/popper.min.js"></script>

    <script defer src="js/ajax.js"></script>
    <script defer src="js/bootstrap.min.js"></script>
    <script defer src="DataTables/datatables.min.js"></script>
    <script defer src="./js/main.js"></script>
    <!-- FontAwesome JS -->
    <script defer src="./js/all.min.js"></script>
</head>
<body>

<div id="nav-wrapper">

    <div class="row">
        <nav class="navbar navbar-light navbar-expand-sm">
            <a href="index.php" class="navbar-brand">Eventus</a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarLinks"
                    aria-controls="navbarLinks" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarLinks">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="index.php" class="nav-link">HOME</a>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">ABOUT US</a>
                    </li>
                    <?php
                    if (isAdmin()) {
                        echo '
                    <li class="nav-item dropdown">
                        <a  class="nav-link dropdown-toggle" id="eventsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">MANAGE EVENTS</a>
                            <div class="dropdown-menu" aria-labelledby="eventsDropdown">
                                <a class="dropdown-item" href="./display_events.php">Display Events</a>
                                <a class="dropdown-item" href="./create_event.php">Create Events</a>
                            </div>

                    </li>
                    <li class="nav-item dropdown">
                        <a  class="nav-link dropdown-toggle" id="usersDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">MANAGE USERS</a>
                            <div class="dropdown-menu" aria-labelledby="usersDropdown">
                                <a class="dropdown-item" href="./display_users.php">Display Users</a>
                                <a class="dropdown-item" href="./create_user.php">Create User</a>
                            </div>

                    </li>';
                    }
                    ?>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php
                            if (isLoggedIn()) {
                                echo $_SESSION['fname'];
                            } else {
                                echo 'USER';
                            }
                            ?>
                            <i class="fa fa-portrait"></i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <?php
                            if (isLoggedIn()) {
                                echo '<a class="dropdown-item" href="./logout.php">Log Out</a>';
                            } else {
                                echo '<a class="dropdown-item" href="#loginDiv" data-toggle="modal" aria-controls="loginDiv">Log In / Sign Up</a>';
                            }
                            ?>
                            <div class="dropdown-divider"></div>
                            <?php
                            if (isLoggedIn() && !isAdmin()) {
                                echo '<a class="dropdown-item" href="./user_bookings.php"><i class="fa fa-calendar-alt"></i> My Bookings</a>
';
                            }
                            ?>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>

</div>
<div class="testcontent">
    <!--<p>EVENTS</p>-->
    <img src="assets/images/EVENTS1.png" alt="">
</div>
<script defer src="./js/main.js"></script>
