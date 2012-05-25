<?php

function assign_bonuses($bonus_string)
{
    global $character_all_bonus;
    global $bonus_by_name;
    global $i;

    $bonuses = parse_query_string($bonus_string);
    if (is_array($bonuses)) {
	foreach ($bonuses as $property => $type) {
	    // format is:
	    // AC=+2(armor)
	    ereg('([^(]*)(\(([^)]*)\))*', $type, $bonus);
	    // subject such as AC, Str, Saves etc.
	    $character_all_bonus[$i][subject] = $property;
	    // value of bonus eg: +2
            // check if bonus is from attribute (such as divine grace)
            if (stristr("str,dex,con,int,wis,cha", $bonus[1])) {
		// echo "<pre>Found $bonus[1] bonus</pre>\n";
		$character_all_bonus[$i][value] = get_att_bonus($bonus[1]);
		$character_all_bonus[$i][category] = 'Misc';
	    } else {
	        $character_all_bonus[$i][value] = $bonus[1];
		$character_all_bonus[$i][category] = 'Magic';
	    }
	    // type of bonus eg: resistance, natural armor etc.
	    $character_all_bonus[$i][type] = $bonus[3];
	    // echo "property = $property, fulltype = $type, type = $bonus[3], value = $bonus[1]</pre>\n";
	    // also add bonus to totalled bonus by name and type array
	    switch($bonus[3]) {
		case '':
		case 'dodge':
		    $bonus_by_name[$property][$bonus[3]] += $bonus[1];
		    break;
		default:
		    $bonus_by_name[$property][$bonus[3]] = max($bonus_by_name[$property][$bonus[3]], $bonus[1]);
	            break;
	    }
	    $i++;
	} // end foreach
    } // endif
}

function bonus_by_name($ability)
{
    global $bonus_by_name;

    return bonus_total($bonus_by_name[substr(strtoupper($ability), 0, 1) . substr($ability, 1, 2)]);
}
    

function get_att_bonus($ability)
{
    global $character;

    $bonus = bonus_by_name($ability);
    if ($character["cur_$ability"] > 0 && $character["cur_$ability"] != $character["$ability"]) {
	$prefix = (intval(($character["cur_{$ability}"] - 10) / 2) > 0) ? '+' : '';
	$att_bonus = "$prefix" . intval(($character["cur_{$ability}"] - 10) / 2);
    } else {
	$prefix = (intval(($character["$ability"] + $bonus - 10) / 2) > 0) ? '+' : '';
	$att_bonus = "$prefix" . intval(($character["$ability"] + $bonus - 10) / 2);
    }
    return $att_bonus;
}


function bonuses_from_feats()
{
    $c = 0;
    $i = 0;
    global $character_feat;

    $query = "SELECT * FROM `character_feats` WHERE `character_id` = '$_POST[character_id]' ORDER BY `character_feat_id`";
    $query_result = issue_query($query);
    while($feat_row = $query_result->fetchRow(DB_FETCHMODE_ASSOC)) {
	if (DB::isError($feat_row)) {
	    die($feat_row->getMessage());
	}
	if (!empty($feat_row[feat_id])) {
	    $lookup = "SELECT * FROM `feats` WHERE `feat_id` = $feat_row[feat_id]";
	    $lookup_result = issue_query($lookup);
	    if ($lookup_row = $lookup_result->fetchRow(DB_FETCHMODE_ASSOC)) {
		$character_feat[$c][name] = $lookup_row["name"];
		$character_feat[$c][type] = $lookup_row["type"];
		$character_feat[$c][properties] = $lookup_row["properties"];
		// echo "<pre>Parsing: " . $character_feat[$c][properties] . "\n";
		assign_bonuses($character_feat[$c][properties]);
	    } else {
		echo "<pre>Exception: missing feat id: $feat_row[feat_id]</pre>\n";
	    }
	} else {
	    $character_feat[$c][name] = $feat_row["name"];
	}
	$character_feat[$c][info] = $feat_row["extra_info"];
	$c++;
    }
}

// this function extracts per level abilities into separate array with
// one ability per line, and computes bonuses accruing from these abilities.
function bonuses_from_abilities()
{
    global $special_ability;
    global $separate_ability;

    $ability_num = 0;
    for ($c = 0; $c < 5; $c++) {
	for ($n = 0; $n < 40; $n++) {
	    if ($special_ability[$c][$n]) {
		$special = strtok($special_ability[$c][$n], ',');
		while ($special !== false) {
		    // echo "<pre>\$separate_ability[$c][$ability_num] = " . trim($special) . "</pre>\n";
		    $separate_ability[$c][$ability_num] = trim($special);
		    $name = $separate_ability[$c][$ability_num];
		    if (!empty($name)) {
			$query = "SELECT * FROM `special_abilities` WHERE `name` = '" . addslashes($name) . "'";
			$ability_result = issue_query($query);
			if ($ability_row = $ability_result->fetchRow(DB_FETCHMODE_ASSOC)) {
			    // add any skill mods here
			    if ($ability_row[modifiers] != "") {
				assign_bonuses($ability_row[modifiers]);
			    }
			}
		    }
		    $ability_num++;
		    $special = strtok(',');
		}
	    }
	}
    }
}

function bonuses_from_items()
{
    global $character_item_row;

    $query = "SELECT * FROM `character_items` WHERE `character_id` = '$_POST[character_id]' ORDER BY `character_item_id`";
    $query_result = issue_query($query);
    $c = 0;
    while($character_item_row[$c] = $query_result->fetchRow(DB_FETCHMODE_ASSOC)) {
	if (DB::isError($character_item_row[$c])) {
	    die($character_item_row[$c]->getMessage());
	}
	assign_bonuses($character_item_row[$c][properties]);
	$c++;
    }
}

function get_bonuses()
{

    bonuses_from_feats();
    bonuses_from_items();
}

$i = 0;

?>
