<?php
require_once './initialize.php';
require_once './classes/ticket.php';
if (!isAdmin()) {
    setMessage('INSUFFICIENT PRIVILEGES: ADMIN REQUIRED', 'error');
    header('location:index.php');}

(new Ticket())->deleteTicket();
echo '<script>
window.history.back();
</script> ';