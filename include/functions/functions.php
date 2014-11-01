<?php     
   
    function connect_db() {
        global $connection;
        $dbhost = "localhost";
        $dbuser = "akash";
        $dbpass = "bingo";
        $dbname = "BMS";
        $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    }


    function redirect_to($new_location) {
      header("Location: " . $new_location);
      exit;
    }

    function mysql_prep($string) {
        global $connection;
        
        $escaped_string = mysqli_real_escape_string($connection, $string);
        return $escaped_string;
    }

    function confirm_query($result_set) {
        if (!$result_set) {
            die("Database query failed.");
        }
    }

    function form_errors($errors=array()) {
        $output = "";
        if (!empty($errors)) {
          $output .= "<div id=\"message\">";
          $output .= "Please fix the following errors:";
          $output .= "<ul>";
          foreach ($errors as $key => $error) {
            $output .= "<li>";
                $output .= htmlentities($error);
                $output .= "</li>";
          }
          $output .= "</ul>";
          $output .= "</div>";
        }
        return $output;
    }

    function find_all_users() {
        global $connection;
        
        $query  = "SELECT * ";
        $query .= "FROM user ";
        $query .= "ORDER BY username ASC";
        $user_set = mysqli_query($connection, $query);
        confirm_query($user_set);
        return $user_set;
    }

    function confirm_user($result_set) {
        if (!$result_set) {
            die("User already exist");
        }
    }

    function find_user_by_id($user_id) {
        global $connection;
        
        $safe_user_id = mysqli_real_escape_string($connection, $user_id);
        
        $query  = "SELECT * ";
        $query .= "FROM user ";
        $query .= "WHERE id = {$safe_user_id} ";
        $query .= "LIMIT 1";
        $user_set = mysqli_query($connection, $query);
        confirm_query($user_set);
        if($user = mysqli_fetch_assoc($user_set)) {
            return $user;
        } else {
            return null;
        }
    }


    function check_connect() {
        if(mysqli_connect_errno()) {
        die("database connection failed" . 
            mysqli_connect_error() . 
            " ( " . mysqli_connect_errno() . " ) " );
        }
    }

    function find_user_by_username($username) {
        global $connection;
        
        $safe_username = mysqli_real_escape_string($connection, $username);
        
        $query  = "SELECT * ";
        $query .= "FROM user ";
        $query .= "WHERE username = '{$safe_username}' ";
        $query .= "LIMIT 1";
        $user_set = mysqli_query($connection, $query);
        confirm_query($user_set);
        if($user = mysqli_fetch_assoc($user_set)) {
            return $user;
        } else {
            return null;
        }
    }
    
    function password_check($password, $existing_hash) {
        // existing hash contains format and salt at start
      $hash = crypt($password, $existing_hash);
      if ($hash === $existing_hash) {
        return true;
      } else {
        return false;
      }
    }

    function attempt_login($username, $password) {
        $user = find_user_by_username($username);
        if ($user) {
            // found user, now check password
            if (password_check($password, $user["password"])) {
                // password matches
                return $user;
            } else {
                // password does not match
                return false;
            }
        } else {
            // user not found
            return false;
        }
    }

    function generate_salt($length) {
      // Not 100% unique, not 100% random, but good enough for a salt
      // MD5 returns 32 characters
      $unique_random_string = md5(uniqid(mt_rand(), true));
      
        // Valid characters for a salt are [a-zA-Z0-9./]
      $base64_string = base64_encode($unique_random_string);
      
        // But not '+' which is valid in base64 encoding
      $modified_base64_string = str_replace('+', '.', $base64_string);
      
        // Truncate string to the correct length
      $salt = substr($modified_base64_string, 0, $length);
      
        return $salt;
    }


    function password_encrypt($password) {
      $hash_format = "$2y$10$";   // Tells PHP to use Blowfish with a "cost" of 10
      $salt_length = 22;                    // Blowfish salts should be 22-characters or more
      $salt = generate_salt($salt_length);
      $format_and_salt = $hash_format . $salt;
      $hash = crypt($password, $format_and_salt);
        return $hash;
    }

    function confirm_logged_in() {
        if (!logged_in()) {
            redirect_to("login.php");
        }
    }
?>