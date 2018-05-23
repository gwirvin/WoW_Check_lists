<?php
/* FIle: adcategory.php
 *
 * Script to add Link cagegories to organize links page */

// Initialize the session
session_start();

// If session variable is not set it will redirect to login page
if(!isset($_SESSION['user_email']) || empty($_SESSION['user_email'])){
  header("location: login.php");
  exit;
}

// Define variables and initialize with empty values
$cat_name = ""; 
$cat_owner = "";
$cat_user = "";
$cat_opts= "";
$catEdits = "\n<div id=\"table-edits\">\n<table>\n\t<tr>\n\t\t<th>Current Name:</th>\n\t\t<th>New Name:</th>\n\t</tr>\n\t";
$link_name = "";
$link_cat = "";
$link_owner = "";
$link_url = "";
$link_type = "";
$link_url = "";

// Define empty error variables
$cat_name_err =  "";
$cat_owner_err =  "";
$cat_user_err = "";
$link_nam_erre = "";
$link_cat_err = "";
$link_owner_err = "";
$link_url_err = "";
$link_type_err = "";
$link_url_err = "";

// Use session to set page variables
$cat_email = $_SESSION['user_email'];
$cat_owner = $_SESSION['user_id'];
$cat_user = $_SESSION['user_first'];
$link_owner = $cat_owner;
//includes
include "../cats.php";

$cat_gather_sql = ("SELECT cat_id, cat_name, cat_owner FROM categories WHERE cat_owner=\"".$cat_owner."\" ORDER BY cat_name");
$link_gather_sql = ("SELECT link_id, link_name, link_type, link_cat, link_url FROM links WHERE link_owner=".$cat_owner." ORDER BY link_cat, link_name");
$cat_query = mysqli_query ($links_conn, $cat_gather_sql);
$link_query = mysqli_query ($links_conn, $link_gather_sql);
while ($cat_row = mysqli_fetch_array($cat_query))
{
	$cat_opts .= "\n\t<option value=\"".$cat_row['cat_name']."\">".$cat_row['cat_name']."</option>";
	$catEdits .= "<tr>\n\t\t<td><font color=\"FFFFFF\" style=\"font-family: 'Times New Roman', Times, serif; float: right;\">".$cat_row['cat_name']."</font></td>\n\t\t<form name=\"update_cat_".$cat_row['cat_id']."\" method=\"POST\" action=\"update_cats.php\"><td><input type=\"text\" width=\"50em\" name=\"catNameUpdate\" placeholder=\"Ne Category Name\"><input type=\"hidden\" name=\"cat_owner\" value=\"".$_SESSION['user_id']."\"><input type=\"submit\" name=\"edit\" value=\"UPDATE\"></td></form>\n\t</tr>\n";
}


$catEdits .= "</table>\n";

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Add Links for <?php echo $_SESSION['user_first']?></title>
<link rel="stylesheet" href="../style/style.css">
<link rel="icon" type="image/png" href="../favicon-32x32.png" sizes="32x32" />
<link rel="icon" type="image/png" href="../favicon-16x16.png" sizes="16x16" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
jQuery.noConflict();
jQuery(document).ready(function($) {
    $('.category').keyup(function(event) {
        var textBox = event.target;
        var start = textBox.selectionStart;
        var end = textBox.selectionEnd;
        textBox.value = textBox.value.charAt(0).toUpperCase() + textBox.value.slice(1).toLowerCase();
        textBox.setSelectionRange(start, end);
    });
});
</script>
</head>
<?php echo $nav_table?>
<div id="body-add">
<body>
<center><h1>Making additions for <?php echo $_SESSION['user_first']?>'s links</h1></center>
<center><hr style="width:30%"><font style="font-family: 'Times New Roman', Times, serif"><h1>NOTE:</h1><br />You will want to add in a category called Navigation.<br />This category of links will always show as buttons at the top of all pages on this site.<br />Please take care as your links and categories are connected.</font></center>
<hr />
<center>
<h2>New things for <?php echo $_SESSION['user_first']?>'s Link page</h2>
<hr style="width: 50%">
<h3>Adding a Category for <?php echo $_SESSION['user_first']?>'s Links Page</h3>
<div id="container">
<form action="./insert_cat.php" name="add_cat" method="POST">
<div class="form-group"><label><font color="ffffff" style="font-family: 'Times New Roman', Times, serif">Category Name:<sup>*</sup></font></label><input type="text" name="cat_name"  class="category" width="50em" style="text-transform: capitalize;" placeholder="Enter a Category Name" value=""><input type="hidden" name="cat_owner" value="<?php print $cat_owner; ?>"><input type="submit" name="insert" value="ADD"></div>
</form>
<hr />
</div>
<p />
<center>
<hr style="width: 30%">
<h3>Adding a Link for <?php echo $_SESSION['user_first']?>'s Links Page</h3>
<div id="container">
<form action="./insert_link.php" name="add_link" method="POST">
<div class="form-group">
<input type="hidden" name="link_owner" value="<?php print $link_owner;?>"><br />
<label><font color="ffffff" style="font-family: 'Times New Roman', Times, serif">Link Name:<sup>*</sup></font></label><input type="text" name="link_name" width="20em" value="">
<label><font color="ffffff" style="font-family: 'Times New Roman', Times, serif">Link Type:<sup>*</sup></font></label><select name="link_type">
	<option value="external">External Site</option>
	<option value="internal">Internal Page</option>
</select>
<label><font color="ffffff" style="font-family: 'Times New Roman', Times, serif">Link Category:<sup>*</sup></font></label><select name="link_cat"><?php print $cat_opts."\n"?></select>
<label><font color="ffffff" style="font-family: 'Times New Roman', Times, serif">Link Address:<sup>*</sup></font></label><input type="url" name="link_url"><input type="submit" name="insert_link" value="Add Link"></div>
</div>
<hr />
<h2>Editing <?php echo $_SESSION['user_first']?>'s Link Stuff</h2>
<hr style="width: 50%">
<?php echo $catEdits?>
<hr style="width: 30%">
<hr />
<p />
</div>
</form>
</center>
</body>
</div>
</html>
