<?php

// connect
require_once('DB.php');
require_once('../phplib/metabase.lib.php');
require_once('../phplib/dnd.lib.php');

db_connect("dnd");
 
$submit = $_POST[submit];

switch ($submit) {
case 'Add':
  $query = "INSERT INTO `spell` (`name`) VALUES ('$_POST[spell_name]')";
  issue_query($query);
  $spell_num = $db->getOne("SELECT LAST_INSERT_ID()");
  break;
case 'Delete':
  $query = "DELETE FROM `spell` WHERE `spell_num` = '$_POST[spell_num]'";
  issue_query($query);
  header("Location: add-spell.php?");
  break;
default:
  $spell_num = $_POST[spell_num];
  break;
}

 
$query = "SELECT * FROM `spell` WHERE `spell_num` = '$spell_num'";
$result = issue_query($query);
$spell = $result->fetchRow(DB_FETCHMODE_ASSOC);

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


<table>

<tr><th class='Edit'>Name</th><td><?= form_input_text('spell', 'name', "'$spell[name]'"); ?></td></tr>
<tr><th class='Edit'>Exp. Components</th><td><?= form_input_text('spell', 'exp_components', "'$spell[exp_components]'"); ?></td></tr>
<tr><th class='Edit'>School</th><td><input type='text' name='school' value='<?= $spell[school] ?>'/></td></tr>
<tr><th class='Edit'>Sub-school</th><td><input type='text' name='subschool value='<?= $spell[subschool] ?>'/></td></tr>
<tr><th class='Edit'>Name</th><td><input type='text' name='name' value='<?= $spell[spell_name] ?>'/></td></tr>
<tr><th class='Edit'>Name</th><td><input type='text' name='name' value='<?= $spell[spell_name] ?>'/></td></tr>
<tr><th class='Edit'>Name</th><td><input type='text' name='name' value='<?= $spell[spell_name] ?>'/></td></tr>
<tr><th class='Edit'>Name</th><td><input type='text' name='name' value='<?= $spell[spell_name] ?>'/></td></tr>

</table>
<?php
}
?>

<img src="../images/dnd_terminator.gif" alt="separator">
</form>

</body>

</html>
