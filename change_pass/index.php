<!-- Alexander Simchuk
 A page for the drivers to change their passwords -->

<?php
  #ini_set('display_errors',1);
  #error_reporting(E_ALL);
  $showlink = true;
  session_start();

if(isset($_SESSION['driver_num'])) #if 1
{
  require ("../default/top.php");
  require ("../default/var_names.php");
?>
 
  <h1>This page is still under construction</h1>

<?php
 
  require_once ("../default/bot.html");
}
else
{
   header('Location: ../login_page/');
}

?>
