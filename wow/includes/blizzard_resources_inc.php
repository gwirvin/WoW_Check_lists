<?php

/* 
 * FILE: blizzard_resources_inc.php
 *
 * This file is a repository of all the things needed for use of the blizzard APIs
 */
$tokenbPrefix = "&access_token=";
$wow_url = "https://us.api.battle.net/wow/";
$wowUrl = "https://us.api.blizzard.com/wow/";
$blizzardApiBase = "https://us.api.blizzard.com";
$blizzardOauthTokenUrl = "https://us.battle.net/oauth/token";
$blizzardOauthAuthUrl = "https://us.battle.net/oauth/authorize";
$blizzardUserInfoUrl = "https://us.battle.net/oauth/user/info";
$blizzardWowProfileUrl = "https://us.api.blizzard.com/wow/user/characters?locale=en_US";
$blizzardProfileNamespace = "namespace=profile-us";
$blizzardLocaleUs = "&locale=en_US";
$clientId = "2abc5bd3a1d64274a2aa9575404cf0e9";
$clientSecret = "4lDDBAihtzLRkljrtYmwRTL1L6xZeOGv";
$blizzardAuthorizeUrl = "https://us.battle.net/oauth/authorize";
$wowCommuniutyUserChars = "/wow/user/characters?";
$wowProfile = "/profile/wow/character/";
$wowProfileNamespace = "?namespace=profile-us";
/* NOTE: Character profile URLs built with $blizzardApiBase.$wowProfile.$realmSlug."/".$toonSlug.<"/FIELD">.$wowProfileNamespace.$blizzardLocaleUs.$tokenPrfix.$accessToken

/* 
 * EXAMPLE CURL for WOW PRofile Data:
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "https://us.api.blizzard.com/wow/user/characters?locale=en_US");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");


* EXAMPLE URIs for new API methods
* Profile Summary: /profile/wow/character/{realmSlug}/{characterName}
	Luxalor Profile summary: https://us.api.blizzard.com/profile/wow/character/area-52/luxalor?namespace=profile-us&locale=en_US&access_token=<OAUTH_TOKEN>
	INCLUDES, Level, Spec, Race, Faction, active title and other Profile URLs
* Profile Status: /profile/wow/character/{realmSlug}/{characterName}/status
	Luxchen Profile Status: https://us.api.blizzard.com/profile/wow/character/area-52/luxchen/status?namespace=profile-us&locale=en_US&access_token=<OAUTH_TOKEN>
	USE TO REMOVE INVALID CHARACTERS
* Reputations: /profile/wow/character/{realmSlug}/{characterName}/reputations
	Luxdino Reps: https://us.api.blizzard.com/profile/wow/character/area-52/luxdino/reputations?namespace=profile-us&locale=en_US&access_token=<OAUTH_TOKEN>
* Professions: NO NEW METHOD YET
	 No updated API for professions!!!
* Titles: /profile/wow/character/{realm-slug}/{character-name}/titles
	Luxdief Titles: https://us.api.blizzard.com/profile/wow/character/proudmoore/luxdief/titles?namespace=profile-us&locale=en_US&access_token=<OAUTH_TOKEN>
	* Specializations: /profile/wow/character/{realmSlug}/{characterName}/specializations
	Luxtodes Specializations: https://us.api.blizzard.com/profile/wow/character/area-52/luxtodes/specializations?namespace=profile-us&locale=en_US&access_token=<OAUTH_TOKEN>




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
