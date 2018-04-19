<?php
/** file: leg_rep_inc.php
 * A file to act on all legion counted reputations
 * **/
namespace girvin\wow;

# BEGIN Block for testing
include './wow_char_inc.php';
include "./wow_rep_lvl_inc.php";
$toonLegRepHtml = "";
# END Block for testing

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
print $toonLegRepHtml;
?>
