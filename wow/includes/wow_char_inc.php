<?php
/** file: wow_char_inc.php 
 * All we are doing here is getting the character object
 * from the Blizzard WOW API.
 * There are other fields that might be of more interest
 * for raiders (i.e. audit to see unenchanted/ungemmed gear)
 * but I have no interest in that for a simple next expansion 
 * ready check list.
 * The other fields can be found at:
 * https://dev.battle.net/io-docs **/
namespace girvin\wow;
# BEGIN Block for testing
$toon_realm="area-52";
$toon_name="Luxalor";
$blizz_locale = "locale=en_us";
$wow_url = "https://us.api.battle.net/wow/";
$api_key = "apikey=fkff3mjw67rm6eqzsf2u9vxgfk4y5b88";
$toon_info_url = $wow_url."character/".$toon_realm."/".$toon_name."?fields=reputation,professions,talents,mounts,pets,titles,guild&".$blizz_locale."&".$api_key;
# END BLOCK for testing

# Using a curl function to get info
function getToonInfo ($toon_info_url, array $get = NULL, array $options = array())
{
	$defaults = array(
		CURLOPT_URL => $toon_info_url,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_HTTPHEADER => array(
			"cache-control: no-cache"
		),
	);
	$ch = curl_init();
	curl_setopt_array($ch, ($options + $defaults));
	if ( !$result = curl_exec($ch))
	{
		trigger_error(curl_error($ch));
	}
	curl_close($ch);
	return $result;
}

# What can I do with the objects in the array
#
$toon_json = getToonInfo($toon_info_url);
$toon_obj = json_decode($toon_json);
#echo gettype($toon_obj), "\n";
#var_dump(get_object_vars($toon_obj)); echo "\n";
#print_r($toon_obj); echo "\n";

# BEGIN Mounts Block
#$mounts_count = count($toon_obj->mounts->collected);
#$mountsFlying = 0;
#$mountsGround = 0;
#$mountsUcollected = $toon_obj->mounts->numNotCollected;
#for ($mountCounter = 0; $mountCounter < $mounts_count; $mountCounter++) {
#	if ( $toon_obj->mounts->collected[$mountCounter]->isFlying) {
#		$mountsFlying++;
#	} else {
#		$mountsGround++;
#	}
#}
#$totalMounts = $mountsFlying + $mountsGround." - Total mounts\n";
# END Mounts Block

# BEGIN Battle Pet Block
#$bpet_count = count($toon_obj->pets->collected);
#$max_lvl_pets = 0;
#$nonBattlePets = 0;
#$petsNeedLvl = 0;
#for ($pet_counter = 0; $pet_counter < $bpet_count; $pet_counter++) {
#	if ($toon_obj->pets->collected[$pet_counter]->stats->level === 25 && $toon_obj->pets->collected[$pet_counter]->stats->petQualityId === 3) {
#		$max_lvl_pets++;
#	} elseif ( !$toon_obj->pets->collected[$pet_counter]->canBattle /**== 'false'**/ ) {
#		$nonBattlePets++;
#	} else {
#		$petsNeedLvl++;
#	}
#}
#$totalPets = $nonBattlePets + $max_lvl_pets + $petsNeedLvl;
# END Battle Pet Block
?>
