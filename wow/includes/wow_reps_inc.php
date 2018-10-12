<?php

############################# FILE: wow_reps_inc.php ############################
# This file is for functions around Gathering Reputation Data from the BLizzard	#
# API. It should include seperating out Faction reputation be expansion and 	#
# marking those repuration scores with HTML for out put in the "Checklist".	#
# 										#
#   AUTHOR: Grant Irvin 11 October 2018 - v1.0					#
#################################################################################

function bfaFactions($bfaReps, $wowRepsCounter) {
	foreach ($bfaReps as $bfaRep) {
		if ($bfaRep->id === 2163) {
		}
	}
}

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
            return  "\n\t\t<td bgcolor=\"10AA06\"><font color=\"FFFFFF\">".$faction_name."</font></td>";
            break;
        default:
            return  "<td bgcolor=\"000000\">Not Active</td>";
            break;
        }
    }

# BEGIN BLOCK for testing
$toon_realm="area-52";
$toon_name="Luxalor";
$blizz_locale = "locale=en_us";
$wow_url = "https://us.api.battle.net/wow/";
$api_key = "apikey=fkff3mjw67rm6eqzsf2u9vxgfk4y5b88";
$toon_info_url = $wow_url."character/".$toon_realm."/".$toon_name."?fields=reputation,professions,talents,mounts,pets,titles,guild,items&".$blizz_locale."&".$api_key;

# Using a curl function to get info
function getToonInfo ($toon_info_url, array $get = NULL, array $options = array())
{
	$defaults = array(
		CURLOPT_URL => $toon_info_url,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_HTTPHEADER => array(
			"cache-control: no-cache"
		),
	);
	$ch = curl_init();
	curl_setopt_array($ch, ($options + $defaults));
	if ( !$result = curl_exec($ch))
	{
		trigger_error(curl_error($ch));
	}
	curl_close($ch);
	return $result;
}
# END BLOCK for testing

?>
