<?php

/** File: register.php
 * Script for registering new users 
 * **/

// Include config file
require_once 'cats.php';
 
// Define variables and initialize with empty values
$user_first = $user_last = $user_email = $user_password = $confirm_user_password = "";
$user_first_err = $user_last_err = $user_email_err = $user_password_err = $confirm_user_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validate First Name
    if (empty(trim($_POST["user_first"]))) {
        $user_first_err = "Please enter your first name";
    } else {
        //prepare a select statement
        $first_sql = "SELECT user_id FROM users WHERE user_first = ?";
        if ($first_stmt = mysqli_prepare($users_conn, $first_sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($first_stmt, "s", $param_user_first);
            // Set parameters
            $param_user_first = trim($_POST["user_first"]);
            // Attempt to execute the prepared statement
            mysqli_stmt_execute($first_stmt);
                /* Store Result */
                mysqli_stmt_store_result($first_stmt);
                $user_first = trim($_POST["user_first"]);
          } else {
                echo "Oops! Something went wrong. Please try again later.";
          }
        // Close statement
        mysqli_stmt_close($first_stmt);
        }

    // Validate Last Name
    if (empty(trim($_POST["user_last"]))) {
        $user_last_err = "Please enter your last name";
    } else {
        //prepare a select statement
        $last_sql = "SELECT user_id FROM users WHERE user_last = ?";
        if ($last_stmt = mysqli_prepare($users_conn, $last_sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($last_stmt, "s", $param_user_last);
            // Set parameters
            $param_user_last = trim($_POST["user_last"]);
            // Attempt to execute the prepared statement
            mysqli_stmt_execute($last_stmt);
                /* Store Result */
                mysqli_stmt_store_result($last_stmt);
                $user_last = trim($_POST["user_last"]);
          } else {
                echo "Oops! Something went wrong. Please try again later.";
          }
        // Close statement
        mysqli_stmt_close($last_stmt);
        }

    // Validate e-mail address
    if (empty(trim($_POST["user_email"]))) {
        $user_email_err = "Please enter your e-mail address";
    } else {
        //prepare a select statement
        $user_email_sql = "SELECT user_id FROM users WHERE user_email = ?";
        $stmt = mysqli_prepare($users_conn, $user_email_sql);
        if ( !$stmt ) {
            // Error checking?
            die('mysqli error: '.mysqli_error($userconn));
         } elseif ($stmt) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_user_email);
            if ( !mysqli_execute($stmt)) {
                die('statement error: '.mysqli_stmt_error($stmt));
            } else {
                error_log($stmt, 0);
                }
            // Set parameters
            $param_user_email = trim($_POST["user_email"]);
            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                /* Store Result */
                mysqli_stmt_store_result($stmt);
                if (mysqli_stmt_num_rows($stmt) ==1) {
                   $user_email_err = "This e-mail address has already been registered!";
                } else {
                    $user_email = trim($_POST["user_email"]);
                 }
          } else {
                echo "Oops! Something went wrong. Please try again later.";
          }
        }
        // Close statement
        mysqli_stmt_close($stmt);
    }

    if(empty(trim($_POST['user_password']))){
        $user_password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST['user_password'])) < 6){
        $user_password_err = "Password must have atleast 6 characters.";
    } else{
        $user_password = trim($_POST['user_password']);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_user_password"]))){
        $confirm_user_password_err = 'Please confirm password.';     
    } else{
        $confirm_user_password = trim($_POST['confirm_user_password']);
        if($user_password != $confirm_user_password){
            $confirm_user_password_err = 'Password did not match.';
        }
    }
    
    // Check input errors before inserting in database
    if(empty($user_first_err) && empty($user_last_err) && empty($user_email_err) && empty($user_password_err) && empty($confirm_user_password_err)) {
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (user_first, user_last, user_email, user_password) VALUES (?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($users_conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssss", $param_user_first, $param_user_last, $param_user_email, $param_user_password);
            
            // Set parameters
            $param_user_first = $user_first;
            $param_user_last = $user_last;
            $param_user_email = $user_email;
            $param_user_password = password_hash($user_password, PASSWORD_DEFAULT); // Creates a password hash
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: /login.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }
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
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="icon" type="image/png" href="favicon-32x32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="favicon-16x16.png" sizes="16x16" />
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($user_first_err)) ? 'has-error' : ''; ?>">
                <label>First Name:<sup>*</sup></label>
                <input type="text" name="user_first" class="form-control" value="<?php echo $user_first; ?>">
		<span class=help-block"><?php echo $user_first_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($user_last_err)) ? 'has-error' : ''; ?>">
                <label>Last Name:<sup>*</sup></label>
                <input type="text" name="user_last" class="form-control" value="<?php echo $user_last; ?>">
		<span class=help-block"><?php echo $user_last_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($user_email_err)) ? 'has-error' : ''; ?>">
                <label>E-Mail:<sup>*</sup></label>
                <input type="email" name="user_email" class="form-control" value="<?php echo $user_email; ?>">
                <span class=help-block"><?php echo $user_email_err ; ?></span>
            </div> 
            <div class="form-group <?php echo (!empty($user_password_err)) ? 'has-error' : ''; ?>">
                <label>Password:<sup>*</sup></label>
                <input type="password" name="user_password" class="form-control" value="<?php echo $user_password; ?>">
                <span class="help-block"><?php echo $user_password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_user_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password:<sup>*</sup></label>
                <input type="password" name="confirm_user_password" class="form-control" value="<?php echo $confirm_user_password; ?>">
                <span class="help-block"><?php echo $confirm_user_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
    </div>    
</body>
</html>
