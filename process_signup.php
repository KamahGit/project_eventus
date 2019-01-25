<?php
/**
 * Created by PhpStorm.
 * User: Bruce
 * Date: 1/14/2019
 * Time: 8:12 PM
 */

require_once 'initialize.php';
require_once './classes/user.php';

$user = new User();
$user->createUser();
header('location:index.php');