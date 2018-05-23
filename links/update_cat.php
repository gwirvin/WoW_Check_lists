<?php
/* file: update_cat.php */
// Includes
include "../cats.php";
// Passed Variables 

$cat_name = ucwords($_POST['cat_name']);
$cat_owner = $_REQUEST['cat_owner'];
$cat_id = $_REQUEST['cat_id'];

$cat_edit_sql = ("UPDATE categories SET cat_name=\"".$cat_name."\" WHERE cat_id=\"".$cat_id."\" ON UPDATE CASCADE");
$cat_update = mysqli_query($links_conn, $cat_ins_sql);

if ($cat_ins_sql) {
    header ("Location: ./addforlinks.php");
    } else {
    echo "ERROR: ".mysqli_error($links_conn);
    }

?>
