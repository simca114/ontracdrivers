<!--Alexander Simchuk, home/index.php
This will be the user homepage-->

<?php
  $showlink = true;
  session_start();
if(isset($_SESSION['driver_num'])) #if 1
{
  require("../default/top.php");
?>

  <h1>Welcome 
    <?php echo $_SESSION['driver_fname'];?> 
    <?php echo $_SESSION['driver_lname'];?>
  </h1>

<?php
  require_once( "../default/bot.html" );

} #end of if 1
else #redirect to login page if no session data is stored
{
  header('Location: ../login_page/');
}

?>
