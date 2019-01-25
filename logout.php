<?php
/**
 * Created by PhpStorm.
 * User: Bruce
 * Date: 1/15/2019
 * Time: 9:03 PM
 */
include_once 'functions.php';
session_start();
if (isset($_SESSION['id'])) {
    session_destroy();
    foreach ($_SESSION as $key => $value) {
        unset($_SESSION[$key]);
    }
} else {
    exit;
}
//var_dump($_SESSION);
redirect_to('index.php');
