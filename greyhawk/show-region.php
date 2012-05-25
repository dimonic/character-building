<?php

  // connect
  require_once('DB.php');
  require_once('../phplib/metabase.lib.php');
  require_once('../phplib/dnd.lib.php');

  db_connect("dnd");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Greyhawk Gazeteer</title>
<link rel="stylesheet" type=text/css href="../styles/table.css" title="php-style">
<script language="JavaScript" type="text/javascript" src="../javascript/pick-classes.js">
</script>
</head>
<body>
<h2>Greyhawk Regional Gazeteer</h2> 

<?php

  $region = $_GET[region];

  // echo "<pre>$region</pre\n";
  $query = "SELECT * FROM geography WHERE name = '$region'";
  $query_result = issue_query($query);
  $c = 0;
  while ($geography_row = $query_result->fetchRow(DB_FETCHMODE_ASSOC)) {
    if (DB::isError($geography_row)) {
      die($geography_row->getMessage());
    }
    if (!empty($geography_row[device_url])) {
      echo "<img src='$geography_row[device_url]' align='left'>\n";
    }
    echo "<h2>$geography_row[name] [$geography_row[type]]</h2>\n";
    if (!empty($geography_row[img_url])) {
      echo "<img src='$geography_row[img_url]' align='right'>\n";
    }
    if (!empty($geography_row[page_url])) {
      echo "<a href='$geography_row[page_url]' target='main'>Additional detail.</a>";
    }
    echo "<p>$geography_row[brief_description]</p>\n";
    if (!empty($geography_row[proper_name])) {
      echo "<p><b>Proper Name</b> $geography_row[proper_name]</p>\n";
    }
    if (!empty($geography_row[ruler])) {
      echo "<p><b>Ruler:</b> $geography_row[ruler]</p>\n";
    }
    if (!empty($geography_row[government])) {
      echo "<p><b>Government:</b> $geography_row[government]</p>\n";
    }
    if (!empty($geography_row[cities])) {
      echo "<p><b>Cities:</b> $geography_row[cities] <a href='city-key.html'>Population key</a></p>\n";
    }
    if (!empty($geography_row[resources])) {
      echo "<p><b>Resources:</b> $geography_row[resources]</p>\n";
    }
    if (!empty($geography_row[population])) {
      echo "<p><b>Population:</b> $geography_row[population]</p>\n";
    }
    if (!empty($geography_row[law])) {
      echo "<p><b>Law:</b> $geography_row[law]</p>\n";
    }
    if (!empty($geography_row[allies])) {
      echo "<p><b>Allies:</b> $geography_row[allies]</p>\n";
    }
    if (!empty($geography_row[enemies])) {
      echo "<p><b>Enemies:</b> $geography_row[enemies]</p>\n";
    }
    echo "<p>$geography_row[description]</p>\n";

  }
  
?>

</body>
</html>