<?php
/**
*
*	version 1.4

*/
// Initialize the session
session_start();
// If session variable is not set it will redirect to login page
if(!isset($_SESSION['user_email']) || empty($_SESSION['user_email'])){
  header("location: /login.php");
  exit;
}
error_reporting(E_ALL);
 ini_set('display_errors', 1);


require_once('Client.php');
require_once('GrantType/IGrantType.php');
require_once('GrantType/AuthorizationCode.php');
include "includes/blz_oauth_inc.php";
include "includes/blizzard_resources_inc.php";

/**
*	Required vars for the api to work
*
**/

$client_id			= '2abc5bd3a1d64274a2aa9575404cf0e9';
$client_secret			= '4lDDBAihtzLRkljrtYmwRTL1L6xZeOGv';
$region				= 'US';
$locale				= 'en_US';
$redirectUri			= 'https://www.grantsgrabbag.com/wow/var_dumps.php';

// init the auth system client_id, client_secret, region, local all required
$client = new OAuth2\Client($client_id, $client_secret, $region, $locale, $redirect_uri);

$myOauthToken = getOauthToken($blizzardOauthTokenUrl);
print "var_dump of \$myOauth:\n<pre>"; var_dump($myOauthiToken); print "</pre>\n<hr />\n";

$myOauthCode = getOauthCode($blizzardOauthAuthUrl, $redirectUri, $_SESSION['access_token']);
print "var_dump of \$myOauth:\n<pre>"; var_dump($myOauthCode); print "</pre>\n<hr />\n";

print "var_dump of \$_SESSION:\n<pre> "; var_dump($_SESSION); print "</pre>>\n<hr />\n";

print "var_dump of \$_REQUEST):\n<pre>"; var_dump($_REQUEST); print "</pre>>\n<hr />\n";

print "var_dump of \$_GET:\n<pre>"; var_dump($_GET); print "</pre>>\n<hr />\n";

if (!isset($_GET['code']))
{
	$auth_url = $client->getAuthenticationUrl($client->baseurl[$client->region]['AUTHORIZATION_ENDPOINT'], $client->redirect_uri);
	print "var_dump of \$auth_url:<pre>"; var_dump($auth_url); print "</pre>\n<hr />\n";
	header('Location: ' . $auth_url);
}
else
{
	$params = array('code' => $_GET['code'], 'auth_flow' => 'auth_code', 'redirect_uri' => $client->redirect_uri);
	print "var_dump of \$params:\n<pre>";
	var_dump($params);
	print "</pre>";
	print "<hr />\n";
	$response = $client->getAccessToken($client->baseurl[$client->region]['TOKEN_ENDPOINT'], 'authorization_code', $params);
echo 'print_r of $response on else clause:\n<pre>';
print_r($response);
echo '</pre>';
	print "<hr />\n";
	$client->setAccessToken($response['result']['access_token']);
	print "<hr />\n";
	$response = $client->fetch('user',array('source'=>'account'));
	echo '<pre>';
	print_r($response);
	echo '</pre>';
	print "<hr />\n";
}
