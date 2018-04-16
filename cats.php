<?php

/* File: cats.php */

$dbhost = 'localhost';
$dbuser = 'web_app';
$dbpass = 'zoh6oePohb3a';
$dbusers = 'users';
$dbwow = 'wow_api';
$users_conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbusers) or die   ('Could not connect to DB');
$wow_conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbwow) or die   ('Could not connect to DB');
//$wow_conn = mysqli_connect($dbhost, $dbuser, $dbpass) or die   ('Could not connect to DB');
$db_user = mysqli_select_db($users_conn, $dbusers) or die ('Something went wrong!');
$db_wow = mysqli_select_db($wow_conn, $dbwow) or die ('Something went wrong!');
$api_key = "apikey=fkff3mjw67rm6eqzsf2u9vxgfk4y5b88";
$wow_url = "https://us.api.battle.net/wow/";
$icon_url = "http://render-us.worldofwarcraft.com/character/";
$blizz_locale = "locale=en_US";
?>
