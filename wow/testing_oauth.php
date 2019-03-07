<?php
/* file: legion.php */
// Initialize the session
session_start();

// If session variable is not set it will redirect to login page
if(!isset($_SESSION['user_email']) || empty($_SESSION['user_email'])){
  header("location: /login.php");
  exit;
}


// Block for testing
/*
*/
include "../cats.php";
include "./includes/blz_oauth_inc.php";
include "includes/blizzard_resources_inc.php";
include "./includes/wow_char_inc.php";
include "./includes/wow_class_inc.php";
include "./includes/wow_fact_inc.php";
include "./includes/wow_html_inc.php";
include "./includes/wow_profs_inc.php";
include "./includes/wow_reps_inc.php";
include "./includes/bfa_chk_lst.php";
#include "./includes/multiapi.php";

// Variables for the start
$toon_owner_id = $_SESSION['user_id'];
$toon_owner_first = $_SESSION['user_first'];
$myOauthTokenArr = getOauthToken($blizzardOauthTokenUrl);
$myOauthToken = $myOauthTokenArr['access_token'];

$allUserToons = getUserToons ($userId, $dbHost, $dbUser, $dbPass, $dbWow); // Getting the users info from the DB
$userToonCount = count($allUserToons); // Getting the count of the user's toons
// $allToonUrls = toonUrlArray ($allUserToons, $wow_url, $wowFields, $api_key); // Creating an array of all the API calls
$allToonUrls = toonUrlArray ($allUserToons, $wowUrl, $wowFields, $myOauthToken); // Creating an array of all the API calls using OAuth

print "<hr />\r<p />\rvar_dump of \$allUserToons\r<pre>\n";
var_dump($allUserToons);
print "</pre>\r";
print "hr />\r<p />\rvar_dump of \$allToonUrls\r<pre>\r";
var_dump($allToonUrls);
print "</pre>\r";
print "hr />\r";


?>
