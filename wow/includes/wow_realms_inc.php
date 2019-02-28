<?php

/* file: wow_realms_inc.php
 *
 * Creating the option list of realms for adding toons
 *
 * */

function wowRealmList ($realmsUrl) {
	$realmSelect = "";
	foreach ($realmsObject->realms as $realmsValue) {
		$realmName = $realms_value->name;
		$realmSlug = $realms_value->slug;
		$realmSelectHtml .= "\r\n\t\t\t\t<option value=\"".$realm_slug."\">".$realm_name."</option>";
	}
	return $realmSelect;
}

?>
