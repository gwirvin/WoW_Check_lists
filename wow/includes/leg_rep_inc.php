<?php
/** file: leg_rep_inc.php
 * A file to act on all legion counted reputations
 * **/
namespace girvin\wow\legion;

# BEGIN Block for testing
include './wow_char_inc.php';
# END Block for testing

function filterLegionReps ($array, $index, $value) {
	if (is_array($array) && count($array) > 0)
	{
		foreach (array_keys($array) as $key) {
		$temp[$key] = $array[$key]{$index];	
#for ($repCounter = 0; $repCounter < $repCount; $repCounter++) {
#print_r($toon_obj->reputation); echo "\n";

?>
