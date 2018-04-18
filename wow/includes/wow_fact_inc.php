<?php
/* file: wow_fact_inc.php 
 * This file gives us styles for showing the 
 * faction the character is in */
namespace girvin\wow;
function factionStylesRealm ($toon_faction, $toon_realm) {
    switch ($toon_faction) {
        case 1: //Putting a faction color on the realm name
            return "\n\t\t<td bgcolor=\"C80A04\"><font color=\"FFFFFF\">".$toon_realm."</font></td>";
        case  0:
            return "\n\t\t<td bgcolor=\"2133E7\"><font color=\"FFFFFF\">".$toon_realm."</font></td>";
        default:
            return "\n\t\t<td bgcolor=\"EFDD05\"><font color=\"000000\">".$toon_realm."</font></td>";
        }
    }

function factionStylesIcon ($toon_faction, $toon_icon, $toon_name, $toon_realm) {
    switch ($toon_faction) {
        case 1: //Putting a faction color in the icon cell
        return "\n\t\t<td bgcolor=\"C80A04\"><a href=\"http://us.battle.net/wow/en/character/".$toon_realm."/".$toon_name."/advanced\" target=\"_blank\"><img src=\"".$toon_icon."\" style=\"height:30px;width:30px;border:1;\" alt=\"http://us.battle.net/wow/en/character/".$toon_realm."/".$toon_name."/advanced\"></a></td>";
        case  0:
        return "\n\t\t<td bgcolor=\"2133E7\"><a href=\"http://us.battle.net/wow/en/character/".$toon_realm."/".$toon_name."/advanced\" target=\"_blank\"><img src=\"".$toon_icon."\" style=\"height:30px;width:30px;border:1;\" alt=\"http://us.battle.net/wow/en/character/".$toon_realm."/".$toon_name."/advanced\"></a></td>";
        default:
        return "\n\t\t<td bgcolor=\"EFDD05\"><a href=\"http://us.battle.net/wow/en/character/".$toon_realm."/".$toon_name."/advanced\" target=\"_blank\"><img src=\"".$toon_icon."\" style=\"height:30px;width:30px;border:1;\" alt=\"http://us.battle.net/wow/en/character/".$toon_realm."/".$toon_name."/advanced\"></a></td>";
         }
    }

?>
