<?php

/* FILE: links.php
 *
 * This should display links stored by an individual user
 * in the links Database, sort their dispaly out by
 * category and display them alphabetically
 * */

// Initialize the session
session_start();

// If session variable is not set it will redirect to login page
if(!isset($_SESSION['user_email']) || empty($_SESSION['user_email'])){
  header("location: login.php");
  exit;
}

// Includes
include "../cats.php";

// Navigation table
$nav_link_sql = mysqli_query($links_conn, "SELECT link_type, link_name, link_url FROM links WHERE link_cat=\"Navigation\" ORDER BY link_name") or die(mysqli_error());
$nav_table="<center>\r\n<div id=\"table-nav\">\r\n<table>\r\n<center>\r\n<tr>\r\n";
while ($nav_link_row = mysqli_fetch_array($nav_link_sql))
        {
        if ($nav_link_row['link_type'] == "internal")
                {
                $nav_table .= "\t<td><center><form name=\"".$nav_link_row['link_name']."\"method=\"POST\" action=\"".$nav_link_row['link_url']."\"><input type=\"SUBMIT\" value=\"".$nav_link_row['link_name']."\"></form></td>\r\n";
                }
        else
                {
                $nav_table .= "\t<td><center><form name=\"".$nav_link_row['link_name']."\"method=\"POST\" action=\"".$nav_link_row['link_url']."\" target=\"_blank\"><input type=\"SUBMIT\" value=\"".$nav_link_row['link_name']."\"></form></td>\r\n";
                }
        }
$nav_table .= "</tr>\r\n</center>\r\n</table>\r\n</div>\r\n</center>\r\n<hr />\r\n";

// Links table(s)
$links_table_count = 0;
$links_cat_sql = mysqli_query($links_conn, "SELECT cat_name FROM categories WHERE NOT cat_name=\"Navigation\" ORDER BY cat_name") or die (mysqli_error());
while ($links_cat_row = mysqli_fetch_array($links_cat_sql))
{
	$links_table_count = 0;
	$links_links_sql = mysqli_query($links_conn, "SELECT link_name, link_type, link_cat, link_url FROM links WHERE link_cat=\"".$links_cat_row['cat_name']."\" ORDER BY link_name") or die (mysqli_error());
	$links_table = "<div id=\"table-body\">\n<table><center>\n\t<caption><h3>".$links_cat_rom['cat_name']."</h3></caption>\n<tr>\n";
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
	$links_table .="</center></table>\n<hr />\n";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title><?php echo $_SESSION['user_first']?>'s Page o'Links</title>
<link rel="stylesheet" href="./style/style.css">
<link rel="icon" type="image/png" href="../favicon-32x32.png" sizes="32x32" />
<link rel="icon" type="image/png" href="../favicon-16x16.png" sizes="16x16" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<div id="body-add">
<center><?php echo $nav_table?></center>
<body>
<center><h2><?php echo $_SESSION['user_first']?>'s Page o'Links</h2></center?
<hr />
<?php echo $links_table?>
<p />
</div>
</body>
</div>
</html>
