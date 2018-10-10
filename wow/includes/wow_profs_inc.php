<?php
# file: wow_profs_inc.php
#
# Grouping of functions based on how blizzard split out professions.
#
# Primary Professions Functions
#
# This will take in the $toonPriProfs ($toon_obj->professions->primary) and spit out
# HTML table data for each expansion page
#

function bfaPrimaryProfs($toonPriProfs) {
	$return = "";
	foreach ($toonPriProfs as $priProf) {
		if (strpos ( $priProf->name, 'Kul Tiran') !== false) {
			if (strpos ( $priProf->name, 'Hebalism') || strpos ( $priProf->name, 'Mining') || strpos ( $priProf->name, 'Skinning') !== false) {
				$return .= "\t\t<td>".$priProf->name." - ".$priProf->rank."</td>\n";
			} else {
				$return .= "\t\t<td>".$priProf->name." - ".$priProf->rank."</td>\n";
			}
		}
	}
	return $return;
}

function legPrimaryProfs($toonPriProfs) {
	$return = "";
	foreach ($toonPriProfs as $priProf) {
		if (strpos ( $priProf->name, 'Legion') !== false) {
			if (strpos ( $priProf->name, 'Hebalism') || strpos ( $priProf->name, 'Mining') || strpos ( $priProf->name, 'Skinning') !== false) {
				$return .= "\t\t<td>".$priProf->name." - ".$priProf->rank."</td>\n";
			} else {
				$return .= "\t\t<td>".$priProf->name." - ".$priProf->rank."</td>\n";
			}
		}
	}
	return $return;
}

function wodPrimaryProfs($toonPriProfs) {
	$return = "";
	foreach ($toonPriProfs as $priProf) {
		if (strpos ( $priProf->name, 'Draenor') !== false) {
			if (strpos ( $priProf->name, 'Hebalism') || strpos ( $priProf->name, 'Mining') || strpos ( $priProf->name, 'Skinning') !== false) {
				$return .= "\t\t<td>".$priProf->name." - ".$priProf->rank."</td>\n";
			} else {
				$return .= "\t\t<td>".$priProf->name." - ".$priProf->rank."</td>\n";
			}
		}
	}
	return $return;
}

function mopPrimaryProfs($toonPriProfs) {
	$return = "";
	foreach ($toonPriProfs as $priProf) {
		if (strpos ( $priProf->name, 'Pandaria') !== false) {
			if (strpos ( $priProf->name, 'Hebalism') || strpos ( $priProf->name, 'Mining') || strpos ( $priProf->name, 'Skinning') !== false) {
				$return .= "\t\t<td>".$priProf->name." - ".$priProf->rank."</td>\n";
			} else {
				$return .= "\t\t<td>".$priProf->name." - ".$priProf->rank."</td>\n";
			}
		}
	}
	return $return;
}

function cataPrimaryProfs($toonPriProfs) {
	$return = "";
	foreach ($toonPriProfs as $priProf) {
		if (strpos ( $priProf->name, 'Cataclysm') !== false) {
			if (strpos ( $priProf->name, 'Hebalism') || strpos ( $priProf->name, 'Mining') || strpos ( $priProf->name, 'Skinning') !== false) {
				$return .= "\t\t<td>".$priProf->name." - ".$priProf->rank."</td>\n";
			} else {
				$return .= "\t\t<td>".$priProf->name." - ".$priProf->rank."</td>\n";
			}
		}
	}
	return $return;
}

function wotlkPrimaryProfs($toonPriProfs) {
	$return = "";
	foreach ($toonPriProfs as $priProf) {
		if (strpos ( $priProf->name, 'Northrend') !== false) {
			if (strpos ( $priProf->name, 'Hebalism') || strpos ( $priProf->name, 'Mining') || strpos ( $priProf->name, 'Skinning') !== false) {
				$return .= "\t\t<td>".$priProf->name." - ".$priProf->rank."</td>\n";
			} else {
				$return .= "\t\t<td>".$priProf->name." - ".$priProf->rank."</td>\n";
			}
		}
	}
	return $return;
}

function bcPrimaryProfs($toonPriProfs) {
	$return = "";
	foreach ($toonPriProfs as $priProf) {
		if (strpos ( $priProf->name, 'Outland') !== false) {
			if (strpos ( $priProf->name, 'Hebalism') || strpos ( $priProf->name, 'Mining') || strpos ( $priProf->name, 'Skinning') !== false) {
				$return .= "\t\t<td>".$priProf->name." - ".$priProf->rank."</td>\n";
			} else {
				$return .= "\t\t<td>".$priProf->name." - ".$priProf->rank."</td>\n";
			}
		}
	}
	return $return;
}

function vanPrimaryProfs($toonPriProfs) {
	$return = "";
	foreach ($toonPriProfs as $priProf) {
		if (strpos ( $priProf->name, 'Kul Tiran') !== false) {
			if (strpos ( $priProf->name, 'Hebalism') || strpos ( $priProf->name, 'Mining') || strpos ( $priProf->name, 'Skinning') !== false) {
				$return .= "\t\t<td>".$priProf->name." - ".$priProf->rank."</td>\n";
			} else {
				$return .= "\t\t<td>".$priProf->name." - ".$priProf->rank."</td>\n";
			}
		}
	}
	return $return;
}

# Secondary Professions Functions
#
# This section will take expansion based secondary Professions data
# and spit out table data.
# NOTE: Archeology is *not* seperated by exapnsion.
function bfaSecondaryProfs($toonSecProfs) {
	$return = "";
	foreach ($toonSecProfs as $secondaryProf) {
		if (strpos ( $secondaryProf->name, 'Kul Tiran Fishing') !== false) {
			$return .= "\t\t<td>".$secondaryProf->name." - ".$secondaryProf->rank."</td>\n";
		} elseif (strpos ($secondaryProf->name, 'Kul Tiran Cooking') !== false) {
			$return .= "\t\t<td>".$secondaryProf->name." - ".$secondaryProf->rank."</td>\n";
		} elseif (strpos($secondaryProf->name, 'Archaeology') !== false) {
			$return .= "\t\t<td>".$secondaryProf->name." - ".$secondaryProf->rank."</td>\n";
		}
	}
	return $return;
}

function legSecondaryProfs($toonSecProfs) {
	$return = "";
	foreach ($toonSecProfs as $secondaryProf) {
		if (strpos ( $secondaryProf->name, 'Legion Fishing') !== false) {
			$return .= "\t\t<td>".$secondaryProf->name." - ".$secondaryProf->rank."</td>\n";
		} elseif (strpos ($secondaryProf->name, 'Legion Cooking') !== false) {
			$return .= "\t\t<td>".$secondaryProf->name." - ".$secondaryProf->rank."</td>\n";
		} elseif (strpos($secondaryProf->name, 'Archaeology') !== false) {
			$return .= "\t\t<td>".$secondaryProf->name." - ".$secondaryProf->rank."</td>\n";
		}
	}
	return $return;
}

function wodSecondaryProfs($toonSecProfs) {
	$return = "";
	foreach ($toonSecProfs as $secondaryProf) {
		if (strpos ( $secondaryProf->name, 'Draenor Fishing') !== false) {
			$return .= "\t\t<td>".$secondaryProf->name." - ".$secondaryProf->rank."</td>\n";
		} elseif (strpos ($secondaryProf->name, 'Draenor Cooking') !== false) {
			$return .= "\t\t<td>".$secondaryProf->name." - ".$secondaryProf->rank."</td>\n";
		} elseif (strpos($secondaryProf->name, 'Archaeology') !== false) {
			$return .= "\t\t<td>".$secondaryProf->name." - ".$secondaryProf->rank."</td>\n";
		}
	}
	return $return;
}

function mopSecondaryProfs($toonSecProfs) {
	$return = "";
	foreach ($toonSecProfs as $secondaryProf) {
		if (strpos ( $secondaryProf->name, 'Pandaria Fishing') !== false) {
			$return .= "\t\t<td>".$secondaryProf->name." - ".$secondaryProf->rank."</td>\n";
		} elseif (strpos ($secondaryProf->name, 'Pandaria Cooking') !== false) {
			$return .= "\t\t<td>".$secondaryProf->name." - ".$secondaryProf->rank."</td>\n";
		} elseif (strpos($secondaryProf->name, 'Archaeology') !== false) {
			$return .= "\t\t<td>".$secondaryProf->name." - ".$secondaryProf->rank."</td>\n";
		}
	}
	return $return;
}

function cataSecondaryProfs($toonSecProfs) {
	$return = "";
	foreach ($toonSecProfs as $secondaryProf) {
		if (strpos ( $secondaryProf->name, 'Cataclysm Fishing') !== false) {
			$return .= "\t\t<td>".$secondaryProf->name." - ".$secondaryProf->rank."</td>\n";
		} elseif (strpos ($secondaryProf->name, 'Cataclysm Cooking') !== false) {
			$return .= "\t\t<td>".$secondaryProf->name." - ".$secondaryProf->rank."</td>\n";
		} elseif (strpos($secondaryProf->name, 'Archaeology') !== false) {
			$return .= "\t\t<td>".$secondaryProf->name." - ".$secondaryProf->rank."</td>\n";
		}
	}
	return $return;
}

function wotlkSecondaryProfs($toonSecProfs) {
	$return = "";
	foreach ($toonSecProfs as $secondaryProf) {
		if (strpos ( $secondaryProf->name, 'Northrend Fishing') !== false) {
			$return .= "\t\t<td>".$secondaryProf->name." - ".$secondaryProf->rank."</td>\n";
		} elseif (strpos ($secondaryProf->name, 'Northrend Cooking') !== false) {
			$return .= "\t\t<td>".$secondaryProf->name." - ".$secondaryProf->rank."</td>\n";
		} elseif (strpos($secondaryProf->name, 'Archaeology') !== false) {
			$return .= "\t\t<td>".$secondaryProf->name." - ".$secondaryProf->rank."</td>\n";
		}
	}
	return $return;
}

function bcSecondaryProfs($toonSecProfs) {
	$return = "";
	foreach ($toonSecProfs as $secondaryProf) {
		if (strpos ( $secondaryProf->name, 'Outland Fishing') !== false) {
			$return .= "\t\t<td>".$secondaryProf->name." - ".$secondaryProf->rank."</td>\n";
		} elseif (strpos ($secondaryProf->name, 'Outland Cooking') !== false) {
			$return .= "\t\t<td>".$secondaryProf->name." - ".$secondaryProf->rank."</td>\n";
		} elseif (strpos($secondaryProf->name, 'Archaeology') !== false) {
			$return .= "\t\t<td>".$secondaryProf->name." - ".$secondaryProf->rank."</td>\n";
		}
	}
	return $return;
}

function vanSecondaryProfs($toonSecProfs) {
	$return = "";
	foreach ($toonSecProfs as $secondaryProf) {
		if (strpos ( $secondaryProf->name, 'Kul Tiran Fishing') !== false) {
			$return .= "\t\t<td>".$secondaryProf->name." - ".$secondaryProf->rank."</td>\n";
		} elseif (strpos ($secondaryProf->name, 'Kul Tiran Cooking') !== false) {
			$return .= "\t\t<td>".$secondaryProf->name." - ".$secondaryProf->rank."</td>\n";
		} elseif (strpos($secondaryProf->name, 'Archaeology') !== false) {
			$return .= "\t\t<td>".$secondaryProf->name." - ".$secondaryProf->rank."</td>\n";
		}
	}
	return $return;
}

?>
