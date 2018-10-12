<?php
############################# FILE: wow_profs_inc.php ###################
#									#
# Grouping of functions based on how blizzard split out professions.	#
# We will be gathering data on Primary and Seconday Professions and 	#
# using that data to populate the "Checklist" for each expansion now	#
# that Blizzard has seperated professions by expansion. Each return	#
# should show either complete, or currnet rank in each profession.	#
# 									#
# NOTE: I have attempted to put some order to the return, as much as 	#
# possible. From Primary professions, Gathering should always be in the #
# first slot on the return. For secondary, I tried to make Archaeology	#
# return last, but all my tests have shown it to return second after	#
# Fishing. I do not yet know why.					#
#########################################################################
# Primary Professions Functions
#
# This will take in the $toonPriProfs ($toon_obj->professions->primary) and spit out
# HTML table data for each expansion page
#

function bfaPrimaryProfs($toonPriProfs, $priProfCount) {
	$return = "";
	$priProfCount = 0;
	do {
		foreach ($toonPriProfs as $priProf) {
			if (strpos ( $priProf->name, 'Kul Tiran') !== false) {
				if (strpos ( $priProf->name, 'Hebalism') || strpos ( $priProf->name, 'Mining') || strpos ( $priProf->name, 'Skinning') !== false) {
					if ($priProf->rank < $priProf->max) {
						$return .= "\n\t\t<td bgcolor=\"F4E938\">".$priProf->name." - ".$priProf->rank."</td>\n";
						$priProfCount++;
					} else {
						$return .= "\n\t\t<td bgcolor=\"10AA06\"><font color=\"FFFFFF\">".$priProf->name."</font></td>";
						$priProfCount++;
					}
			} elseif (strpos ( $priProf->name, 'Kul Tiran' ) !== false) {
				if ($priProf->rank < $priProf->max) {
					$return .= "\n\t\t<td bgcolor=\"F4E938\">".$priProf->name." - ".$priProf->rank."</td>\n";
					$priProfCount++;
				} else {
					$return .= "\n\t\t<td bgcolor=\"10AA06\"><font color=\"FFFFFF\">".$priProf->name."</font></td>";
					$priProfCount++;
				}
			} else {
				$return .= "\n\t\t<td bgcolor=\"000000\"> </td>";
				$priPorfCount++;
			}
			}
		}
	} while ($priProfCount < 2);
	return $return;
}

function legPrimaryProfs($toonPriProfs) {
	$return = "";
	$priProfCount = 0;
	do {
		foreach ($toonPriProfs as $priProf) {
			if (strpos ( $priProf->name, 'Legion') !== false) {
				if (strpos ( $priProf->name, 'Hebalism') || strpos ( $priProf->name, 'Mining') || strpos ( $priProf->name, 'Skinning') !== false) {
					if ($priProf->rank < $priProf->max) {
						$return .= "\n\t\t<td bgcolor=\"F4E938\">".$priProf->name." - ".$priProf->rank."</td>\n";
						$priProfCount++;
					} else {
						$return .= "\n\t\t<td bgcolor=\"10AA06\"><font color=\"FFFFFF\">".$priProf->name."</font></td>";
						$priProfCount++;
					}
			} elseif (strpos ( $priProf->name, 'Legion' ) !== false) {
				if ($priProf->rank < $priProf->max) {
					$return .= "\n\t\t<td bgcolor=\"F4E938\">".$priProf->name." - ".$priProf->rank."</td>\n";
					$priProfCount++;
				} else {
					$return .= "\n\t\t<td bgcolor=\"10AA06\"><font color=\"FFFFFF\">".$priProf->name."</font></td>";
					$priProfCount++;
				}
			} else {
				$return .= "\n\t\t<td bgcolor=\"000000\"> </td>";
				$priPorfCount++;
			}
			}
		}
	} while ($priProfCount < 2);
	return $return;
}

function wodPrimaryProfs($toonPriProfs) {
	$return = "";
	$priProfCount = 0;
	do {
		foreach ($toonPriProfs as $priProf) {
			if (strpos ( $priProf->name, 'Draenor') !== false) {
				if (strpos ( $priProf->name, 'Hebalism') || strpos ( $priProf->name, 'Mining') || strpos ( $priProf->name, 'Skinning') !== false) {
					if ($priProf->rank < $priProf->max) {
						$return .= "\n\t\t<td bgcolor=\"F4E938\">".$priProf->name." - ".$priProf->rank."</td>\n";
						$priProfCount++;
					} else {
						$return .= "\n\t\t<td bgcolor=\"10AA06\"><font color=\"FFFFFF\">".$priProf->name."</font></td>";
						$priProfCount++;
					}
			} elseif (strpos ( $priProf->name, 'Draenor' ) !== false) {
				if ($priProf->rank < $priProf->max) {
					$return .= "\n\t\t<td bgcolor=\"F4E938\">".$priProf->name." - ".$priProf->rank."</td>\n";
					$priProfCount++;
				} else {
					$return .= "\n\t\t<td bgcolor=\"10AA06\"><font color=\"FFFFFF\">".$priProf->name."</font></td>";
					$priProfCount++;
				}
			} else {
				$return .= "\n\t\t<td bgcolor=\"000000\"> </td>";
				$priPorfCount++;
			}
			}
		}
	} while ($priProfCount < 2);
	return $return;
}

function mopPrimaryProfs($toonPriProfs) {
	$return = "";
	$priProfCount = 0;
	do {
		foreach ($toonPriProfs as $priProf) {
			if (strpos ( $priProf->name, 'Pandaria') !== false) {
				if (strpos ( $priProf->name, 'Hebalism') || strpos ( $priProf->name, 'Mining') || strpos ( $priProf->name, 'Skinning') !== false) {
					if ($priProf->rank < $priProf->max) {
						$return .= "\n\t\t<td bgcolor=\"F4E938\">".$priProf->name." - ".$priProf->rank."</td>\n";
						$priProfCount++;
					} else {
						$return .= "\n\t\t<td bgcolor=\"10AA06\"><font color=\"FFFFFF\">".$priProf->name."</font></td>";
						$priProfCount++;
					}
			} elseif (strpos ( $priProf->name, 'Pandaria' ) !== false) {
				if ($priProf->rank < $priProf->max) {
					$return .= "\n\t\t<td bgcolor=\"F4E938\">".$priProf->name." - ".$priProf->rank."</td>\n";
					$priProfCount++;
				} else {
					$return .= "\n\t\t<td bgcolor=\"10AA06\"><font color=\"FFFFFF\">".$priProf->name."</font></td>";
					$priProfCount++;
				}
			} else {
				$return .= "\n\t\t<td bgcolor=\"000000\"> </td>";
				$priPorfCount++;
			}
			}
		}
	} while ($priProfCount < 2);
	return $return;
}

function cataPrimaryProfs($toonPriProfs, $priProfCount) {
	$return = "";
	do {
		foreach ($toonPriProfs as $priProf) {
			if (strpos ( $priProf->name, 'Cataclysm') !== false) {
				if (strpos ( $priProf->name, 'Hebalism') || strpos ( $priProf->name, 'Mining') || strpos ( $priProf->name, 'Skinning') !== false) {
					if ($priProf->rank < $priProf->max) {
						$return .= "\n\t\t<td bgcolor=\"F4E938\">".$priProf->name." - ".$priProf->rank."</td>\n";
						$priProfCount++;
					} else {
						$return .= "\n\t\t<td bgcolor=\"10AA06\"><font color=\"FFFFFF\">".$priProf->name."</font></td>";
						$priProfCount++;
					}
			} elseif (strpos ( $priProf->name, 'Cataclysm' ) !== false) {
				if ($priProf->rank < $priProf->max) {
					$return .= "\n\t\t<td bgcolor=\"F4E938\">".$priProf->name." - ".$priProf->rank."</td>\n";
					$priProfCount++;
				} else {
					$return .= "\n\t\t<td bgcolor=\"10AA06\"><font color=\"FFFFFF\">".$priProf->name."</font></td>";
					$priProfCount++;
				}
			} else {
				$return .= "\n\t\t<td bgcolor=\"000000\"> </td>";
				$priPorfCount++;
			}
			}
		}
	} while ($priProfCount < 2);
	return $return;
}

function wotlkPrimaryProfs($toonPriProfs) {
	$return = "";
	$priProfCount = 0;
	do {
		foreach ($toonPriProfs as $priProf) {
			if (strpos ( $priProf->name, 'Northrend') !== false) {
				if (strpos ( $priProf->name, 'Hebalism') || strpos ( $priProf->name, 'Mining') || strpos ( $priProf->name, 'Skinning') !== false) {
					if ($priProf->rank < $priProf->max) {
						$return .= "\n\t\t<td bgcolor=\"F4E938\">".$priProf->name." - ".$priProf->rank."</td>\n";
						$priProfCount++;
					} else {
						$return .= "\n\t\t<td bgcolor=\"10AA06\"><font color=\"FFFFFF\">".$priProf->name."</font></td>";
						$priProfCount++;
					}
			} elseif (strpos ( $priProf->name, 'Northrend' ) !== false) {
				if ($priProf->rank < $priProf->max) {
					$return .= "\n\t\t<td bgcolor=\"F4E938\">".$priProf->name." - ".$priProf->rank."</td>\n";
					$priProfCount++;
				} else {
					$return .= "\n\t\t<td bgcolor=\"10AA06\"><font color=\"FFFFFF\">".$priProf->name."</font></td>";
					$priProfCount++;
				}
			} else {
				$return .= "\n\t\t<td bgcolor=\"000000\"> </td>";
				$priPorfCount++;
			}
			}
		}
	} while ($priProfCount < 2);
	return $return;
}

function bcPrimaryProfs($toonPriProfs) {
	$return = "";
	$priProfCount = 0;
	do {
		foreach ($toonPriProfs as $priProf) {
			if (strpos ( $priProf->name, 'Outland') !== false) {
				if (strpos ( $priProf->name, 'Hebalism') || strpos ( $priProf->name, 'Mining') || strpos ( $priProf->name, 'Skinning') !== false) {
					if ($priProf->rank < $priProf->max) {
						$return .= "\n\t\t<td bgcolor=\"F4E938\">".$priProf->name." - ".$priProf->rank."</td>\n";
						$priProfCount++;
					} else {
						$return .= "\n\t\t<td bgcolor=\"10AA06\"><font color=\"FFFFFF\">".$priProf->name."</font></td>";
						$priProfCount++;
					}
			} elseif (strpos ( $priProf->name, 'Outland' ) !== false) {
				if ($priProf->rank < $priProf->max) {
					$return .= "\n\t\t<td bgcolor=\"F4E938\">".$priProf->name." - ".$priProf->rank."</td>\n";
					$priProfCount++;
				} else {
					$return .= "\n\t\t<td bgcolor=\"10AA06\"><font color=\"FFFFFF\">".$priProf->name."</font></td>";
					$priProfCount++;
				}
			} else {
				$return .= "\n\t\t<td bgcolor=\"000000\"> </td>";
				$priPorfCount++;
			}
			}
		}
	} while ($priProfCount < 2);
	return $return;
}

function vanPrimaryProfs($toonPriProfs, $priProfCount) {
}

# Secondary Professions Functions
#
# This section will take expansion based secondary Professions data
# and spit out table data.
# NOTE: Archeology is *not* seperated by exapnsion.
function bfaSecondaryProfs($toonSecProfs) {
	$return = "";
	foreach ($toonSecProfs as $secProf) {
		if (strpos ( $secProf->name, 'Kul Tiran Fishing') !== false) {
				if ($secProf->rank < $secProf->max) {
					$return .= "\n\t\t<td bgcolor=\"F4E938\">".$secProf->name." - ".$secProf->rank."</td>\n";
					$priProfCount++;
				} else {
					$return .= "\n\t\t<td bgcolor=\"10AA06\"><font color=\"FFFFFF\">".$secProf->name."</font></td>";
					$priProfCount++;
				}
		} elseif (strpos ($secProf->name, 'Kul Tiran Cooking') !== false) {
		} elseif (strpos($secProf->name, 'Archaeology') !== false) {
		} else {
				$return .= "\n\t\t<td bgcolor=\"000000\"> </td>";
		}
	}
	return $return;
}

function legSecondaryProfs($toonSecProfs) {
}

function wodSecondaryProfs($toonSecProfs) {
}

function mopSecondaryProfs($toonSecProfs) {
}

function cataSecondaryProfs($toonSecProfs) {
}

function wotlkSecondaryProfs($toonSecProfs) {
}

function bcSecondaryProfs($toonSecProfs) {
}

function vanSecondaryProfs($toonSecProfs) {
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

	$priProfCount = 0;
$toonObj = json_decode(file_get_contents($toon_info_url));
$toonPriProfs = bfaPrimaryProfs($toonObj->professions->primary, $priProfCount);
print $toonPriProfs;
# END BLOCK for testing

?>
