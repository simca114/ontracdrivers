<?php
#logout function for the website

session_start();

#unset all of the set session variables
unset($_SESSION['driver_num']);
unset($_SESSION['driver_fname']);
unset($_SESSION['driver_lname']);

session_destroy();
header('Location: ../login_page/');
exit;
?>
