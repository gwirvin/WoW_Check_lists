<?php
/* file: character.php */

// Initialize the session
session_start();

// If session variable is not set it will redirect to login page
if(!isset($_SESSION['user_email']) || empty($_SESSION['user_email'])){
  header("location: /login.php");
  exit;
}


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" http-equiv="refresh" content="7200">
    <title><?php echo $_SESSION['user_first']?>'s World of Warcraft Characters</title>
    <link rel="stylesheet" href="./style/style.css">
    <link rel="icon" type="image/png" href="../favicon-32x32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="../favicon-16x16.png" sizes="16x16" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="../scripts/jquery.tablesorter.js"></script>
</head>
<div id="body">
<body>
<?php echo $nav_table?>
    <div id="table-nav"><table>
        <tr>
            <div class="form-group"><td><center><form name="add_toon" method="POST" action="./add_toon.php"><input value="Add a character" type="submit"></form></td></div>
            <div class="form-group"><td><center><form name="legion" method="POST" action="./latest.php"><input value="Legion - <?php echo $_SESSION['user_first']; ?>" type="submit"></form></td></div>
            <div class="form-group"><td><center><form name="toon" method="POST" action="./wow.php"><input value="<?php echo $_SESSION['user_first']; ?>'s Characters" type="submit"></form></td></div>
    </div>
    <h1><center> Hey, <?php echo $_SESSION['user_first']?>, the web developer has this page here with no idea what to do with it. Sorry.</center></h2>
    <div id="table-nav">
        <table>
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
    <p />
    <p />
    <p />
</body></div>
</html>
