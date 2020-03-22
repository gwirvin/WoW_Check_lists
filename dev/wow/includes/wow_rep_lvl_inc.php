<?php
/* file: leg_rep_inc.php */
//namespace girvin\wow;

function factionStanding($faction_standing, $faction_curr, $faction_max, $faction_name) {
    switch ($faction_standing) {
        case 0:
            return  "\n\t\t<td bgcolor=\"C00808\">".($faction_max-$faction_curr)." to Hostile.</td>";
            break;
        case 1:
            return  "\n\t\t<td bgcolor=\"F02206\">".($faction_max-$faction_curr)." to Unfriendly.</td>";
            break;
        case 2:
            return  "\n\t\t<td bgcolor=\"F05406\">".($faction_max-$faction_curr)." to Neutral.</td>";
            break;
        case 3:
            return  "\n\t\t<td bgcolor=\"F1D50E\">".($faction_max-$faction_curr)." to Friendly.</td>";
            break;
        case 4:
            return  "\n\t\t<td bgcolor=\"BDF10E\">".($faction_max-$faction_curr)." to Honored.</td>";
            break;
        case 5:
            return  "\n\t\t<td bgcolor=\"98F10E\">".($faction_max-$faction_curr)." to Revered.</td>";
            break;
        case 6:
            return  "\n\t\t<td bgcolor=\"5AF10E\">".($faction_max-$faction_curr)." to Exalted.</td>";
            break;
        case 7:
//            return  "\n\t\t<td bgcolor=\"10AA06\"><font color=\"FFFFFF\">Exalted</font></td>";
            return  "\n\t\t<td bgcolor=\"10AA06\"><font color=\"FFFFFF\">".$faction_name."</font></td>";
            break;
        default:
            return  "<td bgcolor=\"000000\">Not Active</td>";
//            break;
        }
    }
?>
