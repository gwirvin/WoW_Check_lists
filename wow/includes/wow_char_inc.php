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

# BEGIN Block for testing
#$toon_realm="area-52";
#$toon_name="Luxalor";
#$blizz_locale = "locale=en_us";
#$wow_url = "https://us.api.battle.net/wow/";
#$api_key = "apikey=fkff3mjw67rm6eqzsf2u9vxgfk4y5b88";
# END BLOCK for testing

$char_url = $wow_url."character/".$toon_realm."/".$toon_name."?fields=reputation,items,professions,talents&".$blizz_locale."&".$api_key; // Getting the character info
$toon_json = file_get_contents($char_url);
$toon_obj = json_decode($toon_json);

# What can I do with the objects in the array
?>
