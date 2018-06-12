<?php
/* file: legion.php */

// Initialize the session
session_start();

// If session variable is not set it will redirect to login page
if(!isset($_SESSION['user_email']) || empty($_SESSION['user_email'])){
  header("location: /login.php");
  exit;
}


// Block for testing
include "../cats.php";
include "./includes/leg_html_inc.php";
include "./includes/leg_lgnd_inc.php";
include "./includes/leg_rep_inc.php";
include "./includes/leg_fact_inc.php";
include "./includes/leg_ac_inc.php";

// Variables for the start
$toon_owner_id = $_SESSION['user_id'];
$toon_owner_first = $_SESSION['user_first'];
$toon = "";
$toon_url = "";
$db_toon_count = "";
$db_toon_counter = 0;
$wow_item_url = $wow_url."item/";
$char_url = $wow_url."character/";
$char_fields = "fields=reputation,items,professions,audit,talents,guild";
$toon_sql = ("SELECT toon_name, toon_realm FROM toon WHERE toon_owner=\"".$toon_owner_id."\" ORDER BY toon_realm, toon_name");
$toon_query = mysqli_query($wow_conn, $toon_sql);
// Starting the character table
$toon_table = "<div id=\"table-body\">\n<table>\n\t<caption><center><font color=\"FFFFFF\"><h3>Legion checklist for ".$_SESSION['user_first']."</h3></font></center></caption>\n\t<tr>\n\t\t<th rowspan=\"2\"bgcolor=\"BFBCBA\">Realm</th>\n\t\t<th rowspan=\"2\" bgcolor=\"BFBCBA\">Character</th>\n\t\t<th rowspan=\"2\" bgcolor=\"BFBCBA\">Icon</th>\n\t\t<th rowspan=\"2\" bgcolor=\"BFBCBA\">Level</th>\n\t\t<th rowspan=\"2\" bgcolor=\"BFBCBA\">Current Spec</th>\n\t\t<th rowspan=\"2\" bgcolor=\"FB2723\">Auto Complete</th>\n\t\t<th colspan=\"2\" bgcolor=\"FB7B23\">Legendary</th>\n\t\t<th colspan=\"6\" bgcolor=\"6C00FF\"><font color=\"FFFFFF\">Professions</font></th>\n\t\t<th colspan=\"9\" rowspan=\"2\" bgcolor=\"0008FF\"><font color=\"FFFFFF\">Reputations</font></th>\n\t\t<th rowspan=\"2\" bgcolor=\"E6DC43\">Artifact Rank</th>\n\t\t<th rowspan=\"2\" bgcolor=\"BFBCBA\">Equiped iLvl</th>\n\t</tr>\n\t<tr>\n\t\t<th bgcolor=\"F09456\">Needed Total</th>\n\t\t<th bgcolor=\"D38550\">Needs Lvl</th>\n\t\t<th colspan=\"2\" bgcolor=\"8439EB\"><font color=\"FFFFFF\">Primary Professions</font></th>\n\t\t<th colspan=\"4\" bgcolor=\"9E5FF4\"><font color=\"FFFFFF\">Secondary Professions</font></th>\n\t</tr>";
// Variables that need some setting other than empty
$rep_obj_counter = 0;
$rep_count = 0;
$mainspec = "0";
$primary_profs_counter = 1;
$secondary_profs_counter = 1;
$rep_obj_counter = 0;
$toon_legend_count = 0;
$toon_legend_level_count = 0;
$rep_missing_counter = 0;
$rep_legion_count = 9;
$toon_artifact_rank = 0;
$toon_legend_lvl_count = 0;
$max_legend_lvl = 970;
$toon_class = "";
$toon_faction = "";
$toon_mainspec = "";
$toon_auto_complete = "";
$toon_avg_eilvl = "";
$toon_legend_need = "";
$toon_pri_profs = "";
$toon_sec_profs = "";
$primary_profs_count = "";
$secondary_profs_counter = "";
$faction_standing_name = "";
$faction_name = "";
$faction_standing = "";
$faction_curr = "";
$faction_max = "";
$toon_rep_obj = "";
$rep_total_missing = "";
$toon_faction_html = "";
$toon_artf_rank = "";
$toon_relic_count = "";
$toon_artf_html = "";
$toon_ac_html = "";
$toon_lgnd_need_html = "";
$toon_lgnd_lvl_need_html = "";
$toon_name = $_REQUEST['toon_name'];
$toon_realm = $_REQUEST['toon_realm'];
$toon_info_url = $char_url.$toon_realm."/".$toon_name."?".$char_fields."&".$blizz_locale."&".$api_key; // The magic from the Blizzard API
$toon_json = file_get_contents($toon_info_url);
$toon_info_object = json_decode($toon_json);
$toon_faction = $toon_info_object->faction;
$toon_icon = $icon_url.$toon_info_object->thumbnail;
$toon_realm_name = $toon_info_object->realm;
$toon_guild = $toon_info_object->guild->name;
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
$toon_auto_complete = autoComplete($toon_class_api);
$possible_item_slots = array('head', 'neck', 'shoulder', 'back', 'chest', 'wrist', 'hands','waist', 'legs', 'feet', 'finger1', 'finger2', 'trinket1', 'trinket2', 'mainHand', 'offhand');
for ($i = 0; $i < 16; $i++) {
    if (isset($toon_info_object->items->{$possible_item_slots[$i]})) {
        if ($toon_info_object->items->{$possible_item_slots[$i]}->quality === 5 && $toon_info_object->items->{$possible_item_slots[$i]}->itemLevel >= $max_legend_lvl) { 
            $toon_legend_count++;
            $toon_legend_lvl_count++;
        } elseif ($toon_info_object->items->{$possible_item_slots[$i]}->quality === 5 ) {
            $toon_legend_count++;
            }
        if ($toon_info_object->items->{$possible_item_slots[$i]}->quality === 6) {
            $toon_relic_count = count($toon_info_object->items->{$possible_item_slots[$i]}->relics);
            $artifact_traits_count = count($toon_info_object->items->{$possible_item_slots[$i]}->artifactTraits);
            for ($x = 0; $x < $artifact_traits_count; $x++) {
                $toon_artf_rank = $toon_artf_rank + $toon_info_object->items->{$possible_item_slots[$i]}->artifactTraits[$x]->rank;
                }
            $toon_artf_rank = $toon_artf_rank - $toon_relic_count;
            }
        }
    }
$toon_legend_need = legendCount($toon_legend_count);
$toon_legend_lvl_need = legendLevelCount($toon_legend_lvl_count);
while ($primary_profs_counter <= 2) { //getting primary professions + lvl if not maxed
    foreach ($toon_info_object->professions->primary as $toon_pri_prof_obj) {
        if ($toon_pri_prof_obj->rank >= 800) {
            $toon_pri_profs .= "\n\t\t<td bgcolor=\"10AA06\"><font color=\"FFFFFF\">".$toon_pri_prof_obj->name."</font></td>";
            $primary_profs_counter++;
        } elseif ($toon_pri_prof_obj->rank <= 799 && $toon_pri_prof_obj->rank >= 700) {
            $toon_pri_profs .= "\n\t\t<td bgcolor=\"F4E938\">".$toon_pri_prof_obj->name." - ".$toon_pri_prof_obj->rank."</td>";
            $primary_profs_counter++;
        } elseif ($toon_pri_prof_obj->rank <= 699) {
            $toon_pri_profs .= "\n\t\t<td bgcolor=\"C00808\"><font color=\"FFFFFF\">".$toon_pri_prof_obj->name." - ".$toon_pri_prof_obj->rank."</font></td>";
            $primary_profs_counter++;
        } else {
            $toon_pri_profs .= "\n\t\t<td bgcolor=\"000000\"> </td>";
            $primary_profs_counter++;
            }
        }
    }
while ($secondary_profs_counter <= 4) { //Getting secondary professions +lvl if not maxed, no idea what happens if all are not taken
    $toon_sec_profs = "";
    foreach ($toon_info_object->professions->secondary as $toon_sec_prof_obj) {
        if ($toon_sec_prof_obj->rank >= 800) {
            $toon_sec_profs .= "\n\t\t<td bgcolor=\"10AA06\"><font color=\"FFFFFF\">".$toon_sec_prof_obj->name."</font></td>";
            $secondary_profs_counter++;
        } elseif ($toon_sec_prof_obj->rank <= 799 && $toon_sec_prof_obj->rank >= 700) {
            $toon_sec_profs .= "\n\t\t<td bgcolor=\"F4E938\">".$toon_sec_prof_obj->name." - ".$toon_sec_prof_obj->rank."</td>";
            $secondary_profs_counter++;
        } elseif ($toon_sec_prof_obj->rank <= 699) {
            $toon_sec_profs .= "\n\t\t<td bgcolor=\"C00808\"><font color=\"FFFFFF\">".$toon_sec_prof_obj->name." - ".$toon_sec_prof_obj->rank."</font></td>";
            $secondary_profs_counter++;
        } else {
            $toon_sec_profs .= "\n\t\t<td bgcolor=\"000000\"> </td>";
            $secondary_profs_counter++;
            }
        }
    }

$rep_count = count($toon_info_object->reputation);
while ($rep_obj_counter < $rep_count) {
    foreach ($toon_info_object->reputation as $toon_rep_obj) {
        if ($toon_rep_obj->id === 1900 || $toon_rep_obj->id === 1828 || $toon_rep_obj->id === 1859 || $toon_rep_obj->id === 1883 || $toon_rep_obj->id === 1894 || $toon_rep_obj->id === 2165 || $toon_rep_obj->id === 2170 || $toon_rep_obj->id === 1948 || $toon_rep_obj->id === 2045) {
            $faction_name = $toon_rep_obj->name;
            $faction_standing = $toon_rep_obj->standing;
            $faction_curr = $toon_rep_obj->value;
            $faction_max = $toon_rep_obj->max;
            $faction_standing_name = factionStanding($faction_standing, $faction_curr, $faction_max, $faction_name);
            $toon_faction_html .= $faction_standing_name;
            $rep_missing_counter++;
        }
        $rep_obj_counter++;
        }
    if ($rep_missing_counter < 9) {
        $rep_total_missing = 9 - $rep_missing_counter;
        $toon_faction_html .= "\n\t\t<td colspan=\"".$rep_total_missing."\" bgcolor=\"757B74\"></td>";
        }
if ($toon_info_object->class == 1) { //putting in class colors for class spec and lvl data
    $toon_name_api = $td_open_wr.$toon_info_object->name.$td_close_wr;
    $toon_level = $td_open_wr.$toon_info_object->level.$td_close_wr;
    $toon_curr_spec = $td_open_wr.$toon_mainspec.$td_close_wr;
    $toon_lgnd_need_html = $td_open_wr.$toon_legend_need.$td_close_wr;
    $toon_lgnd_lvl_need_html = $td_open_wr.$toon_legend_lvl_need.$td_close_wr;
    $toon_artf_html = $td_open_wr.$toon_artf_rank.$td_close_wr;
    $toon_ilvl_html = $td_open_wr.$toon_info_object->items->averageItemLevelEquipped.$td_close_wr;
} elseif ($toon_info_object->class == 2) {
    $toon_name_api = $td_open_pl.$toon_info_object->name.$td_close_pl;
    $toon_level = $td_open_pl.$toon_info_object->level.$td_close_pl;
    $toon_curr_spec = $td_open_pl.$toon_mainspec.$td_close_pl;
    $toon_lgnd_need_html = $td_open_pl.$toon_legend_need.$td_close_pl;
    $toon_lgnd_lvl_need_html = $td_open_pl.$toon_legend_lvl_need.$td_close_pl;
    $toon_artf_html = $td_open_pl.$toon_artf_rank.$td_close_pl;
    $toon_ilvl_html = $td_open_pl.$toon_info_object->items->averageItemLevelEquipped.$td_close_pl;
} elseif ($toon_info_object->class == 3) {
    $toon_name_api = $td_open_ht.$toon_info_object->name.$td_close_ht;
    $toon_level = $td_open_ht.$toon_info_object->level.$td_close_ht;
    $toon_curr_spec = $td_open_ht.$toon_mainspec.$td_close_ht;
    $toon_lgnd_need_html = $td_open_ht.$toon_legend_need.$td_close_ht;
    $toon_lgnd_lvl_need_html = $td_open_ht.$toon_legend_lvl_need.$td_close_ht;
    $toon_artf_html = $td_open_ht.$toon_artf_rank.$td_close_ht;
    $toon_ilvl_html = $td_open_ht.$toon_info_object->items->averageItemLevelEquipped.$td_close_ht;
} elseif ($toon_info_object->class == 4) {
    $toon_name_api = $td_open_rg.$toon_info_object->name.$td_close_rg;
    $toon_level = $td_open_rg.$toon_info_object->level.$td_close_rg;
    $toon_curr_spec = $td_open_rg.$toon_mainspec.$td_close_rg;
    $toon_lgnd_need_html = $td_open_rg.$toon_legend_need.$td_close_rg;
    $toon_lgnd_lvl_need_html = $td_open_rg.$toon_legend_lvl_need.$td_close_rg;
    $toon_artf_html = $td_open_rg.$toon_artf_rank.$td_close_rg;
    $toon_ilvl_html = $td_open_rg.$toon_info_object->items->averageItemLevelEquipped.$td_close_rg;
} elseif ($toon_info_object->class == 5) {
    $toon_name_api = $td_open_pr.$toon_info_object->name.$td_close_pr;
    $toon_level = $td_open_pr.$toon_info_object->level.$td_close_pr;
    $toon_curr_spec = $td_open_pr.$toon_mainspec.$td_close_pr;
    $toon_lgnd_need_html = $td_open_pr.$toon_legend_need.$td_close_pr;
    $toon_lgnd_lvl_need_html = $td_open_pr.$toon_legend_lvl_need.$td_close_pr;
    $toon_artf_html = $td_open_pr.$toon_artf_rank.$td_close_pr;
    $toon_ilvl_html = $td_open_pr.$toon_info_object->items->averageItemLevelEquipped.$td_close_pr;
} elseif ($toon_info_object->class == 6) {
    $toon_name_api = $td_open_dk.$toon_info_object->name.$td_close_dk;
    $toon_level = $td_open_dk.$toon_info_object->level.$td_close_dk;
    $toon_curr_spec = $td_open_dk.$toon_mainspec.$td_close_dk;
    $toon_lgnd_need_html = $td_open_dk.$toon_legend_need.$td_close_dk;
    $toon_lgnd_lvl_need_html = $td_open_dk.$toon_legend_lvl_need.$td_close_dk;
    $toon_artf_html = $td_open_dk.$toon_artf_rank.$td_close_dk;
    $toon_ilvl_html = $td_open_dk.$toon_info_object->items->averageItemLevelEquipped.$td_close_dk;
} elseif ($toon_info_object->class == 7) {
    $toon_name_api = $td_open_sm.$toon_info_object->name.$td_close_sm;
    $toon_level = $td_open_sm.$toon_info_object->level.$td_close_sm;
    $toon_curr_spec = $td_open_sm.$toon_mainspec.$td_close_sm;
    $toon_lgnd_need_html = $td_open_sm.$toon_legend_need.$td_close_sm;
    $toon_lgnd_lvl_need_html = $td_open_sm.$toon_legend_lvl_need.$td_close_sm;
    $toon_artf_html = $td_open_sm.$toon_artf_rank.$td_close_sm;
    $toon_ilvl_html = $td_open_sm.$toon_info_object->items->averageItemLevelEquipped.$td_close_sm;
} elseif ($toon_info_object->class == 8) {
    $toon_name_api = $td_open_mg.$toon_info_object->name.$td_close_mg;
    $toon_level = $td_open_mg.$toon_info_object->level.$td_close_mg;
    $toon_curr_spec = $td_open_mg.$toon_mainspec.$td_close_mg;
    $toon_lgnd_need_html = $td_open_mg.$toon_legend_need.$td_close_mg;
    $toon_lgnd_lvl_need_html = $td_open_mg.$toon_legend_lvl_need.$td_close_mg;
    $toon_artf_html = $td_open_mg.$toon_artf_rank.$td_close_mg;
    $toon_ilvl_html = $td_open_mg.$toon_info_object->items->averageItemLevelEquipped.$td_close_mg;
} elseif ($toon_info_object->class == 9) {
    $toon_name_api = $td_open_wk.$toon_info_object->name.$td_close_wk;
    $toon_level = $td_open_wk.$toon_info_object->level.$td_close_wk;
    $toon_curr_spec = $td_open_wk.$toon_mainspec.$td_close_wk;
    $toon_lgnd_need_html = $td_open_wk.$toon_legend_need.$td_close_wk;
    $toon_lgnd_lvl_need_html = $td_open_wk.$toon_legend_lvl_need.$td_close_wk;
    $toon_artf_html = $td_open_wk.$toon_artf_rank.$td_close_wk;
    $toon_ilvl_html = $td_open_wk.$toon_info_object->items->averageItemLevelEquipped.$td_close_wk;
} elseif ($toon_info_object->class == 10) {
    $toon_name_api = $td_open_mk.$toon_info_object->name.$td_close_mk;
    $toon_level = $td_open_mk.$toon_info_object->level.$td_close_mk;
    $toon_curr_spec = $td_open_mk.$toon_mainspec.$td_close_mk;
    $toon_lgnd_need_html = $td_open_mk.$toon_legend_need.$td_close_mk;
    $toon_lgnd_lvl_need_html = $td_open_mk.$toon_legend_lvl_need.$td_close_mk;
    $toon_artf_html = $td_open_mk.$toon_artf_rank.$td_close_mk;
    $toon_ilvl_html = $td_open_mk.$toon_info_object->items->averageItemLevelEquipped.$td_close_mk;
} elseif ($toon_info_object->class == 11) {
    $toon_name_api = $td_open_dr.$toon_info_object->name.$td_close_dr;
    $toon_level = $td_open_dr.$toon_info_object->level.$td_close_dr;
    $toon_curr_spec = $td_open_dr.$toon_mainspec.$td_close_dr;
    $toon_lgnd_need_html = $td_open_dr.$toon_legend_need.$td_close_dr;
    $toon_lgnd_lvl_need_html = $td_open_dr.$toon_legend_lvl_need.$td_close_dr;
    $toon_artf_html = $td_open_dr.$toon_artf_rank.$td_close_dr;
    $toon_ilvl_html = $td_open_dr.$toon_info_object->items->averageItemLevelEquipped.$td_close_dr;
} elseif ($toon_info_object->class == 12) {
    $toon_name_api = $td_open_dh.$toon_info_object->name.$td_close_dh;
    $toon_level = $td_open_dh.$toon_info_object->level.$td_close_dh;
    $toon_curr_spec = $td_open_dh.$toon_mainspec.$td_close_dh;
    $toon_lgnd_need_html = $td_open_dh.$toon_legend_need.$td_close_dh;
    $toon_lgnd_lvl_need_html = $td_open_dh.$toon_legend_lvl_need.$td_close_dh;
    $toon_artf_html = $td_open_dh.$toon_artf_rank.$td_close_dh;
    $toon_ilvl_html = $td_open_dh.$toon_info_object->items->averageItemLevelEquipped.$td_close_dh;
} else {
    $toon_name_api = "\n\t\t<td>".$toon_info_object->name."</td>";
    $toon_level = "\n\t\t<td>".$toon_info_object->level."</td>";
    $toon_curr_spec = "\n\t\t<td>".$toon_mainspec."</td>";
    $toon_lgnd_need_html = "\n\t\t<td>".$toon_legend_need."</td>";
    $toon_lgnd_lvl_need_html = "\n\t\t<td>".$toon_legend_lvl_need."</td>";
    $toon_artf_html = "\n\t\t<td>".$toon_artf_rank."</td>";
    $toon_ilvl_html = "\n\t\t<td>".$toon_info_object->items->averageItemLevelEquipped."</td>";
    }
    $toon_table .= "\n\t<tr>".$toon_realm_html.$toon_name_api.$toon_icon_html.$toon_level.$toon_curr_spec.$toon_auto_complete.$toon_lgnd_need_html.$toon_lgnd_lvl_need_html.$toon_pri_profs.$toon_sec_profs.$toon_faction_html.$toon_artf_html.$toon_ilvl_html."\n\t</tr>\n";
    }
//        sleep(0.15);
//        }
//    }
$toon_table .= "\n</table>\n</div>\n";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" http-equiv="refresh" content="7200">
    <title><?php echo $_SESSION['user_first']?>'s Legion Checklist</title>
    <link rel="stylesheet" href="./style/style.css">
    <link rel="icon" type="image/png" href="../favicon-32x32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="../favicon-16x16.png" sizes="16x16" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<div id="body"><body>
    <h2><center>World of Warcraft: Legion Checklist</center></h2>
    <div id="table-nav">
        <table>
            <tr>
                <div class="form-group"><td><center><form name="home" method="POST" action="../index.php"><input value="Home" type="submit"></form></center></td></div>
                <div class="form-group"><td><form name="logout" method="post" action="../logout.php"><input value="Logout" type="submit"></form></td></div>
            </div>
            </tr>
        </table>
    </div>
    <div id="container">
        <?php print $toon_table?>
    <p />
    <p />
    <p />
    </div>
    <div id="table-nav"><table>
        <tr>
            <div class="form-group"><td><center><form name="add_toon" method="POST" action="./add_toon.php"><input value="Add a character" type="submit"></form></td></div>
            <div class="form-group"><td><center><form name="legion" method="POST" action="./legion.php"><input value="Legion - <?php echo $_SESSION['user_first']; ?>" type="submit"></form></td></div>
            <div class="form-group"><td><center><form name="toon" method="POST" action="./wow.php"><input value="<?php echo $_SESSION['user_first']; ?>'s Characters" type="submit"></form></td></div>
            <div class="form-group"><td><center><form name="guild" method="POST" action="./guild.php"><input type="HIDDEN" name="guild_name" value="<?php echo $toon_guild; ?>"><input type="HIDDEN" name="guild_realm" value="<?php echo $toon_realm; ?>"><input type="SUBMIT" value="<?php echo $toon_guild; ?>"></form></td></div>
<hr />
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
</body></div>
</html>
