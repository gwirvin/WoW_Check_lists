<?php

/* File: cats.php */

// If session variable is not set it will redirect to login page
if(!isset($_SESSION['user_email']) || empty($_SESSION['user_email'])){
  header("location: login.php");
  exit;

$dbhost = 'localhost';
$dbuser = 'web_app';
$dbpass = 'zoh6oePohb3a';
$dbusers = 'users';
$dbwow = 'wow_api';
$dblinks = 'links';
$users_conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbusers) or die   ('Could not connect to DB');
$wow_conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbwow) or die   ('Could not connect to DB');
$links_conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dblinks) or die ('Could not connect to the DB');
//$wow_conn = mysqli_connect($dbhost, $dbuser, $dbpass) or die   ('Could not connect to DB');
$db_user = mysqli_select_db($users_conn, $dbusers) or die ('Something went wrong!');
$db_wow = mysqli_select_db($wow_conn, $dbwow) or die ('Something went wrong!');
$db_links = mysqli_select_db($links_conn, $dblinks) or die ("Something went wrong!");
$api_key = "apikey=fkff3mjw67rm6eqzsf2u9vxgfk4y5b88";
$wow_url = "https://us.api.battle.net/wow/";
$icon_url = "http://render-us.worldofwarcraft.com/character/";
$blizz_locale = "locale=en_US";

// Navigation table
$nav_link_sql = mysqli_query($links_conn, "SELECT link_type, link_name, link_url FROM links WHERE link_cat=\"Navigation\" AND link_owner=\"".$_SESSION['user_id']."\" ORDER BY link_name") or die(mysqli_error());
$nav_table="<center>\n<div id=\"table-nav\">\n<table>\n<center>\n<tr>\n\t<td><center><form name=\"home\" method=\"POST\" action=\"/index.php\"><input type=\"SUBMIT\" value=\"Go Home\"></form></td>\n\t<td><center><form name=\"links\" method=\"POST\" action=\"/links/links.php\"><input type=\"SUBMIT\" value=\"".$_SESSION['user_first']."'s Links\"></form></td>\n";
while ($nav_link_row = mysqli_fetch_array($nav_link_sql))
	{
	if ($nav_link_row['link_type'] == "internal")
		{
		$nav_table .= "\t<td><center><form name=\"".$nav_link_row['link_name']."\"method=\"POST\" action=\"".$nav_link_row['link_url']."\"><input type=\"SUBMIT\" value=\"".$nav_link_row['link_name']."\"></form></td>\n";
		}
	else
		{
		$nav_table .= "\t<td><center><form name=\"".$nav_link_row['link_name']."\"method=\"POST\" action=\"".$nav_link_row['link_url']."\" target=\"_blank\"><input type=\"SUBMIT\" value=\"".$nav_link_row['link_name']."\"></form></td>\n";
		}
	}
$nav_table .= "\t<td><form name=\"logout\" method=\"POST\" action=\"/logout.php\"><input value=\"Logout\" type=\"submit\"></form></td>\n</tr>\n</center>\n</table>\n</div>\n</center>\n<hr />\n";
?>
