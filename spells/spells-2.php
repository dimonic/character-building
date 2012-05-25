<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Spell query step 2</title>
<LINK rel="stylesheet" type=text/css href="../styles/table.css" title="php-style">
<script language="JavaScript" type="text/javascript">

  function validateSpecial()
  {
    var c;
    var prohibs = 0;
    var spec = document.query2.elements[3];
    var prohib = document.query2.elements[4];

    if (spec.value != 'Wizard') {
      return true;
    }
    for (c = 0; c < 8; c++) {
      prohibs += prohib.options[c].selected;
    }
    if (prohibs == 0 && spec.value == 'None') {
      return true;
    }
    if (prohibs == 1 && spec.value == 'Divination') {
      return true;
    }
    if (prohibs == 2 || prohibs == 3) {
      return true;
    }
    alert('Invalid number of prohibited classes for specialization ' + spec.value);
    return false;
  }

</script>
<?php

  require_once('DB.php');
  require_once('../phplib/metabase.lib.php');
  require_once('../phplib/dnd.lib.php');

  db_connect("dnd");

  $post = $_POST;

  $title = ucwords($post[cclass]);

  $cclass = $post[spell_list];
  $c = 0;
  $source = array();

  $source_select = get_sources('');
?>
</head>
<body>

<h3>You have selected class: <?= $title ?></h3>

  <p>Specialize, pick domains as appropriate, 
  Select the range of levels you need.</p>

<img src="../images/DND_R_1A_13.gif" alt="separator">

<form name="query2" action="spells-3.php" method="post" onSubmit="return validateSpecial();">

<input type="hidden" name="title" value="<?= $title ?>">
<input type="hidden" name="cclass" value="<?= $cclass ?>">
<input type="hidden" name="class_id" value="<?= $post[class_id] ?>">
<input type="hidden" name="sources" value="<?= $source_select ?>">

<table summary="Spell Search">

<?php

  if (stristr("cleric hospitaler master_of_shrouds temple_raider_of_olidammara", $cclass)) {
    echo "<tr><th>Domains</th></tr>\n";
    echo "<tr><td><select name=\"domain[]\" multiple>\n";
      // core cleric domains
?>
      <optgroup label="Player's Handbook">
      <option>Air</option>
      <option>Animal</option>
      <option>Chaos</option>
      <option>Death</option>
      <option>Destruction</option>
      <option>Earth</option>
      <option>Evil</option>
      <option>Fire</option>
      <option>Good</option>
      <option>Healing</option>
      <option>Knowledge</option>
      <option>Law</option>
      <option>Luck</option>
      <option>Magic</option>
      <option>Plant</option>
      <option>Protection</option>
      <option>Strength</option>
      <option>Sun</option>
      <option>Travel</option>
      <option>Trickery</option>
      <option>War</option>
      <option>Water</option>
      </optgroup>
<?php
    // Deities and Demigods
    if (in_array('DD', $source)) {
?>
      <optgroup label="Deities and Demigods">
      <option>Artifice</option>
      <option>Community</option>
      <option>Charm</option>
      <option>Creation</option>
      <option>Darkness</option>
      <option>Glory</option>
      <option>Liberation</option>
      <option>Madness</option>
      <option>Nobility</option>
      <option>Repose</option>
      <option>Rune</option>
      <option>Scalykind</option>
      <option>Weather</option>
      </optgroup>
<?php
    }
      // defenders of the faith domains
    if (in_array('DotF', $source)) {
?>
      <optgroup label="Defenders of the Faith">
      <option>Beastmaster</option>
      <option>Celerity</option>
      <option>Community</option>
      <option>Creation</option>
      <option>Divination</option>
      <option>Domination</option>
      <option>Exorcism</option>
      <option>Glory</option>
      <option>Inquisition</option>
      <option>Madness</option>
      <option>Mind</option>
      <option>Mysticism</option>
      <option>Pestilence</option>
      <option>Summoning</option>
      </optgroup>
<?php
    }
    // frcs domains
    if (in_array('FRCS', $source)) {
?>
      <optgroup label="Forgotten Realms Campaign Setting">
      <option>Cavern</option>
      <option>Charm</option>
      <option>Craft</option>
      <option>Darkness</option>
      <option>Drow</option>
      <option>Dwarf</option>
      <option>Elf</option>
      <option>Family</option>
      <option>Fate</option>
      <option>Gnome</option>
      <option>Halfling</option>
      <option>Hatred</option>
      <option>Illusion</option>
      <option>Mentalism</option>
      <option>Metal</option>
      <option>Moon</option>
      <option>Nobility</option>
      <option>Ocean</option>
      <option>Orc</option>
      <option>Planning</option>
      <option>Portal</option>
      <option>Renewal</option>
      <option>Retribution</option>
      <option>Rune</option>
      <option>Scalykind</option>
      <option>Slime</option>
      <option>Spell</option>
      <option>Spider</option>
      <option>Storm</option>
      <option>Suffering</option>
      <option>Time</option>
      <option>Trade</option>
      <option>Tyranny</option>
      <option>Undeath</option>
      </optgroup>
<?php
    }
    // Underdark domains
    if (in_array('Und', $source)) {
?>
      <optgroup label="Underdark">
      <option>Balance</option>
      <option>Portal</option>
      <option>Watery Death</option>
      </optgroup>
<?php

    }
    // Player's Guide to Faerun domains
    if (in_array('PG', $source)) {
?>
      <optgroup label="Player's Guide to Faerun">
      <option>Balance</option>
      <option>Cavern</option>
      <option>Charm</option>
      <option>Cold</option>
      <option>Craft</option>
      <option>Darkness</option>
      <option>Drow</option>
      <option>Dwarf</option>
      <option>Elf</option>
      <option>Family</option>
      <option>Fate</option>
      <option>Gnome</option>
      <option>Halfling</option>
      <option>Hatred</option>
      <option>Illusion</option>
      <option>Mentalism</option>
      <option>Metal</option>
      <option>Moon</option>
      <option>Nobility</option>
      <option>Ocean</option>
      <option>Orc</option>
      <option>Planning</option>
      <option>Portal</option>
      <option>Renewal</option>
      <option>Repose</option>
      <option>Retribution</option>
      <option>Rune</option>
      <option>Skalykind</option>
      <option>Slime</option>
      <option>Spell</option>
      <option>Spider</option>
      <option>Storm</option>
      <option>Suffering</option>
      <option>Time</option>
      <option>Trade</option>
      <option>Tyranny</option>
      <option>Undeath</option>
      <option>Watery Death</option>
      </optgroup>
<?php
    }
    // Faiths and Pantheons (FRCS)
    if (in_array('FP', $source)) {
?>
      <optgroup label="Faiths and Pantheons">
      <option>Repose</option>
      </optgroup>
<?php
    }
    // Book of Exalted Deeds
    if (in_array('BE', $source)) {
?>
      <optgroup label="Book of Exalted Deeds">
      <option>Celestial</option>
      <option>Community</option>
      <option>Endurance</option>
      <option>Fey</option>
      <option>Glory</option>
      <option>Herald</option>
      <option>Joy</option>
      <option>Pleasure</option>
      <option>Wrath</option>
      </optgroup>
<?php
    }
    // Eberron Campaign Setting
    if (in_array('ECS', $source)) {
?>
      <optgroup label="Eberron Campaign Setting">
      <option>Artifice</option>
      <option>Charm</option>
      <option>Commerce</option>
      <option>Community</option>
      <option>Deathless</option>
      <option>Decay</option>
      <option>Dragon Below</option>
      <option>Exorcism</option>
      <option>Feast</option>
      <option>Life</option>
      <option>Madness</option>
      <option>Meditation</option>
      <option>Necromancer</option>
      <option>Passion</option>
      <option>Weather</option>
      </optgroup>
<?php
    }
    echo "</select></td><td>Hold &lt;Ctrl&gt; and &lt;Click&gt; to make multiple selections</td></tr>\n";
  } else {
    if ($title == "Wizard") {
?>
      <tr><th>Specialization</th><th>Prohibited</th></tr>
      <td><select name="domain[]">
        <option>None</option>
        <option>Abjuration</option>
        <option>Conjuration</option>
        <option>Divination</option>
        <option>Enchantment</option>
        <option>Evocation</option>
        <option>Illusion</option>
        <option>Necromancy</option>
        <option>Transmutation</option>
      </select></td>
      <td><select name="prohibited[]" multiple>
        <option>Abjuration</option>
        <option>Conjuration</option>
        <option>Divination</option>
        <option>Enchantment</option>
        <option>Evocation</option>
        <option>Illusion</option>
        <option>Necromancy</option>
        <option>Transmutation</option>
      </select></td><td>Hold &lt;Ctrl&gt; and &lt;Click&gt; to make multiple selections</td></tr>
<?php
    }
  }

?>
    <tr><th>From level</th><td><select name="from_level">
      <option selected>0</option>
      <option>1</option>
      <option>2</option>
      <option>3</option>
      <option>4</option>
      <option>5</option>
      <option>6</option>
      <option>7</option>
      <option>8</option>
      <option>9</option>
      </select></td></tr>
  <tr><th>To level</th><td><select name="to_level">
      <option>0</option>
      <option>1</option>
      <option>2</option>
      <option>3</option>
      <option>4</option>
      <option>5</option>
      <option>6</option>
      <option>7</option>
      <option>8</option>
      <option selected>9</option>
      </select></td></tr>

  <tr><td>&nbsp;</td><td align="right"><b><input type=submit value="Next"></b></td></tr>
</table>
<img src="../images/dnd_terminator.gif" alt="separator">
</form>
</body>

</html>
