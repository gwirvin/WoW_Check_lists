<?php
/* file: insert_cat.php */
// Includes
include "../cats.php";
// Passed Variables 

$link_del_sql = ("DELETE FROM links WHERE link_id=\"".$_REQUST['link_id']\" ON DELETE CASCADE");
$link_insert = mysqli_query($links_conn, $link_del_sql);

if ($link_del_sql) {
    header ("Location: ./addforlinks.php");
    } else {
    echo "ERROR: ".mysqli_error($links_conn);
    }

?>
