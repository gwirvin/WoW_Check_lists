<?php
/* file: wow_fact_inc.php 
 * This file gives us styles for showing the 
 * faction the character is in */
function factionStylesRealm ($toon_faction, $toonRealm) {
	$return = "";
	switch ($toon_faction) {
		case 0:
			$return = "\n\t\t<td bgcolor=\"2133E7\"><font color=\"FFFFFF\">".$toonRealm."</font></td>";
			break;
		case 1: //Putting a faction color on the realm name
			$return =  "\n\t\t<td bgcolor=\"C80A04\"><font color=\"FFFFFF\">".$toonRealm."</font></td>";
			break;
		default:
			$return  = "\n\t\t<td bgcolor=\"EFDD05\"><font color=\"000000\">".$toonRealm."</font></td>";
			break;
		}
		return $return;
	}

function factionStylesIcon ($toon_faction, $toon_icon, $toonName, $toonRealmSlug) {
	switch ($toon_faction) {
		case 1: //Putting a faction color in the icon cell
			return "\n\t\t<td bgcolor=\"C80A04\"><a href=\"http://worldofwarcraft.com/en-us/character/us/".$toonRealmSlug."/".$toonName."\" target=\"_blank\"><img src=\"".$toon_icon."\" style=\"height:30px;width:30px;border:1;\" alt=\"http://worldofwarcraft.com/en-us/character/us/".$toonRealmSlug."/".$toonName."\"></a></td>";
		case	0:
			return "\n\t\t<td bgcolor=\"2133E7\"><a href=\"http://worldofwarcraft.com/en-us/character/us/".$toonRealmSlug."/".$toonName."\" target=\"_blank\"><img src=\"".$toon_icon."\" style=\"height:30px;width:30px;border:1;\" alt=\"http://worldofwarcraft.com/en-us/character/us/".$toonRealmSlug."/".$toonName."\"></a></td>";
		default:
			return "\n\t\t<td bgcolor=\"EFDD05\"><a href=\"http://worldofwarcraft.com/en-us/character/us/".$toonRealmSlug."/".$toonName."\" target=\"_blank\"><img src=\"".$toon_icon."\" style=\"height:30px;width:30px;border:1;\" alt=\"http://worldofwarcraft.com/en-us/character/us/".$toonRealmSlug."/".$toonName."\"></a></td>";
		}
	}

?>
