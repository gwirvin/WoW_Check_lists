<?php

/* file: wow_realms_inc.php
 *
 * Creating the option list of realms for adding toons
 *
 * */

function wowRealmList ($realmsUrl) {
	$realmSelectHtml = "";
	$realmsObject = json_decode(file_get_contents($realmsUrl));
	$realmsCount = count($realmsObject->realms);
	for ( $realmsCounter = 0; $realmsCounter < $realmsCount; $realmsCounter++) {
		$realmName = $realmsObject->realms[$realmsCounter]->name;
		$realmSlug = $realmsObject->realms[$realmsCounter]->slug;
//	foreach ($realmsObject->realms as $realmsValue) {
//		$realmName = $realmsValue->name;
//		$realmSlug = $realmsValue->slug;
		$realmSelectHtml .= "\r\n\t\t\t\t<option value=\"".$realmSlug."\">".$realmName."</option>";
	}
	return $realmSelectHtml;
}

?>
