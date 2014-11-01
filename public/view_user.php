<?php require_once("../include/functions/session.php"); ?>
<?php require_once("../include/functions/functions.php"); ?>
<?php
    require_once("../include/functions/functions.php");
    connect_db();
    check_connect();

?>

<?php include("../include/layout/header.php"); ?>

<?php echo "{$_SESSION["username"]}" ?>

<?php include("../include/layout/footer.php"); ?>
