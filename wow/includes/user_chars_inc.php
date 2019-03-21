<?php
/* file: legion.php */


// Variables for the start
#if(!isset($_SESSION) || empty($_SESSION)) {
#	$userId = $_REQUEST['user_id'];
#	} else {
#	$userId = $_SESSION['user_id'];
#	}
#if (!isset($_SESSION) || empty($_SESSION)) {
#	$toon_owner_first = $_REQUEST['user_first'];
#	} else {
#	$toon_owner_first = $_SESSION['user_first'];
#	}

// Block for testing
/*
*/
include "../../cats.php";
include "./blz_oauth_inc.php";
include "./blizzard_resources_inc.php";
include "./wow_char_inc.php";
include "./wow_class_inc.php";
include "./wow_fact_inc.php";
include "./wow_html_inc.php";
#include "./wow_profs_inc.php";
include "./wow_reps_inc.php";
#include "./bfa_chk_lst.php";
#include "./multiapi.php";

$userId = 1;
$toon_onwer_first = "Grant";
$blizzLocale = "locale=en_US";
$toonCounter = 0;
$char_url = $wowUrl."character/";
$wowFields = "fields=reputation,professions,talents,titles,guild,pets,mounts,feed";
//$wowLocale = "locale=en_US";
$toon_sql = ("SELECT toon_name, toon_realm FROM toon WHERE toon_owner=\"".$userId."\" ORDER BY toon_realm, toon_name");
$toonName = "";
$toonRealm = "";
$toonIcon = "";
$toonCounter = 0;
$myOauthTokenArr = getOauthToken($blizzardOauthTokenUrl);
$myOauthToken = $myOauthTokenArr['access_token'];

// Starting the character table
$toon_table = "";

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

foreach ($allToonsObjArray as $toonObj) {
#	$toonFaction = $toonObj->faction;
#	$toonIcon = $icon_url.$toonObj->thumbnail;
#	$toonRealm = $toonObj->realm;
#	$toonTalents = $toonObj->talents;
#	$toon_realm_html = factionStylesRealm($toonFaction, $toonRealm);
#	$toon_icon_html = factionStylesIcon($toonFaction, $toonIcon, $toonName, $toonRealm);
#	$toonPriProfHtml = bfaPrimaryProfs($toonObj->professions->primary);
#	$toonSecProfHtml = bfaSecondaryProfs($toonObj->professions->secondary);
#	$toonRepHtml = bfaFactions($toonObj->reputation, $toonObj->faction);
#	$toon_bg_color = wowClassColors($toonObj->class);
#	$toonClassCellColor = wowClassColors($toonObj->class);
#	$toonNameCell = "\n\t\t<td ".$toonClassCellColor.$toonObj->name."</font></td>";
#	$toonLvlCell = "\n\t\t<td ".$toonClassCellColor.$toonObj->level."</font></td>";
#	$toonSpecCell = "\n\t\t<td ".$toonClassCellColor.$toonObj->talents[0]->spec->name."</font></td>";
#	$toonIlvlCell = "\n\t\t<td ".$toonClassCellColor.$toonObj->items->averageItemLevelEquipped."</font></td>";
#	$toon_table .= "\n\t<tr>".$toon_realm_html.$toonNameCell.$toon_icon_html.$toonLvlCell.$toonSpecCell.$toonPriProfHtml.$toonSecProfHtml.$toonRepHtml.$toonIlvlCell."\n\t</tr>\n";
	print "\rvar_dump of \$toonObj: <pre>\r"; var_dump($toonObj); print "\r</pre>\r<hr .\r";
}
$toon_table .= "\n</table>\n</div>\n"; 

?>
