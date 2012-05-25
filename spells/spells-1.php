<?php

  // connect
  require_once('DB.php');
  require_once('../phplib/metabase.lib.php');
  require_once('../phplib/dnd.lib.php');

  db_connect("dnd");

  $source_select = get_sources('');

  $query = "SELECT * FROM cclasses WHERE $source_select ORDER BY source, name";
  $query_result = issue_query($query);
  $c = 0;
  while ($cclass_row = $query_result->fetchRow(DB_FETCHMODE_ASSOC)) {
    if (DB::isError($cclass_row)) {
      die($class_row->getMessage());
    }
    if (! empty($cclass_row[spell_list])) {
      $class_list[$c][0] = $cclass_row[name];
      $class_list[$c][1] = $cclass_row[prestige];
      $class_list[$c][2] = $cclass_row[source];
      $class_list[$c][3] = $cclass_row[spell_list];
      $class_list[$c][4] = $cclass_row[id];
      $c++;
    }
  }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Spell query step 1</title>
<link rel="stylesheet" type=text/css href="../styles/table.css" title="php-style">
<script language="JavaScript" type="text/javascript" src="../javascript/cookies.js"></script>
<script language="JavaScript" type="text/javascript" src="../javascript/pick-classes.js"></script>
<script language="JavaScript" type="text/javascript">

  function setList(s)
  {
    for (var c = 0; c < s.length; c++) {
      if (s[c].selected) {
				// alert('spell_list = ' + s[c].id.substr(0, s[c].id.indexOf('_')) + ' class_id = ' + s[c].id.substr(s[c].id.indexOf('_') + 1));
        s.form.spell_list.value = s[c].id.substr(0, s[c].id.indexOf('_'));
				s.form.class_id.value = s[c].id.substr(s[c].id.lastIndexOf('_') + 1);
				break;
      }
    }
  }

</script>
</head>

<body>

<p><a name="pick_source" onClick="pickSources()">Select from whichever source books you choose.</a></p>

<h3>Choose your spell-casting class</h3>

<img src="../images/DND_R_1A_13.gif" alt="separator">

<form name="query" action="spells-2.php" method="post">
<input type='hidden' name='class_id' value='2'/>
<table summary="Spell Search">
  <tr><th>Class</th><td style="border-style: none"><select name="cclass" onChange="setList(this);">
<?php
        $default = 'Bard';
        $source = $class_list[0][2];
	print "<optgroup label=\"$source\">\n";
        foreach ($class_list as $cclass) {
          if ($cclass[2] != $source) {
	    $source = $cclass[2];
	    print "</optgroup>\n";
	    print "<optgroup label=\"$source\">\n";
	  }
	  if ($default == $cclass[0]) {
            print "<option id='$cclass[3]_$cclass[4]' value='$cclass[0]' selected>$cclass[0]</option>\n";
	    $default = $cclass[3];
	  } else {
            print "<option id='$cclass[3]_$cclass[4]' value='$cclass[0]'>$cclass[0]</option>\n";
          }
        }
	print "</optgroup>\n";
?>
    </select><input type='hidden' name='spell_list' value='<?= $default ?>'/></td>
    
  </tr>
  <tr><td style="border-style: none">&nbsp;</td><td style="border-style: none" align="right"><b><input type=submit value="Next"></b></td></tr>
</table>
<img src="../images/dnd_terminator.gif" alt="separator">
</form>

</body>

</html>
