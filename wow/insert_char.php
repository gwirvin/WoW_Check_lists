<?php
/* file: insert_char.php */
// Includes
include "../cats.php";
// Passed Variables 

$toon_name = $_POST['char_name'];
$toon_owner = $_REQUEST['char_owner'];
$toon_slug = strtolower($_REQUEST['char_name']);
$toon_primary = $_REQUEST['char_primary'];
$toon_realm = $_POST['char_realm'];

$char_ins_sql = ("INSERT INTO toon (toon_name, toon_slug, toon_realm, toon_primary, toon_owner) VALUES (\"".$toon_name."\", \"".$toon_slug."\", \"".$toon_realm."\", \"".$toon_primary."\", \"".$toon_owner."\")");
$char_insert = mysqli_query($wow_conn, $char_ins_sql);

if ($char_ins_sql) {
    header ("Location: ./latest.php");
    } else {
    echo "ERROR: ".mysqli_error($wow_conn);
    }

?>
