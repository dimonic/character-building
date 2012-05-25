  <table summary="Feat and flaw selection">
    <tr><th>Feats</th><th>(Extra Info)</th></tr>
<?php
      // feature enhancement: list a number of feat slots = character level.
      // Add more if full

      // query all feats for SELECT here
      $feats_query = "SELECT * FROM `feats` WHERE $source_select ORDER BY `source`, `name`";
      $feats_query_result = issue_query($feats_query);
      $feats_num = 0;
      while($feats_row[$feats_num] = $feats_query_result->fetchRow(DB_FETCHMODE_ASSOC)) {
	if (DB::isError($feats_row[$feats_num])) {
	    die($feats_row[$feats_num]->getMessage());
	}
	$found = 0;
	foreach ($source as $value) {
	  if (stristr($feats_row[$feats_num][source], "\"$value\"")) {
	    $feats_row[$feats_num][source] = $value;
	    $found = 1;
	    break;
	  }
        }
	if ($found) {
	  $feats_num++;
        }
      }
      function user_sort ($a, $b) {
	return strcasecmp($a[source] . $a[name], $b[source] . $b[name]);
      }
      usort($feats_row, 'user_sort');
      $c = 1; // get character's feats
      $query = "SELECT * FROM `character_feats` WHERE `character_id` = '$character_id' ORDER BY `character_feat_id`";
      $query_result = issue_query($query);
      while ($feat_row = $query_result->fetchRow(DB_FETCHMODE_ASSOC)) {
	if (DB::isError($feat_row)) {
	  die($feat_row->getMessage());
	}
	if (!empty($feat_row[feat_id])) {
	  $lookup = "SELECT * FROM `feats` WHERE `feat_id` = $feat_row[feat_id]";
	  $lookup_result = issue_query($lookup);
	  if ($lookup_row = $lookup_result->fetchRow(DB_FETCHMODE_ASSOC)) {
	    $feat_name = $lookup_row["name"];
	  } else {
	    echo "<pre>Exception: missing feat id: $feat_row[feat_id]</pre>\n";
	  }
	} else {
	  $feat_name = $feat_row["name"];
	}
	echo "<tr><td>";
	echo "<input type='text' name='feat{$c}' value='$feat_name' maxlength='30' size='20'/>\n";
//	    echo "</td><td>"; // now we have 'select' for feat from list
	echo "<select style='max-width: 2em' name='feat_select{$c}' onChange=\"updateFeat(this, $c)\">\n";
	echo "<option>&nbsp;</option>\n";
	$source = $feats_row[0]["source"];
	echo "<optgroup label='$source'>";
	for ($n = 0; $n < $feats_num; $n++) {
	  if ($feats_row[$n][source] != $source) {
	    echo "</optgroup>\n";
	    $source = $feats_row[$n][source];
	    echo "<optgroup label='$source'>\n";
	  }
	  $feats_name = $feats_row[$n][name];
	  if (strcasecmp($feats_name, $feat_name) == 0) {
	    echo "<option class='small' selected>$feats_name" . ($feats_row[$n][type] != 'General' ? " [" . $feats_row[$n][type] . ']' : '') . "</option>\n";
	  } else {
	    echo "<option class='small'>$feats_name" . ($feats_row[$n][type] != 'General' ? " [" . $feats_row[$n][type] . ']' : '') . "</option>\n";
	  }
	}
	echo "</optgroup>";
	echo "</select>\n";
	echo "</td>\n<td>";
	echo "<input type='text' name='feat_info{$c}' value='$feat_row[extra_info]' maxlength='30' size='20'/>\n";
	echo "</td></tr>\n";
	$c++;
      }
      // add up levels
      for ($l = 1; $l  <= 4; $l++) {
	if ($character["class{$l}"] == "None") {
	  break;
	}
	$char_level += $level = $character["level$l"];
      }

      for ( ; $c < $char_level + 5; $c++) {
	echo "<tr><td>";
	echo "<input type='text' name='feat{$c}' value='' maxlength='30' size='20'/>\n";
//	    echo "</td><td>";
	echo "<select style='max-width: 2em' name='feat_select{$c}' onChange=\"updateFeat(this, $c)\">\n";
	$source = $feats_row[0]["source"];
	echo "<optgroup label='$source'>";
	echo "<option>&nbsp;</option>\n";
	for ($n = 0; $n < $feats_num; $n++) {
	  if ($feats_row[$n][source] != $source) {
	    echo "</optgroup>\n";
	    $source = $feats_row[$n][source];
	    echo "<optgroup label='$source'>\n";
	  }
	  $feats_name = $feats_row[$n][name];
	  echo "<option class='small'>$feats_name</option>\n";
	}
	echo "</select>\n";
	echo "</td><td>";
	echo "<input type='text' name='feat_info{$c}' value='' maxlength='30' size='20'/>\n";
	echo "</td></tr>\n";
      }
?>
  </table> <!-- end feat selection table -->
