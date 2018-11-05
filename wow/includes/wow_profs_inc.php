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
# This will take in the $priProfs ($toon_obj->professions->primary) and spit out
# HTML table data for each expansion page
#

function bfaPrimaryProfs($priProfs) {
	$return = "";
	$priProfCount = 0;
		foreach ($priProfs as $priProf) {
			if (strpos ( $priProf->name, 'Kul Tiran') !== false) {
				if (strpos ( $priProf->name, 'Hebalism') !== false) {
					if ($priProf->rank < $priProf->max) {
						$return .= "\n\t\t<td bgcolor=\"F4E938\">".$priProf->name." - ".($priProf->max - $priProf->rank)." points left</td>";
						$priProfCount++;
					} else {
						$return .= "\n\t\t<td bgcolor=\"10AA06\"><font color=\"FFFFFF\">".$priProf->name."</font></td>";
						$priProfCount++;
					}
				} elseif (strpos ( $priProf->name, 'Mining') !== false) {
					if ($priProf->rank < $priProf->max) {
						$return .= "\n\t\t<td bgcolor=\"F4E938\">".$priProf->name." - ".($priProf->max - $priProf->rank)." points left</td>";
						$priProfCount++;
					} else {
						$return .= "\n\t\t<td bgcolor=\"10AA06\"><font color=\"FFFFFF\">".$priProf->name."</font></td>";
						$priProfCount++;
					}
				} elseif (strpos ( $priProf->name, 'Skinning') !== false) {
					if ($priProf->rank < $priProf->max) {
						$return .= "\n\t\t<td bgcolor=\"F4E938\">".$priProf->name." - ".($priProf->max - $priProf->rank)." points left</td>";
						$priProfCount++;
					} else {
						$return .= "\n\t\t<td bgcolor=\"10AA06\"><font color=\"FFFFFF\">".$priProf->name."</font></td>";
						$priProfCount++;
					}
			} elseif (strpos ( $priProf->name, 'Kul Tiran' ) !== false) {
				if ($priProf->rank < $priProf->max) {
					$return .= "\n\t\t<td bgcolor=\"F4E938\">".$priProf->name." - ".($priProf->max - $priProf->rank)." points left</td>";
					$priProfCount++;
				} else {
					$return .= "\n\t\t<td bgcolor=\"10AA06\"><font color=\"FFFFFF\">".$priProf->name."</font></td>";
					$priProfCount++;
				}
			} else {
				$return .= "\n\t\t<td bgcolor=\"000000\"> </td>";
				$priProfCount++;
			}
		}
	}
	return $return;
}

function legPrimaryProfs($priProfs) {
	$return = "";
	$priProfCount = 0;
	do {
		foreach ($priProfs as $priProf) {
			if (strpos ( $priProf->name, 'Legion') !== false) {
				if (strpos ( $priProf->name, 'Hebalism') || strpos ( $priProf->name, 'Mining') || strpos ( $priProf->name, 'Skinning') !== false) {
					if ($priProf->rank < $priProf->max) {
						$return .= "\n\t\t<td bgcolor=\"F4E938\">".$priProf->name." - ".($priProf->max - $priProf->rank)." points left</td>";
						$priProfCount++;
					} else {
						$return .= "\n\t\t<td bgcolor=\"10AA06\"><font color=\"FFFFFF\">".$priProf->name."</font></td>";
						$priProfCount++;
					}
			} elseif (strpos ( $priProf->name, 'Legion' ) !== false) {
				if ($priProf->rank < $priProf->max) {
					$return .= "\n\t\t<td bgcolor=\"F4E938\">".$priProf->name." - ".($priProf->max - $priProf->rank)." points left</td>";
					$priProfCount++;
				} else {
					$return .= "\n\t\t<td bgcolor=\"10AA06\"><font color=\"FFFFFF\">".$priProf->name."</font></td>";
					$priProfCount++;
				}
			} else {
				$return .= "\n\t\t<td bgcolor=\"000000\"> </td>";
				$priProfCount++;
			}
			}
		}
	} while ($priProfCount < 2);
	return $return;
}

function wodPrimaryProfs($priProfs) {
	$return = "";
	$priProfCount = 0;
	do {
		foreach ($priProfs as $priProf) {
			if (strpos ( $priProf->name, 'Draenor') !== false) {
				if (strpos ( $priProf->name, 'Hebalism') || strpos ( $priProf->name, 'Mining') || strpos ( $priProf->name, 'Skinning') !== false) {
					if ($priProf->rank < $priProf->max) {
						$return .= "\n\t\t<td bgcolor=\"F4E938\">".$priProf->name." - ".($priProf->max - $priProf->rank)." points left</td>";
						$priProfCount++;
					} else {
						$return .= "\n\t\t<td bgcolor=\"10AA06\"><font color=\"FFFFFF\">".$priProf->name."</font></td>";
						$priProfCount++;
					}
			} elseif (strpos ( $priProf->name, 'Draenor') !== false) {
				if ($priProf->rank < $priProf->max) {
					$return .= "\n\t\t<td bgcolor=\"F4E938\">".$priProf->name." - ".($priProf->max - $priProf->rank)." points left</td>";
					$priProfCount++;
				} else {
					$return .= "\n\t\t<td bgcolor=\"10AA06\"><font color=\"FFFFFF\">".$priProf->name."</font></td>";
					$priProfCount++;
				}
			} else {
				$return .= "\n\t\t<td bgcolor=\"000000\"> </td>";
				$priProfCount++;
			}
			}
		}
	} while ($priProfCount < 2);
	return $return;
}

function mopPrimaryProfs($priProfs) {
	$return = "";
	$priProfCount = 0;
	do {
		foreach ($priProfs as $priProf) {
			if (strpos ( $priProf->name, 'Pandaria') !== false) {
				if (strpos ( $priProf->name, 'Hebalism') || strpos ( $priProf->name, 'Mining') || strpos ( $priProf->name, 'Skinning') !== false) {
					if ($priProf->rank < $priProf->max) {
						$return .= "\n\t\t<td bgcolor=\"F4E938\">".$priProf->name." - ".($priProf->max - $priProf->rank)." points left</td>";
						$priProfCount++;
					} else {
						$return .= "\n\t\t<td bgcolor=\"10AA06\"><font color=\"FFFFFF\">".$priProf->name."</font></td>";
						$priProfCount++;
					}
			} elseif (strpos ( $priProf->name, 'Pandaria' ) !== false) {
				if ($priProf->rank < $priProf->max) {
					$return .= "\n\t\t<td bgcolor=\"F4E938\">".$priProf->name." - ".($priProf->max - $priProf->rank)." points left</td>";
					$priProfCount++;
				} else {
					$return .= "\n\t\t<td bgcolor=\"10AA06\"><font color=\"FFFFFF\">".$priProf->name."</font></td>";
					$priProfCount++;
				}
			} else {
				$return .= "\n\t\t<td bgcolor=\"000000\"> </td>";
				$priProfCount++;
			}
			}
		}
	} while ($priProfCount < 2);
	return $return;
}

function cataPrimaryProfs($priProfs) {
	$return = "";
	do {
		foreach ($priProfs as $priProf) {
			if (strpos ( $priProf->name, 'Cataclysm') !== false) {
				if (strpos ( $priProf->name, 'Hebalism') || strpos ( $priProf->name, 'Mining') || strpos ( $priProf->name, 'Skinning') !== false) {
					if ($priProf->rank < $priProf->max) {
						$return .= "\n\t\t<td bgcolor=\"F4E938\">".$priProf->name." - ".($priProf->max - $priProf->rank)." points left</td>";
						$priProfCount++;
					} else {
						$return .= "\n\t\t<td bgcolor=\"10AA06\"><font color=\"FFFFFF\">".$priProf->name."</font></td>";
						$priProfCount++;
					}
			} elseif (strpos ( $priProf->name, 'Cataclysm' ) !== false) {
				if ($priProf->rank < $priProf->max) {
					$return .= "\n\t\t<td bgcolor=\"F4E938\">".$priProf->name." - ".($priProf->max - $priProf->rank)." points left</td>";
					$priProfCount++;
				} else {
					$return .= "\n\t\t<td bgcolor=\"10AA06\"><font color=\"FFFFFF\">".$priProf->name."</font></td>";
					$priProfCount++;
				}
			} else {
				$return .= "\n\t\t<td bgcolor=\"000000\"> </td>";
				$priProfCount++;
			}
			}
		}
	} while ($priProfCount < 2);
	return $return;
}

function wotlkPrimaryProfs($priProfs) {
	$return = "";
	$priProfCount = 0;
	do {
		foreach ($priProfs as $priProf) {
			if (strpos ( $priProf->name, 'Northrend') !== false) {
				if (strpos ( $priProf->name, 'Hebalism') || strpos ( $priProf->name, 'Mining') || strpos ( $priProf->name, 'Skinning') !== false) {
					if ($priProf->rank < $priProf->max) {
						$return .= "\n\t\t<td bgcolor=\"F4E938\">".$priProf->name." - ".($priProf->max - $priProf->rank)." points left</td>";
						$priProfCount++;
					} else {
						$return .= "\n\t\t<td bgcolor=\"10AA06\"><font color=\"FFFFFF\">".$priProf->name."</font></td>";
						$priProfCount++;
					}
			} elseif (strpos ( $priProf->name, 'Northrend' ) !== false) {
				if ($priProf->rank < $priProf->max) {
					$return .= "\n\t\t<td bgcolor=\"F4E938\">".$priProf->name." - ".($priProf->max - $priProf->rank)." points left</td>";
					$priProfCount++;
				} else {
					$return .= "\n\t\t<td bgcolor=\"10AA06\"><font color=\"FFFFFF\">".$priProf->name."</font></td>";
					$priProfCount++;
				}
			} else {
				$return .= "\n\t\t<td bgcolor=\"000000\"> </td>";
				$priProfCount++;
			}
			}
		}
	} while ($priProfCount < 2);
	return $return;
}

function bcPrimaryProfs($priProfs) {
	$return = "";
	$priProfCount = 0;
	do {
		foreach ($priProfs as $priProf) {
			if (strpos ( $priProf->name, 'Outland') !== false) {
				if (strpos ( $priProf->name, 'Hebalism') || strpos ( $priProf->name, 'Mining') || strpos ( $priProf->name, 'Skinning') !== false) {
					if ($priProf->rank < $priProf->max) {
						$return .= "\n\t\t<td bgcolor=\"F4E938\">".$priProf->name." - ".($priProf->max - $priProf->rank)." points left</td>";
						$priProfCount++;
					} else {
						$return .= "\n\t\t<td bgcolor=\"10AA06\"><font color=\"FFFFFF\">".$priProf->name."</font></td>";
						$priProfCount++;
					}
			} elseif (strpos ( $priProf->name, 'Outland' ) !== false) {
				if ($priProf->rank < $priProf->max) {
					$return .= "\n\t\t<td bgcolor=\"F4E938\">".$priProf->name." - ".($priProf->max - $priProf->rank)." points left</td>";
					$priProfCount++;
				} else {
					$return .= "\n\t\t<td bgcolor=\"10AA06\"><font color=\"FFFFFF\">".$priProf->name."</font></td>";
					$priProfCount++;
				}
			} else {
				$return .= "\n\t\t<td bgcolor=\"000000\"> </td>";
				$priProfCount++;
			}
			}
		}
	} while ($priProfCount < 2);
	return $return;
}

function vanPrimaryProfs($priProfs) {
}

# Secondary Professions Functions
#
# This section will take expansion based secondary Professions data
# and spit out table data.
# NOTE: Archeology is *not* seperated by exapnsion.
function bfaSecondaryProfs($toonSecProfs) {
	$fishing = "\r\t\t<td bgcolor=\"000000\"><font color=\"FFFFFF\">Not Active</font></td>";
	$cooking = "\r\t\t<td bgcolor=\"000000\"><font color=\"FFFFFF\">Not Active</font></td>";
	$archaeology = "\r\t\t<td bgcolor=\"000000\"><font color=\"FFFFFF\">Not Active</font></td>";
	foreach ($toonSecProfs as $secProf) {
		if (strpos ( $secProf->name, 'Kul Tiran Fishing') !== false) {
				if ($secProf->rank < $secProf->max) {
					$fishing = "\n\t\t<td bgcolor=\"F4E938\">".($secProf->max - $secProf->rank)." points left</td>";
				} else {
					$fishing = "\n\t\t<td bgcolor=\"10AA06\"><font color=\"FFFFFF\">".$secProf->name."</font></td>";
				}
		} elseif (strpos ($secProf->name, 'Kul Tiran Cooking') !== false) {
				if ($secProf->rank < $secProf->max) {
					$cooking = "\n\t\t<td bgcolor=\"F4E938\">".($secProf->max - $secProf->rank)." points left</td>";
				} else {
					$cooking = "\n\t\t<td bgcolor=\"10AA06\"><font color=\"FFFFFF\">".$secProf->name."</font></td>";
				}
		} elseif (strpos($secProf->name, 'Archaeology') !== false) {
			if ($secProf->rank < $secProf->max) {
				$archaeology = "\n\t\t<td bgcolor=\"F4E938\">".($secProf->max - $secProf->rank)." points left</td>";
			} else {
				$archaeology = "\n\t\t<td bgcolor=\"10AA06\"><font color=\"FFFFFF\">".$secProf->name."</font></td>";
			}
		}
	}
	return $cooking.$fishing.$archaeology;
}

function legSecondaryProfs($toonSecProfs) {
	$fishing = "\r\t\t<td bgcolor=\"000000\"><font color=\"FFFFFF\">Not Active</font></td>";
	$cooking = "\r\t\t<td bgcolor=\"000000\"><font color=\"FFFFFF\">Not Active</font></td>";
	$archaeology = "\r\t\t<td bgcolor=\"000000\"><font color=\"FFFFFF\">Not Active</font></td>";
	foreach ($toonSecProfs as $secProf) {
		if (strpos ( $secProf->name, 'Legion Fishing') !== false) {
				if ($secProf->rank < $secProf->max) {
					$fishing = "\n\t\t<td bgcolor=\"F4E938\">".($secProf->max - $secProf->rank)." points left</td>";
				} else {
					$fishing = "\n\t\t<td bgcolor=\"10AA06\"><font color=\"FFFFFF\">".$secProf->name."</font></td>";
				}
		} elseif (strpos ($secProf->name, 'Legion Cooking') !== false) {
				if ($secProf->rank < $secProf->max) {
					$cooking = "\n\t\t<td bgcolor=\"F4E938\">".($secProf->max - $secProf->rank)." points left</td>";
				} else {
					$cooking = "\n\t\t<td bgcolor=\"10AA06\"><font color=\"FFFFFF\">".$secProf->name."</font></td>";
				}
		} elseif (strpos($secProf->name, 'Archaeology') !== false) {
			if ($secProf->rank < $secProf->max) {
				$archaeology = "\n\t\t<td bgcolor=\"F4E938\">".($secProf->max - $secProf->rank)." points left</td>";
			} else {
				$archaeology = "\n\t\t<td bgcolor=\"10AA06\"><font color=\"FFFFFF\">".$secProf->name."</font></td>";
			}
		}
	}
	return $fishing.$cooking.$archaeology;
}

function wodSecondaryProfs($toonSecProfs) {
	$fishing = "\r\t\t<td bgcolor=\"000000\"><font color=\"FFFFFF\">Not Active</font></td>";
	$cooking = "\r\t\t<td bgcolor=\"000000\"><font color=\"FFFFFF\">Not Active</font></td>";
	$archaeology = "\r\t\t<td bgcolor=\"000000\"><font color=\"FFFFFF\">Not Active</font></td>";
	foreach ($toonSecProfs as $secProf) {
		if (strpos ( $secProf->name, 'Draenor Fishing') !== false) {
				if ($secProf->rank < $secProf->max) {
					$fishing = "\n\t\t<td bgcolor=\"F4E938\">".($secProf->max - $secProf->rank)." points left</td>";
					$priProfCount++;
				} else {
					$fishing = "\n\t\t<td bgcolor=\"10AA06\"><font color=\"FFFFFF\">".$secProf->name."</font></td>";
					$priProfCount++;
				}
		} elseif (strpos ($secProf->name, 'Draenor Cooking') !== false) {
				if ($secProf->rank < $secProf->max) {
					$cooking = "\n\t\t<td bgcolor=\"F4E938\">".($secProf->max - $secProf->rank)." points left</td>";
					$priProfCount++;
				} else {
					$cooking = "\n\t\t<td bgcolor=\"10AA06\"><font color=\"FFFFFF\">".$secProf->name."</font></td>";
					$priProfCount++;
				}
		} elseif (strpos($secProf->name, 'Archaeology') !== false) {
			if ($secProf->rank < $secProf->max) {
				$archaeology = "\n\t\t<td bgcolor=\"F4E938\">".($secProf->max - $secProf->rank)." points left</td>";
				$priProfCount++;
			} else {
				$archaeology = "\n\t\t<td bgcolor=\"10AA06\"><font color=\"FFFFFF\">".$secProf->name."</font></td>";
				$priProfCount++;
			}
		}
	}
	return $fishing.$cooking.$archaeology;
}

function mopSecondaryProfs($toonSecProfs) {
	$fishing = "\r\t\t<td bgcolor=\"000000\"><font color=\"FFFFFF\">Not Active</font></td>";
	$cooking = "\r\t\t<td bgcolor=\"000000\"><font color=\"FFFFFF\">Not Active</font></td>";
	$archaeology = "\r\t\t<td bgcolor=\"000000\"><font color=\"FFFFFF\">Not Active</font></td>";
	foreach ($toonSecProfs as $secProf) {
		if (strpos ( $secProf->name, 'Pandaria Fishing') !== false) {
				if ($secProf->rank < $secProf->max) {
					$fishing = "\n\t\t<td bgcolor=\"F4E938\">".($secProf->max - $secProf->rank)." points left</td>";
				} else {
					$fishing = "\n\t\t<td bgcolor=\"10AA06\"><font color=\"FFFFFF\">".$secProf->name."</font></td>";
				}
		} elseif (strpos ($secProf->name, 'Pandaria Cooking') !== false) {
				if ($secProf->rank < $secProf->max) {
					$cooking = "\n\t\t<td bgcolor=\"F4E938\">".($secProf->max - $secProf->rank)." points left</td>";
				} else {
					$cooking = "\n\t\t<td bgcolor=\"10AA06\"><font color=\"FFFFFF\">".$secProf->name."</font></td>";
				}
		} elseif (strpos($secProf->name, 'Archaeology') !== false) {
			if ($secProf->rank < $secProf->max) {
				$archaeology = "\n\t\t<td bgcolor=\"F4E938\">".($secProf->max - $secProf->rank)." points left</td>";
			} else {
				$archaeology = "\n\t\t<td bgcolor=\"10AA06\"><font color=\"FFFFFF\">".$secProf->name."</font></td>";
			}
		}
	}
	return $cooking.$fishing.$archaeology;
}

function cataSecondaryProfs($toonSecProfs) {
}
	$fishing = "\r\t\t<td bgcolor=\"000000\"><font color=\"FFFFFF\">Not Active</font></td>";
	$cooking = "\r\t\t<td bgcolor=\"000000\"><font color=\"FFFFFF\">Not Active</font></td>";
	$archaeology = "\r\t\t<td bgcolor=\"000000\"><font color=\"FFFFFF\">Not Active</font></td>";
	foreach ($toonSecProfs as $secProf) {
		if (strpos ( $secProf->name, 'Cataclysm Fishing') !== false) {
				if ($secProf->rank < $secProf->max) {
					$fishing = "\n\t\t<td bgcolor=\"F4E938\">".($secProf->max - $secProf->rank)." points left</td>";
				} else {
					$fishing = "\n\t\t<td bgcolor=\"10AA06\"><font color=\"FFFFFF\">".$secProf->name."</font></td>";
				}
		} elseif (strpos ($secProf->name, 'Cataclysm Cooking') !== false) {
				if ($secProf->rank < $secProf->max) {
					$cooking = "\n\t\t<td bgcolor=\"F4E938\">".($secProf->max - $secProf->rank)." points left</td>";
				} else {
					$cooking = "\n\t\t<td bgcolor=\"10AA06\"><font color=\"FFFFFF\">".$secProf->name."</font></td>";
				}
		} elseif (strpos($secProf->name, 'Archaeology') !== false) {
			if ($secProf->rank < $secProf->max) {
				$archaeology = "\n\t\t<td bgcolor=\"F4E938\">".($secProf->max - $secProf->rank)." points left</td>";
			} else {
				$archaeology = "\n\t\t<td bgcolor=\"10AA06\"><font color=\"FFFFFF\">".$secProf->name."</font></td>";
			}
		}
	}
	return $cooking.$fishing.$archaeology;

function wotlkSecondaryProfs($toonSecProfs) {
	$fishing = "\r\t\t<td bgcolor=\"000000\"><font color=\"FFFFFF\">Not Active</font></td>";
	$cooking = "\r\t\t<td bgcolor=\"000000\"><font color=\"FFFFFF\">Not Active</font></td>";
	$archaeology = "\r\t\t<td bgcolor=\"000000\"><font color=\"FFFFFF\">Not Active</font></td>";
	foreach ($toonSecProfs as $secProf) {
		if (strpos ( $secProf->name, 'Northrend Fishing') !== false) {
				if ($secProf->rank < $secProf->max) {
					$fishing = "\n\t\t<td bgcolor=\"F4E938\">".($secProf->max - $secProf->rank)." points left</td>";
				} else {
					$fishing = "\n\t\t<td bgcolor=\"10AA06\"><font color=\"FFFFFF\">".$secProf->name."</font></td>";
				}
		} elseif (strpos ($secProf->name, 'Northrend Cooking') !== false) {
				if ($secProf->rank < $secProf->max) {
					$cooking = "\n\t\t<td bgcolor=\"F4E938\">".($secProf->max - $secProf->rank)." points left</td>";
				} else {
					$cooking = "\n\t\t<td bgcolor=\"10AA06\"><font color=\"FFFFFF\">".$secProf->name."</font></td>";
				}
		} elseif (strpos($secProf->name, 'Archaeology') !== false) {
			if ($secProf->rank < $secProf->max) {
				$archaeology = "\n\t\t<td bgcolor=\"F4E938\">".($secProf->max - $secProf->rank)." points left</td>";
			} else {
				$archaeology = "\n\t\t<td bgcolor=\"10AA06\"><font color=\"FFFFFF\">".$secProf->name."</font></td>";
			}
		}
	}
	return $cooking.$fishing.$archaeology;
}

function bcSecondaryProfs($toonSecProfs) {
	$fishing = "\r\t\t<td bgcolor=\"000000\"><font color=\"FFFFFF\">Not Active</font></td>";
	$cooking = "\r\t\t<td bgcolor=\"000000\"><font color=\"FFFFFF\">Not Active</font></td>";
	$archaeology = "\r\t\t<td bgcolor=\"000000\"><font color=\"FFFFFF\">Not Active</font></td>";
	foreach ($toonSecProfs as $secProf) {
		if (strpos ( $secProf->name, 'Outland Fishing') !== false) {
				if ($secProf->rank < $secProf->max) {
					$fishing = "\n\t\t<td bgcolor=\"F4E938\">".($secProf->max - $secProf->rank)." points left</td>";
				} else {
					$fishing = "\n\t\t<td bgcolor=\"10AA06\"><font color=\"FFFFFF\">".$secProf->name."</font></td>";
				}
		} elseif (strpos ($secProf->name, 'Outland Cooking') !== false) {
				if ($secProf->rank < $secProf->max) {
					$cooking = "\n\t\t<td bgcolor=\"F4E938\">".($secProf->max - $secProf->rank)." points left</td>";
				} else {
					$cooking = "\n\t\t<td bgcolor=\"10AA06\"><font color=\"FFFFFF\">".$secProf->name."</font></td>";
				}
		} elseif (strpos($secProf->name, 'Archaeology') !== false) {
			if ($secProf->rank < $secProf->max) {
				$archaeology = "\n\t\t<td bgcolor=\"F4E938\">".($secProf->max - $secProf->rank)." points left</td>";
			} else {
				$archaeology = "\n\t\t<td bgcolor=\"10AA06\"><font color=\"FFFFFF\">".$secProf->name."</font></td>";
			}
		}
	}
	return $cooking.$fishing.$archaeology;
}

function vanSecondaryProfs($toonSecProfs) {
}

?>
