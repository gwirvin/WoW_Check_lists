<?php
/* file: wow_class_inc.php */
function wowClassColors($toon_class_api) {
    switch ($toon_class_api) { //Setting out if the class hall has an autocomplete
        case "Warrior": //case 1: //Warrior
            return "bgcolor=\"CB9B6C\"><font color=\"000000\">";
            break;
        case "Paladin": //case 2: //Paladin
            return "bgcolor=\"FB8EBB\"><font color=\"000000\">";
            break;
        case "Hunter": //case 3: //Hunter
            return "bgcolor=\"A8D373\"><font color=\"000000\">";
            break;
        case "Rogue": //case 4: //Rogue
            return "bgcolor=\"FFF267\"><font color=\"000000\">";
            break;
        case "Priest": //case 5: //Priest
            return "bgcolor=\"F1EBE1\"><font color=\"000000\">";
            break;
        case "Death Knight": //case 6: //Death Knight
            return "bgcolor=\"CD1736\"><font color=\"FFFFFF\">";
            break;
        case "Shaman": //case 7: //Shaman
            return "bgcolor=\"0061FF\"><font color=\"FFFFFF\">";
            break;
        case "Mage": //case 8: //Mage
            return "bgcolor=\"57CEF0\"><font color=\"000000\">";
            break;
        case "Warlock": //case 9: //Warlock
            return "bgcolor=\"9585C9\"><font color=\"FFFFFF\">";
            break;
        case "Monk": //case 10: //Monk
            return "bgcolor=\"00FEBD\"><font color=\"000000\">";
            break;
        case "Druid": //case 11: //Druid
            return "bgcolor=\"FF7B00\"><font color=\"000000\">";
            break;
        case "Demon Hunter": //case 12: //Demon Hunter
            return "bgcolor=\"AA37CA\"><font color=\"FFFFFF\">";
            break;
        default:
            return "bgcolor=\"000000\"><font color=\"FFFFFF\">";
        }
}
function wowClasses($toon_class_api) {
    switch ($toon_class_api) { //Setting out if the class hall has an autocomplete
        case "Warrior": //case 1: //Warrior
            return "Warrior";
            break;
        case "Paladin": //case 2: //Paladin
            return "Paladin";
            break;
        case "Hunter": //case 3: //Hunter
            return "Hunter";
            break;
        case "Rogue": //case 4: //Rogue
            return "Rogue";
            break;
        case "Priest": //case 5: //Priest
            return "Priest";
            break;
        case "Death Knight": //case 6: //Death Knight
            return "Death Knight";
            break;
        case "Shaman": //case 7: //Shaman
            return "Shaman";
            break;
        case "Mage": //case 8: //Mage
            return "Mage";
            break;
        case "Warlock": //case 9: //Warlock
            return "Warlock";
            break;
        case "Monk": //case 10: //Monk
            return "Monk";
            break;
        case "Druid": //case 11: //Druid
            return "Druid";
            break;
        case "Demon Hunter": //case 12: //Demon Hunter
            return "Demon Hunter";
            break;
        default:
	    return "I Broked it";
    }
}

?>
