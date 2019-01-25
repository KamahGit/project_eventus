<?php
require_once './initialize.php';
require_once './classes/events.php';
require_once './classes/ticket.php';
if (!isAdmin()) {
    setMessage('INSUFFICIENT PRIVILEGES: ADMIN REQUIRED', 'error');
    header('location:index.php');}

//DELETE CHILD
(new Ticket())->deleteWithEvent();

//DELETE PARENT
$event = new Events();
$event->deleteEvent();

echo '<script>
window.history.back();
</script> ';