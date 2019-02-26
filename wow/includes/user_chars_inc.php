<?php
/* file: bfa_chk_lst.php */

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
$char_url = $wow_url."character/";
$wowFields = "fields=mounts,reputation,pets,professions,talents,titles,items";
$toon_sql = ("SELECT toon_name, toon_realm FROM toon WHERE toon_owner=\"".$userId."\" ORDER BY toon_realm, toon_name");
$toonName = "";
$toonRealm = "";
$toonIcon = "";
$toonCounter = 0;

// Starting the character table
$toon_table = "<table>\n\t<caption><center><font color=\"FFFFFF\"><h3>World of Warcraft Characters for </h3></font></center></caption>\n\t<thead>\n\t\t<tr>\n\t\t\t<th rowspan=\"2\"bgcolor=\"BFBCBA\">Realm</th>\n\t\t\t<th rowspan=\"2\" bgcolor=\"BFBCBA\">Character</th>\n\t\t\t<th rowspan=\"2\" bgcolor=\"BFBCBA\">Title</th>\n\t\t\t<th rowspan=\"2\" bgcolor=\"BFBCBA\">Guild</th>\n\t\t\t<th rowspan=\"2\" bgcolor=\"BFBCBA\">Icon</th>\n\t\t\t<th rowspan=\"2\" bgcolor=\"BFBCBA\">Level</th>\n\t\t\t<th rowspan=\"2\" bgcolor=\"BFBCBA\">Current Spec</th>\n\t\t\t<th colspan=\"3\" bgcolor=\"6C00FF\"><font color=\"FFFFFF\">Battle Pets</font></th>\n\t\t\t<th colspan=\"2\" bgcolor=\"009933\"><font color=\"FFFFFF\">Mounts</font></th>\n\t\t\t<th colspan=\"2\" bgcolor=\"0008FF\"><font color=\"FFFFFF\">Reputations</font></th>\n\t\t\t<th rowspan=\"2\" bgcolor=\"BFBCBA\">Equiped iLvl</th>\n\t\t</tr>\n\t\t<tr>\n\t\t\t<th bgcolor=\"8833FF\"><font color=\"FFFFFF\">Collected</font></th>\n\t\t\t<th bgcolor=\"8833FF\"><font color=\"FFFFFF\">Not Max Level</font></th>\n\t\t\t<th bgcolor=\"8833FF\"><font color=\"FFFFFF\">Uncollected</font></th>\n\t\t\t<th bgcolor=\"33CC33\"><font color=\"FFFFFF\">Collected</font></th>\n\t\t\t<th bgcolor=\"33CC33\"><font color=\"FFFFFF\">Uncollected</font></th>\n\t\t\t<th bgcolor=\"5D63FF\"><font color=\"FFFFFF\">Exalted</font></th>\n\t\t\t<th bgcolor=\"5D63FF\"><font color=\"FFFFFF\">Not Exalted</font></th>\n\t\t</tr>\n\t</thead>\n\t<tbody>\n"

$allUserToons = getUserToons ($userId, $dbHost, $dbUser, $dbPass, $dbWow); // Getting the users info from the DB
$userToonCount = count($allUserToons); // Getting the count of the user's toons
$allToonUrls = toonUrlArray ($allUserToons, $wow_url, $wowFields, $api_key); // Creating an array of all the API calls

/* Using the borrow MultiAPI classes to get all the toon data concurently */
$allToonApiArray = new multiapi();
$allToonApiArray->data = $allToonUrls;
$allToonDataArray = $allToonApiArray->get_process_requests();
/* MultiAPI Calls done */

/* Converting the strings returned int he multiapi to an array fo objects */
$allToonsObjArray = getAllToonObjArray($allToonDataArray, $userToonCount);

foreach ($allToonsObjArray as $toonObj) {
	$toonFaction = $toonObj->faction;
	$toonIcon = $icon_url.$toonObj->thumbnail;
	$toonRealm = $toonObj->realm;
	$toonTalents = $toonObj->talents;
	$toonCollectedMounts = $toonObj->mounts->numCollected;
	$toonUncollectedMounts = $toonObj->mounts->numNotCollected;
	$toonTitle = toonTitle($toonObj->titles);
	$toonExaltedReps = wowExaltedReputations($toonObj->reputation);
	$toonNotExlatedReps = wowNotExlatedReputations($toonObk->reputation);
	$toon_realm_html = factionStylesRealm($toonFaction, $toonRealm);
	$toon_icon_html = factionStylesIcon($toonFaction, $toonIcon, $toonName, $toonRealm);
	$toon_bg_color = wowClassColors($toonObj->class);
	$toonClassCellColor = wowClassColors($toonObj->class);
	$toonNameCell = "\n\t\t<td ".$toonClassCellColor.$toonObj->name."</font></td>";
	$toonLvlCell = "\n\t\t<td ".$toonClassCellColor.$toonObj->level."</font></td>";
	$toonSpecCell = "\n\t\t<td ".$toonClassCellColor.$toonObj->talents[0]->spec->name."</font></td>";
	$toonIlvlCell = "\n\t\t<td ".$toonClassCellColor.$toonObj->items->averageItemLevelEquipped."</font></td>";
	$toonCollectedPetsCell = "\n\t\t<td ".$toonClassCellColor.$toonObj->pets->numCollected."</font></td>";
	$toonUncollectedPetsCell = "\n\t\t<td ".$toonClassCellColor.$toonObj->pets->numNotCollected."</font></td";
	$toon_table .= "\n\t<tr>".$toon_realm_html.$toonNameCell.$toon_icon_html.$toonLvlCell.$toonSpecCell.$toonPriProfHtml.$toonSecProfHtml.$toonRepHtml.$toonIlvlCell."\n\t</tr>\n";
}
$toon_table .= "\n</table>\n</div>\n"; 

?>
