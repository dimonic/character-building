<?php
  require_once('DB.php');
  require_once('phplib/lib.inc.php');
  require_once('phplib/dnd.lib.php');
  require_once('phplib/bossconnect.inc');

  
  $feats = fopen("/home/newdnd/public_html/feats_desc.lst", 'r');
  while ($feat = fgets($feats, 1024)) {
    preg_match('/([^\t]+)\t+([^\t]+)/', $feat, $strings);
    $name = addslashes(chop($strings[1]));
    $desc = addslashes(chop($strings[2]));
    $query = "UPDATE `feat` SET `brief_description` = '$desc' WHERE `name` = '$name'";
    echo "<pre>$query</pre>\n";
    issue_query($query);
  }
  fclose($feats);
?>