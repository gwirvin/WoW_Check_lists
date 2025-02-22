<?php
/* file: wow_battle_pets.php 
 *
 * Used for gathering all Battle Pet
 * data into an object
 * */

// Block for testing
include "../../cats.php";
include "blizzard_resources_inc.php";
include "blz_oauth_inc.php";
#include "./wow_class_inc.php";
#include "./wow_char_inc.php";
#include "./leg_html_inc.php";
#include "./leg_lgnd_inc.php";
#include "./leg_rep_inc.php";
#include "./leg_fact_inc.php";
#include "./leg_ac_inc.php";
#include "./wow_rep_lvl_inc.php";
#include "./wow_fact_inc.php";

// Variables for the start
if(!isset($_SESSION) || empty($_SESSION)) {
        $toon_owner_id = $_REQUEST['user_id'];
        } else {
        $toon_owner_id = $_SESSION['user_id'];
        }
if (!isset($_SESSION) || empty($_SESSION)) {
        $toon_owner_first = $_REQUEST['user_first'];
        } else {
        $toon_owner_first = $_SESSION['user_first'];
	}

$myOauthToken = getOauthToken($blizzardOauthTokenUrl);

$allWowBattlePetsUrl = "https://us.api.blizzard.com/wow/pet/?locale=en_US&access_token=".$myOauthToken['access_token'];
var_dump($allWowBattlePetsUrl);
print "\n<hr />\n";
var_dump($_SESSION);
print "\n<hr />\n";
var_dump($myOauthToken);
print "\n<hr />\n";
$allWowBattlePetsJson = file_get_contents($allWowBattlePetsUrl);
var_dump($allWowBattlePetsJson);

?>
