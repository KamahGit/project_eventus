<?php
require_once './initialize.php';
require_once './classes/ticket.php';
if (!isAdmin()){
    setMessage('INSUFFICIENT PRIVILEGES: ADMIN REQUIRED', 'error');
    header('location:index.php');
}
if (isset($_GET['id'])){
    $id =$_GET['id'];
}
(new Ticket())->updateTicket($id);
//echo '<script>
//window.history.back();
//</script>';