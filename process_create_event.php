<?php
/**
 * Created by PhpStorm.
 * User: Bruce
 * Date: 1/16/2019
 * Time: 3:26 AM
 */

require_once 'initialize.php';
require_once './classes/events.php';
require_once './classes/ticket.php';
if (!isAdmin()) {
    setMessage('INSUFFICIENT PRIVILEGES: ADMIN REQUIRED', 'error');
    header('location:index.php');
}
getMessage();
if (isset($_POST['save'])) {

    $event = new Events();
    $event->createEvent();
}
header('location:index.php');
//echo '<pre>';
//var_dump($_POST);
//echo '</pre>';
//extract($_POST);
//var_dump($free);