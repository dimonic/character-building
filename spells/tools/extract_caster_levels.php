<?php
// connect
require_once('DB.php');
require_once('../phplib/metabase.lib.php');
require_once('../phplib/dnd.lib.php');

db_connect("dnd");

$query = "SELECT * FROM class WHERE 1 ORDER BY source, name";
$query_result = issue_query($query);
$c = 0;
while ($cclass_row = $query_result->fetchRow(DB_FETCHMODE_ASSOC)) {
  if (DB::isError($cclass_row)) {
    die($cclass_row->getMessage());
  }
  if (! empty($cclass_row[spell_list])) {
    $caster[$c++] = $cclass_row;
  }
}


$query = "SELECT * FROM `spell` WHERE 1";
$result = issue_query($query);
while ($spell = $result->fetchRow(DB_FETCHMODE_ASSOC)) {
  if (DB::isError($spell)) {
    die($spell->getMessage());
  }
  $class_name = '';
  foreach ($caster as $class) {
    $class_name = $class[spell_list];
    // echo "<pre>Checking $class[name]</pre>\n";
    if ($spell["$class_name"] != '') {
      $query = "INSERT INTO `spell_list` (`class_id`, `comment`, `spell_id`, `level`) VALUES ('$class[class_id]', '$class[name]', '$spell[spell_num]', '$spell[$class_name]')";
      echo "<pre>$query</pre>\n";
      issue_query($query);
    }
  }
}
  
