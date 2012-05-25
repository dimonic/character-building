<?php

// designed to parse the Wizards of the Coast consolidated feats index

require_once('DB.php');
require_once('../phplib/lib.inc.php');
require_once('../phplib/dnd.lib.php');
require_once('../phplib/connect.inc.php');

echo "<html><body><table>\n";

$file = "feat-index.html";
if (! ($FEATS = fopen($file, "r"))) {
  die("Could not open file: $file\n");
}

$max_length = 1024;
while ($line = fgets($FEATS, $max_length)) {
    $part = array();
    ereg("<tr[^>]*><td[^>]*>([^[]*)(\[([^<]*)])?</td>", $line, $part);
    $feat = addslashes($part[1]);
    $type = $part[3];
    $line = fgets($FEATS, $max_length);
    $part = array();
    ereg("<td[^>]*>(.*)</td>", $line, $part);
    $source = $part[1];
    $line = fgets($FEATS, $max_length);
    $part = array();
    ereg("<td[^>]*>(.*)</td>", $line, $part);
    $page = $part[1];
    $description = "";
    do {
      $line = fgets($FEATS, $max_length);
      $part = array();
      if (ereg("</tr", $line)) {
	break;
      }
      ereg("(<td[^>]*>)?([^<]*)(</td>)?", $line, $part);
      $description .= ' ' . addslashes(trim($part[2]));
    } while (true);
    $query = "SELECT * FROM `feats` WHERE `name` = '$feat'";
    $query_result = issue_query($query);
    if ($feat_row = $query_result->fetchRow(DB_FETCHMODE_ASSOC)) {
      if (DB::isError($skill_row)) {
	die($feat_row->getMessage());
      }
      echo "<tr><th>Found:</th><td>$feat</td><td>$type</td><td>$source</td><td>$page</td><td>$description</td></tr>\n";
      if (!stristr($feat_row[source], $source)) {
        $new_source = $feat_row[source] . ', "' . $source . '"';
        $query = "UPDATE `feats` SET `source` = '$new_source' WHERE `name` = '$feat'";
        echo "<tr><td colspan='6'>$query</td></tr>\n";
	issue_query($query);
      }
    } else {
      // not found - so we add it
      $query = "INSERT INTO `feats` (`name`, `type`, `brief_description`, `source`, `page`) VALUES ('$feat', '$type', '$description', '\"$source\"', '$page')";
      echo "<tr><td colspan='6'>$query</td></tr>\n";
      issue_query($query);
    }
}

fclose($FEATS);

echo "</table></body></html>\n";

?>
