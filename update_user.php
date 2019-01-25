<?php
require_once './initialize.php';
require_once './classes/user.php';
if (!isLoggedIn()){
    setMessage('LOGIN FIRST!!','error');
    header('location:index.php');
}
if (isset($_GET['id'])){
    $id =$_GET['id'];
}
(new User())->updateUser($id);
echo '<script>
window.history.back();
</script>';

//echo '<pre>';
//var_dump($_POST);
//echo '</pre>';