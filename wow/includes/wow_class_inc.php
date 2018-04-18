<?php
/* file: wow_class_inc.php */
namespace girvin\wow;
function wowClasses($toon_class_api) {
    switch ($toon_class_api) { //Setting out if the class hall has an autocomplete
        case 1: //Warrior
            return "Warrior";
            break;
        case 2: //Paladin
            return "Paladin";
            break;
        case 3: //Hunter
            return "Hunter";
            break;
        case 4: //Rogue
            return "Rogue";
            break;
        case 5: //Priest
            return "Priest";
            break;
        case 6: //Death Knight
            return "Death Knight";
            break;
        case 7: //Shaman
            return "Shaman";
            break;
        case 8: //Mage
            return "Mage";
            break;
        case 9: //Warlock
            return "Warlock";
            break;
        case 10: //Monk
            return "Monk";
            break;
        case 11: //Druid
            return "Druid";
            break;
        case 12: //Demon Hunter
            return "Demon Hunter";
            break;
        default:
            return "UNKNOWN";
        }
    }
?>
