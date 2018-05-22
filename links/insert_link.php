<?php

/* FILE: insert_link.php
 *
 * Used to put links in the LINK DB */
// Includes
include "../cats.php";
// Passed Variables 
$link_name = ucwords($_POST['link_name']);
$link_cat = $_POST['link_cat'];
$link_owner = $_POST['link_owner'];
$link_url = $_POST['link_url'];
$link_type = $_POST['link_type'];

$link_ins_sql = ("INSERT INTO links (link_name, link_cat, link_owner, link_url, link_type) VALUES (\"".$link_name."\", \"".$link_cat."\", \"".$link_owner."\", \"".$link_url."\", \"".$link_type."\")");
$link_insert = mysqli_query($links_conn, $link_ins_sql);

if ($link_ins_sql) {
	header ("Location: ./addforlinks.php");
} else {
	echo "ERROR: ".mysqli_error($links_conn);
}

?>
