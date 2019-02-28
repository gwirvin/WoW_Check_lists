<?php

/* file: wow_realms_inc.php
 *
 * Creating the option list of realms for adding toons
 *
 * */

function wowRealmList ($realmsUrl) {
	$realmSelect = "";
	$realmsObject = json_decode(file_get_contents($realmsUrl));
	foreach ($realmsObject->realms as $realmsValue) {
		$realmName = $realms_value->name;
		$realmSlug = $realms_value->slug;
		$realmSelectHtml .= "\r\n\t\t\t\t<option value=\"".$realmSlug."\">".$realmName."</option>";
	}
	return $realmSelect;
}

?>
