<?php
/* file: legion_inc.php */
namespace girvin\wow;

function legendCount($toon_legend_count) {
    switch ($toon_legend_count) {
        case 0:
            return "2";
            break;
        case 1:
            return "1";
            break;
        case 2:
            return "Done";
            break;
        default:
            return "Data Error!";
        }
    }

function legendLevelCount($toon_legend_lvl_count) {
    switch ($toon_legend_lvl_count) {
        case 0:
            return "2";
            break;
        case 1:
            return "1";
            break;
        case 2:
            return "Done";
            break;
        default:
            return "Data Error!";
        }
    }
?>
