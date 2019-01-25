<?php
require_once './initialize.php';
require_once './classes/purchases.php';
if (!isLoggedIn()) {
    setMessage('LOGIN FIRST THEN PURCHASE', 'error');
    header('location:index.php');}

    $account_bal = floatval($_SESSION['account_bal']);
    $total_cost = floatval($_POST['totalcost']);
if ($account_bal<$total_cost){
    setMessage('ACCOUNT BALANCE TOO LOW PLEASE RECHARGE TO PURCHASE A TICKET','error');
    header('location:index.php');
}else{
    (new Purchases())->createPurchase();
}
header('location:index.php');
//echo '<pre>';
//var_dump($_POST);
//echo '</pre><br>';
