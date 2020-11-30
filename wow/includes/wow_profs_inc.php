<?php
############################# FILE: wow_profs_inc.php ###################
##
# Grouping of functions based on how blizzard split out professions.#
# We will be gathering data on Primary and Seconday Professions and #
# using that data to populate the "Checklist" for each expansion now#
# that Blizzard has seperated professions by expansion. Each return#
# should show either complete, or currnet rank in each profession.#
# #
# NOTE: I have attempted to put some order to the return, as much as #
# possible. From Primary professions, Gathering should always be in the #
# first slot on the return. For secondary, I tried to make Archaeology#
# return last, but all my tests have shown it to return second after#
# Fishing. I do not yet know why.#
#########################################################################
/* STARTING PRIMARY PROFESSIONS HERE */
function slPrimaryProfs ($toonProfsObj) {
		$return = "";
		$priProfsCount = count($toonProfsObj->primaries);
		$priProfsCounter = 0;
		$gathering = "";
		$production ="";
		$herbalism = "";
		$priProfsHtml = "";
		for ($priProfsCounter = 0; $priProfsCounter < $priProfsCount; $priProfsCounter++) {
			if ($toonProfsObj->primaries[$priProfsCounter]->profession->id == 164 || $toonProfsObj->primaries[$priProfsCounter]->profession->id == 165 || $toonProfsObj->primaries[$priProfsCounter]->profession->id == 171 || $toonProfsObj->primaries[$priProfsCounter]->profession->id == 197 || $toonProfsObj->primaries[$priProfsCounter]->profession->id == 202 || $toonProfsObj->primaries[$priProfsCounter]->profession->id == 333 || $toonProfsObj->primaries[$priProfsCounter]->profession->id == 755 || $toonProfsObj->primaries[$priProfsCounter]->profession->id == 773 || $toonProfsObj->primaries[$priProfsCounter]->profession->id == 182 || $toonProfsObj->primaries[$priProfsCounter]->profession->id == 186 || $toonProfsObj->primaries[$priProfsCounter]->profession->id == 393) {
				if ($toonProfsObj->primaries[$priProfsCounter]->tiers[8]->skill_points < $toonProfsObj->primaries[$priProfsCounter]->tiers[8]->max_skill_points) {
					$priProfsHtml .= "\n\t\t<td bgcolor=\"F4E938\">".($toonProfsObj->primaries[$priProfsCounter]->tiers[8]->max_skill_points - $toonProfsObj->primaries[$priProfsCounter]->tiers[8]->skill_points)." points left in ".$toonProfsObj->primaries[$priProfsCounter]->tiers[8]->tier->name."</td>"; }
				elseif ($toonProfsObj->primaries[$priProfsCounter]->tiers[8]->skill_points >= $toonProfsObj->primaries[$priProfsCounter]->tiers[8]->max_skill_points) {
					$priProfsHtml .= "\n\t\t<td bgcolor=\"10AA06\"><font color=\"FFFFFF\">".$toonProfsObj->primaries[$priProfsCounter]->tiers[8]->tier->name." maxed</font></td>"; }
				else {
					$priProfsHtml .= "\r\t\t<td bgcolor=\"000000\"><font color=\"FFFFFF\">Not Active</font></td>"; }
			}
		}
		/*return $gathering.$production;*/return $priProfsHtml; }

function slSecondaryProfs ($toonProfsObj) {
		$secProfsCount = count($toonProfsObj->secondaries);
		$return = "";
	$cooking = "";
	$fishing = "";
	$archaeology = "";
		$secProfsCounter = 0;
		for ($secProfsCounter = 0; $secProfsCounter < $secProfsCount; $secProfsCounter++) {
			if ($toonProfsObj->secondaries[$secProfsCounter]->profession->id == 185) {
				$secProfsTierCount = count($toonProfsObj->secondaries[$secProfsCounter]->tiers);
				if ($toonProfsObj->secondaries[$secProfsCounter]->tiers[8]->skill_points < $toonProfsObj->secondaries[$secProfsCounter]->tiers[8]->max_skill_points) {
					$cooking = "\n\t\t<td bgcolor=\"F4E938\">".($toonProfsObj->secondaries[$secProfsCounter]->tiers[8]->max_skill_points - $toonProfsObj->secondaries[$secProfsCounter]->tiers[8]->skill_points)." points left in ".$toonProfsObj->secondaries[$secProfsCounter]->tiers[8]->tier->name."</td>\r"; }
				elseif ($toonProfsObj->secondaries[$secProfsCounter]->tiers[8]->skill_points >= $toonProfsObj->secondaries[$secProfsCounter]->tiers[8]->max_skill_points){
					$cooking = "\n\t\t<td bgcolor=\"10AA06\"><font color=\"FFFFFF\">".$toonProfsObj->secondaries[$secProfsCounter]->tiers[8]->tier->name." maxed</font></td>"; }
				else {
					$cooking = "\r\t\t<td bgcolor=\"000000\"><font color=\"FFFFFF\">Cooking - Not Active</font></td>"; }
				}/* $return .= $cooking;*/
			}
		for ($secProfsCounter = 0; $secProfsCounter < $secProfsCount; $secProfsCounter++) {
			if ($toonProfsObj->secondaries[$secProfsCounter]->profession->id == 356) {
			$secProfsTierCount = count($toonProfsObj->secondaries[$secProfsCounter]->tiers);
					if ($toonProfsObj->secondaries[$secProfsCounter]->tiers[8]->skill_points < $toonProfsObj->secondaries[$secProfsCounter]->tiers[8]->max_skill_points) {
						$fishing = "\n\t\t<td bgcolor=\"F4E938\">".($toonProfsObj->secondaries[$secProfsCounter]->tiers[8]->max_skill_points - $toonProfsObj->secondaries[$secProfsCounter]->tiers[8]->skill_points)." points left in ".$toonProfsObj->secondaries[$secProfsCounter]->tiers[8]->tier->name."</td>\r"; }
						elseif ($toonProfsObj->secondaries[$secProfsCounter]->tiers[8]->skill_points >= $toonProfsObj->secondaries[$secProfsCounter]->tiers[8]->max_skill_points){
						$fishing = "\n\t\t<td bgcolor=\"10AA06\"><font color=\"FFFFFF\">".$toonProfsObj->secondaries[$secProfsCounter]->tiers[8]->tier->name." maxed</font></td>"; }
						else {
							$fishing = "\r\t\t<td bgcolor=\"000000\"><font color=\"FFFFFF\">Fishing - Not Active</font></td>"; }
					}/* $return .= $fishing;*/
				}
		for ($secProfsCounter = 0; $secProfsCounter < $secProfsCount; $secProfsCounter++) {
			if ($toonProfsObj->secondaries[$secProfsCounter]->profession->id == 794) {
				if ($toonProfsObj->secondaries[$secProfsCounter]->skill_points < $toonProfsObj->secondaries[$secProfsCounter]->max_skill_points) {
					$archaeology = "\n\t\t<td bgcolor=\"F4E938\">".($toonProfsObj->secondaries[$secProfsCounter]->max_skill_points - $toonProfsObj->secondaries[$secProfsCounter]->skill_points)." points left in ".$toonProfsObj->secondaries[$secProfsCounter]->profession->name."</td>"; }
				elseif ($toonProfsObj->secondaries[$secProfsCounter]->skill_points >= $toonProfsObj->secondaries[$secProfsCounter]->max_skill_points) {
					$archaeology = "\n\t\t<td bgcolor=\"10AA06\"><font color=\"FFFFFF\">".$toonProfsObj->secondaries[$secProfsCounter]->profession->name."</font></td>"; }
				else {
					$archaeology = "\r\t\t<td bgcolor=\"000000\"><font color=\"FFFFFF\">Archaeology - Not Active</font></td>"; }
				/*$return .= $archaeology; */}
			}
		return $cooking.$fishing.$archaeology;
		}

function bfaPrimaryProfs ($toonProfsObj) {
		$return = "";
		$priProfsCount = count($toonProfsObj->primaries);
		$priProfsCounter = 0;
		$gathering = "";
		$production ="";
		$herbalism = "";
		$priProfsHtml = "";
		for ($priProfsCounter = 0; $priProfsCounter < $priProfsCount; $priProfsCounter++) {
			if ($toonProfsObj->primaries[$priProfsCounter]->profession->id == 164 || $toonProfsObj->primaries[$priProfsCounter]->profession->id == 165 || $toonProfsObj->primaries[$priProfsCounter]->profession->id == 171 || $toonProfsObj->primaries[$priProfsCounter]->profession->id == 197 || $toonProfsObj->primaries[$priProfsCounter]->profession->id == 202 || $toonProfsObj->primaries[$priProfsCounter]->profession->id == 333 || $toonProfsObj->primaries[$priProfsCounter]->profession->id == 755 || $toonProfsObj->primaries[$priProfsCounter]->profession->id == 773 || $toonProfsObj->primaries[$priProfsCounter]->profession->id == 182 || $toonProfsObj->primaries[$priProfsCounter]->profession->id == 186 || $toonProfsObj->primaries[$priProfsCounter]->profession->id == 393) {
				if ($toonProfsObj->primaries[$priProfsCounter]->tiers[0]->skill_points < $toonProfsObj->primaries[$priProfsCounter]->tiers[0]->max_skill_points) {
					$priProfsHtml .= "\n\t\t<td bgcolor=\"F4E938\">".($toonProfsObj->primaries[$priProfsCounter]->tiers[0]->max_skill_points - $toonProfsObj->primaries[$priProfsCounter]->tiers[0]->skill_points)." points left in ".$toonProfsObj->primaries[$priProfsCounter]->tiers[0]->tier->name."</td>"; }
				elseif ($toonProfsObj->primaries[$priProfsCounter]->tiers[0]->skill_points >= $toonProfsObj->primaries[$priProfsCounter]->tiers[0]->max_skill_points) {
					$priProfsHtml .= "\n\t\t<td bgcolor=\"10AA06\"><font color=\"FFFFFF\">".$toonProfsObj->primaries[$priProfsCounter]->tiers[0]->tier->name." maxed</font></td>"; }
				else {
					$priProfsHtml .= "\r\t\t<td bgcolor=\"000000\"><font color=\"FFFFFF\">Not Active</font></td>"; }
			}
		}
		/*return $gathering.$production;*/return $priProfsHtml; }


/* Starting Secondary Professions HERE */
function bfaSecondaryProfs ($toonProfsObj) {
		$secProfsCount = count($toonProfsObj->secondaries);
		$return = "";
	$cooking = "";
	$fishing = "";
	$archaeology = "";
		$secProfsCounter = 0;
		for ($secProfsCounter = 0; $secProfsCounter < $secProfsCount; $secProfsCounter++) {
			if ($toonProfsObj->secondaries[$secProfsCounter]->profession->id == 185) {
				$secProfsTierCount = count($toonProfsObj->secondaries[$secProfsCounter]->tiers);
				if ($toonProfsObj->secondaries[$secProfsCounter]->tiers[0]->skill_points < $toonProfsObj->secondaries[$secProfsCounter]->tiers[0]->max_skill_points) {
					$cooking = "\n\t\t<td bgcolor=\"F4E938\">".($toonProfsObj->secondaries[$secProfsCounter]->tiers[0]->max_skill_points - $toonProfsObj->secondaries[$secProfsCounter]->tiers[0]->skill_points)." points left in ".$toonProfsObj->secondaries[$secProfsCounter]->tiers[0]->tier->name."</td>\r"; }
				elseif ($toonProfsObj->secondaries[$secProfsCounter]->tiers[0]->skill_points >= $toonProfsObj->secondaries[$secProfsCounter]->tiers[0]->max_skill_points){
					$cooking = "\n\t\t<td bgcolor=\"10AA06\"><font color=\"FFFFFF\">".$toonProfsObj->secondaries[$secProfsCounter]->tiers[0]->tier->name." maxed</font></td>"; }
				else {
					$cooking = "\r\t\t<td bgcolor=\"000000\"><font color=\"FFFFFF\">Cooking - Not Active</font></td>"; }
				}/* $return .= $cooking;*/
			}
		for ($secProfsCounter = 0; $secProfsCounter < $secProfsCount; $secProfsCounter++) {
			if ($toonProfsObj->secondaries[$secProfsCounter]->profession->id == 356) {
			$secProfsTierCount = count($toonProfsObj->secondaries[$secProfsCounter]->tiers);
					if ($toonProfsObj->secondaries[$secProfsCounter]->tiers[0]->skill_points < $toonProfsObj->secondaries[$secProfsCounter]->tiers[0]->max_skill_points) {
						$fishing = "\n\t\t<td bgcolor=\"F4E938\">".($toonProfsObj->secondaries[$secProfsCounter]->tiers[0]->max_skill_points - $toonProfsObj->secondaries[$secProfsCounter]->tiers[0]->skill_points)." points left in ".$toonProfsObj->secondaries[$secProfsCounter]->tiers[0]->tier->name."</td>\r"; }
						elseif ($toonProfsObj->secondaries[$secProfsCounter]->tiers[0]->skill_points >= $toonProfsObj->secondaries[$secProfsCounter]->tiers[0]->max_skill_points){
						$fishing = "\n\t\t<td bgcolor=\"10AA06\"><font color=\"FFFFFF\">".$toonProfsObj->secondaries[$secProfsCounter]->tiers[0]->tier->name." maxed</font></td>"; }
						else {
							$fishing = "\r\t\t<td bgcolor=\"000000\"><font color=\"FFFFFF\">Fishing - Not Active</font></td>"; }
					}/* $return .= $fishing;*/
				}
		for ($secProfsCounter = 0; $secProfsCounter < $secProfsCount; $secProfsCounter++) {
			if ($toonProfsObj->secondaries[$secProfsCounter]->profession->id == 794) {
				if ($toonProfsObj->secondaries[$secProfsCounter]->skill_points < $toonProfsObj->secondaries[$secProfsCounter]->max_skill_points) {
					$archaeology = "\n\t\t<td bgcolor=\"F4E938\">".($toonProfsObj->secondaries[$secProfsCounter]->max_skill_points - $toonProfsObj->secondaries[$secProfsCounter]->skill_points)." points left in ".$toonProfsObj->secondaries[$secProfsCounter]->profession->name."</td>"; }
				elseif ($toonProfsObj->secondaries[$secProfsCounter]->skill_points >= $toonProfsObj->secondaries[$secProfsCounter]->max_skill_points) {
					$archaeology = "\n\t\t<td bgcolor=\"10AA06\"><font color=\"FFFFFF\">".$toonProfsObj->secondaries[$secProfsCounter]->profession->name."</font></td>"; }
				else {
					$archaeology = "\r\t\t<td bgcolor=\"000000\"><font color=\"FFFFFF\">Archaeology - Not Active</font></td>"; }
				/*$return .= $archaeology; */}
			}
		return $cooking.$fishing.$archaeology;
		}

function darkmoonProfs (toonProfsObj)
{
		$return = "";
		$priProfsCount = count($toonProfsObj->primaries);
		$priProfsCounter = 0;
		$gathering = "";
		$production ="";
		$herbalism = "";
		$priProfsHtml = "";
		for ($priProfsCounter = 0; $priProfsCounter < $priProfsCount; $priProfsCounter++) {
			if ($toonProfsObj->primaries[$priProfsCounter]->profession->id == 164 || $toonProfsObj->primaries[$priProfsCounter]->profession->id == 165 || $toonProfsObj->primaries[$priProfsCounter]->profession->id == 171 || $toonProfsObj->primaries[$priProfsCounter]->profession->id == 197 || $toonProfsObj->primaries[$priProfsCounter]->profession->id == 202 || $toonProfsObj->primaries[$priProfsCounter]->profession->id == 333 || $toonProfsObj->primaries[$priProfsCounter]->profession->id == 755 || $toonProfsObj->primaries[$priProfsCounter]->profession->id == 773 || $toonProfsObj->primaries[$priProfsCounter]->profession->id == 182 || $toonProfsObj->primaries[$priProfsCounter]->profession->id == 186 || $toonProfsObj->primaries[$priProfsCounter]->profession->id == 393) {
				if ($toonProfsObj->primaries[$priProfsCounter]->tiers[0]->skill_points < $toonProfsObj->primaries[$priProfsCounter]->tiers[0]->max_skill_points) {
					$priProfsHtml .= "\n\t\t<td bgcolor=\"F4E938\">".($toonProfsObj->primaries[$priProfsCounter]->tiers[0]->max_skill_points - $toonProfsObj->primaries[$priProfsCounter]->tiers[0]->skill_points)." points left in ".$toonProfsObj->primaries[$priProfsCounter]->tiers[0]->tier->name."</td>"; }
				elseif ($toonProfsObj->primaries[$priProfsCounter]->tiers[0]->skill_points >= $toonProfsObj->primaries[$priProfsCounter]->tiers[0]->max_skill_points) {
					$priProfsHtml .= "\n\t\t<td bgcolor=\"10AA06\"><font color=\"FFFFFF\">".$toonProfsObj->primaries[$priProfsCounter]->tiers[0]->tier->name." maxed</font></td>"; }
				else {
					$priProfsHtml .= "\r\t\t<td bgcolor=\"000000\"><font color=\"FFFFFF\">Not Active</font></td>"; }
			}
		}
}
?>
