<!-- Login Page for the drivers -->
<?php

  $showlink = false;
  session_start();
  require("../default/top.php");
  require("../default/var_names.php");

if(is_null($_POST['d_pass']) == false && $_POST['d_pass'] != '')
{
  #first, connect to the database
  $connected = mysqli_init();
  if(!$connected)
  {
    die('mysqli_init failed');
  }
  if(!mysqli_real_connect($connected,'localhost','root',$root_pass,'ontrac_db'))
  {
    echo "Connection to DB failed. " . mysqli_connect_error();
  }
  else
  {
    #Query database for driver info
    #(for now one default driver, will eventually pull by logged in user)

    #if data was retrieved, display results. Else, display error message
    if($driver_info = mysqli_prepare($connected,$get_drivers))
    {
      mysqli_stmt_execute($driver_info);

      mysqli_stmt_bind_result($driver_info,$driver_num,$driver_fname,$driver_lname,$driver_pass);

      #go through driver numbers to find a match for inputted driver number
      while(mysqli_stmt_fetch($driver_info))
      {
        #if a match is found, check if password matches
        if(strcmp($driver_num,$_POST['d_num']) == 0)
        {
          #if password matches, go ahead and bring user to their homepage after storing their info
          if(strcmp($driver_pass,$_POST['d_pass']) == 0)
          {
            $_SESSION['driver_num']   = $driver_num;
            $_SESSION['driver_fname'] = $driver_fname;
            $_SESSION['driver_lname'] = $driver_lname;

            #close database connection
            mysqli_close($connected);

            header('Location: ../home/');
            exit;
          }
        }
      }

      mysqli_stmt_close($driver_info);
    } #end of query if
    else
    {
      echo "SQL query failed";
    }
  }
}


  #close database connection
  mysqli_close($connected);
?>

    <form action="" method="post" style="text-align:center;margin: 0 auto;width:800px;">
    <h1>Driver Number:</h1>
    <input type="text" name="d_num">
    <h1>Password:</h1>
    <input type="password" name="d_pass"> 
    <br>
    <input type="submit">
    </form>

<?php

  require_once("../default/bot.html");
?>
