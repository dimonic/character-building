<?php
  require_once('get_bonuses.php');

  for ($c = 1; $c < 5; $c++) {
    if ($character["class$c"] != "None" && $character["class$c"] != "") {
      $class_list .= $character["class$c"] . "(" . $character["level$c"] . ")";
      $d = $c + 1;
      if ($character["class$d"] != "None" && ! empty($character["class$d"])) {
        $class_list .= "/";
      }
     }
  }
  $query = "SELECT * FROM races WHERE name = '$character[race]'";
  $query_result = issue_query($query);
  $race_info = $query_result->fetchRow(DB_FETCHMODE_ASSOC);
  if (DB::isError($race_info)) {
    die($race_info->getMessage());
  }
  $racial_skills = $race_info[skill_id];
  $query = "SELECT skills.name FROM skill_lists LEFT JOIN skills ON skill_lists.skill_id = skills.skill_id WHERE skill_lists.class_id = '$racial_skills'";
  $query_result = issue_query($query);
  $d = 0;
  while ($skill_row = $query_result->fetchRow(DB_FETCHMODE_ASSOC)) {
    if (DB::isError($skill_row)) {
      die($cclass_row->getMessage());
    }
    $skill_array[0][$d] = $skill_row[name];
    $d++;
  }
  if ($d > 0) { // if there were any racial skills, class index starts at 2
    $skill_points[0] = $race_info[skill_mult] * MAX($race_info[skill_points] + intval(($character[init_intel] - 10) / 2), 1);
    // echo "<pre>Skill points: $skill_points[0]</pre>\n";
    $start = 2;
  } else {
    $start = 1;
  }

  for ($c = $start; $c <= 4; $c++) {
    $d = 0;
    $cclass = $character["class{$c}"];
    if ($cclass == "None") {
      break;
    }
    $char_level += $level = $character["level$c"];
      
    $query = "SELECT * FROM cclasses WHERE name = \"$cclass\"";
    $query_result = issue_query($query);
    $class_info[$c - 1] = $query_result->fetchRow(DB_FETCHMODE_ASSOC);
    if (DB::isError($class_info[$c - 1])) {
      die($class_info[$c - 1]->getMessage());
    }
    $class_num = $class_info[$c - 1][id];
    if ($class_num != '') {
      $query = "SELECT skills.name FROM skill_lists LEFT JOIN skills ON skill_lists.skill_id = skills.skill_id WHERE skill_lists.class_id = $class_num";
      $query_result = issue_query($query);
      while ($skill_row = $query_result->fetchRow(DB_FETCHMODE_ASSOC)) {
	if (DB::isError($skill_row)) {
	  die($cclass_row->getMessage());
	}
	$skill_array[$c - 1][$d] = $skill_row[name];
	$d++;
      }
      $skill_points[$c - 1] = ($class_info[$c - 1][skills] + intval(($character[init_intel] - 10) / 2) + (($character[race] == 'Human') ? 1 : 0)) * (($c == 1) ? $character["level{$c}"] + 3 : $character["level{$c}"]);
    }
  }
  echo "<table>\n";
  $query = "SELECT * FROM `skills` WHERE $source_select ORDER BY `name`";
  echo "<tr><th colspan='4'>Classes</th><th>Skill</th><th colspan='2'>Attr.</th><th colspan='4'>Ranks</th></tr>\n";
  echo "<tr><td colspan='7'></td>";
  for ($c = 1; $c <= 4; $c++) {
    if ($character["level{$c}"] > 0) {
      echo "<td>";
      if ($class_info[$c - 1][abbrev] == "") {
	echo substr($character["class{$c}"], 0, 3);
      } else {
      echo $class_info[$c - 1][abbrev];
      }
      echo "</td>";
    }
  }
  echo "</tr>\n";
  echo "<tr><td colspan='7' align='right'>Maximums</td>";
  for ($c = 1; $c <= 4; $c++) {
      echo "<td>" . $skill_points[$c - 1] . "</td>";
  }
  $more_skills = 0;
  $cur_bonus_delta = 0;
  $int_bonus_delta = intval(($character[intel] - 10) / 2) - intval(($character[init_intel] - 10) / 2);
  if ($int_bonus_delta > 0) {
    for ($c = 4; $c <= $char_level; $c++) {
      if ($c % 4 == 0 && $cur_bonus_delta < $int_bonus_delta) {
        $cur_bonus_delta++;
      }
      $more_skills += $cur_bonus_delta;
    }
  }
  if ($more_skills) {
    echo "<td>(extra skills +$more_skills)</td>";
  }
  echo "</tr>\n";
  $query_result = issue_query($query);
  while($skill_row = $query_result->fetchRow(DB_FETCHMODE_ASSOC)) {
    if (DB::isError($skill_row)) {
      die($skill_row->getMessage());
    }
    $skill_id = $skill_row["skill_id"];
    $done = 0;

    $skill_query = "SELECT * FROM `character_skills` WHERE `character_id` = $character[id] AND `skill_id` = $skill_id ";
    // echo "<pre>$skill_query</pre>\n";
    $skill_query_result = issue_query($skill_query);
    while (($character_skill = $skill_query_result->fetchRow(DB_FETCHMODE_ASSOC)) || $done == 0) {
      $done++;
      echo "<tr>";
      for ($c = 1; $c <= 4; $c++) {
        $cross_class[$c - 1] = 1;
        echo "<td>";
        $n = 0;
        while($skill_array[$c - 1][$n] || $character["class{$c}"] == 'Expert' || $character["class{$c}"] == "Human paragon") {
	  if (strncasecmp($skill_row[name], $skill_array[$c - 1][$n], strlen($skill_array[$c - 1][$n])) == 0) {
	    if ($start == 2 && $c == 1) {
	      echo substr($character[race], 0, 3);
            } else {
	      if ($class_info[$c - 1][abbrev] == "") {
	        echo substr($character["class{$c}"], 0, 3);
              } else {
	        echo $class_info[$c - 1][abbrev];
	      }
	    }
            $cross_class[$c - 1] = 0;
	    break;
          }
          $n++;
        }
        echo "</td>\n";
      }

      echo "<td><b>$skill_row[name]</b> ";

      if ($skill_row[skill_specifier] == 'Yes') {
	// show/get skill specifier
        form_input_text('character_skills', 'skill_specifier', "$character_skill[skill_specifier]", 20, 'skill_' . $skill_id . '_specifier_' . $done);
      }
      echo ($skill_row[untrained] == 'Yes') ? "&diams;" : "&nbsp;";

      echo "</td><td>$skill_row[key_ability]</td><td>";
      $key = strtolower($skill_row[key_ability]);
      echo att_bonus($key);
      echo "</td>\n";
      //
      // change here 18 Sep 2005: max ranks becomes character level instead of class level
      //
      for ($c = 1; $c <= 4, ($start == 2 && $c == 1) || $character["level{$c}"] > 0; $c++) {
        if (! $cross_class[$c - 1]) {
	  $max_ranks = $char_level + 3;
  	  break;
        } else {
	  $max_ranks = intval(($char_level + 3) / 2);
        }
      }

      for ($c = 1; $c <= 4, ($start == 2 && $c == 1) || $character["level{$c}"] > 0; $c++) {
        echo "<td align='right'><select name='skill_{$skill_id}_{$c}" . ($skill_row[skill_specifier] == 'Yes' ? "_{$done}" : "") . "' id='" . $character_skill["class_{$c}_ranks"] . "' onChange='skillTotals(this, $c, " . $cross_class[$c - 1] . ");'>\n";
        for ($r = 0; $r <= $max_ranks; $r++) {
	  if ($character_skill["class_{$c}_ranks"] == $r) {
	    $skills_total[$c - 1] += $r * ($cross_class[$c - 1] + 1);
  	    echo "<option value='$r' selected>$r</option>\n";
	  } else {
	    echo "<option value='$r'>$r</option>\n";
          }
        }
        echo "</select></td>\n";
      }
      echo "</tr>\n";
    }
  }
  echo "<tr><td colspan='7' align='right'>Current totals</td>";
  for ($c = 1; $c <= 4, ($start == 2 && $c == 1) || $character["level{$c}"] > 0; $c++) {
      echo "<td align='right'><input type='text' size='2' name='class_{$c}_skills_total' value='" . $skills_total[$c - 1] . "'/></td>\n";
  }
  echo "</tr>\n";
  echo "<tr><td colspan='7' align='right'>Maximums</td>";
  for ($c = 1; $c <= 4; $c++) {
      echo "<td align='right'>" . $skill_points[$c - 1] . "</td>";
  }
  if ($more_skills) {
    echo "<td>(extra skills +$more_skills)</td>";
  }
  echo "</tr>\n";
?>
</table>