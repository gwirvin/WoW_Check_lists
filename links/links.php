<?php

/* FILE: links.php
 *
 * This should display links stored by an individual user
 * in the links Database, sort their dispaly out by
 * category and display them alphabetically
 * */
// Includes
include "../cats.php";
$links_table = "";
$links_cat_sql = mysqli_query($links_conn, "SELECT cat_name FROM categories WHERE NOT cat_name=\"Navigation\" ORDER BY cat_name") or die (mysqli_error());
while ($links_cat_row = mysqli_fetch_array($links_cat_sql))
{
	$links_table .= "\t<td><a href=\"".$links_link_row['link_url'];
	if ($links_link_row['link_type'] == "internal")
	{
		$links_table .= "\">".$links_link_row['link_name']."</a></td>\r\n";
		$links_table_count++;
		if ($links_table_count == 5)
		{
			$links_table .= "</tr>\r\n<tr>\r\n";
			$links_table_count = 0;
		}
	}
	else
	{
		$links_table .= "\" target=\"_blank\">".$links_link_row['link_name']."</a></td>\r\n";
		$links_table_count++;
		if ($links_table_count == 5)
		{
			$links_table .= "</tr>\r\n<tr>\r\n";
			$links_table_count = 0;
		}
	}
}
