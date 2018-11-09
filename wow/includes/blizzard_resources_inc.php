<?php

/* 
 * FILE: blizzard_resources_inc.php
 *
 * This file is a prepository of all the things needed for use of the blizzard APIs
*/
$wow_url = "https://us.api.battle.net/wow/";
$wowUrl = "https://us.api.blizzard.com/wow/";
$blizzardOauthTokenUrl = "https://us.battle.net/oauth/token";
$blizzardOauthAuthUrl = "https://us.battle.net/oauth/authorize";
$blizzardUserInfoUrl = "https://us.battle.net/oauth/user/info";
$blizzardWowProfileUrl = "https://us.api.blizzard.com/wow/user/characters?locale=en_US";
$clientId = "2abc5bd3a1d64274a2aa9575404cf0e9";
$clientSecret = "4lDDBAihtzLRkljrtYmwRTL1L6xZeOGv";
$blizzardAuthorizeUrl = "https://us.battle.net/oauth/authorize";

/* 
 * EXAMPLE CURL for WOW PRofile Data:
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "https://us.api.blizzard.com/wow/user/characters?locale=en_US");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");


$headers = array();
$headers[] = "Authorization: Bearer USISCsmIpDarhceLzcYM4fz6SndSwAVNpV";
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close ($ch);
 */

?>
