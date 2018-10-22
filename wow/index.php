<?php
include "../cats.php";
include "includes/blz_oauth_inc.php";
print_r($SESSION);
$oauthToken = getOauthToken($blizzardOauthUrl);
array_push($_SESSION, $oauthToken);
print "\n";
print_r($_SESSION);
?>
