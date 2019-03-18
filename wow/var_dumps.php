<?php
/**
*
*	version 1.4

*/
// Initialize the session
session_start();
// If session variable is not set it will redirect to login page
if(!isset($_SESSION['user_email']) || empty($_SESSION['user_email'])){
  header("location: /login.php");
  exit;
}
error_reporting(E_ALL);
 ini_set('display_errors', 1);


require_once('Client.php');
require_once('GrantType/IGrantType.php');
require_once('GrantType/AuthorizationCode.php');
include "../cats.php";
include "includes/blz_oauth_inc.php";
include "includes/blizzard_resources_inc.php";
include "includes/wow_char_inc.php";

/**
*	Required vars for the api to work
*
**/

$client_id			= '2abc5bd3a1d64274a2aa9575404cf0e9';
$client_secret			= '4lDDBAihtzLRkljrtYmwRTL1L6xZeOGv';
$region				= 'US';
$locale				= 'en_US';
$wowIndexUri			= 'https://www.grantsgrabbag.com/wow/var_dumps.php';
$redirect_uri			= urlencode($wowIndexUri);
$userId				= 1;

print "Value of \$wowIndexUri is: ".$wowIndexUri."<br />Value with urlencode is: ".$redirect_uri."<hr />\n";
// init the auth system client_id, client_secret, region, local all required

$myOauthToken = getOauthToken($blizzardOauthTokenUrl);

print "var_dump of \$myOauthToken:\n<pre>"; var_dump($myOauthToken); print "</pre>\n<hr />\n";
$oauthFetchSql = ("SELECT oauth_user, oauth_token, oauth_token_expires FROM oauth_session WHERE ouath_user=\"".$_SESSION['user_id']."\"");
print "\rvar_dump of \$oauthFetchSql:\r<pre>"; var_dump($oauthFetchSql); print "\r</pre>\r<hr />\r";
$oauthCheckQuery = mysqli_query($wow_conn, $oauthFetchSql);
if(!isset($oauthCheckQuery['oauth_token']) || empty($oauthCheckQuery['oauth_token'])) {
	$oauthInsertSql = ("INSERT INTO oauth_session (oauth_user, oauth_token, oauth_token_expires) VALUES (\"".$myOauthToken['access_token']."\", \"".$_SESSION['user_id']."\", NOW()) ON DUPLICATE KEY UPDATE");
	print "var_dump of \$oauthInsertSql:\r<pre>\r"; var_dump($oauthInsertSql); print "\r</pre>\r<hr />\r";
#	$oauthInsertQuery = mysqli_query($wow_conn, $oauthInsertSql);
}
print "var_dump of \$_SESSION:\n<pre> "; var_dump($_SESSION); print "</pre>>\n<hr />\n";
$_SESSION = array_merge($_SESSION,$myOauthToken);
print "var_dump of \$_SESSION after array_merge:\n<pre>\n"; var_dump($_SESSION); print "</pre>\n<hr />\n";

$oauthToken = $myOauthToken['access_token'];
$sessionOauthToken = $_SESSION['access_token'];
print "access_token from myOauthToken: ".$oauthToken."\n<br />access_token from _SESSION: ".$sessionOauthToken."<hr />\n";

$tokenTime = date('Y-m-d H:i:s', $_SESSION['expires_in']);
print "Trying to get a datetime format from expires_in (seconds): ".$tokenTime."<hr />\n";

$myOauthCode = getOauthCode($blizzardOauthAuthUrl, $redirect_uri, $myOauthToken['access_token']);
print "var_dump of \$myOauthCode:\n<pre>"; var_dump($myOauthCode); print "</pre>\n<hr />\n";

print "<a href=\"".$blizzardOauthAuthUrl."/?response_type=code&clientid=".$clientId."&redirect_uri=".$redirect_uri."&scope=wow.profile&state=1234xyz\">Blizzard Login</a>";
print "<hr />";
print $blizzardOauthAuthUrl."/?response_type=code&clientid=".$clientId."&redirect_uri=".$redirect_uri."&scope=wow.profile&state=1234xyz";
print "<hr />";


print "var_dump of \$_REQUEST):\n<pre>"; var_dump($_REQUEST); print "</pre>\n<hr />\n";

print "var_dump of \$_GET:\n<pre>"; var_dump($_GET); print "</pre>\n<hr />\n";


$blizzLocale = "locale=en_US";
$toonCounter = 0;
$char_url = $wowUrl."character/";
$wowFields = "fields=reputation,professions,talents,titles,items";
$toon_sql = ("SELECT toon_name, toon_realm FROM toon WHERE toon_owner=\"".$userId."\" ORDER BY toon_realm, toon_name");
$toonName = "";
$toonRealm = "";
$toonIcon = "";
$toonCounter = 0;
$myOauthTokenArr = getOauthToken($blizzardOauthTokenUrl);
$myOauthToken = $myOauthTokenArr['access_token'];


$allUserToons = getUserToons ($userId, $dbHost, $dbUser, $dbPass, $dbWow); // Getting the users info from the DB
$userToonCount = count($allUserToons); // Getting the count of the user's toons
// $allToonUrls = toonUrlArray ($allUserToons, $wow_url, $wowFields, $api_key); // Creating an array of all the API calls
$allToonUrls = toonUrlArray ($allUserToons, $wowUrl, $wowFields, $myOauthToken); // Creating an array of all the API calls using OAuth

/* Using the borrow MultiAPI classes to get all the toon data concurently */
$allToonApiArray = new multiapi();
$allToonApiArray->data = $allToonUrls;
$allToonDataArray = $allToonApiArray->get_process_requests();
/* MultiAPI Calls done */

/* Converting the strings returned int he multiapi to an array fo objects */
$allToonsObjArray = getAllToonObjArray($allToonDataArray, $userToonCount);
print "var_dump of \$allToonsObjArray:\n<pre>"; var_dump($allToonsObjArray); print "</pre>\n<hr />\n";
?>
