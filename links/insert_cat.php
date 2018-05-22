<?php
/* file: insert_cat.php */
// Includes
include "../cats.php";
// Passed Variables 

$cat_name = ucwords($_POST['cat_name']);
$cat_owner = $_REQUEST['cat_owner'];

$cat_ins_sql = ("INSERT INTO categories (cat_name, cat_owner) VALUES (\"".$cat_name."\", \"".$cat_owner."\")");
$cat_insert = mysqli_query($links_conn, $cat_ins_sql);

if ($cat_ins_sql) {
    header ("Location: ./addforlinks.php");
    } else {
    echo "ERROR: ".mysqli_error($links_conn);
    }

?>
