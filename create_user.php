<?php
require_once './initialize.php';
require_once './header_main.php';
getMessage();
if (!isAdmin()) {
    setMessage('INSUFFICIENT PRIVILEGES: ADMIN REQUIRED', 'error');
    header('location:index.php');}
?>

<div class="form-wrapper justify-content-center">
    <div class="form-header">CREATE USER</div>
    <?php
    require_once './forms/sign_up.php';
?>

</div>