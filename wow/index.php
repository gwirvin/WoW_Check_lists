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
print "<br />";
var_dump($_SESSION);
print "<br />";
$oauthToken = getOauthToken($blizzardOauthUrl);
print "<br />";
var_dump($oauthToken);
print "<br />";
#$_SESSION['oauth'] = $oauthToken;
array_push($_SESSION, getOauthToken($blizzardOauthUrl));
print "<br />";
var_dump($_SESSION);
print "<br />";
print_r($_SESSION['oauth']['access_token']);
print "<br />";
?>
