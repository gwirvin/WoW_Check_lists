<?php

$userFetchOauthSql = ("SELECT oauth_token, oauth_code FROM oauth_session WHERE oauth_user=\"".$userId."\"");
$userUpdateOauthSql = ("UPDATE oauth_session SET oauth_token=\"".$myOauthToken['access_token'].", oauth_code=\"".$someThing."\" WHERE oauth_user=\"".$userId."\"");


?>
