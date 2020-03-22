<?php
/* file: wow.php */
/* General info per user on wow toons */

// Initialize the session
session_start();

// If session variable is not set it will redirect to login page
if(!isset($_SESSION['user_email']) || empty($_SESSION['user_email'])){
  header("location: ../login.php");
  exit;
}

//includes
include "../cats.php";
include "./includes/wow_class_inc.php";
include "./includes/blizzard_resources_inc.php";

$toon_owner_id = $_SESSION['user_id'];
$toon_owner_first = $_SESSION['user_first'];
$toon = "";
$toon_url = "";
$db_toon_count = "";
$db_toon_counter = 0;
$wow_item_url = $wow_url."item/";
$char_url = $wow_url."character/";
$char_wow_fields = "fields=reputation,professions,talents,mounts,pets,titles,guild";
$toon_sql = ("SELECT toon_name, toon_realm FROM toon WHERE toon_owner=\"".$toon_owner_id."\" ORDER BY toon_realm, toon_name");
$toon_query = mysqli_query($wow_conn, $toon_sql);
// Starting the toon table
$toon_table = "<br><table><font color=\"FFFFFF\"><br>\t<caption><center><font color=\"FFFFFF\"><h3>".$_SESSION['user_first']."'s World of Warcraft Characters</h3></font></caption><br>\t<tr>";
// Getting the data from the database for the rest to work
while ($toon_result = mysqli_fetch_all($toon_query, MYSQLI_ASSOC)) {
    $db_toon_count = count($toon_result); // $db_toon_count is the total number of resutls, db_toon_counter increments on each run through the script
    for ($db_toon_counter = 0; $db_toon_counter < $db_toon_count; $db_toon_counter++) { //looping through each row of returned arrays
        $rep_obj_counter = 0;
        $rep_count = 0;
        $mainspec = "0";
        $primary_profs_counter = 1;
        $toon_class = "";
        $toon_faction = "";
        $toon_mainspec = "";
        $primary_profs_count = "";
        $toon_title = "";
        $toon_priprof1 = "";
        $toon_priprof2 = "";
        $toon_exalted_reps = 0;
        $toon_titled = "";
	//        $toon_name = $toon_result[$db_toon_counter]['toon_name'];
	$toonSlug = $toon_result[$db_toon_counter]['toon_slug'];
	$toonSlug = $toon_result[$db_toon_counter]['toon_realm'];
	//$toon_realm = $toon_result[$db_toon_counter]['toon_realm'];
	$toonProfileUrl = $blizzardApiBase.$wowProfile.$realmSlug."/".$toonSlug.$wowProfileNamespace.$blizzardLocaleUs.$tokenPrfix.$api_key; 
	//$toon_info_url = $char_url.$toon_realm."/".$toon_name."?".$char_wow_fields."&".$blizz_locale."&".$api_key; // The magic from the Blizzard API
	$toonProfileObj = json_decode(file_get_contents($toonProfileUrl));
	$toonName = $toonProfileObj->name;
	$toonFaction = $toonProfileObj->faction->type;
	$toonRace = $toonProfileObj->race->name->en_US;
	$toonClass = $toonProfileObj->character_class->name->en_US;
	$toonGender = $toonProfileObj->gender->type;
	$toonRealm = $toonProfileObj->realm->slug;
	$toonLevel = $toonProfileObj->level;
	$toonILvl = $toonProfileObj->equiped_item_level;
	//	print "$toonName is a $toonFaction $toonGender $toonClass at level $toonLevel wearing gear totaling $toonILvl on $toonRealm\n<br>\n<hr />\n";
	print "Value of \$toonProfileUrl is:\n<br>\n<pre>"; var_dump($toonProfileUrl); print "</pre>\n<br>\n==============================\n<br>\nValue of \$toonProfileObj is:\n<br>\n<pre>\n"; var_dump($toonProfileObj); print "\n</pre>\n<br>\n<hr />\n";
	//$toon_json = file_get_contents($toon_info_url);
        //$toon_info_object = json_decode($toon_json);
        //$toon_faction = $toon_info_object->faction;
        //$toon_icon = $icon_url.$toon_info_object->thumbnail;
        //$toon_realm_name = $toon_info_object->realm;
        //$toon_talents = $toon_info_object->talents;
        //$toon_realm_html = factionStylesRealm($toon_faction, $toon_realm_name);
        //$toon_icon_html = factionStylesIcon($toon_faction, $toon_icon, $toon_name, $toon_realm_name);
        //print $toon_name."<br>".$toon_realm."<br>".$toon_faction."<br>".$toon_talents; print "<br>-----------------------------------<br>";
        }    
    }

?>

