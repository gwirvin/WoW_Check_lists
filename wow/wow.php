<?php
/* file: wow.php */
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
include "./includes/blz_oauth_inc.php";
include "includes/blizzard_resources_inc.php";
include "includes/wow_fact_inc.php";
include "includes/leg_html_inc.php";
include "includes/wow_class_inc.php";

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
$toon_table = "\n<table><font color=\"FFFFFF\">\n\t<caption><center><font color=\"FFFFFF\"><h3>".$_SESSION['user_first']."'s World of Warcraft Characters</h3></font></caption>\n\t<tr>";
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
        $toon_name = $toon_result[$db_toon_counter]['toon_name'];
        $toon_realm = $toon_result[$db_toon_counter]['toon_realm'];
        $toon_info_url = htmlspecialchars_decode($char_url.$toon_realm."/".$toon_name."?".$char_wow_fields."&".$blizz_locale."&".$api_key); // The magic from the Blizzard API
        $toon_json = file_get_contents($toon_info_url);
        $toon_info_object = json_decode($toon_json);
        $toon_faction = $toon_info_object->faction;
        $toon_icon = $icon_url.$toon_info_object->thumbnail;
        $toon_realm_name = $toon_info_object->realm;
        $toon_talents = $toon_info_object->talents;
        $toon_realm_html = factionStylesRealm($toon_faction, $toon_realm_name);
        $toon_icon_html = factionStylesIcon($toon_faction, $toon_icon, $toon_name, $toon_realm_name);
        while (($mainspec >= 0) && ($mainspec <= 4)) {
            foreach ($toon_info_object->talents as $toon_specs_object) {
                if (isset($toon_specs_object->selected)) {
                    $toon_mainspec = $toon_specs_object->spec->name;
                    $mainspec++;
                    }
                }
            }
        $toon_class_api = $toon_info_object->class;
        $toon_class_name = wowClasses($toon_class_api);
        foreach ($toon_info_object->titles as $toon_titles_object) {
            if(isset($toon_titles_object->selected)) {
	        $toon_title = $toon_titles_object->name;
                }
      	    }
        $toon_mount_count = $toon_info_object->mounts->numCollected;
        $toon_bpet_count = $toon_info_object->pets->numCollected;
        foreach ($toon_info_object->professions->primary as $toon_profs_object){
            ${'toon_priprof'.$primary_profs_counter} = $toon_profs_object->name;
 	    $primary_profs_counter++;
 	    }
        foreach ($toon_info_object->reputation as $toon_rep_object) {
 	    if ($toon_rep_object->standing == 7) {
                $toon_exalted_reps++;
                }
 	    }
         $toon_titled = str_replace("%s", $toon_name, $toon_title);
         $toon_guild = $toon_info_object->guild->name;
         $toon_td_header = "\n\t\t<th colspan=\"2\"><form name=\"character\" method=\"POST\" action=\"./character.php\"><input type=\"hidden\" name=\"toon_realm\" value=\"".$toon_realm."\"><input type=\"hidden\" name=\"toon_name\" value=\"".$toon_name."\"><input type=\"SUBMIT\" value=\"".$toon_titled."\"></form></th>";
 	 $toon_td_icon = "\n\t\t<td rowspan=4><img src=\"".$toon_icon."\"></td>";
 	 $toon_td_spec = "\n\t\t<td><font color=\"FFFFFF\">".$toon_mainspec." ".$toon_class_name."</font></td>";
 	 $toon_td_profs = "\n\t\t<td><font color=\"FFFFFF\">".$toon_priprof1."/".$toon_priprof2."</font></td>";
 	 $toon_td_mounts = "\n\t\t<td><font color=\"FFFFFF\">".$toon_priprof1."/".$toon_priprof2."</font></td>";
 	 $toon_td_reps = "\n\t\t<td><font color=\"FFFFFF\">".$toon_exalted_reps." Exalted Reputations</font></td>";
 	 $toon_td_guild = "\n\t\t<td colspan=\"2\"><div class=\"form-group\"><center><form name=\"guild\" method=\"POST\" action=\"guild.php\"><input type=\"hidden\" name=\"guild_name\" value=\"".$toon_guild."\"><input type=\"hidden\" name=\"guild_realm\" value=\"".$toon_realm."\"><input value =\"".$toon_guild."\" type=\"SUBMIT\"></form></center></td>";
 	 $toon_table .= "\n\t<tr>".$toon_td_header."</tr>\n\t<tr>".$toon_td_icon.$toon_td_spec."\n\t</tr>\n\t<tr>".$toon_td_profs."\n\t</tr>\n\t<tr>".$toon_td_reps."\n\t</tr>\n\t<tr>".$toon_td_mounts."\n\t</tr>\n\t<tr>".$toon_td_guild."\n\t</tr>";
        }    
    }
$toon_table .= "\n</table>";
//print "<center>".$toon_table."</center>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" http-equiv="refresh" content="7200">
    <title><?php echo $_SESSION['user_first']?>'s Warcraft Characters</title>
    <link rel="stylesheet" href="./style/style.css">
    <link rel="icon" type="image/png" href="../favicon-32x32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="../favicon-16x16.png" sizes="16x16" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<?php echo $nav_table?>
<body>
    <h2><center>World of Warcraft: <?php echo $_SESSION['user_first']; ?>'s Characters</center></h2>
    <div id="table-nav">
        <table>
                <div class="form-group"><td><center><form name="home" method="POST" action="../index.php"><input value="Home" type="submit"></form></center></td>
                <div class="form-group"><td><center><form name="add_toon" method="POST" action="./add_toon.php"><input value="Add a character" type="submit"></form></td>
            </div>
            </tr>
        </table>
    </div>
    <div id="container">
    <div id="table-nav">
        <?php print $toon_table; ?>
    </div>
    </div>
    <div id="table-nav">
        <table><caption>WoW Info Sites</caption>
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
</html>
