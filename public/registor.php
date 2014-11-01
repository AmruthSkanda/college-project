<?php require_once("../include/functions/session.php"); ?>
<?php require_once("../include/functions/validation_functions.php"); ?>
<?php
    require_once("../include/functions/functions.php");
    connect_db();
    check_connect();
    $username = null;
    $_SESSION["message"] = null;


?>


<?php

if (isset($_POST['submit'])) {

    if($_POST["password"] !== $_POST["pass_conf"]) {
        $_SESSION["message"] = "Passwords doesn't match !";
    } else {



        $required_fields = array("username", "password");
        validate_presences($required_fields);

        $fields_with_max_lengths = array("username" => 15);
        validate_max_lengths($fields_with_max_lengths);

          if (empty($errors)) {


            $username = mysql_prep($_POST["username"]);
            $hashed_password = password_encrypt($_POST["password"]);
            $cemail = mysql_prep($_POST["email"]);
            $address = mysql_prep($_POST["address"]);
            $cph = mysql_prep($_POST["mobile"]);
            $name = mysql_prep($_POST["cname"]);

            
            $query  = "INSERT INTO user (";
            $query .= "  username, password";
            $query .= ") VALUES (";
            $query .= "  '{$username}', '{$hashed_password}'";
            $query .= ")";
            $result = mysqli_query($connection, $query);
            $id = mysqli_insert_id($connection);

            if ($result) {
              // Success
              $query  = "INSERT INTO cus (";
              $query .= "  cid, cname, cph, cemail, Caddress";
              $query .= ") VALUES (";
              $query .= " {$id}, '{$name}' , '{$cph}', '{$cemail}', '{$address}'";
              $query .= ")";
              $result = mysqli_query($connection, $query);

              if ($result) {
                // Success
                $_SESSION["message"] = "User created.";
                redirect_to("index.php");
              } else {
                // Failure
                $_SESSION["message"] = "User creation failed.";
              }

            } else {
              // Failure
              $_SESSION["message"] = "User creation failed.";
            }

        }

    }
}
  
?>

<?php include("../include/layout/header.php"); ?>


 <?php echo message(); ?>
<?php echo form_errors($errors); ?>
<form action="registor.php" method="post">
<div id="rpage" >
  <div id="pbox">
  <h2>Registor </h2>
  </div>
  <div id="pbox">
        <input id="log"  type="text" placeholder="Username" name="username" value="" />
    </div>
  <div id="pbox">
        <input id="log" placeholder="Password" type="password" name="password" value="" />
    </div>
  
  <div id="pbox">  
         <input id="log" placeholder="Confirm Password" type="password" name="pass_conf" value="" />
  </div>

  <div id="pbox">  
         <input id="log" placeholder="Customer Name" type="text" name="cname" value="" />
  </div>

  <div id="pbox">  
 
        <input id="log" placeholder="Mobile" type="text" name="mobile" value="" />
    </div>
      <div id="pbox">  
 
        <input id="log" placeholder="E-mail" type="email" name="email" value="" />
    </div>


      <div id="pbox">  
 
        <input id="log" placeholder="Address" type="text" name="address" value="" />
    </div>

      <div id="pbox">
    <input id="submit" type="submit" name="submit" value="Register" />
</div>
</div>
</form>


<?php include("../include/layout/footer.php"); ?>