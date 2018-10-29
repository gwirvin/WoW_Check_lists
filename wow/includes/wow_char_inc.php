<?php
/** file: wow_char_inc.php 
 * All we are doing here is getting the character object
 * from the Blizzard WOW API.
 * There are other fields that might be of more interest
 * for raiders (i.e. audit to see unenchanted/ungemmed gear)
 * but I have no interest in that for a simple next expansion 
 * ready check list.
 * The other fields can be found at:
 * https://dev.battle.net/io-docs **/
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

function getUserToons ($userId, $dbHost, $dbUser, $dbPass, $dbWow) {
	$mysqli = new mysqli($dbHost, $dbUser, $dbPass, $dbWow);
	$myArray = array();
	$toon_sql = ("SELECT toon_name, toon_realm FROM toon WHERE toon_owner=\"1\" ORDER BY toon_realm, toon_name");
	if ($result = $mysqli->query($toon_sql)) {
		while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
			$myArray[] = $row;
		}
	$myArray = json_decode(json_encode($myArray));
	return $myArray;
	}
	$result->close();
	$mysqli->close();
}

function toonUrlArray ($allUserToons, $wow_url, $wowFields, $api_key) {
	$urlArray = array ();
	foreach ($allUserToons as $toon) {
		$urlArray[] = $wow_url."character/".$toon->toon_realm."/".$toon->toon_name.$wowFields.$api_key;
	}
	return $urlArray;
}

?>
