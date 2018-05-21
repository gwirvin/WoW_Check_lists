<?php
/** file index.php
 * the initial page for me website **/
namespace girvin;
// Initialize the session
session_start();
 
// If session variable is not set it will redirect to login page
if(!isset($_SESSION['user_email']) || empty($_SESSION['user_email'])){
  header("location: login.php");
  exit;

include "cats.php";
$toon_chk_sql = ("SELECT COUNT(toon_name) FROM toon WHERE toon_owner=\"".$_SESSION['user_id']."\"");
$user_chk_sql = ("SELECT user_email. user_last FROM users.users WHERE user_email=\"".$_SESSION['user_email']."\"");
$toon_chk_query = mysqli_query($wow_conn, $toon_sql);
$wow_check = mysqli_fetch_array($toon_chk_query);
}

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome, <?php echo $_SESSION['user_first']?></title>
    <link rel="stylesheet" href="./style/style.css">
    <link rel="icon" type="image/png" href="favicon-32x32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="favicon-16x16.png" sizes="16x16" />
    <script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js\"></script>
</head>
<?php echo $nav_table?>
<div id="body">
<body>
    <div class="page-header">
        <h1>Hi, <b><?php echo $_SESSION['user_first']; ?></b>. Welcome to the grab bag.</h1>
    </div>
<!--    <div id="table-nav">
        <table>
            <tr>
                <td><form name="logout" method="post" action="logout.php"><input value="Logout" type="submit"></form></td>
            </tr>
        </table>
    </div> --!>
	<hr /><center>You last accessed this site on: <?php echo $_SESSION['user_last_access']; ?><br /> You signed up on: <?php echo $_SESSION['user_created_at']; ?></center><hr />
    <p>
        <div id="table-nav">
        <table><caption>World of Warcraft Things</caption>
            <tr>
                <td><center><form name="leg_chk_lst" method="POST" action="./wow/legion.php"><input value="Legion - <?php echo $_SESSION['user_first']; ?>" type="SUBMIT"></form></center></td>
                <td><center><form name="toon" method="POST" action="./wow/wow.php"><input value="<?php echo $_SESSION['user_first']; ?>'s Characters" type="SUBMIT"></form></td>
                <td><center><form name="add_toon" method="POST" action="./wow/add_toon.php"><input value="Add a character" type="SUBMIT"></form></td>
            </tr>
        </table>
    <div id="table-nav">
        <table><caption>Warcraft Info Sites</caption>
            <tr>
                <div class="form-group">
                    <td><center><form name="wowhead" method="POST" action="http://www.wowhead.com/" target="_blank"><input type="SUBMIT" value="WoW Head"></form></center></td>
                    <td><center><form name="raidbots" method="POST" action="https://www.raidbots.com/" target="_blank"><input type="SUBMIT" value="RaidBots"></form></center></td>
                    <td><center><form name="xufu" method="POST" action="https://www.wow-petguide.com/index.php" target="_blank"><input type="SUBMIT" value="Xu-Fu"></form></center></td>
                    <td><center><form name="icyveins" method="POST" action="https://www.icy-veins.com/" target="_blank"><input type="SUBMIT" value="Icy Veins"></form></center></td>
                    <td><center><form name="noxxic" method="POST" action="http://www.noxxic.com/" target="_blank"><input type="SUBMIT" value="Noxxic"></form></center></td>
                    <td><center><form name="warcraft-pets" method="POST" action="https://www.warcraftpets.com/" target="_blank"><input type="SUBMIT" value="Warcraft Pets"></form></center></td>
                    <td><center><form name="wow-professions" method="POST" action="http://www.wow-professions.com/" target="_blank"><input type="SUBMIT" value="WoW Professions"></form></center></td>
                </div>
            </tr> 
        </table>
    </div>
</p>
<hr />
</body>
</html>
