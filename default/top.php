<!-- Alexander Simchuk, top.php
This is a page that contains all of the opening 
statements of a page on the website -->

<html>
  <head>
  <title>OnTrac Driver</title>
  <link rel="stylesheet" type="text/css" href="../default/style.css">
  <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="../bootstrap/css/def_style.css">
  </head>
  <body>

    <div id=topbanner>
      <img src="../default/topbanner.jpeg">
    </div>
<?php if($showlink == true) { ?>    
      <div class="navbar">
        <div class="container"> 
          <ul class="nav nav-tabs">
            <li>
              <a href="../home/index.php">Home</a>
            </li>
            <li>
              <a href="../show_invoice/index.php">View Invoice</a>
            </li>
            <li>
              <a href="../insert_stops/index.php">Insert Stops</a>
            </li>
            <li>
              <a href="../change_pass/index.php">Change Password</a>
            </li>
            <li>
              <a href="../default/logout.php">Logout</a>
            </li>
          </ul>
        </div>
      </div>
<?php  }  ?>
    <div class="container">

