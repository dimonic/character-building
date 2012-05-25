<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Spell query step 3</title>
<LINK rel="stylesheet" type=text/css href="../styles/table.css" title="php-style">
 <script language="JavaScript" type="text/javascript">
function clearLevel(item, level)
{
    for (c = 0; c < item.form.elements.length; c++) {
	element = item.form.elements[c];
	if (element.type == 'checkbox') {
	    if (element.name.indexOf('level_' + level + '_') != -1) {
		element.checked = item.checked;
	    }
	}
    }
}

function setSpec(item)
{
    value = item.value;
    
    for (c = 0; c < item.form.elements.length; c++) {
	element = item.form.elements[c];
	if (element.id.indexOf(value) != -1) {
	    element.checked = item.checked;
	}
    }
}

function setComp(item)
{
    value = item.value;
    for (c = 0; c < item.form.elements.length; c++) {
	element = item.form.elements[c];
	if (element.id.indexOf(value, element.id.lastIndexOf('_')) != -1) {
	    element.checked = item.checked;
	}
    }
}

function clearAll(item)
{
    for (c = 0; c < item.form.elements.length; c++) {
	element = item.form.elements[c];
	if (element.type == 'checkbox') {
	    element.checked = item.checked;
	}
    }
}

</script>

<?php


  require_once('DB.php');
  require_once('../phplib/metabase.lib.php');
  require_once('../phplib/dnd.lib.php');

  db_connect("dnd");

  $post = $_POST;

  $title = $post[title];

  $cclass = $post[cclass];
  $c = 0;

  $source_select = stripcslashes($post[sources]);

  function show_row($row, $level, $num)
  {
    echo "<tr><td class='spell_list'><input type='checkbox' id='{$row[school]}_{$row[subschool]}_{$row[components]}' name='level_${level}_${num}' value='on' checked/></td>";
		echo "<td class='spell_list'>$row[name]</td>";
		echo "<td class='spell_list'>$row[description]</td>";
		echo "<td class='spell_list'>$row[school]</td>";
		echo "<td class='spell_list'>$row[components]</td>";
		echo "<td class='spell_list'>$row[time]</td>";
		echo "<td class='spell_list'>$row[range]</td>";
		echo "<td class='spell_list'>$row[target]</td>";
		echo "<td class='spell_list'>$row[save]</td>";
		echo "<td class='spell_list'>$row[spell_resistance]</td>";
		echo "<td class='spell_list'>$row[source]</td></tr>\n";

  }

  function show_headers()
  {
    echo "<tr><th>&nbsp;</th><th>Name</th><th>Description</th><th>School</th><th>Comp</th><th>Time</th><th>Range</th><th>Target</th><th>Save</th><th>SR</th><th>Source</th></tr>\n";
  }

?>
</head>
<body>

  <h3>Spells for a <?= $title ?>, levels <?= $_POST[from_level] ?> to <?= $_POST[to_level] ?> </h3>

  <img src="../images/DND_R_1A_13.gif" alt="separator">
<?php
  // echo "<pre>Class: $cclass</pre>\n";
  if (stristr("cleric cloistered_cleric hospitaler master_of_shrouds temple_raider_of_olidammara", $cclass)) {
    echo "<h3>Domains: ";
    $domain = $post[domain];
    for ($c = 0; $c < 4; $c++) {
      if ($domain[$c] != "") {
        if ($c > 0) {
	  $domain_filter .= " OR";
	}
        $domain_filter .= " ((INSTR(domain_1, '\"$domain[$c]\"') AND domain_1_level = \$level)"
	  . " OR (INSTR(domain_2, '\"$domain[$c]\"') AND domain_2_level = \$level)"
	  . " OR (INSTR(domain_3, '\"$domain[$c]\"') AND domain_3_level = \$level)"
	  . " OR (INSTR(domain_4, '\"$domain[$c]\"') AND domain_4_level = \$level))";
	// echo "<pre>$domain_filter</pre>\n";
	echo "'$domain[$c]' ";
      }
    }
    echo "</h3>\n";
  } else {
    if ($title == "Wizard") {
      list($special) = $post[domain];
      list($prohibited1, $prohibited2) = $post[prohibited];
      if ($special != "None") {
	$schools = " AND NOT INSTR('$prohibited1, $prohibited2', school) ";
	echo "<h3>Specialization: $special, prohibited: $prohibited1, $prohibited2</h3>\n";
      }
    }
  }
  if (! stristr("bard sorcerer", $title)) {
    $sanctified_filter = " sanctified >= '1' AND sanctified = '\$level' ";
  }
  if ($cclass == 'wu_jen') {
    $sql_query = "SELECT `spells`.*, `level` FROM `spell_lists` LEFT JOIN `spells` ON `spell_id` = spells.id WHERE `class_id` = '$post[class_id]' AND `level` >= '$post[from_level]' AND `level` <= '$post[to_level]' AND $source_select $schools ORDER BY `level`, `element`, `name`";


  } else {
    $sql_query = "SELECT `spells`.*, `level` FROM `spell_lists` LEFT JOIN `spells` ON `spell_id` = spells.id WHERE `class_id` = '$post[class_id]' AND `level` >= '$post[from_level]' AND `level` <= '$post[to_level]' AND $source_select $schools ORDER BY `level`, `name`";

  }

  // echo "<PRE>$sql_query</PRE>\n";
  $query_result = issue_query($sql_query);

  $level = $post['from_level'];
  $spell_num = 1;
?>
  <p><b>Unselect</b> any spells you don't want printed on your sheet.</p>

  <form action="make-spell-sheet-pdf.php" name="spells" method="post">

  <input type="hidden" name="title" value="<?= $title ?>">
  <input type="hidden" name="cclass" value="<?= $cclass ?>">
  <input type="hidden" name="class_id" value="<?= $post[class_id] ?>">
  <input type="hidden" name="domain1" value="<?= $domain[0] ?>">
  <input type="hidden" name="domain2" value="<?= $domain[1] ?>">
  <input type="hidden" name="domain3" value="<?= $domain[2] ?>">
  <input type="hidden" name="domain4" value="<?= $domain[3] ?>">
  <input type="hidden" name="domain_filter" value="<?= htmlentities($domain_filter); ?>">
  <input type="hidden" name="sanctified_filter" value="<?= $sanctified_filter ?>">
  <input type="hidden" name="from_level" value="<?= $level ?>">
  <input type="hidden" name="to_level" value="<?= $post[to_level] ?>">
  <input type="hidden" name="sources" value="<?= $source_select ?>">
  <input type="hidden" name="special" value="<?= $special ?>">
  <input type="hidden" name="prohibited1" value="<?= $prohibited1 ?>">
  <input type="hidden" name="prohibited2" value="<?= $prohibited2 ?>">

  <table border=1 summary="Include/exclude spells by various criteria">
    <tr><th colspan='8'>Include/exclude by</th></tr>
    <tr align=left>
      <th>School</th><th>Components</th><th>Element</th><th>Energy</th><th>Alignment</th><th colspan='2'>Descriptors</th><th></th>
    </tr>
    <tr>
      <td class="spell_list" valign=top>
<?php
  // buttons for selecting/unselecting schools of magic
  foreach (array("Abjur", "Conj", "Div", "Ench", "Evoc", "Illus", "Necro", "Trans") as $school) {
    if (! stristr("$prohibited1 $prohibited2", "$school")) {
      echo "<input type=checkbox name=\"spec\" value=\"$school\" onClick=\"setSpec(this);\" checked>$school</input><br>\n";
    }
  }
  echo "</td>\n<td class='spell_list' valign=top>";
  foreach (array("V", "S", "M", "F", "DF", "XP", "Sac", "Abs") as $descriptor0) {
    echo "<input type=checkbox name=\"descriptor0\" value=\"$descriptor0\" checked onClick=\"setComp(this);\">$descriptor0</input><br>\n";
  } 
  echo "</td>\n<td class='spell_list 'valign=top>";
  foreach (array("Air", "Earth", "Fire", "Water") as $descriptor1) {
    echo "<input type=checkbox name=\"descriptor1\" value=\"$descriptor1\" checked onClick=\"setSpec(this);\">$descriptor1</input><br>\n";
  } 
  echo "</td>\n<td class='spell_list' valign=top>";

  foreach (array("Sonic", "Acid", "Cold", "Electricity", "Force") as $descriptor2) {
    echo "<input type=checkbox name=\"descriptor2\" value=\"$descriptor2\" checked onClick=\"setSpec(this);\">$descriptor2</input><br>\n";
  } 
  echo "</td>\n<td class='spell_list' valign=top>";
    foreach (array("Good", "Evil", "Chaotic", "Lawful") as $descriptor3) {
    echo "<input type=checkbox name=\"descriptor3\" value=\"$descriptor3\" checked onClick=\"setSpec(this);\">$descriptor3</input><br>\n";
  }
  echo "</td>\n<td class='spell_list' valign=top>";
  foreach (array("Creation", "Healing", "Compulsion", "Summoning", "Calling", "Glamer", "Shadow", "Teleportation") as $descriptor4) {
    echo "<input type=checkbox name=\"descriptor4\" value=\"$descriptor4\" checked onClick=\"setSpec(this);\">$descriptor4</input><br>\n";
  }
  echo "</td>\n<td class='spell_list' valign=top>";
  foreach (array("Darknesss", "Death", "Fear", "Light", "Langauge-Dependant", "Mind-Affecting", "Water") as $descriptor5) {
    echo "<input type=checkbox name=\"descriptor5\" value=\"$descriptor5\" checked onClick=\"setSpec(this);\">$descriptor5</input><br>\n";
  }

?>
  </td>
  <td class='spell_list'>
        <input type=checkbox checked name="unclear" value="Unselect all" onClick="clearAll(this);">All</input>
      </td>
    </tr>
    <tr>
      <td colspan='8'>
        <table border-style=none summary="print spell DC tables">
	  <tr>
	    <th>Print Spells/Day and DC tables?</th>
            <td style="border-style: none"><input type="radio" name="DCTable" value="yes" checked>Yes</input><input type="radio" name="DCTable" value="no">No</input></td>
	    <td style="border-style: none"><b><input type='submit' name='submit' value='Make Spell Cards' /></b></td>
	    <td style="border-style: none"><b><input type='submit' name='submit' value='Make Spell Sheets' /></b></td>
	  </tr>
	</table>
      </td>
    </tr>
  </table>

  <table border=1 summary="Spell list">

<?php
  $first_time = 1;
  // generate body of table
  while ($cclass_row = $query_result->fetchRow(DB_FETCHMODE_ASSOC)) {
    if (DB::isError($cclass_row)) {
      die($cclass_row->getMessage());
    }
    if ($cclass_row[level] != $level || $first_time == 1) {
      $first_time = 0;
      $level = $cclass_row[level];
      $spell_num = 1;
      if (! stristr("bard sorcerer", $title) && stristr($source_select, "BoED")) {
        $level_sanctified_filter = str_replace('$level', "$level", $sanctified_filter);
 	$first_sanctified = 1;
	$sanctified_query = "SELECT * FROM spells WHERE $level_sanctified_filter AND $source_select ORDER BY name";
        $sanctified_result = issue_query($sanctified_query);
        while ($san_row = $sanctified_result->fetchRow(DB_FETCHMODE_ASSOC)) {
          if (DB::isError($san_row)) {
	    die($san_row->getMessage());
	  }
	  if ($first_sanctified == 1) {
	    echo "<tr><th colspan=13>Sanctified level $level spells</th></tr>\n";
	    show_headers();
	    $first_sanctified = 0;
	  }
	  show_row($san_row, "san_{$level}", $spell_num);
	  $spell_num++;
	}
	$spell_num = 1;

      }
      if ($title != "Wizard" && $domain[0] != '') {
        $level_domain_filter = str_replace('$level', "$level", $domain_filter);
	$first_domain = 1;
	$domain_query = "SELECT * FROM spells WHERE $level_domain_filter AND $source_select ORDER BY name";

        $domain_result = issue_query($domain_query);
        while ($dom_row = $domain_result->fetchRow(DB_FETCHMODE_ASSOC)) {
          if (DB::isError($dom_row)) {
	    die($dom_row->getMessage());
	  }
	  if ($first_domain == 1) {
	    echo "<tr><th colspan=12>Level $level domain spells</th></tr>\n";
	    show_headers();
	    $first_domain = 0;
	  }
	  show_row($dom_row, "dom_{$level}", $spell_num);
	  $spell_num++;
	}
	$spell_num = 1;
      }
      echo "<tr><th><input type='checkbox' name=\"clear$level\" onClick=\"clearLevel(this, '$level')\" checked></th><th colspan=12>Level $level</th></tr>\n";
      show_headers();
    }
    show_row($cclass_row, $level, $spell_num);
    $spell_num++;
  }
?>

</table>
<b><input type=submit name="submit" value="Make Spell Sheets"></b>
</form>
</body>
</html>
