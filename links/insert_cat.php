<?php
/* file: insert_cat.php */
// Includes
include "../cats.php";
// Passed Variables 

$cat_name = ucwords($_POST['cat_name']);
$cat_owner = $_REQUEST['cat_owner'];

$cat_ins_sql = ("INSERT INTO categories (cat_name, cat_owner) VALUES (\"".$cat_name."\", \"".$cat_owner."\")");
$nav_chk_sql = ("SELECT cat_name FROM categories WHERE cat_owner=\"".$cat_owner."\"");
$nav_ins_sql = ("INSERT INTO categories (cat_name, cat_owner) VALUES (\"Navigation\", \"".$cat_owner."\"");
$cat_insert = mysqli_query($links_conn, $cat_ins_sql);

if (strpos($cat_name, 'Navigation') !== false)
{
	if ($cat_ins_sql) 
	{
		header ("Location: ./addforlinks.php");
	} else 
	{
		echo "ERROR: ".mysqli_error($links_conn);
	}
}
else
{
	$nav_check = mysqli_num_rows(mysqli_query($links_conn, $nav_chk_sql));
	if ($nav_check > 0
	{
		 if ($cat_ins_sql)
		 {
			 header ("Location: ./addforlinks.php");
		 } 
		 else
		 {
			 echo "ERROR: ".mysqli_error($links_conn);
		 }
	}
	else
	{
		mysqli_query($links_conn, $nav_ins_sql);
		if ($cat_ins_sql)
		{
			header ("Location: ./addforlinks.php");
		}
		else
		{
			echo "ERROR: ".mysqli_error($links_conn);
		}
	}
}


?>
