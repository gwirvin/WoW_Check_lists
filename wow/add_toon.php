<?php

/* File: add_toon.php */

// Initialize the session
session_start();

// If session variable is not set it will redirect to login page
if(!isset($_SESSION['user_email']) || empty($_SESSION['user_email'])){
  header("location: /login.php");
  exit;
}

// Define variables and initialize with empty values
$char_name = $char_realm = $realm_select = "";

// Define empty error variables
$char_name_err = $char_realm_err = $char_owner_err = "";

// Use session to set page variables
$char_email = $_SESSION['user_email'];
$char_owner = $_SESSION['user_id'];

//includes
include "../cats.php";
include "includes/blizzard_resources_inc.php";
include "includes/blz_oauth_inc.php";

if(!isset($myOauthToken["access_token"]) || empty($myOauthToken["token_type"])) {
	$myOathToken = getOauthToken($blizzardOauthTokenUrl);
}

// Getting realms for form
$realms_url = /*$wow_url.*/"https://us.api.blizzard.com/data/wow/realm/index?namespace=dynamic-us&".$blizz_locale."&access_token=".$myOauthToken["access_token"];
$realms_json = file_get_contents($realms_url);
$realms_object = json_decode($realms_json);

/* **************** TESTING *************** */
//$user_id = 1;

// Form processing
foreach ($realms_object->realms as $realms_value) {
    $realm_name = $realms_value->name;
    $realm_slug = $realms_value->slug;
    $realm_select .= "\r\n\t\t\t\t<option value=\"".$realm_slug."\">".$realm_name."</option>";
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add a Character for <?php echo $_SESSION['user_first']?></title>
    <link rel="stylesheet" href="./style/style.css">
    <link rel="icon" type="image/png" href="../favicon-32x32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="../favicon-16x16.png" sizes="16x16" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<div id="body-add">
<body>
<center>
    <h2>Adding a character</h2>
    <div id="container">
        <form action="./insert_char.php" name="add_toon" method="POST">
            <div class="form-group"><label><font color="FFFFFF">Character Name:<sup>*</sup></label><input type="text" name="char_name"  width="20em" value=""></font><input type="hidden" name="char_owner" value="<?php print $char_owner; ?>">
            <div class="form-group"><label><font color="FFFFFF">Character Realm:<sup>*</sup></font></label><select name="char_realm"><?php print $realm_select?><input type="submit" name="insert" value="ADD">
            </div>
    <p />
    <p />
    <p />
        </div>
        </form>
</center>
</body>
</div>
</html>
