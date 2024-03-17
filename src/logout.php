<?php
session_start();
if (isset($_GET['secure'])) {
    session_destroy();
    sleep(1);
    echo "<script>
    window.location.href = 'slogin.php'; </script>";
}
if (isset($_GET['unsecure'])) {
    session_destroy();
    sleep(1);
    echo "<script>
    window.location.href = 'uslogin.php'; </script>";
}
