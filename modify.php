<?php
  require_once('DB.php');
  require_once('phplib/lib.inc.php');
  require_once('phplib/dnd.lib.php');
  require_once('phplib/bossconnect.inc');

  
  for ($c = 1; $c < 57; $c++) {
    for ($n = 1; $n < 5; $n++) {
      $query = "ALTER TABLE `character` DROP COLUMN skill_{$c}_{$n}";
      // echo "<pre>$query</pre>\n";
      issue_query($query);
    }
  }
?>