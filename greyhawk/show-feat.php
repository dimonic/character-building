<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Feat</title>
<link rel="stylesheet" type=text/css href="../styles/table.css" title="php-style">
</head>
<body>
<h2>Feat</h2> 

<?php
  require_once('DB.php');
  require_once('../phplib/lib.inc.php');
  require_once('../phplib/dnd.lib.php');
  require_once('../phplib/connect.inc.php');

  $feat = $_GET[feat_name];

	$feat = str_replace("'", "''", $feat);
  // echo "<pre>$feat</pre\n";
  $query = "SELECT * FROM feats WHERE name = '$feat'";
  $query_result = issue_query($query);
  $c = 0;
  while ($feat_row = $query_result->fetchRow(DB_FETCHMODE_ASSOC)) {
    if (DB::isError($feat_row)) {
      die($feat_row->getMessage());
    }
    echo "<h2>$feat_row[name] [$feat_row[type]]</h2>\n";
    echo "<p>$feat_row[brief_description]</p>\n";
    if (!empty($feat_row[prerequisites])) {
      echo "<p><b>Prerequisites</b> $feat_row[prerequisites]</p>\n";
    }
    echo "<p><b>Benefit:</b> $feat_row[benefit]</p>\n";
    if (!empty($feat_row[normal])) {
      echo "<p><b>Normal:</b> $feat_row[normal]</p>\n";
    }
    if (!empty($feat_row[special])) {
      echo "<p><b>Special:</b> $feat_row[special]</p>\n";
    }
  }
?>

</body>
</html>
  
