<?php
require_once 'functions.php';
loginFailed();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>eventus</title>

    <!-- Bootstrap || with Data Tables CSS -->
    <link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css"/>

    <!-- FontAwesome CSS -->
    <link rel="stylesheet" href="./css/all.min.css"/>
    <link rel="stylesheet" href="./css/form.css">
    <!-- Custom CSS-->
    <link rel="stylesheet" href="./css/style.css"/>
    <!-- Bootstrap Javascript -->
    <script defer src="js/jquery-3.3.1.slim.min.js"></script>
    <script defer src="js/popper.min.js"></script>

    <script defer src="js/bootstrap.min.js"></script>
    <script defer src="DataTables/datatables.min.js"></script>

    <!-- FontAwesome JS -->
    <script defer src="./js/all.min.js"></script>

</head>
<body>
<nav class="navbar navbar-expand-lg  navbar-light sticky-top">
    <a class="navbar-brand" href="index.php">Eventus</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navContent"
            aria-controls="navContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navContent">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li>
            <?php
            if (isAdmin()) {
                echo <<<HTML
                <li class="nav-item dropdown">
                         <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown1" role="button" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">EVENT ACTIONS</a>
                   <div class="dropdown-menu" aria-labelledby="navbarDropdown1">
                            <a class="dropdown-item" href="#" onclick="getPage('./pager.php?page=event1')">Create Event</a>
                            <div class="dropdown-divider"></div>
                            
                            <a class="dropdown-item" href="#" onclick="getData('2')">View Events(Table)</a>
                            <div class="dropdown-divider"></div>
                   </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">USER ACTIONS</a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown2">
                        <a class="dropdown-item" href="#createuser" id="createuser" onclick="getPage('./pager.php?page=user1')">Create User</a>
                        <div class="dropdown-divider"></div>
                
                        <a class="dropdown-item" href="#" id="viewuser" onclick="getData('1')">View Users(Table)</a>
                        <div class="dropdown-divider"></div>
                    </div>
                </li>
HTML;

            }
            ?>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false"><?php
                    if (isLoggedIn()) {
                        echo $_SESSION['fname'];
                    } ?>
                    <i style="font-size: 25px;text-align: justify; color: #da1b60;" class="fa fa-user-circle"></i>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <?php
                    if (isLoggedIn()) {
                        echo '<a class="dropdown-item" href="logout.php">Log Out</a>';
                    } else {
                        echo ' <a id="loginBtn" class="dropdown-item" href="#" data-toggle="modal" data-target="#loginDiv">Log In </a>';
                    }

                    ?>


                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#regForm">Settings</a>

                </div>
            </li>
        </ul>

    </div>
</nav>

<div id="wrapper">
    <div class="wrapper-content">
        EVENTS MANAGEMENT WITH CLASS
    </div>
</div>

