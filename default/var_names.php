<?php
  #queries
  $insert_stops = "INSERT INTO stops(driver_num,date_del,num_stops,sun_stops,pu_stops,hw_stops) VALUES(?,?,?,?,?,?)";
  $get_stops    = "SELECT * FROM stops WHERE driver_num=? AND MONTH(date_del)=? and YEAR(date_del)=?";
  $get_drivers  = "SELECT * FROM drivers;";

  ?>
