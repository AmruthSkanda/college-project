<?php require_once("../include/functions/session.php"); ?>
<?php require_once("../include/functions/validation_functions.php"); ?>
<?php
    require_once("../include/functions/functions.php");
    connect_db();
    check_connect();
?>

<?php

$username = "";

if (isset($_POST['submit'])) {
  // Process the form
  
  // vauldations
  $required_fields = array("username", "password");
  validate_presences($required_fields);
  
    // Attempt Login
  if (empty($errors)) {

    $username = $_POST["username"];
    $password = $_POST["password"];
    
    $found_user = attempt_login($username, $password);

    if ($found_user) {
      // Success
      // Mark user as logged in
      $_SESSION["user_id"] = $found_user["id"];
      $_SESSION["username"] = $found_user["username"];
      redirect_to("logedin.php");
    } else {
      // Failure
      $_SESSION["message"] = "Username/password not found.";
    }
  
} else {
  // This is probably a GET request
  
} // end: if (isset($_POST['submit']))
}
?>

<?php include("../include/layout/header.php"); ?>
       
<form action="login.php" method="post">
<div id="login" >
<?php echo message(); ?>
<?php echo form_errors($errors); ?>
<h2>Login</h2>
<ul>
  <li> <div id="box">
        <input id="log" type="text" name="username" placeholder="Username" value="<?php echo htmlentities($username); ?>" />
  </div> </li>
  
  <li> <div id="box">
      <input id="log" type="password" placeholder="Password" name="password" value="" />
  </div> </li>
  
  <li>       
      <input id="submit" type="submit" name="submit" value="Login" />
  </li>
  
  <li> <div id="box" > <div id="reg"> 
        <a id="regl" href="registor.php"><center>Register</center></a>
  </div> </div></li>

</ul> 
</div>
</form>

<?php include("../include/layout/footer.php"); ?>