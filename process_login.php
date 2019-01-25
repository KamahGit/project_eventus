<?php
/**
 * Created by PhpStorm.
 * User: Bruce
 * Date: 1/14/2019
 * Time: 1:59 PM
 */

require_once 'initialize.php';
if (isset($_POST['login'])) {
    extract($_POST);
    $db = new dataBase();

    $login_sql = "SELECT u.`id`,u.`fname`,u.`lname`,u.`email`,u.`photo`,u.`account_bal` , role.`name` AS `role` 
                  FROM  project_eventus.user u 
                  INNER JOIN project_eventus.role ON u.role_id = role.id 
                  WHERE `email` = '$email' and `password` = '$password'";
    $db->setSql($login_sql)->execQuery();


    if (mysqli_num_rows($db->getResult()) == 1) {
        $user = mysqli_fetch_assoc($db->getResult());
        session_start();
        foreach ($user as $key=>$value) {
            $_SESSION[$key] = $value;

        }
        setMessage('LOGIN SUCCESS!','success');
    } else {
        setMessage('LOGIN FAILED! TRY AGAIN'.$db->getConn()->error,'error');
    }
    $db->freeRes();
    redirect_to('index.php');

}
