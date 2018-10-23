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

print "<hr />";
print "Your toekn is: ".$_SESSION['access_token'];
print "<hr />";
print "<a href=\"".$blizzardOauthAuthUrl."/?response_type=code&clientid=".$clientId."&redirect_uri=".$wowIndexUri."&scope=wow.profile&state=1234xyz\">Blizzard Login</a>";
print "<hr />";
var_dump($_SESSION);
print "<hr />";
var_dump($_GET);
print "<hr />";

?>
