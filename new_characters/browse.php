<?php

require_once('DB.php');
require_once('../phplib/lib.inc.php');
require_once('../phplib/dnd.lib.php');
require_once('../phplib/connect.inc.php');

$userw_info = array();

if (check_login() == false) {
  header('WWW-Authenticate: Basic realm="Character Management"');
  header('HTTP/1.0 401 Unauthorized');
}
?>
<html>
<head>
<title>DnD Player's Resources</title>
<link rel="stylesheet" type=text/css href="../styles/table.css" title="php-style">
<script language="JavaScript" type="text/javascript">

  var last_selected;

  function hilightRow(which, row_id) 
  {
  
    if (document.getElementById) { // DOM feature supported
       if (last_selected == undefined) {
         last_selected = document.getElementById(document.browse.character_id.value);
       }
       last_selected.className = "Data";
       last_selected = which;
       which.className = "DataSelected";
       document.browse.character_id.value = row_id;
    }
  }
</script>
</head>
<body>
<h2>Characters belonging to <?= $user_info[username] ?></h2>
<p>Click on a character to work with and click "Edit", or "Add" to create a new character.</p>
<form name="browse" action="tabbed-page.php" method="post">
<table summary="list of characters belonging to user">
<tr><th>Name</th><th>Campaign</th><th>Race</th><th>Classes</th></tr>
<?php
  // so here we are logged in and ready to browse our character table

  $query = "SELECT * FROM `characters` WHERE user_id = '$user_info[user_id]'";
//  echo "<pre>$query</pre>\n";
  $first_row = 1;
  $query_result = issue_query($query);
  while ($character_row = $query_result->fetchRow(DB_FETCHMODE_ASSOC)) {
    if (DB::isError($character_row)) {
      die($dom_row->getMessage());
    }
    if ($first_row) {
      $first_row = 0;
      echo "  <input type='hidden' name='character_id' value='$character_row[id]'>\n";
      echo "  <tr class='DataSelected' id='$character_row[id]' onClick=\"hilightRow(this, '$character_row[character_id]')\">\n";
    } else {
      echo "  <tr class='Data' id='$character_row[id]' onClick=\"hilightRow(this, '$character_row[id]')\">\n";
    }
    echo "    <td>$character_row[name]</td>\n";
    echo "    <td>$character_row[campaign]</td>\n";
    echo "    <td>$character_row[race]</td>\n";
    echo "    <td>$character_row[class1]($character_row[level1])";
    if ($character_row[level2] > 0) {
      echo", $character_row[class2]($character_row[level2])";
      if ($character_row[level3] > 0) {
	echo ", $character_row[class3]($character_row[level3])";
	if ($character_row[level4] > 0) {
	   echo ", $character_row[class4]($character_row[level4])";
        }
      }
    }
    echo "    </td>\n  </tr>\n";
  }
?>
</table>
<table>
<tr>
  <td><input type="submit" name="submit" value="Edit"\></td>
  <td><input type="submit" name="submit" value="Add"\></td>
  <td><input type="submit" name="submit" value="Delete"\></td>
</tr>
</table>
</form>
<h3>Design Philosophy</h3>

<p>Having used a whole bunch of character sheet generators, I have
found certain things to be true. Those that attempt to calculate
everything completely can either only do so for a small part of the
possible ruleset (from the growing number of books out there), or they
are too buggy for typical real world use (or both).</p>

<p>I have therefore attempted a middle-approach. Where possible and
reasonable, I have auto-calculated things, and included things from
databases. I have also intentionally left certain variable final
calculations out, such as the actual attacks for a particular melee
weapon, or the character's total AC, because there are so many feats,
special abilities, enhancements etc. that can impact these, that I
doubt the ability of software to keep up with them and their
interactions. During the data-capture process I do "suggest" certain
values, but leave the user to key in many of their own values in the
end.</p>

<p>I have also attempted to have my character sheets closely resemble
the standard Wizard's (particularly the RPGA) character sheets, except
where certain enhancements in detail capability could be included
without great loss of clarity or radical layout changes. This is in
order for DMs and players to be able to quickly find things.</p>

</body>
</html>
