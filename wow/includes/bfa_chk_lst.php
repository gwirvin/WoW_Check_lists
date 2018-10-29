<?php
/* file: legion.php */

// Block for testing
/*
include "/cats.php";
include "./wow_class_inc.php";
include "./wow_char_inc.php";
include "./leg_html_inc.php";
include "./leg_lgnd_inc.php";
include "./leg_rep_inc.php";
include "./leg_fact_inc.php";
include "./leg_ac_inc.php";
include "./wow_rep_lvl_inc.php";
include "./wow_fact_inc.php";
*/

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
#$blizz_locale = "locale=en_US";
$toon = "";
$toon_url = "";
$toonCount = "";
$toonCounter = 0;
$wow_item_url = $wow_url."item/";
$char_url = $wow_url."character/";
$wow_char_fields = "fields=reputation,professions,talents,titles,items";
$toon_sql = ("SELECT toon_name, toon_realm FROM toon WHERE toon_owner=\"".$toon_owner_id."\" ORDER BY toon_realm, toon_name");
$toon_query = mysqli_query($wow_conn, $toon_sql);
$toonName = "";
$toonRealm = "";
$toonIcon = "";
// Starting the character table
$toon_table = "<table>\n\t<caption><center><font color=\"FFFFFF\"><h3>Legion checklist for ".$toon_owner_first."</h3></font></center></caption>\n\t<thead>\n\t<tr>\n\t\t<th rowspan=\"2\"bgcolor=\"BFBCBA\">Realm</th>\n\t\t<th rowspan=\"2\" bgcolor=\"BFBCBA\">Character</th>\n\t\t<th rowspan=\"2\" bgcolor=\"BFBCBA\">Icon</th>\n\t\t<th rowspan=\"2\" bgcolor=\"BFBCBA\">Level</th>\n\t\t<th rowspan=\"2\" bgcolor=\"BFBCBA\">Current Spec</th>\n\t\t<th colspan=\"2\" rowspan=\"2\" bgcolor=\"6C00FF\"><font color=\"FFFFFF\">Primary Professions</font></th>\n\t\t<th colspan=\"3\" bgcolor=\"9E5FF4\"><font color=\"FFFFFF\">Secondary Professions</font></th>\n\t\t<th colspan=\"6\" bgcolor=\"0008FF\"><font color=\"FFFFFF\">Reputations</font></th>\n\t\t<th rowspan=\"2\" bgcolor=\"BFBCBA\">Equiped iLvl</th>\n\t</tr>\n\t<tr>\n\t\t<th bgcolor=\"B180F4\"><font color=\"FFFFFF\">Cooking</font></th>\n\t\t<th bgcolor=\"B180F4\"><font color=\"FFFFFF\">Fishing</font></th>\n\t\t<th bgcolor=\"B180F4\"><font color=\"FFFFFF\">Archaeology</font></th>\n\t\t<th bgcolor=\"5D63FF\"><font color=\"FFFFFF\">Champions of Azeroth</font></th>\n\t\t<th bgcolor=\"5D63FF\"><font color=\"FFFFFF\">Tortallan Seekers</font></th>\n\t\t<th bgcolor=\"5D63FF\"><font color=\"FFFFFF\">The Honorbound\The 7<sup>th</sup> Legion</font></th>\n\t\t<th bgcolor=\"5D63FF\"><font color=\"FFFFFF\">Zandalari Empire/Proudmoore Admiralty</font></th>\n\t\t<th bgcolor=\"5D63FF\"><font color=\"FFFFFF\">Talanji's Expedition/Storm's Wake</font></th>\n\t\t<th bgcolor=\"5D63FF\"><font color=\"FFFFFF\">Voldunai/Order of Embers</font></th>\n\t</tr>\n\t</thead>\n\t<tbody>";
$allUserToons = getUserToons ($userId, $dbHost, $dbUser, $dbPass, $dbWow);
$allToonUrls = toonUrlArray ($checkResults, $wow_url, $wowFields, $api_key);

var_dump($allUserToons);
print "\n\n";
var_dump($allToonUrls);
print "\n\n";
// Getting the data from the database for the rest to work
/*** while ($toon_result = mysqli_fetch_all($toon_query, MYSQLI_ASSOC)) {
	$toonCount = count($toon_result); // $toonCount is the total bumber of resutls, toonCounter increments on each run through the script
	for ($toonCounter = 0; $toonCounter < $toonCount; $toonCounter++) { //looping through each row of returned arrays
/* Setting these variables at a higher level in the script did not get them emptied */
// Variables that need some setting other than empty
// Variables that should really be empty on each loop's start
/***		$toonName = $toon_result[$toonCounter]['toon_name'];
		$toonRealm = $toon_result[$toonCounter]['toon_realm'];
		$toon_info_url = $wow_url."character/".$toonRealm."/".$toonName."?fields=reputation,professions,talents,mounts,pets,titles,guild,items&".$blizz_locale."&".$api_key;
		$toonInfo = getToonInfo($toon_info_url);
		$toonObj = json_decode($toonInfo);
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
