<!-- Alexander Simchuk
 A page for the drivers to insert their daily stops -->

<?php
  #ini_set('display_errors',1);
  #error_reporting(E_ALL);

  $showlink = true;
  session_start();
if(isset($_SESSION['driver_num'])) #if 1
{
  require ("../default/top.php");
  require ("../default/var_names.php");
  
  $dt_del  = $_POST['date_del'] ;
  $d_num     = $_POST['d_num'];
  $stops     = $_POST['stops'];
  $sun       = $_POST['sun']  ;
  $hw        = $_POST['hw']   ;
  $pu        = $_POST['pu']   ;

  $display_form = FALSE;

  if($dt_del == "")
  {
    $display_form = TRUE;
  } 

  if($stops == "") 
  {
    $display_form = TRUE;
  }
  else if (!preg_match('/^\d+$/',$stops)) {$display_form = TRUE;}   

  if($d_num != "")
    { echo "d_num is not null <br/>";
      if(!preg_match('/^\d+$/',$d_num))
      {
        echo "d_num is not an int <br/>";
        $display_form = TRUE;
        #add line for appending the variable to the end of the error message
      }
    }
  if($sun != "")
    { echo "sun is not null <br/>";
      if(!preg_match('/^\d+$/',$sun))
      {
        echo "sun is not an int <br/>";
        $display_form = TRUE;
        #add line for appending the variable to the end of the error message
      }
    }
  if($hw != "")
    { echo "hw is not null <br/>";
      if(!preg_match('/^\d+$/',$hw))
      {
        echo "hw is not an int <br/>";
        $display_form = TRUE;
        #add line for appending the variable to the end of the error message
      }
    }
  if($pu != "")
    { echo "pu is not null <br/>";
      if(!preg_match('/^\d+$/',$pu))
      {
        echo "pu is not an int <br/>";
        $display_form = TRUE;
        #add line for appending the variable to the end of the error message
      }
    }

  echo "<br/>";
  if ($display_form == TRUE) 
  { 
?>

    <p style="font-size:30;margin:0;"><b>Insert stops information</b></p>
    <p>Please enter your information below (in numbers)
    <form action="" method="POST">
     <p>Date (yyyy/mm/dd):
     <input type="date" name="date_del" value="<?php echo date('Y-m-d'); ?>"/>
     </p>
     <p>Driver Number:</p> 
     <input type="text" name="d_num" value="<?php echo $_SESSION['driver_num'];?>"/>
     <p>Stops Delivered (sunrise and heavyweights not included):</p>
     <input type="text" name="stops"/>
     <p>Sunrise Stops:</p>
     <input type="text" name="sun"/>
     <p>Heavyweight Stops:</p>
     <input type="text" name="hw"/>
     <p>Pick-ups</p>
     <input type="text" name="pu"/>
     <br>
     <input type="submit"/>
    </form>
   
<?php
  }
  else #else 1
  {
    
    #first, connect to the database
    $connected = mysqli_init();
    if(!$connected)
    {
      die('mysqli_init failed');
    }
    else #else 2
    {

      if(!mysqli_real_connect($connected,'localhost','root',$root_pass,'ontrac_db'))
      {
        echo "Connection to DB failed. " . mysqli_connect_error();
      }
      else #else3
      {
        if(!$add_stops = mysqli_prepare($connected,$insert_stops))
        {
          echo "query prepare failed";
        }
        else
        {
          mysqli_stmt_bind_param($add_stops,"isiiii",$d_num,$dt_del,$stops,$sun,$pu,$hw);

          mysqli_stmt_execute($add_stops);

          echo "Stops inserted successfully!";

          mysqli_stmt_close($add_stops);
        }
      } #end of else 3
    } #end of else 2

    mysqli_close($connected);
  } #end of else 1

  require_once ("../default/bot.html");

} #end of if 1
else #redirect to login page if no session data is stored
{
  header('Location: ../login_page/');
}
?>
