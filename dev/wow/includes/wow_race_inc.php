<?php
/** file: wow_race_inc.php
 * Not sure what, if anything to do
 * with this file at this time
 * **/
//namespace girvin\wow;
$wow_races_url="https://us.api.battle.net/wow/data/character/races?locale=en_US&apikey=fkff3mjw67rm6eqzsf2u9vxgfk4y5b88";
$wow_races_json = file_get_contents($wow_races_url);
$wow_races_obj = json_decode($wow_races_json);
$race_count = count($wow_races_obj->races);
//$wow_race_obj = $$wow_races_arr_obj->races;
for ($i=0;$i<$race_count;$i++) {
	if ($wow_races_obj->races[$i]->side === horde) {
		echo "HORDE:\t".$wow_races_obj->races[$i]->name."\r";
	} else {
		print "ALLIANCE:\t".$wow_races_obj->races[$i]->name."\r";
	}
//	print_r($wow_races_obj->races[$i]);
}
//print_r($wow_races_obj->races);
?>
