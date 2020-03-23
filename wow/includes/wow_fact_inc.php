<?php
/* file: wow_fact_inc.php 
 * This file gives us styles for showing the 
 * faction the character is in */
function factionStylesRealm ($toonFaction, $toonRealm) {
	$return = "";
	switch ($toonFaction) {
		case "ALLIANCE":
			$return = "\n\t\t<td bgcolor=\"2133E7\"><font color=\"FFFFFF\">".$toonRealm."</font></td>";
			break;
		case "HORDE": //Putting a faction color on the realm name
			$return =  "\n\t\t<td bgcolor=\"C80A04\"><font color=\"FFFFFF\">".$toonRealm."</font></td>";
			break;
		default:
			$return  = "\n\t\t<td bgcolor=\"EFDD05\"><font color=\"000000\">".$toonRealm."</font></td>";
			break;
		}
		return $return;
	}

function factionStylesIcon ($toonFaction, $toonIcon, $toonName, $toonRealmSlug) {
	switch ($toonFaction) {
		case "ALLIANCE":
			return "\n\t\t<td bgcolor=\"2133E7\"><a href=\"http://worldofwarcraft.com/en-us/character/us/".$toonRealmSlug."/".$toonName."\" target=\"_blank\"><img src=\"".$toonIcon."\" style=\"height:30px;width:30px;border:1;\" alt=\"http://worldofwarcraft.com/en-us/character/us/".$toonRealmSlug."/".$toonName."\"></a></td>";
		case "HORDE": //Putting a faction color in the icon cell
			return "\n\t\t<td bgcolor=\"C80A04\"><a href=\"http://worldofwarcraft.com/en-us/character/us/".$toonRealmSlug."/".$toonName."\" target=\"_blank\"><img src=\"".$toonIcon."\" style=\"height:30px;width:30px;border:1;\" alt=\"http://worldofwarcraft.com/en-us/character/us/".$toonRealmSlug."/".$toonName."\"></a></td>";
		default:
			return "\n\t\t<td bgcolor=\"EFDD05\"><a href=\"http://worldofwarcraft.com/en-us/character/us/".$toonRealmSlug."/".$toonName."\" target=\"_blank\"><img src=\"".$toonIcon."\" style=\"height:30px;width:30px;border:1;\" alt=\"http://worldofwarcraft.com/en-us/character/us/".$toonRealmSlug."/".$toonName."\"></a></td>";
		}
	}

?>
