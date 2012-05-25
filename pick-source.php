<html>
<head>
<title>Pick Source Books</title>
<LINK rel="stylesheet" type=text/css href="styles/table.css" title="php-style">
<script language="JavaScript" src="javascript/cookies.js"></script>
<?php

require_once('DB.php');
require_once('phplib/lib.inc.php');
require_once('phplib/dnd.lib.php');
require_once('phplib/connect.inc.php');
  
// we should be called with user_id as get parameter

// $query = "SELECT `sourcebooks` FROM `characters` WHERE `character_id` = '$_GET[user_id]'";
// $query_result = issue_query($query);
// $character = $query_result->fetchRow(DB_FETCHMODE_ASSOC);

?>

<script language="JavaScript">
  var visitordata = new Cookie(parent.document, "sourcebooks", 365 * 24);

  if (!visitordata.load()) {
    alert('No existing cookie');
    visitordata.ph = 'true';
  }

  function setSelectionsFromCookies(form)
  {
    form.PH.checked = ('true' == visitordata.ph);
    form.DMG.checked = ('true' == visitordata.dmg);
    form.MM.checked = ('true' == visitordata.mm);

    form.SaF.checked = ('true' == visitordata.saf);
    form.DotF.checked = ('true' == visitordata.dotf);
    form.SaS.checked = ('true' == visitordata.sas);
    form.MW.checked = ('true' == visitordata.mw);
    form.TB.checked = ('true' == visitordata.tb);

    form.RS.checked = ('true' == visitordata.rs);
    form.RD.checked = ('true' == visitordata.rd);
    form.RW.checked = ('true' == visitordata.rw);

    form.CAr.checked = ('true' == visitordata.car);
    form.CD.checked = ('true' == visitordata.cd);
    form.CW.checked = ('true' == visitordata.cw);
    form.CAd.checked = ('true' == visitordata.cad);

    form.FRCS.checked = ('true' == visitordata.frcs);
    form.PG.checked = ('true' == visitordata.pg);
    form.Mag.checked = ('true' == visitordata.mag);
    form.Rac.checked = ('true' == visitordata.rac);
    form.Und.checked = ('true' == visitordata.und);
    form.FP.checked = ('true' == visitordata.fp);

    form.HOUSE.checked = ('true' == visitordata.house);
    form.UA.checked = ('true' == visitordata.ua);
    form.SpC.checked = ('true' == visitordata.spc);
    form.BV.checked = ('true' == visitordata.bv);
    form.BE.checked = ('true' == visitordata.be);
    form.XPH.checked = ('true' == visitordata.xph);

    form.DD.checked = ('true' == visitordata.dd);
    form.LG.checked = ('true' == visitordata.lg);
    form.DrM.checked = ('true' == visitordata.drm);

    form.ECS.checked = ('true' == visitordata.ecs);

  }

</script>
</head>

<body onLoad="setSelectionsFromCookies(document.pick);">

<h1>Source Book Chooser</h1>

  <h2>Select from more than 20 core and optional source books.</h2>
  <p>This page requires cookies to be enabled in your browser.</p>

<img src="images/DND_R_1A_13.gif">
<form name="pick">
<table summary="Source Selection">

  <tr><th>Sources</th>
    <td>
      <table>
        <tr><th>Core Rules</th><th>Guide Books</th><th>Forgotten Realms</th><th>Eberron</th><th>Other Sources</th></tr>
	<tr>
	  <td>
	    <input type="checkbox" name="PH" title="Player's Handbook" onClick="visitordata.ph=this.checked;">PH</input><br>
	    <input type="checkbox" name="DMG" title="Dungeon Master's Guide" onClick="visitordata.dmg=this.checked;">DMG</input><br>
	    <input type="checkbox" name="MM" title="Monster Manual" onClick="visitordata.mm=this.checked;">MM</input>
	  </td>
	  <td>

	    <input type="checkbox" name="SaF" onClick="visitordata.dotf=(this.checked ? 'true' : 'false');">Sword and Fist</input><br>
	    <input type="checkbox" name="DotF" onClick="visitordata.dotf=(this.checked ? 'true' : 'false');">Defenders of the Faith</input><br>
            <input type="checkbox" name="SaS" onClick="visitordata.sas=(this.checked ? 'true' : 'false');">Song and Silence</input><br>
	    <input type="checkbox" name="MW" onClick="visitordata.mw=(this.checked ? 'true' : 'false');">Masters of the Wild</input><br>
	    <input type="checkbox" name="TB" onClick="visitordata.tb=(this.checked ? 'true' : 'false');">Tome and Blood</input><br>

	    <input type="checkbox" name="RD" onClick="visitordata.rd=(this.checked ? 'true' : 'false');">Races of Destiny</input><sup>*</sup><br>
	    <input type="checkbox" name="RS" onClick="visitordata.rs=(this.checked ? 'true' : 'false');">Races of Stone</input><sup>*</sup><br>
	    <input type="checkbox" name="RW" onClick="visitordata.rw=(this.checked ? 'true' : 'false');">Races of the Wild</input><sup>*</sup><br>

	    <input type="checkbox" name="CAd" onClick="visitordata.cad=(this.checked ? 'true' : 'false');">Complete Adventurer</input><sup>*</sup><img src="images/new_red.gif" hspace='5'><br>	    <input type="checkbox" name="CAr" onClick="visitordata.car=(this.checked ? 'true' : 'false');">Complete Arcane</input><sup>*</sup><img src="images/new_red.gif" hspace='5'><br>
	    <input type="checkbox" name="CD" onClick="visitordata.cd=(this.checked ? 'true' : 'false');">Complete Divine</input><sup>*</sup><img src="images/new_red.gif" hspace='5'><br>
	    <input type="checkbox" name="CW" onClick="visitordata.cw=(this.checked ? 'true' : 'false');">Complete Warrior</input><sup>*</sup><img src="images/new_red.gif" hspace='5'><br>

	  </td>
	  <td>
	    <input type="checkbox" name="PG" onClick="visitordata.pg=(this.checked ? 'true' : 'false');">Player's Guide to Faerun</input><br>	  
	    <input type="checkbox" name="FRCS" onClick="visitordata.frcs=(this.checked ? 'true' : 'false');">Forgotten Realms  Campaign Setting</input><br>
	    <input type="checkbox" name="Mag" onClick="visitordata.mag=(this.checked ? 'true' : 'false');">Magic of Faerun</input><br>
	    <input type="checkbox" name="Rac" onClick="visitordata.rac=(this.checked ? 'true' : 'false');">Races of Faerun</input><br>
	    <input type="checkbox" name="Und" onClick="visitordata.und=(this.checked ? 'true' : 'false');">Underdark</input><br>
	    <input type="checkbox" name="FP" onClick="visitordata.fp=(this.checked ? 'true' : 'false');">Faiths and Pantheons</input><br>
	  </td>
	  <td>
	    <input type="checkbox" name="ECS" onClick="visitordata.ecs=(this.checked ? 'true' : 'false');">Eberron Campaign Setting</input><sup>*</sup><img src="images/new_red.gif" hspace='5'>
	  </td>
	  <td>
	    <input type="checkbox" name="HOUSE" onClick="visitordata.house=(this.checked ? 'true' : 'false');">House Rules<sup>*</sup></input><br>
	    <input type="checkbox" name="UA" onClick="visitordata.ua=(this.checked ? 'true' : 'false');">Unearthed Arcana<sup>*</sup></input><br>
	    <input type="checkbox" name="SpC" onClick="visitordata.spc=(this.checked ? 'true' : 'false');">Spell Compendium</input><sup>*</sup><br>

	    <input type="checkbox" name="BV" onClick="visitordata.bv=(this.checked ? 'true' : 'false');">Book of Vile Darkness<sup>*</sup></input><br>
	    <input type="checkbox" name="BE" onClick="visitordata.be=(this.checked ? 'true' : 'false');">Book of Exalted Deeds</input><br>
	    <input type="checkbox" name="XPH" onClick="visitordata.xph=(this.checked ? 'true' : 'false');">Expanded Psionics Handbook</input><br>
	    <input type="checkbox" name="DD" onClick="visitordata.dd=(this.checked ? 'true' : 'false');">Deities and Demigods</input><br>
	    <input type="checkbox" name="LG" onClick="visitordata.lg=(this.checked ? 'true' : 'false');">Living Greyhawk Journals<sup>*</sup></input><br>
	    <input type="checkbox" name="DrM" onClick="visitordata.drm=(this.checked ? 'true' : 'false');">Dragon Magazines</input><sup>*</sup><br>
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
	    onClick="visitordata.store(); opener.location.reload(); window.close();">Remember</button></b>
	  </td>
	  <td>
	    <button name=remove value="Remove this cookie" onClick="visitordata.remove(); opener.location.reload(); window.close();">Forget</button>
	  </td>
	  <td><button name=close value="Close" onClick="window.close();">Close</button></td>
	</tr>
      </table>
    </td>
  </tr>
</table>
<img src="images/dnd_terminator.gif">
</form>
<p><sup>*</sup>Indicates item under development/incomplete</p>
</body>

</html>
