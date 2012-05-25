<html>
<head>
<LINK rel="stylesheet" type=text/css href="styles/table.css" title="php-style">
<script language="JavaScript" type="text/javascript">
  var last_row;

  function hilightRow(which, url) {
  
    if (document.all || document.getElementById) {
      if (last_row !== undefined) {
        last_row.className = "Data";
      }
      last_row = which;
      which.className = "DataSelected";
      parent.main.location = url;
    }
  }

</script>
</head>
<body>
<?php
  // connect
  require_once('phplib/connect.inc.php');
  require_once('phplib/lib.inc.php');

  $post = $_POST;

  echo "<table>\n";

  // create  query
  $sql_query = "SELECT * FROM categories ORDER BY sequence";
  // echo "<pre>$sql_query</pre>\n";
  $query_result = issue_query($sql_query);
  while ($row = $query_result->fetchRow(DB_FETCHMODE_ASSOC)) {
    if (DB::isError($row)) {
      die($row->getMessage());
    }
    if ($row[url] != "") {
      $link = $row[url];
    } else {
      $link = "items.php/$row[category]";
    }
    echo "<tr class=Data onClick=\"hilightRow(this, '$link');\">\n";
    if ($row[button] != "") {
      echo "<td><img border=0 src=\"$row[button]\" alt=\"$row[info]\" title=\"$row[info]\"></td>\n";
    } else {
      echo "<td>&nbsp;</td>\n";
    }
    echo "<td><a href=\"$link\" target=\"main\">$row[category]</a></td>\n";
    echo "</tr>\n";
  }
  echo "</table>\n";
?>
</body>
</html>

