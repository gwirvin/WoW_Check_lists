<?php
/* file: legion.php */

// Block for testing
/* include "../../cats.php";
include "./wow_class_inc.php";
include "./wow_classes_inc.php";
include "./wow_char_inc.php";
include "./wow_html_inc.php";
include "./wow_reps_inc.php";
include "./wow_profs_inc.php";
include "./wow_rep_lvl_inc.php";
include "./wow_fact_inc.php";
include "./multiapi.php";
$userId = 1;
$toon_owner_first = "Grant"; */

// Variables for the start
if(!isset($_SESSION) || empty($_SESSION)) {
	$userId = $_REQUEST['user_id'];
	} else {
	$userId = $_SESSION['user_id'];
	}
if (!isset($_SESSION) || empty($_SESSION)) {
	$toon_owner_first = $_REQUEST['user_first'];
	} else {
	$toon_owner_first = $_SESSION['user_first'];
	}
$blizzLocale = "locale=en_US";
$toonCounter = 0;
$char_url = $wow_url."character/";
$wowFields = "fields=reputation,professions,talents,titles,items";
$toon_sql = ("SELECT toon_name, toon_realm FROM toon WHERE toon_owner=\"".$userId."\" ORDER BY toon_realm, toon_name");
$toonName = "";
$toonRealm = "";
$toonIcon = "";

// Starting the character table
$toon_table = "<table>\n\t<caption><center><font color=\"FFFFFF\"><h3>Legion checklist for ".$toon_owner_first."</h3></font></center></caption>\n\t<thead>\n\t<tr>\n\t\t<th rowspan=\"2\"bgcolor=\"BFBCBA\">Realm</th>\n\t\t<th rowspan=\"2\" bgcolor=\"BFBCBA\">Character</th>\n\t\t<th rowspan=\"2\" bgcolor=\"BFBCBA\">Icon</th>\n\t\t<th rowspan=\"2\" bgcolor=\"BFBCBA\">Level</th>\n\t\t<th rowspan=\"2\" bgcolor=\"BFBCBA\">Current Spec</th>\n\t\t<th colspan=\"2\" rowspan=\"2\" bgcolor=\"6C00FF\"><font color=\"FFFFFF\">Primary Professions</font></th>\n\t\t<th colspan=\"3\" bgcolor=\"9E5FF4\"><font color=\"FFFFFF\">Secondary Professions</font></th>\n\t\t<th colspan=\"6\" bgcolor=\"0008FF\"><font color=\"FFFFFF\">Reputations</font></th>\n\t\t<th rowspan=\"2\" bgcolor=\"BFBCBA\">Equiped iLvl</th>\n\t</tr>\n\t<tr>\n\t\t<th bgcolor=\"B180F4\"><font color=\"FFFFFF\">Cooking</font></th>\n\t\t<th bgcolor=\"B180F4\"><font color=\"FFFFFF\">Fishing</font></th>\n\t\t<th bgcolor=\"B180F4\"><font color=\"FFFFFF\">Archaeology</font></th>\n\t\t<th bgcolor=\"5D63FF\"><font color=\"FFFFFF\">Champions of Azeroth</font></th>\n\t\t<th bgcolor=\"5D63FF\"><font color=\"FFFFFF\">Tortallan Seekers</font></th>\n\t\t<th bgcolor=\"5D63FF\"><font color=\"FFFFFF\">The Honorbound\The 7<sup>th</sup> Legion</font></th>\n\t\t<th bgcolor=\"5D63FF\"><font color=\"FFFFFF\">Zandalari Empire/Proudmoore Admiralty</font></th>\n\t\t<th bgcolor=\"5D63FF\"><font color=\"FFFFFF\">Talanji's Expedition/Storm's Wake</font></th>\n\t\t<th bgcolor=\"5D63FF\"><font color=\"FFFFFF\">Voldunai/Order of Embers</font></th>\n\t</tr>\n\t</thead>\n\t<tbody>";

$allUserToons = getUserToons ($userId, $dbHost, $dbUser, $dbPass, $dbWow); // Getting the users info from the DB
$userToonCount = count($allUserToons); // Getting the count of the user's toons
$allToonUrls = toonUrlArray ($allUserToons, $wow_url, $wowFields, $api_key); // Creating an array of all the API calls

/* Using the borrow MultiAPI classes to get all the toon data concurently */
$allToonApiArray = new multiapi();
$allToonApiArray->data = $allToonUrls;
$allToonDataArray = $allToonApiArray->get_process_requests();
/* MultiAPI Calls done */

/* Converting the strings returned int he multiapi to an array fo objects */
$allToonsObjArray = getAllToonObjArray($allToonDataArray, $userToonCount);

#var_dump($allToonsObjArray); print "\n";

/* Setting these variables at a higher level in the script did not get them emptied */
// Variables that need some setting other than empty
// Variables that should really be empty on each loop's start
$toonCounter = 0;
foreach ($allToonObjArray as $toonObj) {
	var_dump($toonObj); } /*
		$toonFaction = $toonObj->faction;
		$toonIcon = $icon_url.$toonObj->thumbnail;
		$toonRealm = $toonObj->realm;
		$toonTalents = $toonObj->talents;
		$toon_realm_html = factionStylesRealm($toonFaction, $toonRealm);
		$toon_icon_html = factionStylesIcon($toonFaction, $toonIcon, $toonName, $toonRealm);
		$toonPriProfHtml = bfaPrimaryProfs($toonObj->professions->primary, $priProfCount);
		$toonSecProfHtml = bfaSecondaryProfs($toonObj->professions->secondary);
		$toonRepHtml = bfaFactions($toonObj->reputation, $toonObj->faction);
		$toon_bg_color = wowClassColors($toonObj->class);
		$toonClassCellColor = wowClassColors($toonObj->class);
		$toonNameCell = "\n\t\t<td ".$toonClassCellColor.$toonObj->name."</font></td>";
		$toonLvlCell = "\n\t\t<td ".$toonClassCellColor.$toonObj->level."</font></td>";
		$toonSpecCell = "\n\t\t<td ".$toonClassCellColor.$toonObj->talents[0]->spec->name."</font></td>";
		$toonIlvlCell = "\n\t\t<td ".$toonClassCellColor.$toonObj->items->averageItemLevelEquipped."</font></td>";
		$toon_table .= "\n\t<tr>".$toon_realm_html.$toonNameCell.$toon_icon_html.$toonLvlCell.$toonSpecCell.$toonPriProfHtml.$toonSecProfHtml.$toonRepHtml.$toonIlvlCell."\n\t</tr>\n";
#		print $toon_info_url;
#		print "<hr />";
#		var_dump($toonObj);
	}
	sleep(0.15);
}
$toon_table .= "\n</table>\n</div>\n"; ***/


?>
