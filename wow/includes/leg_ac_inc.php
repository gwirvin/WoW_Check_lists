<?php
/* file: leg_ac_inc.php */
namespace girvin\wow;
function autoComplete($toon_class_api) {
    switch ($toon_class_api) { //Setting out if the class hall has an autocomplete
        case 1: //Warrior
            return "\n\t\t<td bgcolor=\"10AA06\"><font color=\"FFFFFF\">Yes</font></td>";
            break;
        case 2: //Paladin
            return "\n\t\t<td bgcolor=\"10AA06\"><font color=\"FFFFFF\">Yes</font></td>";
            break;
        case 3: //Hunter
            return "\n\t\t<td bgcolor=\"C00808\"><font color=\"FFFFFF\">No</font></td>";
            break;
        case 4: //Rogue
            return "\n\t\t<td bgcolor=\"C00808\"><font color=\"FFFFFF\">No</font></td>";
            break;
        case 5: //Priest
            return "\n\t\t<td bgcolor=\"C00808\"><font color=\"FFFFFF\">No</font></td>";
            break;
        case 6: //Death Knight
            return "\n\t\t<td bgcolor=\"10AA06\"><font color=\"FFFFFF\">Yes</font></td>";
            break;
        case 7: //Shaman
            return "\n\t\t<td bgcolor=\"C00808\"><font color=\"FFFFFF\">No</font></td>";
            break;
        case 8: //Mage
            return "\n\t\t<td bgcolor=\"10AA06\"><font color=\"FFFFFF\">Yes</font></td>";
            break;
        case 9: //Warlock
            return "\n\t\t<td bgcolor=\"10AA06\"><font color=\"FFFFFF\">Yes</font></td>";
            break;
        case 10: //Monk
            return "\n\t\t<td bgcolor=\"C00808\"><font color=\"FFFFFF\">No</font></td>";
            break;
        case 11: //Druid
            return "\n\t\t<td bgcolor=\"C00808\"><font color=\"FFFFFF\">No</font></td>";
            break;
        case 12: //Demon Hunter
            return "\n\t\t<td bgcolor=\"10AA06\"><font color=\"FFFFFF\">Yes</font></td>";
            break;
        default:
            return "\n\t\t<td bgcolor\"000000\"><font color=\"FFFFFF\">UNKNOWN</font></td>";
        }
    }
?>
