<?php
/* file: legion.php */
namespace girvin\wow\legion;

// Block for testing
/* include "../../cats.php";
include "./includes/leg_html_inc.php";
include "./leg_lgnd_inc.php";
include "./leg_rep_inc.php";
include "./leg_fact_inc.php";
include "./includes/leg_ac_inc.php"; */

// Variables for the start
if(!isset($_SESSION) || empty($_SESSION)) {
    $toon_owner_id = $_REQUEST['user_id'];
    } else {
    $toon_owner_id = $_SESSION['user_id'];
    }
if (!isset($_SESSION) || empty($_SESSION)) {
    $toon_owner_first = $_REQUEST['user_first'];
    } else {
    $toon_owner_first = $_SESSION['user_first'];
    }
$toon = "";
$toon_url = "";
$db_toon_count = "";
$db_toon_counter = 0;
$wow_item_url = $wow_url."item/";
$char_url = $wow_url."character/";
$leg_char_fields = "fields=reputation,items,professions,audit,talents";
$toon_sql = ("SELECT toon_name, toon_realm FROM toon WHERE toon_owner=\"".$toon_owner_id."\" ORDER BY toon_realm, toon_name");
$toon_query = mysqli_query($wow_conn, $toon_sql);
// Block for sorting???
$field = "ID";
$sort = "ASC";
$sortOrder = "";
$sort_name = "Toon";
$sort_level = "Level";
// Starting the character table
$toon_table = "<table>\n\t<caption><center><font color=\"FFFFFF\"><h3>Legion checklist for ".$toon_owner_first."</h3></font></center></caption>\n\t<thead>\n\t<tr>\n\t\t<th rowspan=\"2\"bgcolor=\"BFBCBA\">Realm</th>\n\t\t<th rowspan=\"2\" bgcolor=\"BFBCBA\">Character</th>\n\t\t<th rowspan=\"2\" bgcolor=\"BFBCBA\">Icon</th>\n\t\t<th rowspan=\"2\" bgcolor=\"BFBCBA\">Level</th>\n\t\t<th rowspan=\"2\" bgcolor=\"BFBCBA\">Current Spec</th>\n\t\t<th rowspan=\"2\" bgcolor=\"FB2723\">Auto Complete</th>\n\t\t<th colspan=\"2\" bgcolor=\"FB7B23\">Legendary</th>\n\t\t<th colspan=\"2\" rowspan=\"2\" bgcolor=\"6C00FF\"><font color=\"FFFFFF\">Primary Professions</font></th>\n\t\t<th colspan=\"4\" bgcolor=\"9E5FF4\"><font color=\"FFFFFF\">Secondary Professions</font></th>\n\t\t<th colspan=\"9\" bgcolor=\"0008FF\"><font color=\"FFFFFF\">Reputations</font></th>\n\t\t<th rowspan=\"2\" bgcolor=\"E6DC43\">Artifact Rank</th>\n\t\t<th rowspan=\"2\" bgcolor=\"BFBCBA\">Equiped iLvl</th>\n\t</tr>\n\t<tr>\n\t\t<th bgcolor=\"F09456\">Needed Total</th>\n\t\t<th bgcolor=\"D38550\">Needs Lvl</th>\n\t\t<th bgcolor=\"B180F4\"><font color=\"FFFFFF\">First Aid</font></th>\n\t\t<th bgcolor=\"B180F4\"><font color=\"FFFFFF\">Cooking</font></th>\n\t\t<th bgcolor=\"B180F4\"><font color=\"FFFFFF\">Fishing</font></th>\n\t\t<th bgcolor=\"B180F4\"><font color=\"FFFFFF\">Archaeology</font></th>\n\t\t<th bgcolor=\"5D63FF\"><font color=\"FFFFFF\">Court of Farondis</font></th>\n\t\t<th bgcolor=\"5D63FF\"><font color=\"FFFFFF\">Dreamweavers</font></th>\n\t\t<th bgcolor=\"5D63FF\"><font color=\"FFFFFF\">Highmountain Tribe</font></th>\n\t\t<th bgcolor=\"5D63FF\"><font color=\"FFFFFF\">Valarjar</font></th>\n\t\t<th bgcolor=\"5D63FF\"><font color=\"FFFFFF\">The Wardens</font></th>\n\t\t<th bgcolor=\"5D63FF\"><font color=\"FFFFFF\">The Nightfallen</font></th>\n\t\t<th bgcolor=\"5D63FF\"><font color=\"FFFFFF\">Armies of Legionfall</font></th>\n\t\t<th bgcolor=\"5D63FF\"><font color=\"FFFFFF\">Army of the Light</font></th>\n\t\t<th bgcolor=\"5D63FF\"><font color=\"FFFFFF\">Argussian Reach</font></th>\n\t</tr>\n\t</thead>\n\t<tbody>";
// Getting the data from the database for the rest to work
while ($toon_result = mysqli_fetch_all($toon_query, MYSQLI_ASSOC)) {
    $db_toon_count = count($toon_result); // $db_toon_count is the total bumber of resutls, db_toon_counter increments on each run through the script
    for ($db_toon_counter = 0; $db_toon_counter < $db_toon_count; $db_toon_counter++) { //looping through each row of returned arrays
/* Setting these variables at a higher level in the script did not get them emptied */
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
        $max_legend_lvl = 1000;
// Variables that should really be empty on each loop's start
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
        $toon_name = $toon_result[$db_toon_counter]['toon_name'];
        $toon_realm = $toon_result[$db_toon_counter]['toon_realm'];
        $toon_info_url = $char_url.$toon_realm."/".$toon_name."?".$leg_char_fields."&".$blizz_locale."&".$api_key; // The magic from the Blizzard API
        $toon_json = getToonInfo($toon_info_url);
        $toon_obj = json_decode($toon_json);
        $toon_faction = $toon_obj->faction;
        $toon_icon = $icon_url.$toon_obj->thumbnail;
        $toon_realm = $toon_obj->realm;
        $toon_talents = $toon_obj->talents;
        $toon_realm_html = factionStylesRealm($toon_faction, $toon_realm);
        $toon_icon_html = factionStylesIcon($toon_faction, $toon_icon, $toon_name, $toon_realm);
        $toon_reps_obj = $toon_obj->reputation;
        $leg_toon_fact_1900 = array();
        $leg_toon_fact_1883 = array();
        $leg_toon_fact_1828 = array();
        $leg_toon_fact_1948 = array();
        $leg_toon_fact_1894 = array();
        $leg_toon_fact_1859 = array();
        $leg_toon_fact_2045 = array();
        $leg_toon_fact_2165 = array();
        $leg_toon_fact_2170 = array();
        $toon_sec_profs_obj = $toon_obj->professions->secondary;
        usort ($toon_sec_profs_obj, function($a, $b) {
            return strcmp($a->id, $b->id);
            });
        while (($mainspec >= 0) && ($mainspec <= 4)) {
            foreach ($toon_obj->talents as $toon_specs_object) {
                if (isset($toon_specs_object->selected)) {
                    $toon_mainspec = $toon_specs_object->spec->name;
                    $mainspec++;
                    }
                }
            }
        $toon_class_api = $toon_obj->class;
        $toon_auto_complete = autoComplete($toon_class_api);
        $possible_item_slots = array('head', 'neck', 'shoulder', 'back', 'chest', 'wrist', 'hands','waist', 'legs', 'feet', 'finger1', 'finger2', 'trinket1', 'trinket2', 'mainHand', 'offhand');
        for ($i = 0; $i < 16; $i++) {
            if (isset($toon_obj->items->{$possible_item_slots[$i]})) {
                if ($toon_obj->items->{$possible_item_slots[$i]}->quality === 5 && $toon_obj->items->{$possible_item_slots[$i]}->itemLevel >= $max_legend_lvl) { 
                    $toon_legend_count++;
                    $toon_legend_lvl_count++;
                } elseif ($toon_obj->items->{$possible_item_slots[$i]}->quality === 5 ) {
                    $toon_legend_count++;
                    }
                if ($toon_obj->items->{$possible_item_slots[$i]}->quality === 6) {
                    $toon_relic_count = count($toon_obj->items->{$possible_item_slots[$i]}->relics);
                    $artifact_traits_count = count($toon_obj->items->{$possible_item_slots[$i]}->artifactTraits);
                    for ($x = 0; $x < $artifact_traits_count; $x++) {
                        $toon_artf_rank = $toon_artf_rank + $toon_obj->items->{$possible_item_slots[$i]}->artifactTraits[$x]->rank;
                        }
                    $toon_artf_rank = $toon_artf_rank - $toon_relic_count;
                    }
                }
            }
        $toon_legend_need = legendCount($toon_legend_count);
        $toon_legend_lvl_need = legendLevelCount($toon_legend_lvl_count);
        while ($primary_profs_counter <= 2) { //getting primary professions + lvl if not maxed
            foreach ($toon_obj->professions->primary as $toon_pri_prof_obj) {
                if ($toon_pri_prof_obj->rank >= 800) {
                    $toon_pri_profs .= "\n\t\t<td bgcolor=\"10AA06\"><font color=\"FFFFFF\">".$toon_pri_prof_obj->name."</font></td>";
                    $primary_profs_counter++;
                } elseif ($toon_pri_prof_obj->rank <= 799 && $toon_pri_prof_obj->rank >= 700) {
                    $toon_pri_profs .= "\n\t\t<td bgcolor=\"F4E938\">".$toon_pri_prof_obj->rank." - ".$toon_pri_prof_obj->name."</td>";
                    $primary_profs_counter++;
                } elseif ($toon_pri_prof_obj->rank <= 699) {
                    $toon_pri_profs .= "\n\t\t<td bgcolor=\"C00808\"><font color=\"FFFFFF\">".$toon_pri_prof_obj->rank." - ".$toon_pri_prof_obj->name."</font></td>";
                    $primary_profs_counter++;
                } else {
                    $toon_pri_profs .= "\n\t\t<td bgcolor=\"000000\"> </td>";
                    $primary_profs_counter++;
                    }
                }
            if ($primary_profs_counter < 2) {
                $primary_profs_missing = 2 - $primary_profs_counter;
                $toon_pri_profs .= "\n\t\t<td colspan=\"".$primary_profs_missing."\" bgcolor=\"757B74\"></td>";
                }
            }
        while ($secondary_profs_counter <= 4) { //Getting secondary professions +lvl if not maxed, no idea what happens if all are not taken
            $toon_sec_profs = "";
            foreach ($toon_sec_profs_obj as $toon_sec_prof_obj) {
                if ($toon_sec_prof_obj->rank >= 800) {
                    $toon_sec_profs .= "\n\t\t<td bgcolor=\"10AA06\"><font color=\"FFFFFF\">Done</font></td>";
                    $secondary_profs_counter++;
                } elseif ($toon_sec_prof_obj->rank <= 799 && $toon_sec_prof_obj->rank >= 700) {
                    $toon_sec_profs .= "\n\t\t<td bgcolor=\"F4E938\">".$toon_sec_prof_obj->rank."</td>";
                    $secondary_profs_counter++;
                } elseif ($toon_sec_prof_obj->rank <= 699) {
                    $toon_sec_profs .= "\n\t\t<td bgcolor=\"C00808\"><font color=\"FFFFFF\">".$toon_sec_prof_obj->rank."</font></td>";
                    $secondary_profs_counter++;
                } else {
                    $toon_sec_profs .= "\n\t\t<td bgcolor=\"000000\"> </td>";
                    $secondary_profs_counter++;
                    }
                }
            if ($secondary_profs_counter < 4) {
                $secondary_profs_missing = 4 - $secondary_profs_counter;
                $toon_sec_profs .= "\n\t\t<td colspan=\"".$secondary_profs_missing."\" bgcolor=\"757B74\"></td>";
                }
            }

        $rep_count = count($toon_reps_obj);
        while ($rep_obj_counter < $rep_count) {
            foreach ($toon_reps_obj as $toon_rep_obj) {
                if ($toon_rep_obj->id === 1900 || $toon_rep_obj->id === 1828 || $toon_rep_obj->id === 1859 || $toon_rep_obj->id === 1883 || $toon_rep_obj->id === 1894 || $toon_rep_obj->id === 2165 || $toon_rep_obj->id === 2170 || $toon_rep_obj->id === 1948 || $toon_rep_obj->id === 2045) {
                    $faction_array_id = $toon_rep_obj->id;
                    $faction_array_name = $toon_rep_obj->name;
                    $faction_array_standing = $toon_rep_obj->standing;
                    $faction_array_curr = $toon_rep_obj->value;
                    $faction_array_max = $toon_rep_obj->max;
                    ${'leg_toon_fact_'.$faction_array_id}['id'] = $faction_array_id;
                    ${'leg_toon_fact_'.$faction_array_id}['name'] = $faction_array_name;
                    ${'leg_toon_fact_'.$faction_array_id}['standing'] = $faction_array_standing;
                    ${'leg_toon_fact_'.$faction_array_id}['value'] = $faction_array_curr;
                    ${'leg_toon_fact_'.$faction_array_id}['max'] = $faction_array_max;
                    }
                $rep_obj_counter++;
                }
        if (empty($leg_toon_fact_1900)) {
            $toon_faction_html .= "\n\t\t<td  bgcolor=\"757B74\"></td>";
        } else {
            $faction_standing = $leg_toon_fact_1900['standing'];
            $faction_curr = $leg_toon_fact_1900['value'];
            $faction_max = $leg_toon_fact_1900['max'];
            $faction_name = $leg_toon_fact_1900['name'];
            $faction_standing = factionStanding($faction_standing, $faction_curr, $faction_max, $faction_name);
            $toon_faction_html .= $faction_standing;
            }
        if (empty($leg_toon_fact_1883)) {
            $toon_faction_html .= "\n\t\t<td  bgcolor=\"757B74\"></td>";
        } else {
            $faction_standing = $leg_toon_fact_1883['standing'];
            $faction_curr = $leg_toon_fact_1883['value'];
            $faction_max = $leg_toon_fact_1883['max'];
            $faction_name = $leg_toon_fact_1883['name'];
            $faction_standing = factionStanding($faction_standing, $faction_curr, $faction_max, $faction_name);
            $toon_faction_html .= $faction_standing;
            }
        if (empty($leg_toon_fact_1828)) {
            $toon_faction_html .= "\n\t\t<td  bgcolor=\"757B74\"></td>";
        } else {
            $faction_standing = $leg_toon_fact_1828['standing'];
            $faction_curr = $leg_toon_fact_1828['value'];
            $faction_max = $leg_toon_fact_1828['max'];
            $faction_name = $leg_toon_fact_1828['name'];
            $faction_standing = factionStanding($faction_standing, $faction_curr, $faction_max, $faction_name);
            $toon_faction_html .= $faction_standing;
            }
        if (empty($leg_toon_fact_1948)) {
            $toon_faction_html .= "\n\t\t<td  bgcolor=\"757B74\"></td>";
        } else {
            $faction_standing = $leg_toon_fact_1948['standing'];
            $faction_curr = $leg_toon_fact_1948['value'];
            $faction_max = $leg_toon_fact_1948['max'];
            $faction_name = $leg_toon_fact_1948['name'];
            $faction_standing = factionStanding($faction_standing, $faction_curr, $faction_max, $faction_name);
            $toon_faction_html .= $faction_standing;
            }
        if (empty($leg_toon_fact_1894)) {
            $toon_faction_html .= "\n\t\t<td  bgcolor=\"757B74\"></td>";
        } else {
            $faction_standing = $leg_toon_fact_1894['standing'];
            $faction_curr = $leg_toon_fact_1894['value'];
            $faction_max = $leg_toon_fact_1894['max'];
            $faction_name = $leg_toon_fact_1894['name'];
            $faction_standing = factionStanding($faction_standing, $faction_curr, $faction_max, $faction_name);
            $toon_faction_html .= $faction_standing;
            }
        if (empty($leg_toon_fact_1859)) {
            $toon_faction_html .= "\n\t\t<td  bgcolor=\"757B74\"></td>";
        } else {
            $faction_standing = $leg_toon_fact_1859['standing'];
            $faction_curr = $leg_toon_fact_1859['value'];
            $faction_max = $leg_toon_fact_1859['max'];
            $faction_name = $leg_toon_fact_1859['name'];
            $faction_standing = factionStanding($faction_standing, $faction_curr, $faction_max, $faction_name);
            $toon_faction_html .= $faction_standing;
            }
        if (empty($leg_toon_fact_2045)) {
            $toon_faction_html .= "\n\t\t<td  bgcolor=\"757B74\"></td>";
        } else {
            $faction_standing = $leg_toon_fact_2045['standing'];
            $faction_curr = $leg_toon_fact_2045['value'];
            $faction_max = $leg_toon_fact_2045['max'];
            $faction_name = $leg_toon_fact_2045['name'];
            $faction_standing = factionStanding($faction_standing, $faction_curr, $faction_max, $faction_name);
            $toon_faction_html .= $faction_standing;
            }
        if (empty($leg_toon_fact_2165)) {
            $toon_faction_html .= "\n\t\t<td  bgcolor=\"757B74\"></td>";
        } else {
            $faction_standing = $leg_toon_fact_2165['standing'];
            $faction_curr = $leg_toon_fact_2165['value'];
            $faction_max = $leg_toon_fact_2165['max'];
            $faction_name = $leg_toon_fact_2165['name'];
            $faction_standing = factionStanding($faction_standing, $faction_curr, $faction_max, $faction_name);
            $toon_faction_html .= $faction_standing;
            }
        if (empty($leg_toon_fact_2170)) {
            $toon_faction_html .= "\n\t\t<td  bgcolor=\"757B74\"></td>";
        } else {
            $faction_standing = $leg_toon_fact_2170['standing'];
            $faction_curr = $leg_toon_fact_2170['value'];
            $faction_max = $leg_toon_fact_2170['max'];
            $faction_name = $leg_toon_fact_2170['name'];
            $faction_standing = factionStanding($faction_standing, $faction_curr, $faction_max, $faction_name);
            $toon_faction_html .= $faction_standing;
            }


        if ($toon_obj->class == 1) { //putting in class colors for class spec and lvl data
            $toon_name_api = $td_open_wr.$toon_obj->name.$td_close_wr;
            $toon_level = $td_open_wr.$toon_obj->level.$td_close_wr;
            $toon_curr_spec = $td_open_wr.$toon_mainspec.$td_close_wr;
            $toon_lgnd_need_html = $td_open_wr.$toon_legend_need.$td_close_wr;
            $toon_lgnd_lvl_need_html = $td_open_wr.$toon_legend_lvl_need.$td_close_wr;
            $toon_artf_html = $td_open_wr.$toon_artf_rank.$td_close_wr;
            $toon_ilvl_html = $td_open_wr.$toon_obj->items->averageItemLevelEquipped.$td_close_wr;
        } elseif ($toon_obj->class == 2) {
            $toon_name_api = $td_open_pl.$toon_obj->name.$td_close_pl;
            $toon_level = $td_open_pl.$toon_obj->level.$td_close_pl;
            $toon_curr_spec = $td_open_pl.$toon_mainspec.$td_close_pl;
            $toon_lgnd_need_html = $td_open_pl.$toon_legend_need.$td_close_pl;
            $toon_lgnd_lvl_need_html = $td_open_pl.$toon_legend_lvl_need.$td_close_pl;
            $toon_artf_html = $td_open_pl.$toon_artf_rank.$td_close_pl;
            $toon_ilvl_html = $td_open_pl.$toon_obj->items->averageItemLevelEquipped.$td_close_pl;
        } elseif ($toon_obj->class == 3) {
            $toon_name_api = $td_open_ht.$toon_obj->name.$td_close_ht;
            $toon_level = $td_open_ht.$toon_obj->level.$td_close_ht;
            $toon_curr_spec = $td_open_ht.$toon_mainspec.$td_close_ht;
            $toon_lgnd_need_html = $td_open_ht.$toon_legend_need.$td_close_ht;
            $toon_lgnd_lvl_need_html = $td_open_ht.$toon_legend_lvl_need.$td_close_ht;
            $toon_artf_html = $td_open_ht.$toon_artf_rank.$td_close_ht;
            $toon_ilvl_html = $td_open_ht.$toon_obj->items->averageItemLevelEquipped.$td_close_ht;
        } elseif ($toon_obj->class == 4) {
            $toon_name_api = $td_open_rg.$toon_obj->name.$td_close_rg;
            $toon_level = $td_open_rg.$toon_obj->level.$td_close_rg;
            $toon_curr_spec = $td_open_rg.$toon_mainspec.$td_close_rg;
            $toon_lgnd_need_html = $td_open_rg.$toon_legend_need.$td_close_rg;
            $toon_lgnd_lvl_need_html = $td_open_rg.$toon_legend_lvl_need.$td_close_rg;
            $toon_artf_html = $td_open_rg.$toon_artf_rank.$td_close_rg;
            $toon_ilvl_html = $td_open_rg.$toon_obj->items->averageItemLevelEquipped.$td_close_rg;
        } elseif ($toon_obj->class == 5) {
            $toon_name_api = $td_open_pr.$toon_obj->name.$td_close_pr;
            $toon_level = $td_open_pr.$toon_obj->level.$td_close_pr;
            $toon_curr_spec = $td_open_pr.$toon_mainspec.$td_close_pr;
            $toon_lgnd_need_html = $td_open_pr.$toon_legend_need.$td_close_pr;
            $toon_lgnd_lvl_need_html = $td_open_pr.$toon_legend_lvl_need.$td_close_pr;
            $toon_artf_html = $td_open_pr.$toon_artf_rank.$td_close_pr;
            $toon_ilvl_html = $td_open_pr.$toon_obj->items->averageItemLevelEquipped.$td_close_pr;
        } elseif ($toon_obj->class == 6) {
            $toon_name_api = $td_open_dk.$toon_obj->name.$td_close_dk;
            $toon_level = $td_open_dk.$toon_obj->level.$td_close_dk;
            $toon_curr_spec = $td_open_dk.$toon_mainspec.$td_close_dk;
            $toon_lgnd_need_html = $td_open_dk.$toon_legend_need.$td_close_dk;
            $toon_lgnd_lvl_need_html = $td_open_dk.$toon_legend_lvl_need.$td_close_dk;
            $toon_artf_html = $td_open_dk.$toon_artf_rank.$td_close_dk;
            $toon_ilvl_html = $td_open_dk.$toon_obj->items->averageItemLevelEquipped.$td_close_dk;
        } elseif ($toon_obj->class == 7) {
            $toon_name_api = $td_open_sm.$toon_obj->name.$td_close_sm;
            $toon_level = $td_open_sm.$toon_obj->level.$td_close_sm;
            $toon_curr_spec = $td_open_sm.$toon_mainspec.$td_close_sm;
            $toon_lgnd_need_html = $td_open_sm.$toon_legend_need.$td_close_sm;
            $toon_lgnd_lvl_need_html = $td_open_sm.$toon_legend_lvl_need.$td_close_sm;
            $toon_artf_html = $td_open_sm.$toon_artf_rank.$td_close_sm;
            $toon_ilvl_html = $td_open_sm.$toon_obj->items->averageItemLevelEquipped.$td_close_sm;
        } elseif ($toon_obj->class == 8) {
            $toon_name_api = $td_open_mg.$toon_obj->name.$td_close_mg;
            $toon_level = $td_open_mg.$toon_obj->level.$td_close_mg;
            $toon_curr_spec = $td_open_mg.$toon_mainspec.$td_close_mg;
            $toon_lgnd_need_html = $td_open_mg.$toon_legend_need.$td_close_mg;
            $toon_lgnd_lvl_need_html = $td_open_mg.$toon_legend_lvl_need.$td_close_mg;
            $toon_artf_html = $td_open_mg.$toon_artf_rank.$td_close_mg;
            $toon_ilvl_html = $td_open_mg.$toon_obj->items->averageItemLevelEquipped.$td_close_mg;
        } elseif ($toon_obj->class == 9) {
            $toon_name_api = $td_open_wk.$toon_obj->name.$td_close_wk;
            $toon_level = $td_open_wk.$toon_obj->level.$td_close_wk;
            $toon_curr_spec = $td_open_wk.$toon_mainspec.$td_close_wk;
            $toon_lgnd_need_html = $td_open_wk.$toon_legend_need.$td_close_wk;
            $toon_lgnd_lvl_need_html = $td_open_wk.$toon_legend_lvl_need.$td_close_wk;
            $toon_artf_html = $td_open_wk.$toon_artf_rank.$td_close_wk;
            $toon_ilvl_html = $td_open_wk.$toon_obj->items->averageItemLevelEquipped.$td_close_wk;
        } elseif ($toon_obj->class == 10) {
            $toon_name_api = $td_open_mk.$toon_obj->name.$td_close_mk;
            $toon_level = $td_open_mk.$toon_obj->level.$td_close_mk;
            $toon_curr_spec = $td_open_mk.$toon_mainspec.$td_close_mk;
            $toon_lgnd_need_html = $td_open_mk.$toon_legend_need.$td_close_mk;
            $toon_lgnd_lvl_need_html = $td_open_mk.$toon_legend_lvl_need.$td_close_mk;
            $toon_artf_html = $td_open_mk.$toon_artf_rank.$td_close_mk;
            $toon_ilvl_html = $td_open_mk.$toon_obj->items->averageItemLevelEquipped.$td_close_mk;
        } elseif ($toon_obj->class == 11) {
            $toon_name_api = $td_open_dr.$toon_obj->name.$td_close_dr;
            $toon_level = $td_open_dr.$toon_obj->level.$td_close_dr;
            $toon_curr_spec = $td_open_dr.$toon_mainspec.$td_close_dr;
            $toon_lgnd_need_html = $td_open_dr.$toon_legend_need.$td_close_dr;
            $toon_lgnd_lvl_need_html = $td_open_dr.$toon_legend_lvl_need.$td_close_dr;
            $toon_artf_html = $td_open_dr.$toon_artf_rank.$td_close_dr;
            $toon_ilvl_html = $td_open_dr.$toon_obj->items->averageItemLevelEquipped.$td_close_dr;
        } elseif ($toon_obj->class == 12) {
            $toon_name_api = $td_open_dh.$toon_obj->name.$td_close_dh;
            $toon_level = $td_open_dh.$toon_obj->level.$td_close_dh;
            $toon_curr_spec = $td_open_dh.$toon_mainspec.$td_close_dh;
            $toon_lgnd_need_html = $td_open_dh.$toon_legend_need.$td_close_dh;
            $toon_lgnd_lvl_need_html = $td_open_dh.$toon_legend_lvl_need.$td_close_dh;
            $toon_artf_html = $td_open_dh.$toon_artf_rank.$td_close_dh;
            $toon_ilvl_html = $td_open_dh.$toon_obj->items->averageItemLevelEquipped.$td_close_dh;
        } else {
            $toon_name_api = "\n\t\t<td>".$toon_obj->name."</td>";
            $toon_level = "\n\t\t<td>".$toon_obj->level."</td>";
            $toon_curr_spec = "\n\t\t<td>".$toon_mainspec."</td>";
            $toon_lgnd_need_html = "\n\t\t<td>".$toon_legend_need."</td>";
            $toon_lgnd_lvl_need_html = "\n\t\t<td>".$toon_legend_lvl_need."</td>";
            $toon_artf_html = "\n\t\t<td>".$toon_artf_rank."</td>";
            $toon_ilvl_html = "\n\t\t<td>".$toon_obj->items->averageItemLevelEquipped."</td>";
            }
            $toon_table .= "\n\t<tr>".$toon_realm_html.$toon_name_api.$toon_icon_html.$toon_level.$toon_curr_spec.$toon_auto_complete.$toon_lgnd_need_html.$toon_lgnd_lvl_need_html.$toon_pri_profs.$toon_sec_profs.$toon_faction_html.$toon_artf_html.$toon_ilvl_html."\n\t</tr>\n";
            }
        sleep(0.15);
        }
    }
$toon_table .= "\n</table>\n</div>\n";

/* echo $toon_table; */

?>
