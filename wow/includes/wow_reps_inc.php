<?php

############################# FILE: wow_reps_inc.php ############################
# This file is for functions around Gathering Reputation Data from the BLizzard	#
# API. It should include seperating out Faction reputation be expansion and 	#
# marking those repuration scores with HTML for out put in the "Checklist".	#
# 										#
#   AUTHOR: Grant Irvin 11 October 2018 - v1.0					#
#################################################################################

function bfaFactions($bfaReps, $wowFaction) {
	$champsOfAzeroth = "\n\t\t<td bgcolor=\"000000\"><font color=\"FFFFFF\">Not Active</font></td>";
	$tortollanSeekers = "\n\t\t<td bgcolor=\"000000\"><font color=\"FFFFFF\">Not Active</font></td>";
	$factionReps = "";
	$honorbound = "\n\t\t<td bgcolor=\"000000\"><font color=\"FFFFFF\">Not Active</font></td>";
	$talanjisExpedition = "\n\t\t<td bgcolor=\"000000\"><font color=\"FFFFFF\">Not Active</font></td>";
	$voldunai = "\n\t\t<td bgcolor=\"000000\"><font color=\"FFFFFF\">Not Active</font></td>";
	$zandalariEmpire = "\n\t\t<td bgcolor=\"000000\"><font color=\"FFFFFF\">Not Active</font></td>";
	$seventhLegion = "\n\t\t<td bgcolor=\"000000\"><font color=\"FFFFFF\">Not Active</font></td>";
	$proudmooreAdmiralty = "\n\t\t<td bgcolor=\"000000\"><font color=\"FFFFFF\">Not Active</font></td>";
	$orderOfEmbers = "\n\t\t<td bgcolor=\"000000\"><font color=\"FFFFFF\">Not Active</font></td>";
	$stormsWake = "\n\t\t<td bgcolor=\"000000\"><font color=\"FFFFFF\">Not Active</font></td>";
	foreach ($bfaReps as $bfaRep) {
		if ($bfaRep->id === 2164) {
			switch ($bfaRep->standing) {
				case 0:
					$champsOfAzeroth = "\n\t\t<td bgcolor=\"C00808\">".($bfaRep->max-$bfaRep->value)." to Hostile.</td>";
					break;
				case 1:
					$champsOfAzeroth = "\n\t\t<td bgcolor=\"F02206\">".($bfaRep->max-$bfaRep->value)." to Unfriendly.</td>";
					break;
				case 2:
					$champsOfAzeroth = "\n\t\t<td bgcolor=\"F05406\">".($bfaRep->max-$bfaRep->value)." to Neutral.</td>";
					break;
				case 3:
					$champsOfAzeroth = "\n\t\t<td bgcolor=\"F1D50E\">".($bfaRep->max-$bfaRep->value)." to Friendly.</td>";
					break;
				case 4:
					$champsOfAzeroth = "\n\t\t<td bgcolor=\"BDF10E\">".($bfaRep->max-$bfaRep->value)." to Honored.</td>";
					break;
				case 5:
					$champsOfAzeroth = "\n\t\t<td bgcolor=\"98F10E\">".($bfaRep->max-$bfaRep->value)." to Revered.</td>";
					break;
				case 6:
					$champsOfAzeroth = "\n\t\t<td bgcolor=\"5AF10E\">".($bfaRep->max-$bfaRep->value)." to Exalted.</td>";
					break;
				case 7:
					$champsOfAzeroth = "\n\t\t<td bgcolor=\"10AA06\"><font color=\"FFFFFF\">".$bfaRep->name."</font></td>";
					break;
				case NULL:
					$champsOfAzeroth = "<td bgcolor=\"000000\">Not Active</td>";
					break;
			}
		} elseif ($bfaRep->id === 2163) {
			switch ($bfaRep->standing) {
				case 0:
					$tortollanSeekers = "\n\t\t<td bgcolor=\"C00808\">".($bfaRep->max - $bfaRep->value)." to Hostile.</td>";
					break;
				case 1:
					$tortollanSeekers = "\n\t\t<td bgcolor=\"F02206\">".($bfaRep->max - $bfaRep->value)." to Unfriendly.</td>";
					break;
				case 2:
					$tortollanSeekers = "\n\t\t<td bgcolor=\"F05406\">".($bfaRep->max - $bfaRep->value)." to Neutral.</td>";
					break;
				case 3:
					$tortollanSeekers = "\n\t\t<td bgcolor=\"F1D50E\">".($bfaRep->max - $bfaRep->value)." to Friendly.</td>";
					break;
				case 4:
					$tortollanSeekers = "\n\t\t<td bgcolor=\"BDF10E\">".($bfaRep->max-$bfaRep->value)." to Honored.</td>";
					break;
				case 5:
					$tortollanSeekers = "\n\t\t<td bgcolor=\"98F10E\">".($bfaRep->max-$bfaRep->value)." to Revered.</td>";
					break;
				case 6:
					$tortollanSeekers = "\n\t\t<td bgcolor=\"5AF10E\">".($bfaRep->max-$bfaRep->value)." to Exalted.</td>";
					break;
				case 7:
					$tortollanSeekers = "\n\t\t<td bgcolor=\"10AA06\"><font color=\"FFFFFF\">".$bfaRep->name."</font></td>";
					break;
				case NULL:
					$tortollanSeekers = "<td bgcolor=\"000000\">Not Active</td>";
					break;
			}
		} elseif ($wowFaction === 1) {
			if ($bfaRep->id === 2157) {
				switch ($bfaRep->standing) {
					case 0:
						$honorbound = "\n\t\t<td bgcolor=\"C00808\">".($bfaRep->max-$bfaRep->value)." to Hostile.</td>";
						break;
					case 1:
						$honorbound = "\n\t\t<td bgcolor=\"F02206\">".($bfaRep->max-$bfaRep->value)." to Unfriendly.</td>";
						break;
					case 2:
						$honorbound = "\n\t\t<td bgcolor=\"F05406\">".($bfaRep->max-$bfaRep->value)." to Neutral.</td>";
						break;
					case 3:
						$honorbound = "\n\t\t<td bgcolor=\"F1D50E\">".($bfaRep->max-$bfaRep->value)." to Friendly.</td>";
						break;
					case 4:
						$honorbound = "\n\t\t<td bgcolor=\"BDF10E\">".($bfaRep->max-$bfaRep->value)." to Honored.</td>";
						break;
					case 5:
						$honorbound = "\n\t\t<td bgcolor=\"98F10E\">".($bfaRep->max-$bfaRep->value)." to Revered.</td>";
						break;
					case 6:
						$honorbound = "\n\t\t<td bgcolor=\"5AF10E\">".($bfaRep->max-$bfaRep->value)." to Exalted.</td>";
						break;
					case 7:
						$honorbound = "\n\t\t<td bgcolor=\"10AA06\"><font color=\"FFFFFF\">".$bfaRep->name."</font></td>";
						break;
					case NULL:
						$honorbound = "<td bgcolor=\"000000\">Not Active</td>";
						break;
				}
			} elseif ($bfaRep->id === 2158) {
				switch ($bfaRep->standing) {
					case 0:
						$voldunai = "\n\t\t<td bgcolor=\"C00808\">".($bfaRep->max-$bfaRep->value)." to Hostile.</td>";
						break;
					case 1:
						$voldunai = "\n\t\t<td bgcolor=\"F02206\">".($bfaRep->max-$bfaRep->value)." to Unfriendly.</td>";
						break;
					case 2:
						$voldunai = "\n\t\t<td bgcolor=\"F05406\">".($bfaRep->max-$bfaRep->value)." to Neutral.</td>";
						break;
					case 3:
						$voldunai = "\n\t\t<td bgcolor=\"F1D50E\">".($bfaRep->max-$bfaRep->value)." to Friendly.</td>";
						break;
					case 4:
						$voldunai = "\n\t\t<td bgcolor=\"BDF10E\">".($bfaRep->max-$bfaRep->value)." to Honored.</td>";
						break;
					case 5:
						$voldunai = "\n\t\t<td bgcolor=\"98F10E\">".($bfaRep->max-$bfaRep->value)." to Revered.</td>";
						break;
					case 6:
						$voldunai = "\n\t\t<td bgcolor=\"5AF10E\">".($bfaRep->max-$bfaRep->value)." to Exalted.</td>";
						break;
					case 7:
						$voldunai = "\n\t\t<td bgcolor=\"10AA06\"><font color=\"FFFFFF\">".$bfaRep->name."</font></td>";
						break;
					case NULL:
						$voldunai = "<td bgcolor=\"000000\">Not Active</td>";
						break;
				}
			} elseif ($bfaRep->id === 2156) {
				switch ($bfaRep->standing) {
					case 0:
						$talanjisExpedition = "\n\t\t<td bgcolor=\"C00808\">".($bfaRep->max-$bfaRep->value)." to Hostile.</td>";
						break;
					case 1:
						$talanjisExpedition = "\n\t\t<td bgcolor=\"F02206\">".($bfaRep->max-$bfaRep->value)." to Unfriendly.</td>";
						break;
					case 2:
						$talanjisExpedition = "\n\t\t<td bgcolor=\"F05406\">".($bfaRep->max-$bfaRep->value)." to Neutral.</td>";
						break;
					case 3:
						$talanjisExpedition = "\n\t\t<td bgcolor=\"F1D50E\">".($bfaRep->max-$bfaRep->value)." to Friendly.</td>";
						break;
					case 4:
						$talanjisExpedition = "\n\t\t<td bgcolor=\"BDF10E\">".($bfaRep->max-$bfaRep->value)." to Honored.</td>";
						break;
					case 5:
						$talanjisExpedition = "\n\t\t<td bgcolor=\"98F10E\">".($bfaRep->max-$bfaRep->value)." to Revered.</td>";
						break;
					case 6:
						$talanjisExpedition = "\n\t\t<td bgcolor=\"5AF10E\">".($bfaRep->max-$bfaRep->value)." to Exalted.</td>";
						break;
					case 7:
						$talanjisExpedition = "\n\t\t<td bgcolor=\"10AA06\"><font color=\"FFFFFF\">".$bfaRep->name."</font></td>";
						break;
					case NULL:
						$talanjisExpedition = "<td bgcolor=\"000000\">Not Active</td>";
						break;
				}
			} elseif ($bfaRep->id === 2103) {
				switch ($bfaRep->standing) {
					case 0:
						$zandalariEmpire = "\n\t\t<td bgcolor=\"C00808\">".($bfaRep->max-$bfaRep->value)." to Hostile.</td>";
						break;
					case 1:
						$zandalariEmpire = "\n\t\t<td bgcolor=\"F02206\">".($bfaRep->max-$bfaRep->value)." to Unfriendly.</td>";
						break;
					case 2:
						$zandalariEmpire = "\n\t\t<td bgcolor=\"F05406\">".($bfaRep->max-$bfaRep->value)." to Neutral.</td>";
						break;
					case 3:
						$zandalariEmpire = "\n\t\t<td bgcolor=\"F1D50E\">".($bfaRep->max-$bfaRep->value)." to Friendly.</td>";
						break;
					case 4:
						$zandalariEmpire = "\n\t\t<td bgcolor=\"BDF10E\">".($bfaRep->max-$bfaRep->value)." to Honored.</td>";
						break;
					case 5:
						$zandalariEmpire = "\n\t\t<td bgcolor=\"98F10E\">".($bfaRep->max-$bfaRep->value)." to Revered.</td>";
						break;
					case 6:
						$zandalariEmpire = "\n\t\t<td bgcolor=\"5AF10E\">".($bfaRep->max-$bfaRep->value)." to Exalted.</td>";
						break;
					case 7:
						$zandalariEmpire = "\n\t\t<td bgcolor=\"10AA06\"><font color=\"FFFFFF\">".$bfaRep->name."</font></td>";
						break;
					case NULL:
						$zandalariEmpire = "<td bgcolor=\"000000\">Not Active</td>";
						break;
				}
			}
			$factionReps = $honorbound.$zandalariEmpire.$talanjisExpedition.$voldunai;
		} elseif ($wowFaction === 0) {
			if ($bfaRep->id === 2159) {
				switch ($bfaRep->standing) {
					case 0:
						$seventhLegion = "\n\t\t<td bgcolor=\"C00808\">".($bfaRep->max-$bfaRep->value)." to Hostile.</td>";
						break;
					case 1:
						$seventhLegion = "\n\t\t<td bgcolor=\"F02206\">".($bfaRep->max-$bfaRep->value)." to Unfriendly.</td>";
						break;
					case 2:
						$seventhLegion = "\n\t\t<td bgcolor=\"F05406\">".($bfaRep->max-$bfaRep->value)." to Neutral.</td>";
						break;
					case 3:
						$seventhLegion = "\n\t\t<td bgcolor=\"F1D50E\">".($bfaRep->max-$bfaRep->value)." to Friendly.</td>";
						break;
					case 4:
						$seventhLegion = "\n\t\t<td bgcolor=\"BDF10E\">".($bfaRep->max-$bfaRep->value)." to Honored.</td>";
						break;
					case 5:
						$seventhLegion = "\n\t\t<td bgcolor=\"98F10E\">".($bfaRep->max-$bfaRep->value)." to Revered.</td>";
						break;
					case 6:
						$seventhLegion = "\n\t\t<td bgcolor=\"5AF10E\">".($bfaRep->max-$bfaRep->value)." to Exalted.</td>";
						break;
					case 7:
						$seventhLegion = "\n\t\t<td bgcolor=\"10AA06\"><font color=\"FFFFFF\">".$bfaRep->name."</font></td>";
						break;
					case NULL:
						$seventhLegion = "<td bgcolor=\"000000\">Not Active</td>";
						break;
				}
			} elseif ($bfaRep->id === 2160) {
				switch ($bfaRep->standing) {
					case 0:
						$proudmooreAdmiralty = "\n\t\t<td bgcolor=\"C00808\">".($bfaRep->max-$bfaRep->value)." to Hostile.</td>";
						break;
					case 1:
						$proudmooreAdmiralty = "\n\t\t<td bgcolor=\"F02206\">".($bfaRep->max-$bfaRep->value)." to Unfriendly.</td>";
						break;
					case 2:
						$proudmooreAdmiralty = "\n\t\t<td bgcolor=\"F05406\">".($bfaRep->max-$bfaRep->value)." to Neutral.</td>";
						break;
					case 3:
						$proudmooreAdmiralty = "\n\t\t<td bgcolor=\"F1D50E\">".($bfaRep->max-$bfaRep->value)." to Friendly.</td>";
						break;
					case 4:
						$proudmooreAdmiralty = "\n\t\t<td bgcolor=\"BDF10E\">".($bfaRep->max-$bfaRep->value)." to Honored.</td>";
						break;
					case 5:
						$proudmooreAdmiralty = "\n\t\t<td bgcolor=\"98F10E\">".($bfaRep->max-$bfaRep->value)." to Revered.</td>";
						break;
					case 6:
						$proudmooreAdmiralty = "\n\t\t<td bgcolor=\"5AF10E\">".($bfaRep->max-$bfaRep->value)." to Exalted.</td>";
						break;
					case 7:
						$proudmooreAdmiralty = "\n\t\t<td bgcolor=\"10AA06\"><font color=\"FFFFFF\">".$bfaRep->name."</font></td>";
						break;
					case NULL:
						$proudmooreAdmiralty = "<td bgcolor=\"000000\">Not Active</td>";
						break;
				}
			} elseif ($bfaRep->id === 2161) {
				switch ($bfaRep->standing) {
					case 0:
						$orderOfEmbers = "\n\t\t<td bgcolor=\"C00808\">".($bfaRep->max-$bfaRep->value)." to Hostile.</td>";
						break;
					case 1:
						$orderOfEmbers = "\n\t\t<td bgcolor=\"F02206\">".($bfaRep->max-$bfaRep->value)." to Unfriendly.</td>";
						break;
					case 2:
						$orderOfEmbers = "\n\t\t<td bgcolor=\"F05406\">".($bfaRep->max-$bfaRep->value)." to Neutral.</td>";
						break;
					case 3:
						$orderOfEmbers = "\n\t\t<td bgcolor=\"F1D50E\">".($bfaRep->max-$bfaRep->value)." to Friendly.</td>";
						break;
					case 4:
						$orderOfEmbers = "\n\t\t<td bgcolor=\"BDF10E\">".($bfaRep->max-$bfaRep->value)." to Honored.</td>";
						break;
					case 5:
						$orderOfEmbers = "\n\t\t<td bgcolor=\"98F10E\">".($bfaRep->max-$bfaRep->value)." to Revered.</td>";
						break;
					case 6:
						$orderOfEmbers = "\n\t\t<td bgcolor=\"5AF10E\">".($bfaRep->max-$bfaRep->value)." to Exalted.</td>";
						break;
					case 7:
						$orderOfEmbers = "\n\t\t<td bgcolor=\"10AA06\"><font color=\"FFFFFF\">".$bfaRep->name."</font></td>";
						break;
					case NULL:
						$orderOfEmbers = "<td bgcolor=\"000000\">Not Active</td>";
						break;
				}
			} elseif ($bfaRep->id === 2162) {
				switch ($bfaRep->standing) {
					case 0:
						$stormsWake = "\n\t\t<td bgcolor=\"C00808\">".($bfaRep->max-$bfaRep->value)." to Hostile.</td>";
						break;
					case 1:
						$stormsWake = "\n\t\t<td bgcolor=\"F02206\">".($bfaRep->max-$bfaRep->value)." to Unfriendly.</td>";
						break;
					case 2:
						$stormsWake = "\n\t\t<td bgcolor=\"F05406\">".($bfaRep->max-$bfaRep->value)." to Neutral.</td>";
						break;
					case 3:
						$stormsWake = "\n\t\t<td bgcolor=\"F1D50E\">".($bfaRep->max-$bfaRep->value)." to Friendly.</td>";
						break;
					case 4:
						$stormsWake = "\n\t\t<td bgcolor=\"BDF10E\">".($bfaRep->max-$bfaRep->value)." to Honored.</td>";
						break;
					case 5:
						$stormsWake = "\n\t\t<td bgcolor=\"98F10E\">".($bfaRep->max-$bfaRep->value)." to Revered.</td>";
						break;
					case 6:
						$stormsWake = "\n\t\t<td bgcolor=\"5AF10E\">".($bfaRep->max-$bfaRep->value)." to Exalted.</td>";
						break;
					case 7:
						$stormsWake = "\n\t\t<td bgcolor=\"10AA06\"><font color=\"FFFFFF\">".$bfaRep->name."</font></td>";
						break;
					case NULL:
						$stormsWake = "<td bgcolor=\"000000\">Not Active</td>";
						break;
				}
			}
			$factionReps = $seventhLegion.$proudmooreAdmiralty.$orderOfEmbers.$stormsWake;
		}
	}
	return $champsOfAzeroth.$tortollanSeekers.$factionReps;
}

# BEGIN BLOCK for testing
#$toon_realm="area-52";
#$toon_realm = "proudmoore";
#$toon_name="Luxalor";
#$toon_name="Luxnatur";
#$blizz_locale = "locale=en_us";
#$wow_url = "https://us.api.battle.net/wow/";
#$api_key = "apikey=fkff3mjw67rm6eqzsf2u9vxgfk4y5b88";
#$toon_info_url = $wow_url."character/".$toon_realm."/".$toon_name."?fields=reputation,professions,talents,mounts,pets,titles,guild,items&".$blizz_locale."&".$api_key;

# Using a curl function to get info
#function getToonInfo ($toon_info_url, array $get = NULL, array $options = array())
#{
#	$defaults = array(
#		CURLOPT_URL => $toon_info_url,
#		CURLOPT_RETURNTRANSFER => true,
#		CURLOPT_TIMEOUT => 30,
#		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
#		CURLOPT_CUSTOMREQUEST => "GET",
#		CURLOPT_HTTPHEADER => array(
#			"cache-control: no-cache"
#		),
#	);
#	$ch = curl_init();
#	curl_setopt_array($ch, ($options + $defaults));
#	if ( !$result = curl_exec($ch))
#	{
#		trigger_error(curl_error($ch));
#	}
#	curl_close($ch);
#	return $result;
#}
# END BLOCK for testing
#print $toon_info_url;
#$toonObj = json_decode(file_get_contents($toon_info_url));
#$toonReps = bfaFactions($toonObj->reputation, $toonObj->faction);
#print_r($toonReps);

?>
