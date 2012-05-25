<html>
<head>
<title>Pick Source Books</title>
<LINK rel="stylesheet" type=text/css href="../styles/table.css" title="php-style">
<?php

require_once('DB.php');
require_once('../phplib/lib.inc.php');
require_once('../phplib/dnd.lib.php');
require_once('../phplib/connect.inc.php');
  
// we are called with source-book string

$source_string = $HTTP_GET_VARS[sourcebooks];
?>

<script language="JavaScript">

  function setStringFromSelection(field)
  {
    newval = field.name + ':' + field.checked;
    oldval = new RegExp(field.name + ':' + !field.checked);

    if (field.form.source_string.value.indexOf(field.name) != -1) {
      field.form.source_string.value = field.form.source_string.value.replace(oldval, newval);
    } else {
      field.form.source_string.value += '&' + newval;
    }
  }

  function setSelectionsFromString(form, source_string)
  {
    form.ph.checked = (source_string.indexOf('ph:true') != -1);
    form.dmg.checked = (source_string.indexOf('dmg:true') != -1);
    form.mm.checked = (source_string.indexOf('mm:true') != -1);

    form.rs.checked = (source_string.indexOf('rs:true') != -1);
    form.rd.checked = (source_string.indexOf('rd:true') != -1);
    form.rw.checked = (source_string.indexOf('rw:true') != -1);

    form.car.checked = (source_string.indexOf('car:true') != -1);
    form.cd.checked = (source_string.indexOf('cd:true') != -1);
    form.cw.checked = (source_string.indexOf('cw:true') != -1);
    form.cad.checked = (source_string.indexOf('cad:true') != -1);

    form.frcs.checked = (source_string.indexOf('frcs:true') != -1);
    form.pg.checked = (source_string.indexOf('pg:true') != -1);
    form.mag.checked = (source_string.indexOf('mag:true') != -1);
    form.rac.checked = (source_string.indexOf('rac:true') != -1);
    form.und.checked = (source_string.indexOf('und:true') != -1);
    form.fp.checked = (source_string.indexOf('fp:true') != -1);

    form.house.checked = (source_string.indexOf('house:true') != -1);
    form.ua.checked = (source_string.indexOf('ua:true') != -1);
    form.spc.checked = (source_string.indexOf('spc:true') != -1);
    form.bv.checked = (source_string.indexOf('bv:true') != -1);
    form.be.checked = (source_string.indexOf('be:true') != -1);
    form.xph.checked = (source_string.indexOf('xph:true') != -1);

    form.dd.checked = (source_string.indexOf('dd:true') != -1);
    form.lg.checked = (source_string.indexOf('lg:true') != -1);
    form.drm.checked = (source_string.indexOf('drm:true') != -1);

    form.ecs.checked = (source_string.indexOf('ecs:true') != -1);
  }

</script>
</head>

<body onLoad="setSelectionsFromString(document.pick, '<?= $source_string ?>');">

<h1>Source Book Chooser</h1>

  <h2>Select from more than 20 core and optional source books.</h2>
  <p>This page requires cookies to be enabled in your browser.</p>

<img src="../images/DND_R_1A_13.gif">
<form name="pick">
<table summary="Source Selection">

  <tr><th>Sources</th>
    <td>
      <table>
        <tr><th>Core Rules</th><th>Guide Books</th><th>Forgotten Realms</th><th>Other Sources</th></tr>
        <input type='hidden' name='source_string' value='<?= $source_string ?>'>

	<tr>
	  <td>
	    <input type="checkbox" name="ph" title="Player's Handbook" onClick="setStringFromSelection(this);">PH</input><br>
	    <input type="checkbox" name="dmg" title="Dungeon Master's Guide" onClick="setStringFromSelection(this);">DMG</input><br>
	    <input type="checkbox" name="mm" title="Monster Manual" onClick="setStringFromSelection(this);">MM</input>
	  </td>
	  <td>
	    <input type="checkbox" name="rd" onClick="setStringFromSelection(this);">Races of Destiny</input><sup>*</sup><img src="../images/new_red.gif" hspace='5'><br>
	    <input type="checkbox" name="rs" onClick="setStringFromSelection(this);">Races of Stone</input><sup>*</sup><img src="../images/new_red.gif" hspace='5'>    <br>
	    <input type="checkbox" name="rw" onClick="setStringFromSelection(this);">Races of the Wild</input><sup>*</sup><img src="../images/new_red.gif" hspace='5'>    <br>

	    <input type="checkbox" name="cad" onClick="setStringFromSelection(this);">Complete Adventurer</input><sup>*</sup><img src="../images/new_red.gif" hspace='5'><br>
	    <input type="checkbox" name="car" onClick="setStringFromSelection(this);">Complete Arcane</input><sup>*</sup><img src="../images/new_red.gif" hspace='5'><br>
	    <input type="checkbox" name="cd" onClick="setStringFromSelection(this);">Complete Divine</input><sup>*</sup><img src="../images/new_red.gif" hspace='5'><br>
	    <input type="checkbox" name="cw" onClick="setStringFromSelection(this);">Complete Warrior</input><sup>*</sup><img src="../images/new_red.gif" hspace='5'><br>

	  </td>
	  <td>
	    <input type="checkbox" name="pg" onClick="setStringFromSelection(this);">Player's Guide to Faerun</input><br>	  
	    <input type="checkbox" name="frcs" onClick="setStringFromSelection(this);">Forgotten Realms  Campaign Setting</input><br>
	    <input type="checkbox" name="mag" onClick="setStringFromSelection(this);">Magic of Faerun</input><br>
	    <input type="checkbox" name="rac" onClick="setStringFromSelection(this);">Races of Faerun</input><br>
	    <input type="checkbox" name="und" onClick="setStringFromSelection(this);">Underdark</input><br>
	    <input type="checkbox" name="fp" onClick="setStringFromSelection(this);">Faiths and Pantheons</input><br>
	  </td>
	  <td>
	    <input type="checkbox" name="house" onClick="setStringFromSelection(this);">House Rules<sup>*</sup></input><br>
	    <input type="checkbox" name="ua" onClick="setStringFromSelection(this);">Unearthed Arcana<sup>*</sup></input><br>
	    <input type="checkbox" name="spc" onClick="setStringFromSelection(this);">Spell Compendium<sup>*</sup></input><br>
	    <input type="checkbox" name="bv" onClick="setStringFromSelection(this);">Book of Vile Darkness<sup>*</sup></input><br>
	    <input type="checkbox" name="be" onClick="setStringFromSelection(this);">Book of Exalted Deeds</input><br>
	    <input type="checkbox" name="xph" onClick="setStringFromSelection(this);">Expanded Psionics Handbook</input><br>
	    <input type="checkbox" name="dd" onClick="setStringFromSelection(this);">Deities and Demigods</input><br>
	    <input type="checkbox" name="lg" onClick="setStringFromSelection(this);">Living Greyhawk Journals<sup>*</sup></input><br>
	    <input type="checkbox" name="drm" onClick="setStringFromSelection(this);">Dragon Magazines</input><sup>*</sup><br>
	    <input type="checkbox" name="ecs" onClick="setStringFromSelection(this);">Eberron Campaign Setting</input><sup>*</sup><img src="../images/new_red.gif" hspace='5'>
	  </td>
        </tr>
      </table>
    </td>
  </tr>

  <tr>
    <td colspan="2" align=right>
      <table>
        <tr>
	  <td>&nbsp;</td><td align="right"><b><button name=remember value="Save your
	    selections"
	    onClick="opener.document.query.sourcebooks.value=this.form.source_string.value; window.close();">Remember</button></b>
	  </td>
	  <td><button name=close value="Close" onClick="window.close();">Close</button></td>
	</tr>
      </table>
    </td>
  </tr>
</table>
<img src="../images/dnd_terminator.gif">
</form>
<p><sup>*</sup>Indicates item under development/incomplete</p>
</body>

</html>
