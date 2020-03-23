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
include "includes/wow_reps_inc.php";

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

// init the auth system client_id, client_secret, region, local all required

$myOauthToken = getOauthToken($blizzardOauthTokenUrl);

$oauthFetchSql = ("SELECT oauth_user, oauth_token, oauth_token_expires FROM oauth_session WHERE ouath_user=\"".$_SESSION['user_id']."\"");
$oauthCheckQuery = mysqli_query($wow_conn, $oauthFetchSql);
if(!isset($oauthCheckQuery['oauth_token']) || empty($oauthCheckQuery['oauth_token'])) {
	$oauthInsertSql = ("INSERT INTO oauth_session (oauth_user, oauth_token, oauth_token_expires) VALUES (\"".$myOauthToken['access_token']."\", \"".$_SESSION['user_id']."\", NOW()) ON DUPLICATE KEY UPDATE");
$oauthInsertQuery = mysqli_query($wow_conn, $oauthInsertSql);
}
$_SESSION = array_merge($_SESSION,$myOauthToken);

$oauthToken = $myOauthToken['access_token'];
$sessionOauthToken = $_SESSION['access_token'];

$tokenTime = date('Y-m-d H:i:s', $_SESSION['expires_in']);

$myOauthCode = getOauthCode($blizzardOauthAuthUrl, $redirect_uri, $myOauthToken['access_token']);


$blizzLocale = "locale=en_US";
$toonCounter = 0;
$toon_sql = ("SELECT toon_name, toon_slug, toon_realm FROM toon WHERE toon_owner=\"".$userId."\" ORDER BY toon_realm, toon_slug");
$toonName = "";
$toonRealm = "";
$toonIcon = "";
$toonCounter = 0;
$myOauthTokenArr = getOauthToken($blizzardOauthTokenUrl);
$myOauthToken = $myOauthTokenArr['access_token'];


$allUserToons = getUserToons ($userId, $dbHost, $dbUser, $dbPass, $dbWow); // Getting the users info from the DB
$userToonCount = count($allUserToons); // Getting the count of the user's toons

$communityToonUrls = toonCommunityUrlArray ($allUserToons, $myOauthToken); // Creating an array of all the API calls
/* Using the borrow MultiAPI classes to get all the toon data concurently */
$commToonApiArray = new multiapi();
$commToonApiArray->data = $communityToonUrls;
$commToonDataArray = $commToonApiArray->get_process_requests();
/* MultiAPI Calls done */

/* Converting the strings returned int he multiapi to an array fo objects */
$allToonsObjArray = getAllToonObjArray($commToonDataArray, $userToonCount);
//print "var_dump of \$_SESSION:\n<pre> "; var_dump($_SESSION); print "</pre>>\n<hr />\n";
print "var_dump of \$oauthInsertSql:\r<pre>\r"; var_dump($oauthInsertSql); print "\r</pre>\r<hr />\r";
//print "<hr />\rValue of \$allUserToons is:\r<pre>"; var_dump($allUserToons)."</pre>\r<hr />\r";
print "\n<br>\n<hr />\nValue of \$wowIndexUri is: ".$wowIndexUri."<br />Value with urlencode is: ".$redirect_uri."<hr />\n";
print "var_dump of \$myOauthToken:\n<pre>"; var_dump($myOauthToken); print "</pre>\n<hr />\n";
print "var_dump of \$oauthFetchSql:\r<pre>"; var_dump($oauthFetchSql); print "\r</pre>\r<hr />\r";
print "var_dump of \$communityToonUrls:\n<pre>\n"; var_dump($communityToonUrls); print "\n</pre>\n<hr />\n";
foreach ($allToonsObjArray as $toonObj) {
	$toonRepsUrl = getToonRepInfo($toonObj->reputations->href.$blizzardLocaleUs.$tokenPrefix.$myOauthToken);
	$toonMediaUrl = $toonObj->media->href.$blizzardLocaleUs.$tokenPrefix.$myOauthToken;
	$toonMediaObj = getToonMediaInfo($toonObj->media->href.$blizzardLocaleUs.$tokenPrefix.$myOauthToken);
	$toonProfsUrl = getToonProfsInfo($blizzardApiBase.$wowProfile.$toonObj->realm->slug."/".strtolower($toonObj->name)."/professions".$wowProfileNamespace.$blizzardLocaleUs.$tokenPrefix.$myOauthToken);
	print "<img src=\"".$toonMediaObj->avatar_url."\"> var_dump of \$toonRepsUrl, \$toonMediaUrl \$toonProfsUrl for ".$toonObj->name.", a level ".$toonObj->level." ".$toonObj->faction->name->en_US." ".$toonObj->race->name->en_US." ".$toonObj->active_spec->name->en_US." ".$toonObj->character_class->name->en_US." on ".$toonObj->realm->name->en_US." with an iLVL of ".$toonObj->equipped_item_level.":\r<pre>\r"; var_dump($toonMediaUrl); var_dump($toonProfsUrl);
	
	$toonRepCount = count($toonRepsUrl->reputations);
	$bfaReps = $toonRepsUrl;
	$bfaRepCount = $toonRepCount;
	$wowFaction = $toonObj->faction->type;
	print "\rThe \$toonRepCount is: ".$toonRepCount."\r<br>\r==============================\r<br>\r";
        $toonRepCount = count($bfaReps->reputations);
        $champsOfAzeroth = "\n\tNo API Data";
		$tortollanSeekers = "\n\tNo API Data";
        $factionReps = "";
		
		                       $honorbound = "\n\tNo API Data";
        $talanjisExpedition = "\n\tNo API Data";                                                    $voldunai = "\n\tNo API Data";
        $zandalariEmpire = "\n\tNo API Data";
		$seventhLegion = "\n\tNo API Data";
		  $proudmooreAdmiralty = "\n\tNo API Data";                                                   $orderOfEmbers = "\n\tNo API Data";
        $stormsWake = "\n\tNo API Data";
		     $theUnshackled = "\n\tNo API Data";
		  $wavebladeAnkoan = "\n\tNo API Data";
		$rustboltResistance = "\n\tNo API Data";
	for ($bfaRepCounter = 0; $bfaRepCounter < $bfaRepCount; $bfaRepCounter++) {
                if ($bfaReps->reputations[$bfaRepCounter]->faction->id === 2164) {
                        switch ($bfaReps->reputations[$bfaRepCounter]->standing->tier) {
                                case 0:
                                        $champsOfAzeroth = "\n\t".$bfaReps->reputations[$bfaRepCounter]->faction->name." - ".($bfaReps->reputations[$bfaRepCounter]->standing->max-$bfaReps->reputations[$bfaRepCounter]->standing->value)." to Hostile";
                                        break;
                                case 1:
                                        $champsOfAzeroth = "\n\t".$bfaReps->reputations[$bfaRepCounter]->faction->name." - ".($bfaReps->reputations[$bfaRepCounter]->standing->max-$bfaReps->reputations[$bfaRepCounter]->standing->value)." to Unfriendly";
                                        break;
                                case 2:
                                        $champsOfAzeroth = "\n\t".$bfaReps->reputations[$bfaRepCounter]->faction->name." - ".($bfaReps->reputations[$bfaRepCounter]->standing->max-$bfaReps->reputations[$bfaRepCounter]->standing->value)." to Neutral";
                                        break;
                                case 3:
                                        $champsOfAzeroth = "\n\t".$bfaReps->reputations[$bfaRepCounter]->faction->name." - ".($bfaReps->reputations[$bfaRepCounter]->standing->max-$bfaReps->reputations[$bfaRepCounter]->standing->value)." to Friendly";
                                        break;
                                case 4:
                                        $champsOfAzeroth = "\n\t".$bfaReps->reputations[$bfaRepCounter]->faction->name." - ".($bfaReps->reputations[$bfaRepCounter]->standing->max-$bfaReps->reputations[$bfaRepCounter]->standing->value)." to Honored";
                                        break;
                                case 5:
                                        $champsOfAzeroth = "\n\t".$bfaReps->reputations[$bfaRepCounter]->faction->name." - ".($bfaReps->reputations[$bfaRepCounter]->standing->max-$bfaReps->reputations[$bfaRepCounter]->standing->value)." to Revered";
                                        break;
                                case 6:
                                        $champsOfAzeroth = "\n\t".$bfaReps->reputations[$bfaRepCounter]->faction->name." - ".($bfaReps->reputations[$bfaRepCounter]->standing->max-$bfaReps->reputations[$bfaRepCounter]->standing->value)." to Exalted";
                                        break;
                                case 7:
                                        $champsOfAzeroth = "\n\t".$bfaReps->reputations[$bfaRepCounter]->faction->name." - Exalted"."</font";
                                        break;
                                case NULL:
                                        $champsOfAzeroth = "No API Data";
                                        break;
                        }
                } elseif ($bfaReps->reputations[$bfaRepCounter]->faction->id === 2163) {
                        switch ($bfaReps->reputations[$bfaRepCounter]->standing->tier) {
                                case 0:
                                        $tortollanSeekers = "\n\t".$bfaReps->reputations[$bfaRepCounter]->faction->name." - ".($bfaRep->max - $bfaRep->value)." to Hostile";
                                        break;
                                case 1:
                                        $tortollanSeekers = "\n\t".$bfaReps->reputations[$bfaRepCounter]->faction->name." - ".($bfaRep->max - $bfaRep->value)." to Unfriendly";
                                        break;
                                case 2:
                                        $tortollanSeekers = "\n\t".$bfaReps->reputations[$bfaRepCounter]->faction->name." - ".($bfaRep->max - $bfaRep->value)." to Neutral";
                                        break;
                                case 3:
                                        $tortollanSeekers = "\n\t".$bfaReps->reputations[$bfaRepCounter]->faction->name." - ".($bfaRep->max - $bfaRep->value)." to Friendly";
                                        break;
                                case 4:
                                        $tortollanSeekers = "\n\t".$bfaReps->reputations[$bfaRepCounter]->faction->name." - ".($bfaReps->reputations[$bfaRepCounter]->standing->max-$bfaReps->reputations[$bfaRepCounter]->standing->value)." to Honored";
                                        break;
                                case 5:
                                        $tortollanSeekers = "\n\t".$bfaReps->reputations[$bfaRepCounter]->faction->name." - ".($bfaReps->reputations[$bfaRepCounter]->standing->max-$bfaReps->reputations[$bfaRepCounter]->standing->value)." to Revered";
                                        break;
                                case 6:
                                        $tortollanSeekers = "\n\t".$bfaReps->reputations[$bfaRepCounter]->faction->name." - ".($bfaReps->reputations[$bfaRepCounter]->standing->max-$bfaReps->reputations[$bfaRepCounter]->standing->value)." to Exalted";
                                        break;
                                case 7:
                                        $tortollanSeekers = "\n\t".$bfaReps->reputations[$bfaRepCounter]->faction->name." - Exalted"."</font";                                               break;
                                case NULL:
                                        $tortollanSeekers = "No API Data";
                                        break;
		                                                                          }
                } elseif ($bfaReps->reputations[$bfaRepCounter]->faction->id === 2391) {
                        switch ($bfaReps->reputations[$bfaRepCounter]->standing->tier) {
                                case 0:                                                                                                                                                        $rustboltResistance = "\n\t".$bfaReps->reputations[$bfaRepCounter]->faction->name." - ".($bfaRep->max - $bfaRep->value)." to Hostile";
                                        break;
                                case 1:
                                        $rustboltResistance = "\n\t".$bfaReps->reputations[$bfaRepCounter]->faction->name." - ".($bfaRep->max - $bfaRep->value)." to Unfriendly";                                          break;
                                case 2:
                                        $rustboltResistance = "\n\t".$bfaReps->reputations[$bfaRepCounter]->faction->name." - ".($bfaRep->max - $bfaRep->value)." to Neutral";
                                        break;                                                                                                                                         case 3:
                                        $rustboltResistance = "\n\t".$bfaReps->reputations[$bfaRepCounter]->faction->name." - ".($bfaRep->max - $bfaRep->value)." to Friendly";
                                        break;
                                case 4:                                                                                                                                                        $rustboltResistance = "\n\t".$bfaReps->reputations[$bfaRepCounter]->faction->name." - ".($bfaReps->reputations[$bfaRepCounter]->standing->max-$bfaReps->reputations[$bfaRepCounter]->standing->value)." to Honored";
                                        break;
                                case 5:                                                                                                                                                        $rustboltResistance = "\n\t".$bfaReps->reputations[$bfaRepCounter]->faction->name." - ".($bfaReps->reputations[$bfaRepCounter]->standing->max-$bfaReps->reputations[$bfaRepCounter]->standing->value)." to Revered";
                                        break;
                                case 6:
                                        $rustboltResistance = "\n\t".$bfaReps->reputations[$bfaRepCounter]->faction->name." - ".($bfaReps->reputations[$bfaRepCounter]->standing->max-$bfaReps->reputations[$bfaRepCounter]->standing->value)." to Exalted";
                                        break;
                                case 7:
                                        $rustboltResistance = "\n\t".$bfaReps->reputations[$bfaRepCounter]->faction->name." - Exalted"."</font";
                                        break;
                                case NULL:
                                        $rustboltResistance = "No API Data";
                                        break;
                        }

                } elseif ($wowFaction == 'HORDE' ) {
                        if ($bfaReps->reputations[$bfaRepCounter]->faction->id === 2157) {
                                switch ($bfaReps->reputations[$bfaRepCounter]->standing->tier) {
                                        case 0:
                                                $honorbound = "\n\t".$bfaReps->reputations[$bfaRepCounter]->faction->name." - ".($bfaReps->reputations[$bfaRepCounter]->standing->max-$bfaReps->reputations[$bfaRepCounter]->standing->value)." to Hostile";
                                                break;
                                        case 1:
                                                $honorbound = "\n\t".$bfaReps->reputations[$bfaRepCounter]->faction->name." - ".($bfaReps->reputations[$bfaRepCounter]->standing->max-$bfaReps->reputations[$bfaRepCounter]->standing->value)." to Unfriendly";                                                                                                                           break;
                                        case 2:
                                                $honorbound = "\n\t".$bfaReps->reputations[$bfaRepCounter]->faction->name." - ".($bfaReps->reputations[$bfaRepCounter]->standing->max-$bfaReps->reputations[$bfaRepCounter]->standing->value)." to Neutral";                                                                                                                              break;
                                        case 3:
                                                $honorbound = "\n\t".$bfaReps->reputations[$bfaRepCounter]->faction->name." - ".($bfaReps->reputations[$bfaRepCounter]->standing->max-$bfaReps->reputations[$bfaRepCounter]->standing->value)." to Friendly";                                                                                                                             break;
                                        case 4:
                                                $honorbound = "\n\t".$bfaReps->reputations[$bfaRepCounter]->faction->name." - ".($bfaReps->reputations[$bfaRepCounter]->standing->max-$bfaReps->reputations[$bfaRepCounter]->standing->value)." to Honored";
                                                break;
                                        case 5:
                                                $honorbound = "\n\t".$bfaReps->reputations[$bfaRepCounter]->faction->name." - ".($bfaReps->reputations[$bfaRepCounter]->standing->max-$bfaReps->reputations[$bfaRepCounter]->standing->value)." to Revered";
                                                break;
                                        case 6:
                                                $honorbound = "\n\t".$bfaReps->reputations[$bfaRepCounter]->faction->name." - ".($bfaReps->reputations[$bfaRepCounter]->standing->max-$bfaReps->reputations[$bfaRepCounter]->standing->value)." to Exalted";
                                                break;
                                        case 7:
                                                $honorbound = "\n\t".$bfaReps->reputations[$bfaRepCounter]->faction->name." - Exalted"."</font";
                                                break;
                                        case NULL:
                                                $honorbound = "No API Data";
                                                break;
                                }
                        } elseif ($bfaReps->reputations[$bfaRepCounter]->faction->id === 2158) {
                                switch ($bfaReps->reputations[$bfaRepCounter]->standing->tier) {
                                        case 0:
                                                $voldunai = "\n\t".$bfaReps->reputations[$bfaRepCounter]->faction->name." - ".($bfaReps->reputations[$bfaRepCounter]->standing->max-$bfaReps->reputations[$bfaRepCounter]->standing->value)." to Hostile";                                                                                                                                break;
                                        case 1:
                                                $voldunai = "\n\t".$bfaReps->reputations[$bfaRepCounter]->faction->name." - ".($bfaReps->reputations[$bfaRepCounter]->standing->max-$bfaReps->reputations[$bfaRepCounter]->standing->value)." to Unfriendly";                                                                                                                             break;
                                        case 2:
                                                $voldunai = "\n\t".$bfaReps->reputations[$bfaRepCounter]->faction->name." - ".($bfaReps->reputations[$bfaRepCounter]->standing->max-$bfaReps->reputations[$bfaRepCounter]->standing->value)." to Neutral";                                                                                                                                break;
                                        case 3:
                                                $voldunai = "\n\t".$bfaReps->reputations[$bfaRepCounter]->faction->name." - ".($bfaReps->reputations[$bfaRepCounter]->standing->max-$bfaReps->reputations[$bfaRepCounter]->standing->value)." to Friendly";
                                                break;
                                        case 4:
                                                $voldunai = "\n\t".$bfaReps->reputations[$bfaRepCounter]->faction->name." - ".($bfaReps->reputations[$bfaRepCounter]->standing->max-$bfaReps->reputations[$bfaRepCounter]->standing->value)." to Honored";
                                                break;
                                        case 5:
                                                $voldunai = "\n\t".$bfaReps->reputations[$bfaRepCounter]->faction->name." - ".($bfaReps->reputations[$bfaRepCounter]->standing->max-$bfaReps->reputations[$bfaRepCounter]->standing->value)." to Revered";
                                                break;
                                        case 6:
                                                $voldunai = "\n\t".$bfaReps->reputations[$bfaRepCounter]->faction->name." - ".($bfaReps->reputations[$bfaRepCounter]->standing->max-$bfaReps->reputations[$bfaRepCounter]->standing->value)." to Exalted";
                                                break;
                                        case 7:
                                                $voldunai = "\n\t".$bfaReps->reputations[$bfaRepCounter]->faction->name." - Exalted"."";                                                       break;
                                        case NULL:
                                                $voldunai = "No API Data";
                                                break;                                                                                                                                 }
                        } elseif ($bfaReps->reputations[$bfaRepCounter]->faction->id === 2156) {
                                switch ($bfaReps->reputations[$bfaRepCounter]->standing->tier) {
                                        case 0:                                                                                                                                                        $talanjisExpedition = "\n\t".$bfaReps->reputations[$bfaRepCounter]->faction->name." - ".($bfaReps->reputations[$bfaRepCounter]->standing->max-$bfaReps->reputations[$bfaRepCounter]->standing->value)." to Hostile";
                                                break;
                                        case 1:                                                                                                                                                        $talanjisExpedition = "\n\t".$bfaReps->reputations[$bfaRepCounter]->faction->name." - ".($bfaReps->reputations[$bfaRepCounter]->standing->max-$bfaReps->reputations[$bfaRepCounter]->standing->value)." to Unfriendly";
                                                break;
                                        case 2:                                                                                                                                                        $talanjisExpedition = "\n\t".$bfaReps->reputations[$bfaRepCounter]->faction->name." - ".($bfaReps->reputations[$bfaRepCounter]->standing->max-$bfaReps->reputations[$bfaRepCounter]->standing->value)." to Neutral";
                                                break;
                                        case 3:                                                                                                                                                        $talanjisExpedition = "\n\t".$bfaReps->reputations[$bfaRepCounter]->faction->name." - ".($bfaReps->reputations[$bfaRepCounter]->standing->max-$bfaReps->reputations[$bfaRepCounter]->standing->value)." to Friendly";
                                                break;
                                        case 4:
                                                $talanjisExpedition = "\n\t".$bfaReps->reputations[$bfaRepCounter]->faction->name." - ".($bfaReps->reputations[$bfaRepCounter]->standing->max-$bfaReps->reputations[$bfaRepCounter]->standing->value)." to Honored";
                                                break;
                                        case 5:
                                                $talanjisExpedition = "\n\t".$bfaReps->reputations[$bfaRepCounter]->faction->name." - ".($bfaReps->reputations[$bfaRepCounter]->standing->max-$bfaReps->reputations[$bfaRepCounter]->standing->value)." to Revered";
                                                break;
                                        case 6:
                                                $talanjisExpedition = "\n\t".$bfaReps->reputations[$bfaRepCounter]->faction->name." - ".($bfaReps->reputations[$bfaRepCounter]->standing->max-$bfaReps->reputations[$bfaRepCounter]->standing->value)." to Exalted";
                                                break;
                                        case 7:
                                                $talanjisExpedition = "\n\t".$bfaReps->reputations[$bfaRepCounter]->faction->name." - Exalted"."";
                                                break;
                                        case NULL:
                                                $talanjisExpedition = "No API Data";                                                                                        break;
                                }
                        } elseif ($bfaReps->reputations[$bfaRepCounter]->faction->id === 2103) {
                                switch ($bfaReps->reputations[$bfaRepCounter]->standing->tier) {                                                                                               case 0:
                                                $zandalariEmpire = "\n\t".$bfaReps->reputations[$bfaRepCounter]->faction->name." - ".($bfaReps->reputations[$bfaRepCounter]->standing->max-$bfaReps->reputations[$bfaRepCounter]->standing->value)." to Hostile";
                                                break;                                                                                                                                         case 1:
                                                $zandalariEmpire = "\n\t".$bfaReps->reputations[$bfaRepCounter]->faction->name." - ".($bfaReps->reputations[$bfaRepCounter]->standing->max-$bfaReps->reputations[$bfaRepCounter]->standing->value)." to Unfriendly";
                                                break;                                                                                                                                         case 2:
                                                $zandalariEmpire = "\n\t".$bfaReps->reputations[$bfaRepCounter]->faction->name." - ".($bfaReps->reputations[$bfaRepCounter]->standing->max-$bfaReps->reputations[$bfaRepCounter]->standing->value)." to Neutral";
                                                break;                                                                                                                                         case 3:
                                                $zandalariEmpire = "\n\t".$bfaReps->reputations[$bfaRepCounter]->faction->name." - ".($bfaReps->reputations[$bfaRepCounter]->standing->max-$bfaReps->reputations[$bfaRepCounter]->standing->value)." to Friendly";
                                                break;
                                        case 4:
                                                $zandalariEmpire = "\n\t".$bfaReps->reputations[$bfaRepCounter]->faction->name." - ".($bfaReps->reputations[$bfaRepCounter]->standing->max-$bfaReps->reputations[$bfaRepCounter]->standing->value)." to Honored";
                                                break;
                                        case 5:
                                                $zandalariEmpire = "\n\t".$bfaReps->reputations[$bfaRepCounter]->faction->name." - ".($bfaReps->reputations[$bfaRepCounter]->standing->max-$bfaReps->reputations[$bfaRepCounter]->standing->value)." to Revered";
                                                break;
                                        case 6:                                                                                                                                                        $zandalariEmpire = "\n\t".$bfaReps->reputations[$bfaRepCounter]->faction->name." - ".($bfaReps->reputations[$bfaRepCounter]->standing->max-$bfaReps->reputations[$bfaRepCounter]->standing->value)." to Exalted";
                                                break;
                                        case 7:                                                                                                                                                        $zandalariEmpire = "\n\t".$bfaReps->reputations[$bfaRepCounter]->faction->name." - Exalted"."";
                                                break;
                                        case NULL:
                                                $zandalariEmpire = "No API Data";                                                                                           break;
                                }
                        } elseif ($bfaReps->reputations[$bfaRepCounter]->faction->id === 2373) {
                                switch ($bfaReps->reputations[$bfaRepCounter]->standing->tier) {                                                                                               case 0:
                                                $theUnshackled = "\n\t".$bfaReps->reputations[$bfaRepCounter]->faction->name." - ".($bfaReps->reputations[$bfaRepCounter]->standing->max-$bfaReps->reputations[$bfaRepCounter]->standing->value)." to Hostile";
                                                break;                                                                                                                                         case 1:
                                                $theUnshackled = "\n\t".$bfaReps->reputations[$bfaRepCounter]->faction->name." - ".($bfaReps->reputations[$bfaRepCounter]->standing->max-$bfaReps->reputations[$bfaRepCounter]->standing->value)." to Unfriendly";
                                                break;                                                                                                                                         case 2:
                                                $theUnshackled = "\n\t".$bfaReps->reputations[$bfaRepCounter]->faction->name." - ".($bfaReps->reputations[$bfaRepCounter]->standing->max-$bfaReps->reputations[$bfaRepCounter]->standing->value)." to Neutral";
                                                break;                                                                                                                                         case 3:
                                                $theUnshackled = "\n\t".$bfaReps->reputations[$bfaRepCounter]->faction->name." - ".($bfaReps->reputations[$bfaRepCounter]->standing->max-$bfaReps->reputations[$bfaRepCounter]->standing->value)." to Friendly";
                                                break;                                                                                                                                         case 4:
                                                $theUnshackled = "\n\t".$bfaReps->reputations[$bfaRepCounter]->faction->name." - ".($bfaReps->reputations[$bfaRepCounter]->standing->max-$bfaReps->reputations[$bfaRepCounter]->standing->value)." to Honored";
                                                break;
                                        case 5:
                                                $theUnshackled = "\n\t".$bfaReps->reputations[$bfaRepCounter]->faction->name." - ".($bfaReps->reputations[$bfaRepCounter]->standing->max-$bfaReps->reputations[$bfaRepCounter]->standing->value)." to Revered";
                                                break;
                                        case 6:
                                                $theUnshackled = "\n\t".$bfaReps->reputations[$bfaRepCounter]->faction->name." - ".($bfaReps->reputations[$bfaRepCounter]->standing->max-$bfaReps->reputations[$bfaRepCounter]->standing->value)." to Exalted";
                                                break;
                                        case 7:
                                                $theUnshackled = "\n\t".$bfaReps->reputations[$bfaRepCounter]->faction->name." - Exalted"."";                                                  break;
                                        case NULL:
                                                $theUnshackled = "No API Data";
                                                break;                                                                                                                                 }
                        }
                        $factionReps = $theUnshackled.$zandalariEmpire.$talanjisExpedition.$voldunai.$honorbound;
                } elseif ($wowFaction == 'ALLIANCE' ) {                                                                                                                        if ($bfaReps->reputations[$bfaRepCounter]->faction->id === 2159) {
                                switch ($bfaReps->reputations[$bfaRepCounter]->standing->tier) {
                                        case 0:
                                                $seventhLegion = "\n\t".$bfaReps->reputations[$bfaRepCounter]->faction->name." - ".($bfaReps->reputations[$bfaRepCounter]->standing->max-$bfaReps->reputations[$bfaRepCounter]->standing->value)." to Hostile";
                                                break;
                                        case 1:
                                                $seventhLegion = "\n\t".$bfaReps->reputations[$bfaRepCounter]->faction->name." - ".($bfaReps->reputations[$bfaRepCounter]->standing->max-$bfaReps->reputations[$bfaRepCounter]->standing->value)." to Unfriendly";
                                                break;
                                        case 2:
                                                $seventhLegion = "\n\t".$bfaReps->reputations[$bfaRepCounter]->faction->name." - ".($bfaReps->reputations[$bfaRepCounter]->standing->max-$bfaReps->reputations[$bfaRepCounter]->standing->value)." to Neutral";
                                                break;
                                        case 3:
                                                $seventhLegion = "\n\t".$bfaReps->reputations[$bfaRepCounter]->faction->name." - ".($bfaReps->reputations[$bfaRepCounter]->standing->max-$bfaReps->reputations[$bfaRepCounter]->standing->value)." to Friendly";
                                                break;
                                        case 4:
                                                $seventhLegion = "\n\t".$bfaReps->reputations[$bfaRepCounter]->faction->name." - ".($bfaReps->reputations[$bfaRepCounter]->standing->max-$bfaReps->reputations[$bfaRepCounter]->standing->value)." to Honored";
                                                break;
                                        case 5:
                                                $seventhLegion = "\n\t".$bfaReps->reputations[$bfaRepCounter]->faction->name." - ".($bfaReps->reputations[$bfaRepCounter]->standing->max-$bfaReps->reputations[$bfaRepCounter]->standing->value)." to Revered";                                                                                                                           break;
                                        case 6:
                                                $seventhLegion = "\n\t".$bfaReps->reputations[$bfaRepCounter]->faction->name." - ".($bfaReps->reputations[$bfaRepCounter]->standing->max-$bfaReps->reputations[$bfaRepCounter]->standing->value)." to Exalted";                                                                                                                           break;
                                        case 7:
                                                $seventhLegion = "\n\t".$bfaReps->reputations[$bfaRepCounter]->faction->name." - Exalted"."";
                                                break;                                                                                                                                         case NULL:
                                                $seventhLegion = "No API Data";
                                                break;
                                }                                                                                                                                              } elseif ($bfaReps->reputations[$bfaRepCounter]->faction->id === 2160) {
                                switch ($bfaReps->reputations[$bfaRepCounter]->standing->tier) {
                                        case 0:
                                                $proudmooreAdmiralty = "\n\t".$bfaReps->reputations[$bfaRepCounter]->faction->name." - ".($bfaReps->reputations[$bfaRepCounter]->standing->max-$bfaReps->reputations[$bfaRepCounter]->standing->value)." to Hostile";
                                                break;
                                        case 1:
                                                $proudmooreAdmiralty = "\n\t".$bfaReps->reputations[$bfaRepCounter]->faction->name." - ".($bfaReps->reputations[$bfaRepCounter]->standing->max-$bfaReps->reputations[$bfaRepCounter]->standing->value)." to Unfriendly";
                                                break;
                                        case 2:
                                                $proudmooreAdmiralty = "\n\t".$bfaReps->reputations[$bfaRepCounter]->faction->name." - ".($bfaReps->reputations[$bfaRepCounter]->standing->max-$bfaReps->reputations[$bfaRepCounter]->standing->value)." to Neutral";
                                                break;
                                        case 3:
                                                $proudmooreAdmiralty = "\n\t".$bfaReps->reputations[$bfaRepCounter]->faction->name." - ".($bfaReps->reputations[$bfaRepCounter]->standing->max-$bfaReps->reputations[$bfaRepCounter]->standing->value)." to Friendly";
                                                break;
                                        case 4:
                                                $proudmooreAdmiralty = "\n\t".$bfaReps->reputations[$bfaRepCounter]->faction->name." - ".($bfaReps->reputations[$bfaRepCounter]->standing->max-$bfaReps->reputations[$bfaRepCounter]->standing->value)." to Honored";
                                                break;
                                        case 5:
                                                $proudmooreAdmiralty = "\n\t".$bfaReps->reputations[$bfaRepCounter]->faction->name." - ".($bfaReps->reputations[$bfaRepCounter]->standing->max-$bfaReps->reputations[$bfaRepCounter]->standing->value)." to Revered";
                                                break;
                                        case 6:
                                                $proudmooreAdmiralty = "\n\t".$bfaReps->reputations[$bfaRepCounter]->faction->name." - ".($bfaReps->reputations[$bfaRepCounter]->standing->max-$bfaReps->reputations[$bfaRepCounter]->standing->value)." to Exalted";
                                                break;
                                        case 7:
                                                $proudmooreAdmiralty = "\n\t".$bfaReps->reputations[$bfaRepCounter]->faction->name." - Exalted"."";
                                                break;
                                        case NULL:
                                                $proudmooreAdmiralty = "No API Data";                                                                                       break;
                                }
                        } elseif ($bfaReps->reputations[$bfaRepCounter]->faction->id === 2161) {
                                switch ($bfaReps->reputations[$bfaRepCounter]->standing->tier) {                                                                                               case 0:
                                                $orderOfEmbers = "\n\t".$bfaReps->reputations[$bfaRepCounter]->faction->name." - ".($bfaReps->reputations[$bfaRepCounter]->standing->max-$bfaReps->reputations[$bfaRepCounter]->standing->value)." to Hostile";
                                                break;                                                                                                                                         case 1:
                                                $orderOfEmbers = "\n\t".$bfaReps->reputations[$bfaRepCounter]->faction->name." - ".($bfaReps->reputations[$bfaRepCounter]->standing->max-$bfaReps->reputations[$bfaRepCounter]->standing->value)." to Unfriendly";
                                                break;                                                                                                                                         case 2:                                                                                                                                                        $orderOfEmbers = "\n\t".$bfaReps->reputations[$bfaRepCounter]->faction->name." - ".($bfaReps->reputations[$bfaRepCounter]->standing->max-$bfaReps->reputations[$bfaRepCounter]->standing->value)." to Neutral";
                                                break;                                                                                                                                         case 3:                                                                                                                                                        $orderOfEmbers = "\n\t".$bfaReps->reputations[$bfaRepCounter]->faction->name." - ".($bfaReps->reputations[$bfaRepCounter]->standing->max-$bfaReps->reputations[$bfaRepCounter]->standing->value)." to Friendly";
                                                break;
                                        case 4:
                                                $orderOfEmbers = "\n\t".$bfaReps->reputations[$bfaRepCounter]->faction->name." - ".($bfaReps->reputations[$bfaRepCounter]->standing->max-$bfaReps->reputations[$bfaRepCounter]->standing->value)." to Honored";
                                                break;
                                        case 5:
                                                $orderOfEmbers = "\n\t".$bfaReps->reputations[$bfaRepCounter]->faction->name." - ".($bfaReps->reputations[$bfaRepCounter]->standing->max-$bfaReps->reputations[$bfaRepCounter]->standing->value)." to Revered";
                                                break;
                                        case 6:                                                                                                                                                        $orderOfEmbers = "\n\t".$bfaReps->reputations[$bfaRepCounter]->faction->name." - ".($bfaReps->reputations[$bfaRepCounter]->standing->max-$bfaReps->reputations[$bfaRepCounter]->standing->value)." to Exalted";
                                                break;
                                        case 7:                                                                                                                                                        $orderOfEmbers = "\n\t".$bfaReps->reputations[$bfaRepCounter]->faction->name." - Exalted"."";
                                                break;
                                        case NULL:
                                                $orderOfEmbers = "No API Data";                                                                                             break;
                                }
                        } elseif ($bfaReps->reputations[$bfaRepCounter]->faction->id === 2162) {
                                switch ($bfaReps->reputations[$bfaRepCounter]->standing->tier) {                                                                                               case 0:
                                                $stormsWake = "\n\t".$bfaReps->reputations[$bfaRepCounter]->faction->name." - ".($bfaReps->reputations[$bfaRepCounter]->standing->max-$bfaReps->reputations[$bfaRepCounter]->standing->value)." to Hostile";
                                                break;                                                                                                                                         case 1:
                                                $stormsWake = "\n\t".$bfaReps->reputations[$bfaRepCounter]->faction->name." - ".($bfaReps->reputations[$bfaRepCounter]->standing->max-$bfaReps->reputations[$bfaRepCounter]->standing->value)." to Unfriendly";
                                                break;                                                                                                                                         case 2:
                                                $stormsWake = "\n\t".$bfaReps->reputations[$bfaRepCounter]->faction->name." - ".($bfaReps->reputations[$bfaRepCounter]->standing->max-$bfaReps->reputations[$bfaRepCounter]->standing->value)." to Neutral";
                                                break;                                                                                                                                         case 3:
                                                $stormsWake = "\n\t".$bfaReps->reputations[$bfaRepCounter]->faction->name." - ".($bfaReps->reputations[$bfaRepCounter]->standing->max-$bfaReps->reputations[$bfaRepCounter]->standing->value)." to Friendly";
                                                break;                                                                                                                                         case 4:
                                                $stormsWake = "\n\t".$bfaReps->reputations[$bfaRepCounter]->faction->name." - ".($bfaReps->reputations[$bfaRepCounter]->standing->max-$bfaReps->reputations[$bfaRepCounter]->standing->value)." to Honored";
                                                break;
                                        case 5:
                                                $stormsWake = "\n\t".$bfaReps->reputations[$bfaRepCounter]->faction->name." - ".($bfaReps->reputations[$bfaRepCounter]->standing->max-$bfaReps->reputations[$bfaRepCounter]->standing->value)." to Revered";
                                                break;
                                        case 6:
                                                $stormsWake = "\n\t".$bfaReps->reputations[$bfaRepCounter]->faction->name." - ".($bfaReps->reputations[$bfaRepCounter]->standing->max-$bfaReps->reputations[$bfaRepCounter]->standing->value)." to Exalted";
                                                break;
                                        case 7:
                                                $stormsWake = "\n\t".$bfaReps->reputations[$bfaRepCounter]->faction->name." - Exalted"."";                                                     break;
                                        case NULL:
                                                $stormsWake = "No API Data";
                                                break;                                                                                                                                 }
                        } elseif ($bfaReps->reputations[$bfaRepCounter]->faction->id === 2400) {
                                switch ($bfaReps->reputations[$bfaRepCounter]->standing->tier) {
                                        case 0:                                                                                                                                                        $wavebladeAnkoan = "\n\t".$bfaReps->reputations[$bfaRepCounter]->faction->name." - ".($bfaReps->reputations[$bfaRepCounter]->standing->max-$bfaReps->reputations[$bfaRepCounter]->standing->value)." to Hostile";
                                                break;
                                        case 1:                                                                                                                                                        $wavebladeAnkoan = "\n\t".$bfaReps->reputations[$bfaRepCounter]->faction->name." - ".($bfaReps->reputations[$bfaRepCounter]->standing->max-$bfaReps->reputations[$bfaRepCounter]->standing->value)." to Unfriendly";
                                                break;
                                        case 2:                                                                                                                                                        $wavebladeAnkoan = "\n\t".$bfaReps->reputations[$bfaRepCounter]->faction->name." - ".($bfaReps->reputations[$bfaRepCounter]->standing->max-$bfaReps->reputations[$bfaRepCounter]->standing->value)." to Neutral";
                                                break;
                                        case 3:                                                                                                                                                        $wavebladeAnkoan = "\n\t".$bfaReps->reputations[$bfaRepCounter]->faction->name." - ".($bfaReps->reputations[$bfaRepCounter]->standing->max-$bfaReps->reputations[$bfaRepCounter]->standing->value)." to Friendly";
                                                break;
                                        case 4:
                                                $wavebladeAnkoan = "\n\t".$bfaReps->reputations[$bfaRepCounter]->faction->name." - ".($bfaReps->reputations[$bfaRepCounter]->standing->max-$bfaReps->reputations[$bfaRepCounter]->standing->value)." to Honored";
                                                break;
                                        case 5:
                                                $wavebladeAnkoan = "\n\t".$bfaReps->reputations[$bfaRepCounter]->faction->name." - ".($bfaReps->reputations[$bfaRepCounter]->standing->max-$bfaReps->reputations[$bfaRepCounter]->standing->value)." to Revered";
                                                break;
                                        case 6:
                                                $wavebladeAnkoan = "\n\t".$bfaReps->reputations[$bfaRepCounter]->faction->name." - ".($bfaReps->reputations[$bfaRepCounter]->standing->max-$bfaReps->reputations[$bfaRepCounter]->standing->value)." to Exalted";
                                                break;
                                        case 7:
                                                $wavebladeAnkoan = "\n\t".$bfaReps->reputations[$bfaRepCounter]->faction->name." - Exalted"."";                                                break;
                                        case NULL:
                                                $wavebladeAnkoan = "No API Data";
                                                break;                                                                                                                                 }
                        }
                        $factionReps = $wavebladeAnkoan.$proudmooreAdmiralty.$stormsWake.$orderOfEmbers.$seventhLegion;
                }                                                                                                                                              }
//		print $toonRepsUrl->reputations[$toonRepCounter]->faction->name." - ".$toonRepsUrl->reputations[$toonRepCounter]->standing->tier."\r==============================\r";
//	foreach ($toonRepsUrl->reputations as $toonRep) {
//		var_dump($toonRep->faction/*->name*/); print "\r<br>==============================\r<br?\r";
//		print $toonRep->faction->name; print "\r<br>==============================\r<br?\r";
	print "<pre>".$rustboltResistance.$factionReps.$champsOfAzeroth.$tortollanSeekers."\r</pre>\r<hr />\r";
}
//print "var_dump of \$allToonsObjArray\n<br>\n<pre>\n"; var_dump($allToonsObjArray); print "\n</pre>\n<br>\n<hr />\n";
print "<a href=\"".$blizzardOauthAuthUrl."/?response_type=code&clientid=".$clientId."&redirect_uri=".$redirect_uri."&scope=wow.profile&state=1234xyz\">Blizzard Login</a>";
print "<hr />";
print $blizzardOauthAuthUrl."/?response_type=code&clientid=".$clientId."&redirect_uri=".$redirect_uri."&scope=wow.profile&state=1234xyz";
print "<hr />";
?>
