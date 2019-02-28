<?php

/* file: wow_realms_inc.php
 *
 * Creating the option list of realms for adding toons
 *
 * */

function wowRealmList ($realmsUrl) {
	$realmSelectHtml = "";
	$realmsObject = json_decode(file_get_contents($realmsUrl));
	foreach ($realmsObject->realms as $realmsValue) {
		$realmName = $realmsValue->name;
		$realmSlug = $realmsValue->slug;
		$realmSelectHtml .= "\r\n\t\t\t\t<option value=\"".$realmSlug."\">".$realmName."</option>";
	}
	return $realmSelectHtml;
}

?>
