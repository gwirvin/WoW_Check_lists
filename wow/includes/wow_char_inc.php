<?php

$char_url = $wow_url."character/".$toon_realm."/".$oon_name."?fields=reputation,items,professions,audit,talents&".$blizz_locale."&".$api_key; // Getting the character info
$toon_json = file_get_contents($char_url);
$toon_obj = json_decode($toon_json);
?>

