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

$cat_gather_sql = ("SELECT cat_name, cat_owner FROM categories WHERE cat_owner=\"".$cat_owner."\" ORDER BY cat_name");
$cat_query = mysqli_query ($links_conn, $cat_gather_sql);
while ($cat_row = mysqli_fetch_array($cat_query))
{
	$cat_opts .= "\n\t<option value=\"".$cat_row['cat_name']."\">".$cat_row['cat_name']."</option>";
}

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
</head>
<?php echo $nav_table?>
<div id="body-add">
<body>
<center><h1>Making additions for <?php echo $_SESSION['user_first']?>'s links<h1></center>
<hr />
<center>
<h3>Adding a Category for <?php echo $_SESSION['user_first']?>'s Links Pagei</h3>
<div id="container">
<form action="./insert_cat.php" name="add_cat" method="POST">
<div class="form-group"><label><font color="ffffff">Category Name:<sup>*</sup></font></label><input type="text" name="cat_name"  width="50em" style="text-transform: capitalize;" placeholder="Enter a Category Name" value=""><input type="hidden" name="cat_owner" value="<?php print $cat_owner; ?>"><input type="submit" name="insert" value="ADD"></div>
</form>
</div>
<p />
<center>
<h3>Adding a Link for <?php echo $_SESSION['user_first']?>'s Links Page</h3>
<div id="container">
<form action="./insert_link.php" name="add_link" method="POST">
<div class="form-group">
<input type="hidden" name="link_owner" value="<?php print $link_owner;?>"><br />
<label><font color="ffffff">Link Name:<sup>*</sup></font></label><input type="text" name="link_name" width="20em" value="">
<label><font color="ffffff">Link Type:<sup>*</sup></font></label><select name="link_type">
	<option value="external">External Site</option>
	<option value="internal">Internal Page</option>
</select>
<div class="form-group">
<label><font color="ffffff">Link Category:<sup>*</sup></font></label><select name="link_cat"><?php print $cat_opts."\n"?></select>
<label><font color="ffffff">Link Address:<sup>*</sup></font></label><input type="url" name="link_url"><input type="submit" name="insert_link" value="Add Link"></div>
</div>
<p />
<p />
</div>
</form>
</center>
</body>
</div>
</html>
