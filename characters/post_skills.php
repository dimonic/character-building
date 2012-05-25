<?php
//
// Here we store skills in character_skill table (change from storing skills in character table)
//

$query = "DELETE FROM `character_skills` WHERE `character_id` = $_POST[character_id]";

$query_result = issue_query($query);

for ($c = 1; $c <= 56; $c++) {
  for ($n = 0; ; $n++) {
    $nnext = $n + 1;
    if ($n == 0 || $_POST["skill_{$c}_specifier_{$n}"] != "" || $_POST["skill_{$c}_specifier_{$nnext}"] != "") {
      post_character_skill($c, $n);
    } else {
      break;
    }
  }
}


function post_character_skill($c, $n)
{
  global $_POST;

  if ($_POST["skill_{$c}_specifier_{$n}"] != '') {
    $suffix = "_{$n}";
  } else {
    $suffix = '';
  }
  for ($i = 1; $i <= 4; $i++) {
    if (empty($_POST["skill_{$c}_{$i}{$suffix}"])) {
      $_POST["skill_{$c}_{$i}{$suffix}"] = 0;
    }
  }
  // echo "<pre>Name = skill_{$c}_1{$suffix}</pre>\n";
  $query = 'INSERT INTO `character_skills` (
    `character_id`,
    `skill_id`,
    `skill_specifier`,
    `class_1_ranks`, 
    `class_2_ranks`,
    `class_3_ranks`,
    `class_4_ranks`)
  VALUES (' .
    $_POST["character_id"] . ', ' .
    $c . ', "' .
    $_POST["skill_{$c}_specifier_{$n}"] . '", ' .
    $_POST["skill_{$c}_1{$suffix}"] . ', ' .
    $_POST["skill_{$c}_2{$suffix}"] . ', ' .
    $_POST["skill_{$c}_3{$suffix}"] . ', ' .
    $_POST["skill_{$c}_4{$suffix}"] . ')';
  // echo "<pre>$query</pre>\n";
  issue_query($query);
}
?>