<?php
/* file: legion.php */
// Initialize the session
session_start();

// If session variable is not set it will redirect to login page
if(!isset($_SESSION['user_email']) || empty($_SESSION['user_email'])){
  header("location: ../login.php");
  exit;
}


// Block for testing
include "../cats.php";
include "./includes/wow_char_inc.php";
include "./includes/leg_html_inc.php";
include "./includes/leg_lgnd_inc.php";
// include "./includes/leg_rep_inc.php";
include "./includes/leg_fact_inc.php";
include "./includes/leg_ac_inc.php";
include "./includes/leg_chk_lst.php";
include "./includes/wow_rep_lvl_inc.php";

// Variables for the start
$toon_owner_id = $_SESSION['user_id'];
$toon_owner_first = $_SESSION['user_first'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" http-equiv="refresh" content="7200">
    <title><?php echo $_SESSION['user_first']?>'s Legion Checklist</title>
    <link rel="stylesheet" href="./style/style.css">
    <link rel="icon" type="image/png" href="../favicon-32x32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="../favicon-16x16.png" sizes="16x16" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="../scripts/jquery.tablesorter.js"></script>
</head>
<?php echo $nav_table?>
<div id="body"><body>
    <h2><center>World of Warcraft: Legion Checklist</center></h2>
    <div id="table-nav">
        <table>
            <tr>
                <div class="form-group"><td><center><form name="add_toon" method="POST" action="./add_toon.php"><input value="Add a character" type="submit"></form></td></div>
                <div class="form-group"><td><center><form name="toon" method="POST" action="./wow.php"><input value="<?php echo $_SESSION['user_first']; ?>'s Characters" type="submit"></form></td></div>
                <div class="form-group"><td><center><form name="refresh" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"><input value="Refresh" type="SUBMIT"></form></center></td></div>
            </div>
            </tr>
        </table>
    </div>
    <div id="container">
    <div id="table-scroll">
<script>
$(document).ready(function() {
    $("table").tablesorter({
      sortList: [[0,0],[3,0]]
      });
   });
</script>
        <?php print $toon_table?>
<script>
function sortTable(n) {
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("table-scroll");
  switching = true;
  // Set the sorting direction to ascending:
  dir = "asc"; 
  /* Make a loop that will continue until
  no switching has been done: */
  while (switching) {
    // Start by saying: no switching is done:
    switching = false;
    rows = table.getElementsByTagName("TR");
    /* Loop through all table rows (except the
    first, which contains table headers): */
    for (i = 1; i < (rows.length - 1); i++) {
      // Start by saying there should be no switching:
      shouldSwitch = false;
      /* Get the two elements you want to compare,
      one from current row and one from the next: */
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
      /* Check if the two rows should switch place,
      based on the direction, asc or desc: */
      if (dir == "asc") {
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          // If so, mark as a switch and break the loop:
          shouldSwitch= true;
          break;
        }
      } else if (dir == "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          // If so, mark as a switch and break the loop:
          shouldSwitch= true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      /* If a switch has been marked, make the switch
      and mark that a switch has been done: */
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      // Each time a switch is done, increase this count by 1:
      switchcount ++; 
    } else {
      /* If no switching has been done AND the direction is "asc",
      set the direction to "desc" and run the while loop again. */
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}
</script>
    </div>
    </div>
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
    </div>
</body></div>
</html>
