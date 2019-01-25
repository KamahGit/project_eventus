<?php
require_once './initialize.php';
require_once './classes/user.php';
if (!isAdmin()) {
    setMessage('INSUFFICIENT PRIVILEGES: ADMIN REQUIRED', 'error');
    header('location:index.php');}

(new User())->deleteUser();
echo '<script>
window.history.back();
</script> ';