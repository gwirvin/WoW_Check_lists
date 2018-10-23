<?php
// Initialize the session
session_start();

// If session variable is not set it will redirect to login page
if(!isset($_SESSION['user_email']) || empty($_SESSION['user_email'])){
  header("location: /login.php");
  exit;
}
include "../cats.php";
include "./includes/blz_oauth_inc.php";
$_SESSION = array_merge($_SESSION, getOauthToken($blizzardOauthUrl));


?>
