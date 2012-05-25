<?php
  require_once('DB.php');
  require_once('../phplib/lib.inc.php');
  require_once('../phplib/dnd.lib.php');
  require_once('../phplib/connect.inc.php');

  if (! check_login()) {
    header('WWW-Authenticate: Basic realm="Character Management"');
    header('HTTP/1.0 401 Unauthorized');

    echo( <<< NOLOGIN

<html>
<body>
<p>To get the full functionality of the character sheet manager, you need
to log in. If you do not have an account you can 
<a href="../users/new-account.php?../character/tabbed-page.php">create one here.</a></p>
NOLOGIN
);
  }

  $submit = $_POST[submit];

  switch ($submit) {
  case 'Add':
    $query = "INSERT INTO `characters` (`user_id`) VALUES ('$user_info[user_id]')";
    issue_query($query);
    $character_id = $db->getOne("SELECT LAST_INSERT_ID()");
    break;
  case 'Delete':
    $query = "DELETE FROM `characters` WHERE `id` = '$_POST[character_id]'";
    issue_query($query);
    header("Location: browse.php?$user_info[user_id]");
    break;
  default:
    $character_id = $_POST[character_id];
    break;
  }

	$this_tab = $_POST[tab_value];
  $prev_page = $_POST[prev_page];
  // echo "<pre>This tab: $this_tab</pre>\n";
  if (empty($this_tab)) {
    $this_tab = 'Character';
  }
  // echo "<pre>After empty-check This tab: $this_tab</pre>\n";
  // echo "<pre>Prev. page: $prev_page</pre>\n";


  $source = array();

  // get character from table
  $query = "SELECT * FROM `characters` WHERE `id` = '$character_id'";
  $query_result = issue_query($query);
  $character = $query_result->fetchRow(DB_FETCHMODE_ASSOC);
  $source_select = get_sources($character[sourcebooks]);

  if (!empty($prev_page)) {
    include("post_$prev_page");
  }

  if ($this_tab == 'Print') {
    include("char-sheet.php");
    exit();
  }

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<link rel="stylesheet" type=text/css href="../styles/table.css" title="php-style">
<title>Dungeons and Dragons Character Editor</title>
<script language="JavaScript" type="text/javascript" src="../javascript/pick-classes.js"></script>

<?php
  switch ($this_tab) {
    case 'Character':
?>
<script language="JavaScript" type="text/javascript" src="../javascript/cookies.js"></script>
</head>
<body  onLoad='updatePoints(); updateCurrentBonuses();'>
<?php
      break;
    case 'Feats':
?>
<script language="JavaScript" type="text/javascript">
  function updateFeat(field, num)
  {
    eval("field.form.feat" + num + ".value = field.value");

  }
</script>
</head>
<body>
<?php
      break;
    case 'Skills':
?>
<script language="JavaScript" type="text/javascript">
  function skillTotals(field, class_num, cross_class)
  {
    if (cross_class) {
      eval("field.form.class_" + class_num + "_skills_total.value = Math.floor(field.form.class_" + class_num + "_skills_total.value) + (Math.floor(field.value) - field.id) * 2;");
    } else {
      eval("field.form.class_" + class_num + "_skills_total.value = Math.floor(field.form.class_" + class_num + "_skills_total.value) + (Math.floor(field.value) - field.id);");
    }
    field.id = Math.floor(field.value);
  }
</script>
</head>
<body>
<?php
      break;
    default:
?>

</head>
<body>

<?php
      break;
  }
  // concept: each tab has a page, each page can be a form, it must process its own submit.
  // old_tab is to save changes to that form
  echo "<form enctype='multipart/form-data' name='query' action='$_SERVER[PHP_SELF]' method='post'>\n";
  echo "<input type='hidden' name='character_id' value='$character_id'/>\n";
  echo "<input type='hidden' name='tab_value' value='Character'/>\n";
  // echo "<pre>$_SERVER[HTTP_USER_AGENT]</pre>\n";

  $tabs = array('Character' => 'character.php', 'Feats' => 'feats.php', 'Skills' => 'skills.php', 'Arms and Armour' => 'magic_items.php', 'Equipment' => 'equipment.php', 'Spells' => 'spells.php', 'Print' => 'char-sheet.php');

  $ntabs = count($tabs);
  
  $tab_width = floor(700 / $ntabs - 2);
  foreach ($tabs as $tab => $page) {
    $tab_width = (strlen($tab) + 1) * 10;
    // mozilla sends 'value' of <input type=image...> element, and of <button...> elements
    // opera sends nothing of <input..> value
    // msie sends button contents (in this case the <img...> tag of button element)
    // and apparently nothing in <input type=image...> element
    echo "<input type='image' name='tab' value='$tab' onClick='this.form.tab_value.value = \"$tab\"' src='./mk_image.php?text=$tab&width=$tab_width";
    if ($tab == $this_tab) {
      echo "&active=1";
      $display_page = $page;
    }
    echo "'/>";
  }
  // create 'old_tab' field, so we know what to save on next page.
  echo "<input type='hidden' name='prev_page' value='$display_page'/>\n";

  include("form_$display_page");

?>
  </form>
<!-- BEGIN ChangeNotes Popup Link -->
<script language="JavaScript">
function watchit(url) {
  watchitWin = window.open('http://www.changenotes.com/addapage.php?url='+document.location,
	'watchitWindow',
	'scrollbars=yes,resizable=yes,toolbar=no,directories=no,status=no,menubar=no,height=550,width=600')
  watchitWin.focus()
  return false
}
</script>
<a href="http://www.changenotes.com/addapage.php" onclick='javascript:return watchit()'>Receive email when this page changes</a> 
<!-- END ChangeNotes Popup Link -->
</body>
</html>
