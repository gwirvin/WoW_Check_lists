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

//includes
include "../cats.php";

$cat_gather_sql = ("SELECT cat_name, cat_owner FROM categories WHERE cat_owner=\"".$cat_owner."\" ORDER BY cat_name");
$cat_query = mysqli_query ($links_conn, $cat_gather_sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Add a Character for <?php echo $_SESSION['user_first']?></title>
<link rel="stylesheet" href="./style/style.css">
<link rel="icon" type="image/png" href="../favicon-32x32.png" sizes="32x32" />
<link rel="icon" type="image/png" href="../favicon-16x16.png" sizes="16x16" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<div id="body-add">
<body>
<center>
<h2>Adding a Category for <?php echo $_SESSION['user_first']?>'s Links Page</h2>
<div id="container">
<form action="./insert_cat.php" name="add_cat" method="POST">
<div class="form-group"><label><font color="FFFFFF">Category Name:<sup>*</sup></label><input type="text" name="cat_name"  width="50em" value=""><input type="hidden" name="cat_owner" value="<?php print $cat_owner; ?>"><input type="submit" name="insert" value="ADD"></div>
<p />
<p />
<p />
</div>
</form>
</center>
</body>
</div>
</html>
