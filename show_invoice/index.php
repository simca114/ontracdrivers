<!-- Alexander Simchuk, view_invoices/index.phpn
	This page will grab data from the SQL tables and display them on a table.
	It will also have the option to show a printer friendly version
-->

<?php
   $showlink = true;
   session_start();

if(isset($_SESSION['driver_num'])) #if 1
{
   require("../default/top.php");
   require("../default/var_names.php");


  #set the month and year variables for query
  if(is_null($_POST['month']))
  {
    $month = date('m');
    $year  = date('Y');
  }
  else
  {
    $month = $_POST['month'];
    $year  = $_POST['year'];
  }

?>
 
  <h1>Invoice for <?php echo date("F", mktime(0, 0, 0, $month, 1)) . ", " . $year; ?></h1>

<?php

  #first, connect to the database
  $connected = mysqli_init();
  if (!$connected)
  {
    die('mysqi_init failed');
  }
  else
  { #else2 (sql init_connection)
    if(!mysqli_real_connect($connected,'localhost','root',$root_pass,'ontrac_db'))
    {
      echo "Connection to DB failed. " . mysqli_connect_error();
    }
    else #else3 (sql connection)
    {
      #Query database for driver info
      #(for now one default driver, will eventually pull by logged in user)
      if(!$driver_info = mysqli_prepare($connected,$get_stops))
      {
        echo "SELECT query failed";
      }
      else
      {
        mysqli_stmt_bind_param($driver_info,"iii", $_SESSION['driver_num'],$month,$year);

        mysqli_stmt_execute($driver_info);

        mysqli_stmt_bind_result($driver_info,$driver_num,$date_del,$num_stops,$sun_stops,$pu_stops,$hw_stops);
?>
        <table class="general">
        <tr>
        <!--   <td><b>Name</b></td>   -->
        <td><b>Driver Number</b></td>
        <td><b>Date</b></td>
        <td><b>Stops Delivered</b></td>
        <td><b>Sunrise Stops</b></td>
        <td><b>Pickups</b></td>
        <td><b>Heavy Wieght</b></td>
        </tr>
<?php
        while(mysqli_stmt_fetch($driver_info))
        {
          ?>
          <tr>
	  <td><?php echo $driver_num ?></td>
	  <td><?php echo $date_del   ?></td>
	  <td><?php echo $num_stops  ?></td>
  	  <td><?php echo $sun_stops  ?></td>
  	  <td><?php echo $pu_stops   ?></td>
	  <td><?php echo $hw_stops   ?></td>
          </tr>
<?php
        }

        mysqli_stmt_close($driver_info);

?>
        </table>
<?php
      }
    } #end of else 3

    #close database connection
    mysqli_close($connected);

  } #end of else 2

#Provide a dropdown menu to select a different month to view invoice for
?>
<div id=spacer></div>
<form action="" method="POST">
  <p>Select month to view invoice for (Month,Year):</p>
  <select name="month">
<?php
    for($i = 1; $i <= 12; $i++)
    {
        echo "<option value='$i'" . (($i == $month)?" selected='true'":'') . ">" . date("F", mktime(0, 0, 0, $i, 1)) . "</option>";
    }
?>
  </select>
  <input type="text" name="year" size=4  value="<?php echo $year ?>"/>
  <input type="submit" value="Submit"/>
</form>

<?php  

  require_once( "../default/bot.html" );
} #end of if 1
else #redirect to login page if no session data is stored
{
  header('Location: ../login_page/');
}
?>

