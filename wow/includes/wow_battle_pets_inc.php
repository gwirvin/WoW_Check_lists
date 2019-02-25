<?php

/** file: wow_battle_pets_inc.php
 *
 * Functions to do pet magic
 * **/

#function to compare arrays of pet objects
function comparePets($allPets, $toonPets)
{
	return $allPets->creatureId - $toonPets->creatureId;
}

# Function to return links to WOWHead of missing pets
function getMissingPets ($diffPets)
{
	foreach ($diffPets as $missingPets)
	{
		return "<a href=\"https://www.wowhead.com/npc=".$missingPets->creatureId."\" target=\"_blank\">".$missingPets->name."</a>\n";
	}
}

?>
