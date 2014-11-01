<?php require_once("../include/functions/session.php"); ?>
<?php require_once("../include/functions/functions.php"); ?>

<?php
	// v1: simple logout
	// session_start();
	$_SESSION["admin_id"] = null;
	$_SESSION["username"] = null;

	redirect_to("login.php");
?>

<?php
	// v2: destroy session
	// assumes nothing else in session to keep
	// session_start();
	// $_SESSION = array();
	// if (isset($_COOKIE[session_name()])) {
	//   setcookie(session_name(), '', time()-42000, '/');
	// }
	// session_destroy(); 
	// redirect_to("login.php");
?>
