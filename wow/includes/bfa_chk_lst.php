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
	$toon_owner_id = $_REQUEST['user_id'];
	} else {
	$toon_owner_id = $_SESSION['user_id'];
	}
if (!isset($_SESSION) || empty($_SESSION)) {
	$toon_owner_first = $_REQUEST['user_first'];
	} else {
	$toon_owner_first = $_SESSION['user_first'];
	}
$toon = "";
$toon_url = "";
$db_toon_count = "";
$db_toon_counter = 0;
$wow_item_url = $wow_url."item/";
$char_url = $wow_url."character/";
$leg_char_fields = "fields=reputation,professions,talents,mounts,pets,titles,guild,items";
$toon_sql = ("SELECT toonNmae, toon_realm FROM toon WHERE toon_owner=\"".$toon_owner_id."\" ORDER BY toon_realm, toonNmae");
$toon_query = mysqli_query($wow_conn, $toon_sql);
$maxLgndLvl = 1000;
// Starting the character table
$toon_table = "<table>\n\t<caption><center><font color=\"FFFFFF\"><h3>Legion checklist for ".$toon_owner_first."</h3></font></center></caption>\n\t<thead>\n\t<tr>\n\t\t<th rowspan=\"2\"bgcolor=\"BFBCBA\">Realm</th>\n\t\t<th rowspan=\"2\" bgcolor=\"BFBCBA\">Character</th>\n\t\t<th rowspan=\"2\" bgcolor=\"BFBCBA\">Icon</th>\n\t\t<th rowspan=\"2\" bgcolor=\"BFBCBA\">Level</th>\n\t\t<th rowspan=\"2\" bgcolor=\"BFBCBA\">Current Spec</th>\n\t\t<th colspan=\"2\" rowspan=\"2\" bgcolor=\"6C00FF\"><font color=\"FFFFFF\">Primary Professions</font></th>\n\t\t<th colspan=\"4\" bgcolor=\"9E5FF4\"><font color=\"FFFFFF\">Secondary Professions</font></th>\n\t\t<th colspan=\"9\" bgcolor=\"0008FF\"><font color=\"FFFFFF\">Reputations</font></th>\n\t\t<th rowspan=\"2\" bgcolor=\"E6DC43\">Artifact Rank</th>\n\t\t<th rowspan=\"2\" bgcolor=\"BFBCBA\">Equiped iLvl</th>\n\t</tr>\n\t<tr>\n\t\t<th bgcolor=\"F09456\">Needed Total</th>\n\t\t<th bgcolor=\"D38550\">Needs Lvl</th>\n\t\t<th bgcolor=\"B180F4\"><font color=\"FFFFFF\">Cooking</font></th>\n\t\t<th bgcolor=\"B180F4\"><font color=\"FFFFFF\">Fishing</font></th>\n\t\t<th bgcolor=\"B180F4\"><font color=\"FFFFFF\">Archaeology</font></th>\n\t\t<th bgcolor=\"5D63FF\"><font color=\"FFFFFF\">Champions of Azeroth/font></th>\n\t\t<th bgcolor=\"5D63FF\"><font color=\"FFFFFF\">Tortallan Seekers</font></th>\n\t\t<th bgcolor=\"5D63FF\"><font color=\"FFFFFF\">The Honorbound\The 7<sup>th</sup> Legion</font></th>\n\t\t<th bgcolor=\"5D63FF\"><font color=\"FFFFFF\">Zandalari Empire/Proudmoore Admiralty</font></th>\n\t\t<th bgcolor=\"5D63FF\"><font color=\"FFFFFF\">Talanji's Expedition/Storm's Wake</font></th>\n\t\t<th bgcolor=\"5D63FF\"><font color=\"FFFFFF\">Voldunai/Order of Embers</font></th>\n\t</tr>\n\t</thead>\n\t<tbody>";
// Getting the data from the database for the rest to work
while ($toon_result = mysqli_fetch_all($toon_query, MYSQLI_ASSOC)) {
	$db_toon_count = count($toon_result); // $db_toon_count is the total bumber of resutls, db_toon_counter increments on each run through the script
	for ($db_toon_counter = 0; $db_toon_counter < $db_toon_count; $db_toon_counter++) { //looping through each row of returned arrays
/* Setting these variables at a higher level in the script did not get them emptied */
// Variables that need some setting other than empty
// Variables that should really be empty on each loop's start
		$toonNmae = $toon_result[$db_toon_counter]['toonNmae'];
		$toonRealm = $toon_result[$db_toon_counter]['toon_realm'];
		$toon_info_url = $char_url.$toon_realm."/".$toonNmae."?".$leg_char_fields."&".$blizz_locale."&".$api_key; // The magic from the Blizzard API
		$toonObj = json_decode(getToonInfo($toon_info_url));
		$toonFaction = $toonObj->faction;
		$toonIcon = $icon_url.$toonObj->thumbnail;
		$toonRealm = $toonObj->realm;
		$toonTalents = $toonObj->talents;
		$toon_realm_html = factionStylesRealm($toon_faction, $toon_realm);
		$toon_icon_html = factionStylesIcon($toon_faction, $toon_icon, $toonNmae, $toon_realm);
		$toonPriProfHtml = bfaPrimaryProfs($toonObj->professions->primary);
		$toonSecProfHtml = bfaSecondaryProfs($toonObj->professions->secondary);
		$toonRepHtml = bfaFactions($toonObj->reputation, $toonObj->faction);
		$toon_bg_color = wowClassColors($toonObj->class);
		$toonClassCellColor = wowClassColors($toonObj->class);
		$toonNameCell = "\n\t\t<td ".$toonClassCellColor.$toonObj->name."</font></td>";
		$toonLvlCell = "\n\t\t<td ".$toonClassCellColor.$toonObj->level."</font></td>";
		$toonSpecCell = "\n\t\t<td ".$toonClassCellColor.$toonObj->talents[0]->spec->name."</font></td>";
		$toonIlvlCell = "\n\t\t<td ".$toonClassCellColor.$toonObj->items->averageItemLevelEquipped."</font></td>";
		$toon_table .= "\n\t<tr>".$toon_realm_html.$toonNameCell.$toon_icon_html.$toonLvlCell.$toonSpecCell.$toonPriProfsHtml.$toonSecProfHtml.$toonRepHtml.$toonIlvlCell."\n\t</tr>\n";
	}
	sleep(0.15);
}
$toon_table .= "\n</table>\n</div>\n";

/* echo $toon_table; */

?>
