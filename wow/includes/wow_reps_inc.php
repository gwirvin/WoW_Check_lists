<?php

############################# FILE: wow_reps_inc.php ############################
# This file is for functions around Gathering Reputation Data from the BLizzard	#
# API. It should include seperating out Faction reputation be expansion and 	#
# marking those repuration scores with HTML for out put in the "Checklist".	#
# 										#
#   AUTHOR: Grant Irvin 11 October 2018 - v1.0					#
#################################################################################

function slFactions($slReps, $toonRepCount/*, $wowFaction*/) {
/*	$toonRepCount = count($slReps->reputations); */
	$factionReps = "";
	$ascended = "\n\t\t<td bgcolor=\"000000\"><font color=\"FFFFFF\">No Reputation</font></td>";
	$courtOfHarvesters = "\n\t\t<td bgcolor=\"000000\"><font color=\"FFFFFF\">No Reputation</font></td>";
	$undyingArmy = "\n\t\t<td bgcolor=\"000000\"><font color=\"FFFFFF\">No Reputation</font></td>";
	$wildHunt= "\n\t\t<td bgcolor=\"000000\"><font color=\"FFFFFF\">No Reputation</font></td>";
	$venari = "\n\t\t<td bgcolor=\"000000\"><font color=\"FFFFFF\">No Reputation</font></td>";
	for ($toonRepCounter = 0; $toonRepCounter < $toonRepCount; $toonRepCounter++) {
		if ($slReps->reputations[$toonRepCounter]->faction->id === 2407) {
			switch ($slReps->reputations[$toonRepCounter]->standing->tier) {
				case 0:
					$ascended = "\n\t\t<td bgcolor=\"C00808\">".($slReps->reputations[$toonRepCounter]->standing->max-$slReps->reputations[$toonRepCounter]->standing->value)." to Hostile.</td>";
					break;
				case 1:
					$ascended = "\n\t\t<td bgcolor=\"F02206\">".($slReps->reputations[$toonRepCounter]->standing->max-$slReps->reputations[$toonRepCounter]->standing->value)." to Unfriendly.</td>";
					break;
				case 2:
					$ascended = "\n\t\t<td bgcolor=\"F05406\">".($slReps->reputations[$toonRepCounter]->standing->max-$slReps->reputations[$toonRepCounter]->standing->value)." to Neutral.</td>";
					break;
				case 3:
					$ascended = "\n\t\t<td bgcolor=\"F1D50E\">".($slReps->reputations[$toonRepCounter]->standing->max-$slReps->reputations[$toonRepCounter]->standing->value)." to Friendly.</td>";
					break;
				case 4:
					$ascended = "\n\t\t<td bgcolor=\"BDF10E\">".($slReps->reputations[$toonRepCounter]->standing->max-$slReps->reputations[$toonRepCounter]->standing->value)." to Honored.</td>";
					break;
				case 5:
					$ascended = "\n\t\t<td bgcolor=\"98F10E\">".($slReps->reputations[$toonRepCounter]->standing->max-$slReps->reputations[$toonRepCounter]->standing->value)." to Revered.</td>";
					break;
				case 6:
					$ascended = "\n\t\t<td bgcolor=\"5AF10E\">".($slReps->reputations[$toonRepCounter]->standing->max-$slReps->reputations[$toonRepCounter]->standing->value)." to Exalted.</td>";
					break;
				case 7:
					$ascended = "\n\t\t<td bgcolor=\"10AA06\"><font color=\"FFFFFF\">".$slReps->reputations[$toonRepCounter]->faction->name."</font></td>";
					break;
				case NULL:
					$ascended = "<td bgcolor=\"000000\">No API Data</td>";
					break;
			}
			} elseif ($slReps->reputations[$toonRepCounter]->faction->id === 2413) {
				switch ($slReps->reputations[$toonRepCounter]->standing->tier) {
					case 0:
						$courtOfHarvesters = "\n\t\t<td bgcolor=\"C00808\">".($slReps->reputations[$toonRepCounter]->standing->max-$slReps->reputations[$toonRepCounter]->standing->value)." to Hostile.</td>";
						break;
					case 1:
						$courtOfHarvesters = "\n\t\t<td bgcolor=\"F02206\">".($slReps->reputations[$toonRepCounter]->standing->max-$slReps->reputations[$toonRepCounter]->standing->value)." to Unfriendly.</td>";
						break;
					case 2:
						$courtOfHarvesters = "\n\t\t<td bgcolor=\"F05406\">".($slReps->reputations[$toonRepCounter]->standing->max-$slReps->reputations[$toonRepCounter]->standing->value)." to Neutral.</td>";
						break;
					case 3:
						$courtOfHarvesters = "\n\t\t<td bgcolor=\"F1D50E\">".($slReps->reputations[$toonRepCounter]->standing->max-$slReps->reputations[$toonRepCounter]->standing->value)." to Friendly.</td>";
						break;
					case 4:
						$courtOfHarvesters = "\n\t\t<td bgcolor=\"BDF10E\">".($slReps->reputations[$toonRepCounter]->standing->max-$slReps->reputations[$toonRepCounter]->standing->value)." to Honored.</td>";
						break;
					case 5:
						$courtOfHarvesters = "\n\t\t<td bgcolor=\"98F10E\">".($slReps->reputations[$toonRepCounter]->standing->max-$slReps->reputations[$toonRepCounter]->standing->value)." to Revered.</td>";
						break;
					case 6:
						$courtOfHarvesters = "\n\t\t<td bgcolor=\"5AF10E\">".($slReps->reputations[$toonRepCounter]->standing->max-$slReps->reputations[$toonRepCounter]->standing->value)." to Exalted.</td>";
						break;
					case 7:
						$courtOfHarvesters = "\n\t\t<td bgcolor=\"10AA06\"><font color=\"FFFFFF\">".$slReps->reputations[$toonRepCounter]->faction->name."</font></td>";
						break;
					case NULL:
						$courtOfHarvesters = "<td bgcolor=\"000000\">No API Data</td>";
						break;
				}
			} elseif ($slReps->reputations[$toonRepCounter]->faction->id === 2410) {
				switch ($slReps->reputations[$toonRepCounter]->standing->tier) {
					case 0:
						$undyingArmy = "\n\t\t<td bgcolor=\"C00808\">".($slReps->reputations[$toonRepCounter]->standing->max-$slReps->reputations[$toonRepCounter]->standing->value)." to Hostile.</td>";
						break;
					case 1:
						$undyingArmy = "\n\t\t<td bgcolor=\"F02206\">".($slReps->reputations[$toonRepCounter]->standing->max-$slReps->reputations[$toonRepCounter]->standing->value)." to Unfriendly.</td>";
						break;
					case 2:
						$undyingArmy = "\n\t\t<td bgcolor=\"F05406\">".($slReps->reputations[$toonRepCounter]->standing->max-$slReps->reputations[$toonRepCounter]->standing->value)." to Neutral.</td>";
						break;
					case 3:
						$undyingArmy = "\n\t\t<td bgcolor=\"F1D50E\">".($slReps->reputations[$toonRepCounter]->standing->max-$slReps->reputations[$toonRepCounter]->standing->value)." to Friendly.</td>";
						break;
					case 4:
						$undyingArmy = "\n\t\t<td bgcolor=\"BDF10E\">".($slReps->reputations[$toonRepCounter]->standing->max-$slReps->reputations[$toonRepCounter]->standing->value)." to Honored.</td>";
						break;
					case 5:
						$undyingArmy = "\n\t\t<td bgcolor=\"98F10E\">".($slReps->reputations[$toonRepCounter]->standing->max-$slReps->reputations[$toonRepCounter]->standing->value)." to Revered.</td>";
						break;
					case 6:
						$undyingArmy = "\n\t\t<td bgcolor=\"5AF10E\">".($slReps->reputations[$toonRepCounter]->standing->max-$slReps->reputations[$toonRepCounter]->standing->value)." to Exalted.</td>";
						break;
					case 7:
						$undyingArmy = "\n\t\t<td bgcolor=\"10AA06\"><font color=\"FFFFFF\">".$slReps->reputations[$toonRepCounter]->faction->name."</font></td>";
						break;
					case NULL:
						$undyingArmy = "<td bgcolor=\"000000\">No API Data</td>";
						break;
				}
			} elseif ($slReps->reputations[$toonRepCounter]->faction->id === 2465) {
				switch ($slReps->reputations[$toonRepCounter]->standing->tier) {
					case 0:
						$wildHunt = "\n\t\t<td bgcolor=\"C00808\">".($slReps->reputations[$toonRepCounter]->standing->max-$slReps->reputations[$toonRepCounter]->standing->value)." to Hostile.</td>";
						break;
					case 1:
						$wildHunt = "\n\t\t<td bgcolor=\"F02206\">".($slReps->reputations[$toonRepCounter]->standing->max-$slReps->reputations[$toonRepCounter]->standing->value)." to Unfriendly.</td>";
						break;
					case 2:
						$wildHunt = "\n\t\t<td bgcolor=\"F05406\">".($slReps->reputations[$toonRepCounter]->standing->max-$slReps->reputations[$toonRepCounter]->standing->value)." to Neutral.</td>";
						break;
					case 3:
						$wildHunt = "\n\t\t<td bgcolor=\"F1D50E\">".($slReps->reputations[$toonRepCounter]->standing->max-$slReps->reputations[$toonRepCounter]->standing->value)." to Friendly.</td>";
						break;
					case 4:
						$wildHunt = "\n\t\t<td bgcolor=\"BDF10E\">".($slReps->reputations[$toonRepCounter]->standing->max-$slReps->reputations[$toonRepCounter]->standing->value)." to Honored.</td>";
						break;
					case 5:
						$wildHunt = "\n\t\t<td bgcolor=\"98F10E\">".($slReps->reputations[$toonRepCounter]->standing->max-$slReps->reputations[$toonRepCounter]->standing->value)." to Revered.</td>";
						break;
					case 6:
						$wildHunt = "\n\t\t<td bgcolor=\"5AF10E\">".($slReps->reputations[$toonRepCounter]->standing->max-$slReps->reputations[$toonRepCounter]->standing->value)." to Exalted.</td>";
						break;
					case 7:
						$wildHunt = "\n\t\t<td bgcolor=\"10AA06\"><font color=\"FFFFFF\">".$slReps->reputations[$toonRepCounter]->faction->name."</font></td>";
						break;
					case NULL:
						$wildHunt = "<td bgcolor=\"000000\">No API Data</td>";
						break;
				}
			} elseif ($slReps->reputations[$toonRepCounter]->faction->id === 2432) {
				switch ($slReps->reputations[$toonRepCounter]->standing->tier) {
					case 0:
						$venari = "\n\t\t<td bgcolor=\"C00808\">".($slReps->reputations[$toonRepCounter]->standing->max-$slReps->reputations[$toonRepCounter]->standing->value)." to Hostile.</td>";
						break;
					case 1:
						$venari = "\n\t\t<td bgcolor=\"F02206\">".($slReps->reputations[$toonRepCounter]->standing->max-$slReps->reputations[$toonRepCounter]->standing->value)." to Unfriendly.</td>";
						break;
					case 2:
						$venari = "\n\t\t<td bgcolor=\"F05406\">".($slReps->reputations[$toonRepCounter]->standing->max-$slReps->reputations[$toonRepCounter]->standing->value)." to Neutral.</td>";
						break;
					case 3:
						$venari = "\n\t\t<td bgcolor=\"F1D50E\">".($slReps->reputations[$toonRepCounter]->standing->max-$slReps->reputations[$toonRepCounter]->standing->value)." to Friendly.</td>";
						break;
					case 4:
						$venari = "\n\t\t<td bgcolor=\"BDF10E\">".($slReps->reputations[$toonRepCounter]->standing->max-$slReps->reputations[$toonRepCounter]->standing->value)." to Honored.</td>";
						break;
					case 5:
						$venari = "\n\t\t<td bgcolor=\"98F10E\">".($slReps->reputations[$toonRepCounter]->standing->max-$slReps->reputations[$toonRepCounter]->standing->value)." to Revered.</td>";
						break;
					case 6:
						$venari = "\n\t\t<td bgcolor=\"5AF10E\">".($slReps->reputations[$toonRepCounter]->standing->max-$slReps->reputations[$toonRepCounter]->standing->value)." to Exalted.</td>";
						break;
					case 7:
						$venari = "\n\t\t<td bgcolor=\"10AA06\"><font color=\"FFFFFF\">".$slReps->reputations[$toonRepCounter]->faction->name."</font></td>";
						break;
					case NULL:
						$venari = "<td bgcolor=\"000000\">No API Data</td>";
						break;
				}
                        } elseif ($slReps->reputations[$toonRepCounter]->faction->id === 2478) {
                                switch ($slReps->reputations[$toonRepCounter]->standing->tier) {
                                        case 0:
                                                $theEnlightened = "\n\t\t<td bgcolor=\"C00808\">".($slReps->reputations[$toonRepCounter]->standing->max-$slReps->reputations[$toonRepCounter]->standing->value)." to Hostile.</td>";
                                                break;
                                        case 1:
                                                $theEnlightened = "\n\t\t<td bgcolor=\"F02206\">".($slReps->reputations[$toonRepCounter]->standing->max-$slReps->reputations[$toonRepCounter]->standing->value)." to Unfriendly.</td>";
                                                break;
                                        case 2:
                                                $theEnlightened = "\n\t\t<td bgcolor=\"F05406\">".($slReps->reputations[$toonRepCounter]->standing->max-$slReps->reputations[$toonRepCounter]->standing->value)." to Neutral.</td>";
                                                break;
                                        case 3:
                                                $theEnlightened = "\n\t\t<td bgcolor=\"F1D50E\">".($slReps->reputations[$toonRepCounter]->standing->max-$slReps->reputations[$toonRepCounter]->standing->value)." to Friendly.</td>";
                                                break;
                                        case 4:
                                                $theEnlightened = "\n\t\t<td bgcolor=\"BDF10E\">".($slReps->reputations[$toonRepCounter]->standing->max-$slReps->reputations[$toonRepCounter]->standing->value)." to Honored.</td>";
                                                break;
                                        case 5:
                                                $theEnlightened = "\n\t\t<td bgcolor=\"98F10E\">".($slReps->reputations[$toonRepCounter]->standing->max-$slReps->reputations[$toonRepCounter]->standing->value)." to Revered.</td>";
                                                break;
                                        case 6:
                                                $theEnlightened = "\n\t\t<td bgcolor=\"5AF10E\">".($slReps->reputations[$toonRepCounter]->standing->max-$slReps->reputations[$toonRepCounter]->standing->value)." to Exalted.</td>";
                                                break;
                                        case 7:
                                                $theEnlightened = "\n\t\t<td bgcolor=\"10AA06\"><font color=\"FFFFFF\">".$slReps->reputations[$toonRepCounter]->faction->name."</font></td>";
                                                break;
                                        case NULL:
                                                $theEnlightened = "<td bgcolor=\"000000\">No API Data</td>";
                                                break;
                                }			
			}
			$factionReps = $ascended.$courtOfHarvesters.$undyingArmy.$wildHunt.$venari;
		}
	return $factionReps;
	}
//}


function bfaFactions($bfaReps, $toonRepCount, $wowFaction) {
	$toonRepCount = count($bfaReps->reputations);
	$champsOfAzeroth = "\n\t\t<td bgcolor=\"000000\"><font color=\"FFFFFF\">No Reputation</font></td>";
	$tortollanSeekers = "\n\t\t<td bgcolor=\"000000\"><font color=\"FFFFFF\">No Reputation</font></td>";
	$factionReps = "";
	$honorbound = "\n\t\t<td bgcolor=\"000000\"><font color=\"FFFFFF\">No Reputation</font></td>";
	$talanjisExpedition = "\n\t\t<td bgcolor=\"000000\"><font color=\"FFFFFF\">No Reputation</font></td>";
	$voldunai = "\n\t\t<td bgcolor=\"000000\"><font color=\"FFFFFF\">No Reputation</font></td>";
	$zandalariEmpire = "\n\t\t<td bgcolor=\"000000\"><font color=\"FFFFFF\">No Reputation</font></td>";
	$seventhLegion = "\n\t\t<td bgcolor=\"000000\"><font color=\"FFFFFF\">No Reputation</font></td>";
	$proudmooreAdmiralty = "\n\t\t<td bgcolor=\"000000\"><font color=\"FFFFFF\">No Reputation</font></td>";
	$orderOfEmbers = "\n\t\t<td bgcolor=\"000000\"><font color=\"FFFFFF\">No Reputation</font></td>";
	$stormsWake = "\n\t\t<td bgcolor=\"000000\"><font color=\"FFFFFF\">No Reputation</font></td>";
	$theUnshackled = "\n\t\t<td bgcolor=\"000000\"><font color=\"FFFFFF\">No Reputation</font></td>";
	$wavebladeAnkoan = "\n\t\t<td bgcolor=\"000000\"><font color=\"FFFFFF\">No Reputation</font></td>";
	$rustboltResistance = "\n\t\t<td bgcolor=\"000000\"><font color=\"FFFFFF\">No Reputation</font></td>";
	for ($toonRepCounter = 0; $toonRepCounter < $toonRepCount; $toonRepCounter++) {
//	foreach ($bfaReps->reputations as $bfaRep) {
		if ($bfaReps->reputations[$toonRepCounter]->faction->id === 2164) {
			switch ($bfaReps->reputations[$toonRepCounter]->standing->tier) {
				case 0:
					$champsOfAzeroth = "\n\t\t<td bgcolor=\"C00808\">".($bfaReps->reputations[$toonRepCounter]->standing->max-$bfaReps->reputations[$toonRepCounter]->standing->value)." to Hostile.</td>";
					break;
				case 1:
					$champsOfAzeroth = "\n\t\t<td bgcolor=\"F02206\">".($bfaReps->reputations[$toonRepCounter]->standing->max-$bfaReps->reputations[$toonRepCounter]->standing->value)." to Unfriendly.</td>";
					break;
				case 2:
					$champsOfAzeroth = "\n\t\t<td bgcolor=\"F05406\">".($bfaReps->reputations[$toonRepCounter]->standing->max-$bfaReps->reputations[$toonRepCounter]->standing->value)." to Neutral.</td>";
					break;
				case 3:
					$champsOfAzeroth = "\n\t\t<td bgcolor=\"F1D50E\">".($bfaReps->reputations[$toonRepCounter]->standing->max-$bfaReps->reputations[$toonRepCounter]->standing->value)." to Friendly.</td>";
					break;
				case 4:
					$champsOfAzeroth = "\n\t\t<td bgcolor=\"BDF10E\">".($bfaReps->reputations[$toonRepCounter]->standing->max-$bfaReps->reputations[$toonRepCounter]->standing->value)." to Honored.</td>";
					break;
				case 5:
					$champsOfAzeroth = "\n\t\t<td bgcolor=\"98F10E\">".($bfaReps->reputations[$toonRepCounter]->standing->max-$bfaReps->reputations[$toonRepCounter]->standing->value)." to Revered.</td>";
					break;
				case 6:
					$champsOfAzeroth = "\n\t\t<td bgcolor=\"5AF10E\">".($bfaReps->reputations[$toonRepCounter]->standing->max-$bfaReps->reputations[$toonRepCounter]->standing->value)." to Exalted.</td>";
					break;
				case 7:
					$champsOfAzeroth = "\n\t\t<td bgcolor=\"10AA06\"><font color=\"FFFFFF\">".$bfaReps->reputations[$toonRepCounter]->faction->name."</font></td>";
					break;
				case NULL:
					$champsOfAzeroth = "<td bgcolor=\"000000\">No API Data</td>";
					break;
			}
		} elseif ($bfaReps->reputations[$toonRepCounter]->faction->id === 2163) {
			switch ($bfaReps->reputations[$toonRepCounter]->standing->tier) {
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
					$tortollanSeekers = "\n\t\t<td bgcolor=\"BDF10E\">".($bfaReps->reputations[$toonRepCounter]->standing->max-$bfaReps->reputations[$toonRepCounter]->standing->value)." to Honored.</td>";
					break;
				case 5:
					$tortollanSeekers = "\n\t\t<td bgcolor=\"98F10E\">".($bfaReps->reputations[$toonRepCounter]->standing->max-$bfaReps->reputations[$toonRepCounter]->standing->value)." to Revered.</td>";
					break;
				case 6:
					$tortollanSeekers = "\n\t\t<td bgcolor=\"5AF10E\">".($bfaReps->reputations[$toonRepCounter]->standing->max-$bfaReps->reputations[$toonRepCounter]->standing->value)." to Exalted.</td>";
					break;
				case 7:
					$tortollanSeekers = "\n\t\t<td bgcolor=\"10AA06\"><font color=\"FFFFFF\">".$bfaReps->reputations[$toonRepCounter]->faction->name."</font></td>";
					break;
				case NULL:
					$tortollanSeekers = "<td bgcolor=\"000000\">No API Data</td>";
					break;
			}
		} elseif ($bfaReps->reputations[$toonRepCounter]->faction->id === 2391) {
			switch ($bfaReps->reputations[$toonRepCounter]->standing->tier) {
				case 0:
					$rustboltResistance = "\n\t\t<td bgcolor=\"C00808\">".($bfaRep->max - $bfaRep->value)." to Hostile.</td>";
					break;
				case 1:
					$rustboltResistance = "\n\t\t<td bgcolor=\"F02206\">".($bfaRep->max - $bfaRep->value)." to Unfriendly.</td>";
					break;
				case 2:
					$rustboltResistance = "\n\t\t<td bgcolor=\"F05406\">".($bfaRep->max - $bfaRep->value)." to Neutral.</td>";
					break;
				case 3:
					$rustboltResistance = "\n\t\t<td bgcolor=\"F1D50E\">".($bfaRep->max - $bfaRep->value)." to Friendly.</td>";
					break;
				case 4:
					$rustboltResistance = "\n\t\t<td bgcolor=\"BDF10E\">".($bfaReps->reputations[$toonRepCounter]->standing->max-$bfaReps->reputations[$toonRepCounter]->standing->value)." to Honored.</td>";
					break;
				case 5:
					$rustboltResistance = "\n\t\t<td bgcolor=\"98F10E\">".($bfaReps->reputations[$toonRepCounter]->standing->max-$bfaReps->reputations[$toonRepCounter]->standing->value)." to Revered.</td>";
					break;
				case 6:
					$rustboltResistance = "\n\t\t<td bgcolor=\"5AF10E\">".($bfaReps->reputations[$toonRepCounter]->standing->max-$bfaReps->reputations[$toonRepCounter]->standing->value)." to Exalted.</td>";
					break;
				case 7:
					$rustboltResistance = "\n\t\t<td bgcolor=\"10AA06\"><font color=\"FFFFFF\">".$bfaReps->reputations[$toonRepCounter]->faction->name."</font></td>";
					break;
				case NULL:
					$rustboltResistance = "<td bgcolor=\"000000\">No API Data</td>";
					break;
			}

		} elseif ($wowFaction == 'HORDE' ) {
			if ($bfaReps->reputations[$toonRepCounter]->faction->id === 2157) {
				switch ($bfaReps->reputations[$toonRepCounter]->standing->tier) {
					case 0:
						$honorbound = "\n\t\t<td bgcolor=\"C00808\">".($bfaReps->reputations[$toonRepCounter]->standing->max-$bfaReps->reputations[$toonRepCounter]->standing->value)." to Hostile.</td>";
						break;
					case 1:
						$honorbound = "\n\t\t<td bgcolor=\"F02206\">".($bfaReps->reputations[$toonRepCounter]->standing->max-$bfaReps->reputations[$toonRepCounter]->standing->value)." to Unfriendly.</td>";
						break;
					case 2:
						$honorbound = "\n\t\t<td bgcolor=\"F05406\">".($bfaReps->reputations[$toonRepCounter]->standing->max-$bfaReps->reputations[$toonRepCounter]->standing->value)." to Neutral.</td>";
						break;
					case 3:
						$honorbound = "\n\t\t<td bgcolor=\"F1D50E\">".($bfaReps->reputations[$toonRepCounter]->standing->max-$bfaReps->reputations[$toonRepCounter]->standing->value)." to Friendly.</td>";
						break;
					case 4:
						$honorbound = "\n\t\t<td bgcolor=\"BDF10E\">".($bfaReps->reputations[$toonRepCounter]->standing->max-$bfaReps->reputations[$toonRepCounter]->standing->value)." to Honored.</td>";
						break;
					case 5:
						$honorbound = "\n\t\t<td bgcolor=\"98F10E\">".($bfaReps->reputations[$toonRepCounter]->standing->max-$bfaReps->reputations[$toonRepCounter]->standing->value)." to Revered.</td>";
						break;
					case 6:
						$honorbound = "\n\t\t<td bgcolor=\"5AF10E\">".($bfaReps->reputations[$toonRepCounter]->standing->max-$bfaReps->reputations[$toonRepCounter]->standing->value)." to Exalted.</td>";
						break;
					case 7:
						$honorbound = "\n\t\t<td bgcolor=\"10AA06\"><font color=\"FFFFFF\">".$bfaReps->reputations[$toonRepCounter]->faction->name."</font></td>";
						break;
					case NULL:
						$honorbound = "<td bgcolor=\"000000\">No API Data</td>";
						break;
				}
			} elseif ($bfaReps->reputations[$toonRepCounter]->faction->id === 2158) {
				switch ($bfaReps->reputations[$toonRepCounter]->standing->tier) {
					case 0:
						$voldunai = "\n\t\t<td bgcolor=\"C00808\">".($bfaReps->reputations[$toonRepCounter]->standing->max-$bfaReps->reputations[$toonRepCounter]->standing->value)." to Hostile.</td>";
						break;
					case 1:
						$voldunai = "\n\t\t<td bgcolor=\"F02206\">".($bfaReps->reputations[$toonRepCounter]->standing->max-$bfaReps->reputations[$toonRepCounter]->standing->value)." to Unfriendly.</td>";
						break;
					case 2:
						$voldunai = "\n\t\t<td bgcolor=\"F05406\">".($bfaReps->reputations[$toonRepCounter]->standing->max-$bfaReps->reputations[$toonRepCounter]->standing->value)." to Neutral.</td>";
						break;
					case 3:
						$voldunai = "\n\t\t<td bgcolor=\"F1D50E\">".($bfaReps->reputations[$toonRepCounter]->standing->max-$bfaReps->reputations[$toonRepCounter]->standing->value)." to Friendly.</td>";
						break;
					case 4:
						$voldunai = "\n\t\t<td bgcolor=\"BDF10E\">".($bfaReps->reputations[$toonRepCounter]->standing->max-$bfaReps->reputations[$toonRepCounter]->standing->value)." to Honored.</td>";
						break;
					case 5:
						$voldunai = "\n\t\t<td bgcolor=\"98F10E\">".($bfaReps->reputations[$toonRepCounter]->standing->max-$bfaReps->reputations[$toonRepCounter]->standing->value)." to Revered.</td>";
						break;
					case 6:
						$voldunai = "\n\t\t<td bgcolor=\"5AF10E\">".($bfaReps->reputations[$toonRepCounter]->standing->max-$bfaReps->reputations[$toonRepCounter]->standing->value)." to Exalted.</td>";
						break;
					case 7:
						$voldunai = "\n\t\t<td bgcolor=\"10AA06\"><font color=\"FFFFFF\">".$bfaReps->reputations[$toonRepCounter]->faction->name."</font></td>";
						break;
					case NULL:
						$voldunai = "<td bgcolor=\"000000\">No API Data</td>";
						break;
				}
			} elseif ($bfaReps->reputations[$toonRepCounter]->faction->id === 2156) {
				switch ($bfaReps->reputations[$toonRepCounter]->standing->tier) {
					case 0:
						$talanjisExpedition = "\n\t\t<td bgcolor=\"C00808\">".($bfaReps->reputations[$toonRepCounter]->standing->max-$bfaReps->reputations[$toonRepCounter]->standing->value)." to Hostile.</td>";
						break;
					case 1:
						$talanjisExpedition = "\n\t\t<td bgcolor=\"F02206\">".($bfaReps->reputations[$toonRepCounter]->standing->max-$bfaReps->reputations[$toonRepCounter]->standing->value)." to Unfriendly.</td>";
						break;
					case 2:
						$talanjisExpedition = "\n\t\t<td bgcolor=\"F05406\">".($bfaReps->reputations[$toonRepCounter]->standing->max-$bfaReps->reputations[$toonRepCounter]->standing->value)." to Neutral.</td>";
						break;
					case 3:
						$talanjisExpedition = "\n\t\t<td bgcolor=\"F1D50E\">".($bfaReps->reputations[$toonRepCounter]->standing->max-$bfaReps->reputations[$toonRepCounter]->standing->value)." to Friendly.</td>";
						break;
					case 4:
						$talanjisExpedition = "\n\t\t<td bgcolor=\"BDF10E\">".($bfaReps->reputations[$toonRepCounter]->standing->max-$bfaReps->reputations[$toonRepCounter]->standing->value)." to Honored.</td>";
						break;
					case 5:
						$talanjisExpedition = "\n\t\t<td bgcolor=\"98F10E\">".($bfaReps->reputations[$toonRepCounter]->standing->max-$bfaReps->reputations[$toonRepCounter]->standing->value)." to Revered.</td>";
						break;
					case 6:
						$talanjisExpedition = "\n\t\t<td bgcolor=\"5AF10E\">".($bfaReps->reputations[$toonRepCounter]->standing->max-$bfaReps->reputations[$toonRepCounter]->standing->value)." to Exalted.</td>";
						break;
					case 7:
						$talanjisExpedition = "\n\t\t<td bgcolor=\"10AA06\"><font color=\"FFFFFF\">".$bfaReps->reputations[$toonRepCounter]->faction->name."</font></td>";
						break;
					case NULL:
						$talanjisExpedition = "<td bgcolor=\"000000\">No API Data</td>";
						break;
				}
			} elseif ($bfaReps->reputations[$toonRepCounter]->faction->id === 2103) {
				switch ($bfaReps->reputations[$toonRepCounter]->standing->tier) {
					case 0:
						$zandalariEmpire = "\n\t\t<td bgcolor=\"C00808\">".($bfaReps->reputations[$toonRepCounter]->standing->max-$bfaReps->reputations[$toonRepCounter]->standing->value)." to Hostile.</td>";
						break;
					case 1:
						$zandalariEmpire = "\n\t\t<td bgcolor=\"F02206\">".($bfaReps->reputations[$toonRepCounter]->standing->max-$bfaReps->reputations[$toonRepCounter]->standing->value)." to Unfriendly.</td>";
						break;
					case 2:
						$zandalariEmpire = "\n\t\t<td bgcolor=\"F05406\">".($bfaReps->reputations[$toonRepCounter]->standing->max-$bfaReps->reputations[$toonRepCounter]->standing->value)." to Neutral.</td>";
						break;
					case 3:
						$zandalariEmpire = "\n\t\t<td bgcolor=\"F1D50E\">".($bfaReps->reputations[$toonRepCounter]->standing->max-$bfaReps->reputations[$toonRepCounter]->standing->value)." to Friendly.</td>";
						break;
					case 4:
						$zandalariEmpire = "\n\t\t<td bgcolor=\"BDF10E\">".($bfaReps->reputations[$toonRepCounter]->standing->max-$bfaReps->reputations[$toonRepCounter]->standing->value)." to Honored.</td>";
						break;
					case 5:
						$zandalariEmpire = "\n\t\t<td bgcolor=\"98F10E\">".($bfaReps->reputations[$toonRepCounter]->standing->max-$bfaReps->reputations[$toonRepCounter]->standing->value)." to Revered.</td>";
						break;
					case 6:
						$zandalariEmpire = "\n\t\t<td bgcolor=\"5AF10E\">".($bfaReps->reputations[$toonRepCounter]->standing->max-$bfaReps->reputations[$toonRepCounter]->standing->value)." to Exalted.</td>";
						break;
					case 7:
						$zandalariEmpire = "\n\t\t<td bgcolor=\"10AA06\"><font color=\"FFFFFF\">".$bfaReps->reputations[$toonRepCounter]->faction->name."</font></td>";
						break;
					case NULL:
						$zandalariEmpire = "<td bgcolor=\"000000\">No API Data</td>";
						break;
				}
			} elseif ($bfaReps->reputations[$toonRepCounter]->faction->id === 2373) {
				switch ($bfaReps->reputations[$toonRepCounter]->standing->tier) {
					case 0:
						$theUnshackled = "\n\t\t<td bgcolor=\"C00808\">".($bfaReps->reputations[$toonRepCounter]->standing->max-$bfaReps->reputations[$toonRepCounter]->standing->value)." to Hostile.</td>";
						break;
					case 1:
						$theUnshackled = "\n\t\t<td bgcolor=\"F02206\">".($bfaReps->reputations[$toonRepCounter]->standing->max-$bfaReps->reputations[$toonRepCounter]->standing->value)." to Unfriendly.</td>";
						break;
					case 2:
						$theUnshackled = "\n\t\t<td bgcolor=\"F05406\">".($bfaReps->reputations[$toonRepCounter]->standing->max-$bfaReps->reputations[$toonRepCounter]->standing->value)." to Neutral.</td>";
						break;
					case 3:
						$theUnshackled = "\n\t\t<td bgcolor=\"F1D50E\">".($bfaReps->reputations[$toonRepCounter]->standing->max-$bfaReps->reputations[$toonRepCounter]->standing->value)." to Friendly.</td>";
						break;
					case 4:
						$theUnshackled = "\n\t\t<td bgcolor=\"BDF10E\">".($bfaReps->reputations[$toonRepCounter]->standing->max-$bfaReps->reputations[$toonRepCounter]->standing->value)." to Honored.</td>";
						break;
					case 5:
						$theUnshackled = "\n\t\t<td bgcolor=\"98F10E\">".($bfaReps->reputations[$toonRepCounter]->standing->max-$bfaReps->reputations[$toonRepCounter]->standing->value)." to Revered.</td>";
						break;
					case 6:
						$theUnshackled = "\n\t\t<td bgcolor=\"5AF10E\">".($bfaReps->reputations[$toonRepCounter]->standing->max-$bfaReps->reputations[$toonRepCounter]->standing->value)." to Exalted.</td>";
						break;
					case 7:
						$theUnshackled = "\n\t\t<td bgcolor=\"10AA06\"><font color=\"FFFFFF\">".$bfaReps->reputations[$toonRepCounter]->faction->name."</font></td>";
						break;
					case NULL:
						$theUnshackled = "<td bgcolor=\"000000\">No API Data</td>";
						break;
				}
			}
			$factionReps = $theUnshackled.$zandalariEmpire.$talanjisExpedition.$voldunai.$honorbound;
		} elseif ($wowFaction == 'ALLIANCE' ) {
			if ($bfaReps->reputations[$toonRepCounter]->faction->id === 2159) {
				switch ($bfaReps->reputations[$toonRepCounter]->standing->tier) {
					case 0:
						$seventhLegion = "\n\t\t<td bgcolor=\"C00808\">".($bfaReps->reputations[$toonRepCounter]->standing->max-$bfaReps->reputations[$toonRepCounter]->standing->value)." to Hostile.</td>";
						break;
					case 1:
						$seventhLegion = "\n\t\t<td bgcolor=\"F02206\">".($bfaReps->reputations[$toonRepCounter]->standing->max-$bfaReps->reputations[$toonRepCounter]->standing->value)." to Unfriendly.</td>";
						break;
					case 2:
						$seventhLegion = "\n\t\t<td bgcolor=\"F05406\">".($bfaReps->reputations[$toonRepCounter]->standing->max-$bfaReps->reputations[$toonRepCounter]->standing->value)." to Neutral.</td>";
						break;
					case 3:
						$seventhLegion = "\n\t\t<td bgcolor=\"F1D50E\">".($bfaReps->reputations[$toonRepCounter]->standing->max-$bfaReps->reputations[$toonRepCounter]->standing->value)." to Friendly.</td>";
						break;
					case 4:
						$seventhLegion = "\n\t\t<td bgcolor=\"BDF10E\">".($bfaReps->reputations[$toonRepCounter]->standing->max-$bfaReps->reputations[$toonRepCounter]->standing->value)." to Honored.</td>";
						break;
					case 5:
						$seventhLegion = "\n\t\t<td bgcolor=\"98F10E\">".($bfaReps->reputations[$toonRepCounter]->standing->max-$bfaReps->reputations[$toonRepCounter]->standing->value)." to Revered.</td>";
						break;
					case 6:
						$seventhLegion = "\n\t\t<td bgcolor=\"5AF10E\">".($bfaReps->reputations[$toonRepCounter]->standing->max-$bfaReps->reputations[$toonRepCounter]->standing->value)." to Exalted.</td>";
						break;
					case 7:
						$seventhLegion = "\n\t\t<td bgcolor=\"10AA06\"><font color=\"FFFFFF\">".$bfaReps->reputations[$toonRepCounter]->faction->name."</font></td>";
						break;
					case NULL:
						$seventhLegion = "<td bgcolor=\"000000\">No API Data</td>";
						break;
				}
			} elseif ($bfaReps->reputations[$toonRepCounter]->faction->id === 2160) {
				switch ($bfaReps->reputations[$toonRepCounter]->standing->tier) {
					case 0:
						$proudmooreAdmiralty = "\n\t\t<td bgcolor=\"C00808\">".($bfaReps->reputations[$toonRepCounter]->standing->max-$bfaReps->reputations[$toonRepCounter]->standing->value)." to Hostile.</td>";
						break;
					case 1:
						$proudmooreAdmiralty = "\n\t\t<td bgcolor=\"F02206\">".($bfaReps->reputations[$toonRepCounter]->standing->max-$bfaReps->reputations[$toonRepCounter]->standing->value)." to Unfriendly.</td>";
						break;
					case 2:
						$proudmooreAdmiralty = "\n\t\t<td bgcolor=\"F05406\">".($bfaReps->reputations[$toonRepCounter]->standing->max-$bfaReps->reputations[$toonRepCounter]->standing->value)." to Neutral.</td>";
						break;
					case 3:
						$proudmooreAdmiralty = "\n\t\t<td bgcolor=\"F1D50E\">".($bfaReps->reputations[$toonRepCounter]->standing->max-$bfaReps->reputations[$toonRepCounter]->standing->value)." to Friendly.</td>";
						break;
					case 4:
						$proudmooreAdmiralty = "\n\t\t<td bgcolor=\"BDF10E\">".($bfaReps->reputations[$toonRepCounter]->standing->max-$bfaReps->reputations[$toonRepCounter]->standing->value)." to Honored.</td>";
						break;
					case 5:
						$proudmooreAdmiralty = "\n\t\t<td bgcolor=\"98F10E\">".($bfaReps->reputations[$toonRepCounter]->standing->max-$bfaReps->reputations[$toonRepCounter]->standing->value)." to Revered.</td>";
						break;
					case 6:
						$proudmooreAdmiralty = "\n\t\t<td bgcolor=\"5AF10E\">".($bfaReps->reputations[$toonRepCounter]->standing->max-$bfaReps->reputations[$toonRepCounter]->standing->value)." to Exalted.</td>";
						break;
					case 7:
						$proudmooreAdmiralty = "\n\t\t<td bgcolor=\"10AA06\"><font color=\"FFFFFF\">".$bfaReps->reputations[$toonRepCounter]->faction->name."</font></td>";
						break;
					case NULL:
						$proudmooreAdmiralty = "<td bgcolor=\"000000\">No API Data</td>";
						break;
				}
			} elseif ($bfaReps->reputations[$toonRepCounter]->faction->id === 2161) {
				switch ($bfaReps->reputations[$toonRepCounter]->standing->tier) {
					case 0:
						$orderOfEmbers = "\n\t\t<td bgcolor=\"C00808\">".($bfaReps->reputations[$toonRepCounter]->standing->max-$bfaReps->reputations[$toonRepCounter]->standing->value)." to Hostile.</td>";
						break;
					case 1:
						$orderOfEmbers = "\n\t\t<td bgcolor=\"F02206\">".($bfaReps->reputations[$toonRepCounter]->standing->max-$bfaReps->reputations[$toonRepCounter]->standing->value)." to Unfriendly.</td>";
						break;
					case 2:
						$orderOfEmbers = "\n\t\t<td bgcolor=\"F05406\">".($bfaReps->reputations[$toonRepCounter]->standing->max-$bfaReps->reputations[$toonRepCounter]->standing->value)." to Neutral.</td>";
						break;
					case 3:
						$orderOfEmbers = "\n\t\t<td bgcolor=\"F1D50E\">".($bfaReps->reputations[$toonRepCounter]->standing->max-$bfaReps->reputations[$toonRepCounter]->standing->value)." to Friendly.</td>";
						break;
					case 4:
						$orderOfEmbers = "\n\t\t<td bgcolor=\"BDF10E\">".($bfaReps->reputations[$toonRepCounter]->standing->max-$bfaReps->reputations[$toonRepCounter]->standing->value)." to Honored.</td>";
						break;
					case 5:
						$orderOfEmbers = "\n\t\t<td bgcolor=\"98F10E\">".($bfaReps->reputations[$toonRepCounter]->standing->max-$bfaReps->reputations[$toonRepCounter]->standing->value)." to Revered.</td>";
						break;
					case 6:
						$orderOfEmbers = "\n\t\t<td bgcolor=\"5AF10E\">".($bfaReps->reputations[$toonRepCounter]->standing->max-$bfaReps->reputations[$toonRepCounter]->standing->value)." to Exalted.</td>";
						break;
					case 7:
						$orderOfEmbers = "\n\t\t<td bgcolor=\"10AA06\"><font color=\"FFFFFF\">".$bfaReps->reputations[$toonRepCounter]->faction->name."</font></td>";
						break;
					case NULL:
						$orderOfEmbers = "<td bgcolor=\"000000\">No API Data</td>";
						break;
				}
			} elseif ($bfaReps->reputations[$toonRepCounter]->faction->id === 2162) {
				switch ($bfaReps->reputations[$toonRepCounter]->standing->tier) {
					case 0:
						$stormsWake = "\n\t\t<td bgcolor=\"C00808\">".($bfaReps->reputations[$toonRepCounter]->standing->max-$bfaReps->reputations[$toonRepCounter]->standing->value)." to Hostile.</td>";
						break;
					case 1:
						$stormsWake = "\n\t\t<td bgcolor=\"F02206\">".($bfaReps->reputations[$toonRepCounter]->standing->max-$bfaReps->reputations[$toonRepCounter]->standing->value)." to Unfriendly.</td>";
						break;
					case 2:
						$stormsWake = "\n\t\t<td bgcolor=\"F05406\">".($bfaReps->reputations[$toonRepCounter]->standing->max-$bfaReps->reputations[$toonRepCounter]->standing->value)." to Neutral.</td>";
						break;
					case 3:
						$stormsWake = "\n\t\t<td bgcolor=\"F1D50E\">".($bfaReps->reputations[$toonRepCounter]->standing->max-$bfaReps->reputations[$toonRepCounter]->standing->value)." to Friendly.</td>";
						break;
					case 4:
						$stormsWake = "\n\t\t<td bgcolor=\"BDF10E\">".($bfaReps->reputations[$toonRepCounter]->standing->max-$bfaReps->reputations[$toonRepCounter]->standing->value)." to Honored.</td>";
						break;
					case 5:
						$stormsWake = "\n\t\t<td bgcolor=\"98F10E\">".($bfaReps->reputations[$toonRepCounter]->standing->max-$bfaReps->reputations[$toonRepCounter]->standing->value)." to Revered.</td>";
						break;
					case 6:
						$stormsWake = "\n\t\t<td bgcolor=\"5AF10E\">".($bfaReps->reputations[$toonRepCounter]->standing->max-$bfaReps->reputations[$toonRepCounter]->standing->value)." to Exalted.</td>";
						break;
					case 7:
						$stormsWake = "\n\t\t<td bgcolor=\"10AA06\"><font color=\"FFFFFF\">".$bfaReps->reputations[$toonRepCounter]->faction->name."</font></td>";
						break;
					case NULL:
						$stormsWake = "<td bgcolor=\"000000\">No API Data</td>";
						break;
				}
			} elseif ($bfaReps->reputations[$toonRepCounter]->faction->id === 2400) {
				switch ($bfaReps->reputations[$toonRepCounter]->standing->tier) {
					case 0:
						$wavebladeAnkoan = "\n\t\t<td bgcolor=\"C00808\">".($bfaReps->reputations[$toonRepCounter]->standing->max-$bfaReps->reputations[$toonRepCounter]->standing->value)." to Hostile.</td>";
						break;
					case 1:
						$wavebladeAnkoan = "\n\t\t<td bgcolor=\"F02206\">".($bfaReps->reputations[$toonRepCounter]->standing->max-$bfaReps->reputations[$toonRepCounter]->standing->value)." to Unfriendly.</td>";
						break;
					case 2:
						$wavebladeAnkoan = "\n\t\t<td bgcolor=\"F05406\">".($bfaReps->reputations[$toonRepCounter]->standing->max-$bfaReps->reputations[$toonRepCounter]->standing->value)." to Neutral.</td>";
						break;
					case 3:
						$wavebladeAnkoan = "\n\t\t<td bgcolor=\"F1D50E\">".($bfaReps->reputations[$toonRepCounter]->standing->max-$bfaReps->reputations[$toonRepCounter]->standing->value)." to Friendly.</td>";
						break;
					case 4:
						$wavebladeAnkoan = "\n\t\t<td bgcolor=\"BDF10E\">".($bfaReps->reputations[$toonRepCounter]->standing->max-$bfaReps->reputations[$toonRepCounter]->standing->value)." to Honored.</td>";
						break;
					case 5:
						$wavebladeAnkoan = "\n\t\t<td bgcolor=\"98F10E\">".($bfaReps->reputations[$toonRepCounter]->standing->max-$bfaReps->reputations[$toonRepCounter]->standing->value)." to Revered.</td>";
						break;
					case 6:
						$wavebladeAnkoan = "\n\t\t<td bgcolor=\"5AF10E\">".($bfaReps->reputations[$toonRepCounter]->standing->max-$bfaReps->reputations[$toonRepCounter]->standing->value)." to Exalted.</td>";
						break;
					case 7:
						$wavebladeAnkoan = "\n\t\t<td bgcolor=\"10AA06\"><font color=\"FFFFFF\">".$bfaReps->reputations[$toonRepCounter]->faction->name."</font></td>";
						break;
					case NULL:
						$wavebladeAnkoan = "<td bgcolor=\"000000\">No API Data</td>";
						break;
				}
			}
			$factionReps = $wavebladeAnkoan.$proudmooreAdmiralty.$stormsWake.$orderOfEmbers.$seventhLegion;
		}
	}
	return $rustboltResistance.$factionReps.$champsOfAzeroth.$tortollanSeekers;
}
# BEGIN BLOCK for testing
# END BLOCK for testing

?>
