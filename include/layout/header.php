<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>BUS Reservation</title>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<link rel="stylesheet" type="text/css" href="../css/style.css" media="screen" />
<link rel="stylesheet" type="text/css" href="../css/jquery.timepicker.css" media="screen" />
<link rel="stylesheet" type="text/css" href="../css/timepicki.css" />
<script type="text/javascript" src="../include/scripts/jquery.min.js"></script>
<script type="text/javascript" src="../include/scripts/jquery.plugin.js"></script> 
<script type="text/javascript" src="../include/scripts/jquery.datepick.js"></script>
<script type="text/javascript" src="../include/scripts/jquery.timepicker.js"></script>

<script>
$(function() {
  $('#popupDatepicker').datepick({dateFormat: 'yyyy-mm-dd'});
  $('#inlineDatepicker').datepick({onSelect: showDate});
  $('#inputTimepicker').timepicker({
        timeFormat: 'HH:mm',
        interval: 30 // 15 minutos
  });

});

function showDate(date) {
  alert('The date chosen is ' + date);
}
</script>

</head>
<body>
<div id="wrap">
  <div id="top">
    <h2> <a href="index.php">BUS RESERVATION</a></h2>
    <div id="menu">
      <ul>
        <li><a href="index.php" <?php if(basename($_SERVER['PHP_SELF']) === "index.php"){ echo "class='current'" ; }  ?>  >home</a></li>
<!--         <li><a href="search.php">Search</a></li> -->
        <li><a href="login.php" <?php if(basename($_SERVER['PHP_SELF']) === "login.php"){ echo "class='current'" ; }  ?> >Login</a></li>
        <li><a href="logout.php" <?php if(basename($_SERVER['PHP_SELF']) === "logout.php"){ echo "class='current'" ; }  ?> >Logout</a></li>
        <li><a href="about.php" <?php if(basename($_SERVER['PHP_SELF']) === "about.php"){ echo "class='current'" ; }  ?> >About</a></li>
      </ul>
    </div>
  </div>
<?php  //echo "{$_SESSION["username"]} <br>" ?>
  <div id="content">