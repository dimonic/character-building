<?php

  $query = "DELETE FROM `character_feats` WHERE `character_id` = '$_POST[character_id]'";
  issue_query($query);

  for ($c = 1; $c <= 20; $c++) {
  
    if (!empty($_POST["feat{$c}"])) {
      $feat_name = addslashes($_POST["feat{$c}"]);
      if (ereg('(.*)\(([^)]+)', $feat_name, $feat_array)) {
        $feat_name = $feat_array[1];
        $feat_info = $feat_array[2];
      } else {
        $feat_info = $_POST["feat_info{$c}"];
	// echo "<pre>feat_info = " . $_POST["feat_info{$c}]"] . "</pre>\n";
      }
      $feat_query = "SELECT * FROM `feats` WHERE `name` = '$feat_name'";
      $feat_result = issue_query($feat_query);
      if ($feat_row = $feat_result->fetchRow(DB_FETCHMODE_ASSOC)) {
        $insert_query = "INSERT INTO `character_feats` (`character_id`, `feat_id`, `extra_info`) VALUES ('$_POST[character_id]', '$feat_row[feat_id]', '$feat_info')";
        } else {
          $insert_query = "INSERT INTO `character_feats` (`character_id`, `name`, `extra_info`) VALUES ('$_POST[character_id]', '$feat_name', '$feat_info')";
      }
      issue_query($insert_query);
    }
  }

?>
