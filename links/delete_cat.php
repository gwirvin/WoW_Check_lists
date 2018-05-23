<?php
/* file: insert_cat.php */
// Includes
include "../cats.php";
// Passed Variables 

$cat_del_sql = ("DELETE FROM categories WHERE cat_id=\"".$_REQUST['cat_id']\" ON DELETE CASCADE");
$cat_insert = mysqli_query($links_conn, $cat_del_sql);

if ($cat_del_sql) {
    header ("Location: ./addforlinks.php");
    } else {
    echo "ERROR: ".mysqli_error($links_conn);
    }

?>
