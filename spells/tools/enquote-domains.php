<?php

// connect
require_once('DB.php');
require_once('../phplib/metabase.lib.php');
require_once('../phplib/dnd.lib.php');

db_connect("dnd");
 
 
$query = "SELECT * FROM `spell` WHERE 1";
$result = issue_query($query);
while ($spell = $result->fetchRow(DB_FETCHMODE_ASSOC)) {
  for ($c = 1; $c <= 4; $c++) {
    for ($dom = strtok($spell["domain_{$c}"], ','); $dom != ""; $dom = strtok(',')) {
      $some = 1;
      $newdom[$c - 1] .= (($newdom[$c - 1] != "") ? ", " : "") . '"' . trim($dom) . '"';
    }
  }
  if ($some) {
    $query = "UPDATE `spell` SET `domain_1` = '$newdom[0]', " .
    "`domain_2` = '$newdom[1]', `domain_3` = '$newdom[2]', " .
    "`domain_4` = '$newdom[3]' WHERE `spell_num` = '$spell[spell_num]'";
    echo "<pre>$query</pre>\n";
    issue_query($query);
    $newdom = array();
    $some = 0;
  }
}

?>
