<?php

// File: login.php
namespace girvin;

// Include config file
require_once 'cats.php';
 
// Define variables and initialize with empty values
$user_first = $user_last = $user_created_at = $user_last_access = $user_email = $user_password = "";
$user_email_err = $user_password_err = $access_stmt = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if email is empty
    if(empty(trim($_POST["user_email"]))){
        $user_email_err = 'Please enter email.';
    } else{
        $user_email = trim($_POST["user_email"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST['user_password']))){
        $user_password_err = 'Please enter your password.';
    } else{
        $user_password = trim($_POST['user_password']);
    }
    
    // Validate credentials
    if(empty($user_email_err) && empty($user_password_err)){
        // Prepare a select statement
        $sql = "SELECT user_first, user_last, user_email, user_password, user_id, user_created_at, user_last_access FROM users WHERE user_email = ?";
        $access_sql = "UPDATE users SET user_last_access=NOW() WHERE user_email = ?";
        
        $stmt = mysqli_prepare($users_conn, $sql);
         if(!$stmt){
            // Error checking?
            die('mysqli error: '.mysqli_error($users_conn));
         } elseif ($stmt) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_user_email);
            if ( !mysqli_execute($stmt) ) {
               print_r($stmt);
               print_r($sql);
               die( 'stmt error: '.mysqli_stmt_error($stmt));
            } else {
               //error_log("$stmt", 0);
            }
            // Set parameters
            $param_user_email = $user_email;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if user_email exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $user_first, $user_last, $user_email, $hashed_user_password, $user_id, $user_created_at, $user_last_access);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($user_password, $hashed_user_password)){
                            /* Password is correct, so start a new session and
                            save email, first & last names, created date and last accessed date to the session */
                            $access_stmt = mysqli_prepare($users_conn, $access_sql);
                            if (!$access_stmt) {
                                die('Something went wrong updating access times'.mysqli_error($user_conn));
                            } else {
                                mysqli_stmt_bind_param($access_stmt, "s", $param_user_email);
                                if (!mysqli_stmt_execute($access_stmt)) {
                                   print_r($access_stmt);
                                   die('statement error: '.mysqli_stmt_error($access_stmt));
                                } else {
                                  mysqli_stmt_execute($access_stmt);
                                }
                             }
                            session_start();
                            $_SESSION['user_first'] = $user_first;
                            $_SESSION['user_last'] = $user_last;
                            $_SESSION['user_last_access'] = $user_last_access;
                            $_SESSION['user_created_at'] = $user_created_at;
                            $_SESSION['user_email'] = $user_email;
                            $_SESSION['user_id'] = $user_id;
                            header("location: index.php");
                                
                        } else{
                            // Display an error message if password is not valid
                            $user_password_err = 'The password you entered was not valid.';
                        }
                    }
                } else{
                    // Display an error message if email doesn't exist
                    $user_email_err = 'No account found with that e-mail.';
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
            // Closte statement
            mysqli_stmt_close($access_stmt);
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($users_conn);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="icon" type="image/png" href="favicon-32x32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="favicon-16x16.png" sizes="16x16" />
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body><center>
    <div class="wrapper">
        <h2>Login</h2>
        <p>Please fill in your credentials to login.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($user_email_err)) ? 'has-error' : ''; ?>">
                <label>E-Mail:<sup>*</sup></label>
                <input type="email" name="user_email"class="form-control" value="<?php echo $user_email; ?>">
                <span class="help-block"><?php echo $user_email_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($user_password_err)) ? 'has-error' : ''; ?>">
                <label>Password:<sup>*</sup></label>
                <input type="password" name="user_password" class="form-control">
                <span class="help-block"><?php echo $user_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
            </div>
            <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
        </form>
    </div>
</center>
</body>
</html>
