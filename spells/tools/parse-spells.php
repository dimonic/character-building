<?php

require_once('DB.php');
require_once('../../phplib/lib.inc.php');
require_once('../../phplib/dnd.lib.php');
require_once('../../phplib/connect.inc.php');

echo "<html><body>\n";

$file = "../spell-index.html";
if (! ($SPELLS = fopen($file, "r"))) {
  die("Could not open file: $file\n");
}

$max_length = 1024;
while ($line = fgets($SPELLS, $max_length)) {
  $part = array();
  if (ereg("<tr[^>]*><td[^>]*>([^<]*)(</td>)?", $line, $part)) {
    $name = addslashes(trim($part[1]));
    // echo "<pre>Scanned $name</pre>\n";
    if ($part[2] == '') {
      $line = fgets($SPELLS, $max_length);
      $part = array();
      ereg ("([^<]*)</td>", $line, $part);
      $name .= " " . addslashes(trim($part[1]));
    }
    $line = fgets($SPELLS, $max_length);
    $part = array();
    ereg("<td.*>(.*)</td>", $line, $part);
    $source = $part[1];
    $line = fgets($SPELLS, $max_length);
    $part = array();
    ereg("<td.*>(.*)</td>", $line, $part);
    $page = $part[1];
    $line = fgets($SPELLS, $max_length);
    $part = array();
    ereg("<td[^>]*>([^<]*)(</td>)?", $line, $part);
    $school = trim($part[1]);
    if ($part[2] == '') {
	$line = fgets($SPELLS, $max_length);
	$part = array();
	ereg("([^<]*)</td>", $line, $part);
	$school .= " " . trim($part[1]);
    }
    $line = fgets($SPELLS, $max_length);
    $part = array();
    ereg("<td.*>([^<]*)(</td>)?", $line, $part);
    $classes = trim($part[1]);
    if ($part[2] == '') {
	$line = fgets($SPELLS, $max_length);
	$part = array();
	ereg("([^<]*)</td>", $line, $part);
	$classes .= " " . trim($part[1]);
    }
    $line = fgets($SPELLS, $max_length);
    $part = array();
    ereg("<td.*>(.*)</td>", $line, $part);
    $range = $part[1];
    $line = fgets($SPELLS, $max_length);
    $part = array();
    ereg("<td.*>(.*)</td>", $line, $part);
    $tef = $part[1];
    echo "<pre>Looking for: $name, $source($page), $school, $classes, $range, $tef";
    $query = "SELECT * FROM `spell` WHERE `name` = '$name'";
    $query_result = issue_query($query);
    if ($spell_row = $query_result->fetchRow(DB_FETCHMODE_ASSOC)) {
	if (DB::isError($spell_row)) {
      	    die($spell_row->getMessage());
	}
	echo " - found: $spell_row[name]</pre>\n";
	$query = "UPDATE `spell` SET `source` = '$source', `page` = '$page' WHERE `name` = '$name'";
	echo "<pre>$query</pre>\n";
	issue_query($query);
    } else {
	echo " - not found</pre>\n";
    }
  }
}

fclose($SPELLS);

echo "</body></html>\n";

?>