<?php

// connect
require_once('DB.php');
require_once('../phplib/metabase.lib.php');
require_once('../phplib/dnd.lib.php');

db_connect("dnd");

$query = "SELECT * FROM `spell` WHERE INSTR(name, '$_POST[spell_name]')";
$result = issue_query($query);
 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Add a new spell</title>
<link rel="stylesheet" type=text/css href="../styles/table.css" title="php-style">
<script language="JavaScript" type="text/javascript" src="../javascript/cookies.js"></script>
</head>
<body>

<h2>Search Results</h2>

<img src="../images/DND_R_1A_13.gif" alt="separator">

<?php

function show_row($row, $num)
{
  echo "<tr><td><input type='checkbox' name='level_${num}'/></td><td>$row[name]</td><td>$row[description]</td><td>$row[school]</td><td>$row[components]</td><td>$row[time]</td><td>$row[range]</td><td>$row[target]</td><td>$row[save]</td><td>$row[spell_resistance]</td><td>$row[source]</td></tr>\n";
}

function show_headers()
{
  echo "<tr><th>&nbsp;</th><th>Name</th><th>Description</th><th>School</th><th>Comp</th><th>Time</th><th>Range</th><th>Target</th><th>Save</th><th>SR</th><th>Source</th></tr>\n";
}

$c = 0;
if ($spell_row = $result->fetchRow(DB_FETCHMODE_ASSOC)) {
  echo "<table>\n";
  show_headers();
  do {
    if (DB::isError($spell_row)) {
      die($spell_row->getMessage());
    }
    show_row($spell_row, $c++);
  } while ($spell_row = $result->fetchRow(DB_FETCHMODE_ASSOC));
  echo "</table>\n";
  echo "<p>Select a spell to edit, and/or click an action below.</p>\n";
} else {
  echo "<p>No matching spells found, adding as new:</p>\n";
  $query = "INSERT INTO `spell` (`name`) VALUES ('$_POST[spell_name]')";
  issue_query($query);
  echo "<pre>$query</pre>\n";
  // $character_id = $db->getOne("SELECT LAST_INSERT_ID()");
?>
<tr><th class='Edit'>Name</th><td><input type='text' name='name' value='<?= $_POST[spell_name] ?>'/></td></tr>
<?php
}
?>

<img src="../images/dnd_terminator.gif" alt="separator">
</form>

</body>

</html>
