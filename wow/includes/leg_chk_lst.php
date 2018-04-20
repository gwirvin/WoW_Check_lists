<?php
/* file: legion.php */
namespace girvin\wow;

// Block for testing
/* include "../../cats.php";
include "./includes/leg_html_inc.php";
include "./leg_lgnd_inc.php";
include "./leg_rep_inc.php";
include "./leg_fact_inc.php";
include "./includes/leg_ac_inc.php"; */

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
$leg_char_fields = "fields=reputation,professions,talents,mounts,pets,titles,guild";
$toon_sql = ("SELECT toon_name, toon_realm FROM toon WHERE toon_owner=\"".$toon_owner_id."\" ORDER BY toon_realm, toon_name");
$toon_query = mysqli_query($wow_conn, $toon_sql);
// Starting the character table
$toon_table = "<table>\n\t<caption><center><font color=\"FFFFFF\"><h3>Legion checklist for ".$toon_owner_first."</h3></font></center></caption>\n\t<thead>\n\t<tr>\n\t\t<th rowspan=\"2\"bgcolor=\"BFBCBA\">Realm</th>\n\t\t<th rowspan=\"2\" bgcolor=\"BFBCBA\">Character</th>\n\t\t<th rowspan=\"2\" bgcolor=\"BFBCBA\">Icon</th>\n\t\t<th rowspan=\"2\" bgcolor=\"BFBCBA\">Level</th>\n\t\t<th rowspan=\"2\" bgcolor=\"BFBCBA\">Current Spec</th>\n\t\t<th rowspan=\"2\" bgcolor=\"FB2723\">Auto Complete</th>\n\t\t<th colspan=\"2\" bgcolor=\"FB7B23\">Legendary</th>\n\t\t<th colspan=\"2\" rowspan=\"2\" bgcolor=\"6C00FF\"><font color=\"FFFFFF\">Primary Professions</font></th>\n\t\t<th colspan=\"4\" bgcolor=\"9E5FF4\"><font color=\"FFFFFF\">Secondary Professions</font></th>\n\t\t<th colspan=\"9\" bgcolor=\"0008FF\"><font color=\"FFFFFF\">Reputations</font></th>\n\t\t<th rowspan=\"2\" bgcolor=\"E6DC43\">Artifact Rank</th>\n\t\t<th rowspan=\"2\" bgcolor=\"BFBCBA\">Equiped iLvl</th>\n\t</tr>\n\t<tr>\n\t\t<th bgcolor=\"F09456\">Needed Total</th>\n\t\t<th bgcolor=\"D38550\">Needs Lvl</th>\n\t\t<th bgcolor=\"B180F4\"><font color=\"FFFFFF\">First Aid</font></th>\n\t\t<th bgcolor=\"B180F4\"><font color=\"FFFFFF\">Cooking</font></th>\n\t\t<th bgcolor=\"B180F4\"><font color=\"FFFFFF\">Fishing</font></th>\n\t\t<th bgcolor=\"B180F4\"><font color=\"FFFFFF\">Archaeology</font></th>\n\t\t<th bgcolor=\"5D63FF\"><font color=\"FFFFFF\">Court of Farondis</font></th>\n\t\t<th bgcolor=\"5D63FF\"><font color=\"FFFFFF\">Dreamweavers</font></th>\n\t\t<th bgcolor=\"5D63FF\"><font color=\"FFFFFF\">Highmountain Tribe</font></th>\n\t\t<th bgcolor=\"5D63FF\"><font color=\"FFFFFF\">Valarjar</font></th>\n\t\t<th bgcolor=\"5D63FF\"><font color=\"FFFFFF\">The Wardens</font></th>\n\t\t<th bgcolor=\"5D63FF\"><font color=\"FFFFFF\">The Nightfallen</font></th>\n\t\t<th bgcolor=\"5D63FF\"><font color=\"FFFFFF\">Armies of Legionfall</font></th>\n\t\t<th bgcolor=\"5D63FF\"><font color=\"FFFFFF\">Army of the Light</font></th>\n\t\t<th bgcolor=\"5D63FF\"><font color=\"FFFFFF\">Argussian Reach</font></th>\n\t</tr>\n\t</thead>\n\t<tbody>";
// Getting the data from the database for the rest to work
while ($toon_result = mysqli_fetch_all($toon_query, MYSQLI_ASSOC)) {
	$db_toon_count = count($toon_result); // $db_toon_count is the total bumber of resutls, db_toon_counter increments on each run through the script
	for ($db_toon_counter = 0; $db_toon_counter < $db_toon_count; $db_toon_counter++) { //looping through each row of returned arrays
/* Setting these variables at a higher level in the script did not get them emptied */
// Variables that need some setting other than empty
		$rep_obj_counter = 0;
		$rep_count = 0;
		$primary_profs_counter = 1;
		$secondary_profs_counter = 1;
		$rep_obj_counter = 0;
		$rep_missing_counter = 0;
		$rep_legion_count = 9;
		$toon_artifact_rank = 0;
		$toonLgndCount = 0;
		$toonLgndLvlCount = 0;
		$max_legend_lvl = 1000;
// Variables that should really be empty on each loop's start
		$toon_class = "";
		$toon_faction = "";
		$toon_auto_complete = "";
		$toon_avg_eilvl = "";
		$toon_legend_need = "";
		$toon_pri_profs = "";
		$toon_sec_profs = "";
		$primary_profs_count = "";
		$secondary_profs_counter = "";
		$faction_standing_name = "";
		$faction_name = "";
		$faction_standing = "";
		$faction_curr = "";
		$faction_max = "";
		$toon_rep_obj = "";
		$rep_total_missing = "";
		$toonLegRepHtml = "";
		$toon_artf_rank = "";
		$toon_relic_count = "";
		$toonArtfRankCell = "";
		$toon_ac_html = "";
		$toonLgndCountCell = "";
		$toonLgndLvlCell = "";
		$toon_name = $toon_result[$db_toon_counter]['toon_name'];
		$toon_realm = $toon_result[$db_toon_counter]['toon_realm'];
		$toon_info_url = $char_url.$toon_realm."/".$toon_name."?".$leg_char_fields."&".$blizz_locale."&".$api_key; // The magic from the Blizzard API
		$toon_obj = json_decode($toon_json);
		$toon_json = getToonInfo($toon_info_url);
		$toon_faction = $toon_obj->faction;
		$toon_icon = $icon_url.$toon_obj->thumbnail;
		$toon_realm = $toon_obj->realm;
		$toon_talents = $toon_obj->talents;
		$toon_realm_html = factionStylesRealm($toon_faction, $toon_realm);
		$toon_icon_html = factionStylesIcon($toon_faction, $toon_icon, $toon_name, $toon_realm);
		$toon_reps_obj = $toon_obj->reputation;
		$toon_sec_profs_obj = $toon_obj->professions->secondary;
		usort ($toon_sec_profs_obj, function($a, $b) {
			return strcmp($a->id, $b->id);
			});
		$toon_mainspec = $toon_obj->talents[0]->talents[0]->spec->name;
		$toon_bg_color = wowClassColors($toon_obj->class);
		$toon_auto_complete = autoComplete($toon_obj->class);
#		$possible_item_slots = array('head', 'neck', 'shoulder', 'back', 'chest', 'wrist', 'hands','waist', 'legs', 'feet', 'finger1', 'finger2', 'trinket1', 'trinket2', 'mainHand', 'offhand');
#		for ($i = 0; $i < 16; $i++) {
#			if (isset($toon_obj->items->{$possible_item_slots[$i]})) {
#				if ($toon_obj->items->{$possible_item_slots[$i]}->quality === 5 && $toon_obj->items->{$possible_item_slots[$i]}->itemLevel >= $max_legend_lvl) { 
#					$toon_legend_count++;
#					$toon_legend_lvl_count++;
#				} elseif ($toon_obj->items->{$possible_item_slots[$i]}->quality === 5 ) {
#					$toon_legend_count++;
#					}
		$itemSlotsObj = json_decode(json_encode(array('head', 'neck', 'shoulder', 'back', 'chest', 'wrist', 'hands', 'waist', 'legs', 'feet', 'finger1', 'finger2', 'trinket1', 'trinket2', 'mainHand', 'offhand')));
		foreach ($itemSlotsObj as $itemSlotObj)
		{
			if ($toon_obj->items->{$itemSlotObj}->quality === 5 && $toon_obj->items->{$itemSlotObj}->itemLevel >= $maxLgndLvl)
			{
				$toonLgndCount++;
				$toonLgndLvlCount++;
			}
			elseif ($toon_obj->items->{$itemSlotObj}->quality === 5)
			{
				$toonLgndCount++;
			}
			if ($toon_obj->items->{$possible_item_slots[$i]}->quality === 6)
			{
				$toon_relic_count = count($toon_obj->items->{$possible_item_slots[$i]}->relics);
				$artifact_traits_count = count($toon_obj->items->{$possible_item_slots[$i]}->artifactTraits);
				for ($x = 0; $x < $artifact_traits_count; $x++)
				{
					$toon_artf_rank = $toon_artf_rank + $toon_obj->items->{$possible_item_slots[$i]}->artifactTraits[$x]->rank;
				}
				$toon_artf_rank = $toon_artf_rank - $toon_relic_count;
			}
		}
		$toon_legend_need = legendCount($toon_legend_count);
		$toon_legend_lvl_need = legendLevelCount($toon_legend_lvl_count);
		while ($primary_profs_counter <= 2) { //getting primary professions + lvl if not maxed
			foreach ($toon_obj->professions->primary as $toon_pri_prof_obj) {
				if ($toon_pri_prof_obj->rank >= 800) {
					$toon_pri_profs .= "\n\t\t<td bgcolor=\"10AA06\"><font color=\"FFFFFF\">".$toon_pri_prof_obj->name."</font></td>";
					$primary_profs_counter++;
				} elseif ($toon_pri_prof_obj->rank <= 799 && $toon_pri_prof_obj->rank >= 700) {
					$toon_pri_profs .= "\n\t\t<td bgcolor=\"F4E938\">".$toon_pri_prof_obj->rank." - ".$toon_pri_prof_obj->name."</td>";
					$primary_profs_counter++;
				} elseif ($toon_pri_prof_obj->rank <= 699) {
					$toon_pri_profs .= "\n\t\t<td bgcolor=\"C00808\"><font color=\"FFFFFF\">".$toon_pri_prof_obj->rank." - ".$toon_pri_prof_obj->name."</font></td>";
					$primary_profs_counter++;
				} else {
					$toon_pri_profs .= "\n\t\t<td bgcolor=\"000000\"> </td>";
					$primary_profs_counter++;
					}
				}
			if ($primary_profs_counter < 2) {
				$primary_profs_missing = 2 - $primary_profs_counter;
				$toon_pri_profs .= "\n\t\t<td colspan=\"".$primary_profs_missing."\" bgcolor=\"757B74\"></td>";
				}
			}
		while ($secondary_profs_counter <= 4) { //Getting secondary professions +lvl if not maxed, no idea what happens if all are not taken
			$toon_sec_profs = "";
			foreach ($toon_sec_profs_obj as $toon_sec_prof_obj) {
				if ($toon_sec_prof_obj->rank >= 800) {
					$toon_sec_profs .= "\n\t\t<td bgcolor=\"10AA06\"><font color=\"FFFFFF\">Done</font></td>";
					$secondary_profs_counter++;
				} elseif ($toon_sec_prof_obj->rank <= 799 && $toon_sec_prof_obj->rank >= 700) {
					$toon_sec_profs .= "\n\t\t<td bgcolor=\"F4E938\">".$toon_sec_prof_obj->rank."</td>";
					$secondary_profs_counter++;
				} elseif ($toon_sec_prof_obj->rank <= 699) {
					$toon_sec_profs .= "\n\t\t<td bgcolor=\"C00808\"><font color=\"FFFFFF\">".$toon_sec_prof_obj->rank."</font></td>";
					$secondary_profs_counter++;
				} else {
					$toon_sec_profs .= "\n\t\t<td bgcolor=\"000000\"> </td>";
					$secondary_profs_counter++;
					}
				}
			if ($secondary_profs_counter < 4) {
				$secondary_profs_missing = 4 - $secondary_profs_counter;
				$toon_sec_profs .= "\n\t\t<td colspan=\"".$secondary_profs_missing."\" bgcolor=\"757B74\"></td>";
				}
		}
		/* Begin Reputation Block */
		$toonRepCount = count($toon_obj->reputation); // Counting all the reputations in the toon object
		$htmlFactCounter = 0; // INitalize a counter to keep the HTML table uniform
		for ($toonRepCounter = 0; $toonRepCounter < $toonRepCount; $toonRepCounter++) { // Starting a loop to go as long as there are reputation objects
			if ($toon_obj->reputation[$toonRepCounter]->id === 1883 || $toon_obj->reputation[$toonRepCounter]->id === 1900 || $toon_obj->reputation[$toonRepCounter]->id === 1828 || $toon_obj->reputation[$toonRepCounter]->id === 1948 || $toon_obj->reputation[$toonRepCounter]->id === 1859 || $toon_obj->reputation[$toonRepCounter]->id === 1894 || $toon_obj->reputation[$toonRepCounter]->id === 2045 || $toon_obj->reputation[$toonRepCounter]->id === 2165 || $toon_obj->reputation[$toonRepCounter]->id === 2170) {  // Looking for specific Legion reputations
				$toonLegRepHtml .= factionStanding($toon_obj->reputation[$toonRepCounter]->standing, $toon_obj->reputation[$toonRepCounter]->value, $toon_obj->reputation[$toonRepCounter]->max, $toon_obj->reputation[$toonRepCounter]->name);  // Putting the values from each chosen reputation into a function in wow_rep_lvl_inc.php to get the HTML we want
				$htmlFactCounter++;  //Incrementing the counter for table data
			}
			elseif ($htmlFactCounter < 9) {  // If we do not fill enough cells, let's fill some extras to keep our columns correct for each row
				$toon_faction_html .= "\n\t\t<td  bgcolor=\"757B74\"></td>";  //Filler, I think this should make a gray cell
				$htmlFactCounter++; //Incrementing the counter for table data
			}
		}
		
		$toonClassCellColor = wowClassColors($toon_obj->class);
		$toonNameCell = "\n\t\t<td ".$toonClassCellColor.$toon_obj->name."</font></td>"
		$toonLvlCell = "\n\t\t<td ".$toonClassCellColor.$toon_obj->level."</font></td>"
		$toonSpecCell = "\n\t\t<td ".$toonClassCellColor.$toon_mainspec."</font></td>"
		$toonLgndCountCell = "\n\t\t<td ".$toonClassCellColor.$toon_legend_need."</font></td>"
		$toonLgndLvlCell = "\n\t\t<td ".$toonClassCellColor.$toon_legend_lvl_need."</font></td>"
		$toonArtfRankCell = "\n\t\t<td ".$toonClassCellColor.$toon_artf_rank."</font></td>"
		$toonIlvlCell = "\n\t\t<td ".$toonClassCellColor.$toon_obj->items->averageItemLevelEquipped."</font></td>"
		$toon_table .= "\n\t<tr>".$toon_realm_html.$toonNameCell.$toon_icon_html.$toonLvlCell.$toonSpecCell.$toon_auto_complete.$toonLgndCountCell.$toonLgndLvlCell.$toon_pri_profs.$toon_sec_profs.$toonLegRepHtml.$toonArtfRankCell.$toonIlvlCell."\n\t</tr>\n";
	}
	sleep(0.15);
}
$toon_table .= "\n</table>\n</div>\n";

/* echo $toon_table; */

?>
