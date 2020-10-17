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
//$wowLocale = "locale=en_US";
$toon_sql = ("SELECT toon_name, toon_slug, toon_realm FROM toon WHERE toon_owner=\"".$userId."\" AND toon_primary=\"Yes\" ORDER BY toon_realm, toon_name");
$toonName = "";
$toonRealm = "";
$toonIcon = "";
$toonCounter = 0;
$myOauthTokenArr = getOauthToken($blizzardOauthTokenUrl);
$myOauthToken = $myOauthTokenArr['access_token'];

// Starting the character table
$basicToonTable = "<table>\n\t<caption><center><font color=\"FFFFFF\"><h3>".$toon_owner_first."'s Characters.</h3></font></center></caption>\n\t<thead>\n\t<tr>\n\t\t<th bgcolor=\"BFBCBA\">Realm</th>\n\t\t<th  bgcolor=\"BFBCBA\">Character</th>\n\t\t<th  bgcolor=\"BFBCBA\">Icon</th>\n\t\t<th  bgcolor=\"BFBCBA\">Level</th>\n\t\t<th bgcolor=\"BFBCBA\">Race</th>\n\t\t<th bgcolor=\"BFBCBA\">Gender</th>\n\t\t<th bgcolor=\"BFBCBA\">Class</th>\n\t\t<th bgcolor=\"BFBCBA\">Spec</th>\n\t\t<th bgcolor=\"BFBCBA\">Guild</th><th bgcolor=\"BFBCBA\">iLvl</th>\n\t</thead>\n\t<tbody>";

$allUserToons = getAllUserToons ($userId, $dbHost, $dbUser, $dbPass, $dbWow); // Getting the users info from the DB
$userToonCount = count($allUserToons); // Getting the count of the user's toons

$wowToonUrls = toonCommunityUrlArray ($allUserToons, $myOauthToken); // Creating an array of Profile API calls
/* Using the borrow MultiAPI classes to get all the toon data concurently */
$wowToonApiArray = new multiapi();
$wowToonApiArray->data = $wowToonUrls;
$wowToonDataArray = $wowToonApiArray->get_process_requests();

$wowToonsObjArray = getAllToonObjArray($wowToonDataArray, $userToonCount);

foreach ($wowToonsObjArray as $toonObj) 
	{
	$toonMediaObj = getToonMediaInfo($toonObj->media->href.$blizzardLocaleUs.$tokenPrefix.$myOauthToken);
	$toonFaction = $toonObj->faction->name->en_US;
	$toonIcon = "";
	if (isset($toonMediaObj->avatar_url))
		{
			$toonIcon = $toonMediaObj->avatar_url;
		} else {
			$toonIcon = $toonMediaObj->assets[0]->value;
		}
	$toonName = $toonObj->name;
	$toonRealm = $toonObj->realm->name->en_US;
	$toon_realm_html = factionStylesRealm($toonObj->faction->type, $toonObj->realm->name->en_US);
	$toon_icon_html = factionStylesIcon($toonObj->faction->type, $toonIcon, $toonObj->name, $toonObj->realm->slug);
	$toon_bg_color = wowClassColors($toonObj->character_class->name->en_US);
	$toonClassCellColor = wowClassColors($toonObj->character_class->name->en_US);
	$toonNameCell = "\n\t\t<td ".$toonClassCellColor.$toonObj->name."</font></td>";
	$toonLvlCell = "\n\t\t<td ".$toonClassCellColor.$toonObj->level."</font></td>";
	$toonRaceCell = "\n\t\t<td ".$toonClassCellColor.$toonObj->race->name->en_US."</font></td>";
	$toonGenderCell = factionStylesGuild($toonObj->faction->type, $toonObj->gender->name->en_US);
	$toonClassCell = "\n\t\t<td ".$toonClassCellColor.$toonObj->character_class->name->en_US."</font></td>";
	$toonSpecCell = "\n\t\t<td ".$toonClassCellColor.$toonObj->active_spec->name->en_US."</font></td>";
	$toonGuildCell = factionStylesGuild($toonObj->faction->type, $toonObj->guild->name);
	$toonIlvlCell = "\n\t\t<td ".$toonClassCellColor.$toonObj->equipped_item_level."</font></td>";
	$basicToonTable .= "\n\t<tr>".$toon_realm_html.$toonNameCell.$toon_icon_html.$toonLvlCell.$toonRaceCell.$toonGenderCell.$toonClassCell.$toonSpecCell.$toonGuildCell.$toonIlvlCell."\n\t</tr>\n";
	}
$basicToonTable .= "\n</table>\n</div>\n";

?>
