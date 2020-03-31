<?php
/* file: legion.php */


// Variables for the start
if(!isset($_SESSION) || empty($_SESSION)) {
	$userId = $_REQUEST['user_id'];
	} else {
	$userId = $_SESSION['user_id'];
	}
if (!isset($_SESSION) || empty($_SESSION)) {
	$toon_owner_first = $_REQUEST['user_first'];
	} else {
	$toon_owner_first = $_SESSION['user_first'];
	}
$blizzLocale = "locale=en_US";
$toonCounter = 0;
$char_url = $wowUrl."character/";
$wowFields = "fields=reputation,professions,talents,titles,items";
//$wowLocale = "locale=en_US";
$toon_sql = ("SELECT toon_name, toon_slug, toon_realm FROM toon WHERE toon_owner=\"".$userId."\" AND toon_primary=\"No\" ORDER BY toon_realm, toon_name");
$toonName = "";
$toonRealm = "";
$toonIcon = "";
$toonCounter = 0;
$myOauthTokenArr = getOauthToken($blizzardOauthTokenUrl);
$myOauthToken = $myOauthTokenArr['access_token'];

// Starting the character table
$toon_table = "<table>\n\t<caption><center><font color=\"FFFFFF\"><h3>Battle for Azeroth Checklist (Secondary Characters) for ".$toon_owner_first."</h3></font></center></caption>\n\t<thead>\n\t<tr>\n\t\t<th bgcolor=\"BFBCBA\">Realm</th>\n\t\t<th bgcolor=\"BFBCBA\">Character</th>\n\t\t<th bgcolor=\"BFBCBA\">Icon</th>\n\t\t<th bgcolor=\"BFBCBA\">Level</th>\n\t\t<th bgcolor=\"BFBCBA\">Current Spec</th>\n\t\t<th colspan=\"2\" bgcolor=\"6C00FF\"><font color=\"FFFFFF\">Primary Professions</font></th>\n\t\t<th bgcolor=\"BFBCBA\">Equiped iLvl</th>\n\t</tr>\n\t</thead>\n\t<tbody>";

$allUserToons = getUserSecondaryToons ($userId, $dbHost, $dbUser, $dbPass, $dbWow); // Getting the users info from the DB
$userToonCount = count($allUserToons); // Getting the count of the user's toons
// $allToonUrls = toonUrlArray ($allUserToons, $wow_url, $wowFields, $api_key); // Creating an array of all the API calls
//$allToonUrls = toonUrlArray ($allUserToons, $wowUrl, $wowFields, $myOauthToken); // Creating an array of all the API calls using OAuth

/* Using the borrow MultiAPI classes to get all the toon data concurently */
//$allToonApiArray = new multiapi();
//$allToonApiArray->data = $allToonUrls;
//$allToonDataArray = $allToonApiArray->get_process_requests();
/* MultiAPI Calls done */

/* New Blizzard API fixes */
$wowToonUrls = toonCommunityUrlArray ($allUserToons, $myOauthToken); // Creating an array of Profile API calls
/* Using the borrow MultiAPI classes to get all the toon data concurently */
$wowToonApiArray = new multiapi();
$wowToonApiArray->data = $wowToonUrls;
$wowToonDataArray = $wowToonApiArray->get_process_requests();
/* MultiAPI Calls done */

/* Converting the strings returned int he multiapi to an array fo objects */
//$allToonsObjArray = getAllToonObjArray($allToonDataArray, $userToonCount);
$wowToonsObjArray = getAllToonObjArray($wowToonDataArray, $userToonCount);
//print "\r<hr />\r<pre>\r"; var_dump($wowToonsObjArray); print "\r</pre>\r";

//foreach ($allToonsObjArray as $toonObj) {
foreach ($wowToonsObjArray as $toonObj) {
	$toonMediaObj = getToonMediaInfo($toonObj->media->href.$blizzardLocaleUs.$tokenPrefix.$myOauthToken);
	$toonRepsObj = getToonRepInfo($toonObj->reputations->href.$blizzardLocaleUs.$tokenPrefix.$myOauthToken);
	$toonProfsObj = getToonProfsInfo($blizzardApiBase.$wowProfile.$toonObj->realm->slug."/".strtolower($toonObj->name)."/professions".$wowProfileNamespace.$blizzardLocaleUs.$tokenPrefix.$myOauthToken);
	$toonFaction = $toonObj->faction->name->en_US;
	$toonIcon = $toonMediaObj->avatar_url;
	$toonName = $toonObj->name;
	$toonRealm = $toonObj->realm->name->en_US;
//	$toonRealmSlug = $toonObj->realm));
//	$toonTalents = $toonObj->talents;
	$toon_realm_html = factionStylesRealm($toonObj->faction->type, $toonObj->realm->name->en_US);
	$toon_icon_html = factionStylesIcon($toonObj->faction->type, $toonMediaObj->avatar_url, $toonObj->name, $toonObj->realm->slug);
	if (empty($toonProfsObj)) {
		$toonPriProfHtml = "\n\t\t<td bgcolor=\"000000\"><font color=\"FFFFFF\">No API Data</font></td>\n\t\t<td bgcolor=\"000000\"><font color=\"FFFFFF\">No API Data</font></td>";
	} else {
		$toonPriProfHtml = bfaPrimaryProfs($toonProfsObj);
	}
	$toon_bg_color = wowClassColors($toonObj->character_class->name->en_US);
	$toonClassCellColor = wowClassColors($toonObj->character_class->name->en_US);
	$toonNameCell = "\n\t\t<td ".$toonClassCellColor.$toonObj->name."</font></td>";
	$toonLvlCell = "\n\t\t<td ".$toonClassCellColor.$toonObj->level."</font></td>";
	$toonSpecCell = "\n\t\t<td ".$toonClassCellColor.$toonObj->active_spec->name->en_US."</font></td>";
	$toonIlvlCell = "\n\t\t<td ".$toonClassCellColor.$toonObj->equipped_item_level."</font></td>";
	$toon_table .= "\n\t<tr>".$toon_realm_html.$toonNameCell.$toon_icon_html.$toonLvlCell.$toonSpecCell.$toonPriProfHtml./*$toonSecProfHtml.$toonRepHtml.*/$toonIlvlCell."\n\t</tr>\n";
}
$toon_table .= "\n</table>\n</div>\n"; 

?>
