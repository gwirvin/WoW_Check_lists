<?php

/* FILE: update_link.php
 *
 * Used to put links in the LINK DB */
// Includes
include "../cats.php";
// Passed Variables 
$link_name = ucwords($_REQUEST['link_name']);
$link_cat = $_REQUEST['linkUpdateCat'];
$link_owner = $_REQUEST['link_owner'];
$link_url = $_REQUEST['linkUpdateUrl'];
$link_id = $_REQUEST['link_id'];
$link_type = "";

if (strpos($link_url, 'grantsgrabbag') !== false)
{
	$link_type= "internal";
}
else
{
	$link_type= "external";
}
$link_update_sql = ("UPDATE links SET link_name=\"".$link_name."\", link_cat=\"".$link_cat.", link_url=\"".$link_url."\", link_type=\"".$link_type."\" WHERE link_id=\"".$link_id."\"");
$link_update = mysqli_query($links_conn, $link_ins_sql);

if ($link_ins_sql) {
	header ("Location: ./addforlinks.php");
} else {
	echo "ERROR: ".mysqli_error($links_conn);
}

?>
