<?php
/* file: guild.php */
/* General info per user on wow toons */

// Initialize the session
session_start();

// If session variable is not set it will redirect to login page
if(!isset($_SESSION['user_email']) || empty($_SESSION['user_email'])){
  header("location: /login.php");
  exit;
}

//includes
include "../cats.php";
include "./includes/leg_fact_inc.php";
include "./includes/leg_html_inc.php";
include "./includes/wow_class_inc.php";

//$toon_owner_id = $_SESSION['user_id'];
//$toon_owner_first = $_SESSION['user_first'];
$toon = "";
$toon_url = "";
$db_toon_count = "";
$db_toon_counter = 0;
$wow_item_url = $wow_url."item/";
$char_url = $wow_url."character/";
$guild = $_REQUEST['guild_name'];
$realm = $_REQUEST['guild_realm'];
$guild_url = "https://us.api.battle.net/wow/guild/";
$guild_fields = "fields=members";
$guild_char_fields = "fields=titles,professions,talents";
$guild_info_url = $guild_url.$realm."/".$guild."?".$guild_fields."&".$blizz_locale."&".$api_key;
$guild_json = file_get_contents($guild_info_url);
$guild_info_object = json_decode($guild_json);
$guild_td_icon = "\n\t<tr>";
$guild_td_spec = "\n\t<tr>";
$guild_td_prof = "\n\t<tr>";
$members_list = "\n<table><center>\n\t<caption><h3><font color=\"#FFFFFF\">".$guild." Member List</font></h3></caption>\n\t<tr>\n\t\t<th></th>\n\t\t<th><font color=\"#FFFFFF\">Member</font></th>\n\t\t<th><font color=\"#FFFFFF\">Class</font></th>\n\t\t<th><font color=\"#FFFFFF\">Professions</font></th>";
foreach ($guild_info_object->members as $members_object) {
    $toon_mainspec = $toon_title = $toon_pripof1 = $toon_priprof2 = $toon_class_api = $toon_name = $toon_titled = "";
    $primary_profs_counter = 1;
    $mainspec = "0";
    $guild_char_url = $char_url.$realm."/".$members_object->character->name."?".$guild_char_fields."&".$blizz_locale."&".$api_key; // The magic from the Blizzard API
    $guild_char_json = file_get_contents($guild_char_url);
    $guild_char_object = json_decode($guild_char_json);
    $toon_name = $members_object->character->name;
    $toon_class_api = $guild_char_object->class;
    $guild_char_class = wowClasses($toon_class_api);
    foreach ($guild_char_object->professions->primary as $toon_profs_object){
        ${'toon_priprof'.$primary_profs_counter} = $toon_profs_object->name;
        $primary_profs_counter++;
        }
    foreach ($guild_char_object->titles as $toon_titles_object) {
        if(isset($toon_titles_object->selected)) {
            $toon_title = $toon_titles_object->name;
            }
        }
    $toon_titled = str_replace("%s", $toon_name, $toon_title);
    $members_list .= "\n\t<tr>\n\t\t<td><img src=\"".$icon_url.$members_object->character->thumbnail."\"></td>\n\t\t<td><form name=\"character\" method=\"POST\" action=\"./character.php\"><input type=\"hidden\" name=\"toon_name\" value=\"".$toon_name."\"><input type=\"hidden\" name=\"toon_realm\" value=\"".$realm."\"><input type=\"SUBMIT\" value=\"".$toon_titled."\"></form></td>\n\t\t<td><font color=\"#FFFFFF\">".$members_object->character->spec->name." ".$guild_char_class."</font></td>\n\t\t<td><font color=\"#FFFFFF\">".$toon_priprof1."/".$toon_priprof2."</font></td>\n\t</tr>";
    }
$members_list .= "\n</center></table>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" http-equiv="refresh" content="7200">
    <title><?php echo $guild; ?> Membership List</title>
    <link rel="stylesheet" href="./style/style.css">
    <link rel="icon" type="image/png" href="../favicon-32x32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="../favicon-16x16.png" sizes="16x16" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
	<body><?php echo $nav_table?>
    <h2><center>World of Warcraft: <?php echo $guild; ?> Members</center></h2>
    <div id="table-nav">
        <table>
            <tr>
                <div class="form-group"><td><center><form name="add_toon" method="POST" action="./add_toon.php"><input value="Add a character" type="submit"></form></td></div>
                <div class="form-group"><td><center><form name="legion" method="POST" action="./legion.php"><input value="Legion - <?php echo $_SESSION['user_first']; ?>" type="submit"></form></td></div>
                <div class="form-group"><td><center><form name="toons" method="POST" action="./wow.php"><input type="SUBMIT" value="<?php echo $_SESSION['user_first']; ?>'s characters"></form></td></div>
            </div>
            </tr>
        </table>
    </div>
    <div id="container">
    <div id="table-nav">
        <center><?php print $members_list?></center>
    </div>
    </div>
    <div id="table-nav">
        <table>
            <tr>
                <div class="form-group">
                    <td><center><form name="wowhead" method="POST" action="http://www.wowhead.com/" target="_blank"><input type="SUBMIT" value="WoW Head"></form></center></td>
                    <td><center><form name="raidbots" method="POST" action="https://www.raidbots.com/" target="_blank"><input type="SUBMIT" value="RaidBots"></form></center></td>
                    <td><center><form name="xufu" method="POST" action="https://www.wow-petguide.com/index.php" target="_blank"><input type="SUBMIT" value="Xu-Fu"></form></center></td>
                    <td><center><form name="icyveins" method="POST" action="https://www.icy-veins.com/" target="_blank"><input type="SUBMIT" value="Icy Veins"></form></center></td>
                    <td><center><form name="noxxic" method="POST" action="http://www.noxxic.com/" target="_blank"><input type="SUBMIT" value="Noxxic"></form></center></td>
                    <td><center><form name="warcraft-pets" method="POST" action="https://www.warcraftpets.com/" target="_blank"><input type="SUBMIT" value="Warcraft Pets"></form></center></td>
                    <td><center><form name="wow-professions" method="POST" action="http://www.wow-professions.com/" target="_blank"><input type="SUBMIT" value="WoW Professions"></form></center></td>
                </div>
            </tr> 
        </table>
    </div>
    <p />
    <p />
    <p />
    </div>
</body>
