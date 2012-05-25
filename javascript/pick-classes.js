  var visitordata;
  var w;

  function showHelp(page)
  {
     w = window.open(page, 'Help', 'scrollbars=yes,resizable=yes,height=460,width=800');
     w.focus();
     return false;
  }

  function pickSources()
  { 
    w = window.open('../pick-source.php', 'SourceBooks', 'scrollbars=yes,resizable=yes,height=460,width=800');
    w.focus();
    return false; 
  }

  function pickCharSources(sourcebooks)
  { 
    w = window.open('pick-char-source.php?sourcebooks=' + sourcebooks, 'SourceBooks', 'scrollbars=yes,resizable=yes,height=460,width=800');
    w.focus();
    return false; 
  }

  function showFeat(feat)
  { 
    w = window.open('show-feat.php?feat_name=' + feat,'Feat','scrollbars=yes,resizable=yes,height=460,width=600');
    w.focus();
    return false; 
  }

  function showRegion(region)
  {
    w = window.open('show-region.php?region=' + region, 'Region','scrollbars=yes,resizable=yes,height=460,width=600');
    w.focus();
    false;
  }


function getQueryString(index)
{
  var paramExpressions;
  var param;
  var val;
  paramExpressions = window.location.search.substr(1).split("&");
  if (index < paramExpressions.length)
    {
      param = paramExpressions[index]; 
      if (param.length > 0) {
	return eval(unescape(param));
      }
    }
  return "";
}

  function pickImage(topdir, formfield, folder)
  {
    w = window.open("../treeview/pickImageFrameset.php?fld=" + folder + "&ff=" + formfield + "&topdir=" + topdir,
		    "Pick" + formfield,
		    'scrollbars=yes,resizable=yes,height=460,width=800');
    w.focus();
    return false;
  }


  function updateSkills(class_sp, level, num)
  {
    var sp = class_sp + document.query.intel_bonus.value;

    if (document.query.race.value == 'human')
      sp++;
    switch(num) {
      case 1:
        document.query.skills1.value = sp * (document.query.level1.value + 3);
	break;
      case 2:
	document.query.skills2.value = sp * document.query.level2.value;
	break;
      case 3:
	document.query.skills3.value = sp * document.query.level3.value;
	break;
      case 4:
	document.query.skills4.value = sp * document.query.level4.value;
	break;
    }
  }

  function updatePoints()
  {
    var points = 0;
    var form = document.query;

    points += form.str_cost.value = getPointCost(form.init_str.value - form.str_delta.value);
    // form.str.value = form.init_str.value;
    points += form.dex_cost.value = getPointCost(form.init_dex.value - form.dex_delta.value);
    // form.dex.value = form.init_dex.value;
    points += form.con_cost.value = getPointCost(form.init_con.value - form.con_delta.value);
    // form.con.value = form.init_con.value;
    points += form.intel_cost.value = getPointCost(form.init_intel.value - form.int_delta.value);
    // form.intel.value = form.init_intel.value;
    points += form.wis_cost.value = getPointCost(form.init_wis.value - form.wis_delta.value);
    // form.wis.value = form.init_wis.value;
    points += form.cha_cost.value = getPointCost(form.init_cha.value - form.cha_delta.value);
    // form.cha.value = form.init_cha.value;
    form.points.value = points;
  }


  function updateCurrentBonuses()
  {
    var form = document.query;

    if (form.str.value)
      form.str_bonus.value = Math.floor((form.str.value - 10) / 2);
    else
      form.str_bonus.value = '';
    if (form.dex.value)
      form.dex_bonus.value = Math.floor((form.dex.value - 10) / 2);
    else
      form.dex_bonus.value = '';
    if (form.con.value)
      form.con_bonus.value = Math.floor((form.con.value - 10) / 2);
    else
      form.con_bonus.value = '';
    if (form.intel.value)
      form.intel_bonus.value = Math.floor((form.intel.value - 10) / 2);
    else
      form.intel_bonus.value = '';
    if (form.wis.value)
      form.wis_bonus.value = Math.floor((form.wis.value - 10) / 2);
    else
      form.wis_bonus.value = '';
    if (form.cha.value)
      form.cha_bonus.value = Math.floor((form.cha.value - 10) / 2);
    else
      form.cha_bonus.value = '';
  }

  function updateEnhancedBonuses()
  {
    var form = document.query;

    if (form.enh_str.value)
      form.enh_str_bonus.value = Math.floor((form.enh_str.value - 10) / 2);
    else
      form.enh_str_bonus.value = '';
    if (form.enh_dex.value)
      form.enh_dex_bonus.value = Math.floor((form.enh_dex.value - 10) / 2);
    else
      form.enh_dex_bonus.value = '';
    if (form.enh_con.value)
      form.enh_con_bonus.value = Math.floor((form.enh_con.value - 10) / 2);
    else
      form.enh_con_bonus.value = '';
    if (form.enh_intel.value)
      form.enh_intel_bonus.value = Math.floor((form.enh_intel.value - 10) / 2);
    else
      form.enh_intel_bonus.value = '';
    if (form.enh_wis.value)
      form.enh_wis_bonus.value = Math.floor((form.enh_wis.value - 10) / 2);
    else
      form.enh_wis_bonus.value = '';
    if (form.enh_cha.value)
      form.enh_cha_bonus.value = Math.floor((form.enh_cha.value - 10) / 2);
    else
      form.enh_cha_bonus.value = '';
  }

  function getPointCost(value)
  {
    var points;

    points = value - 8;
    if (value > 14) {
      points += Math.min(value, 16) - 14;
      if (value > 16) {
        points += (value - 16) * 2;
      }
    }
    return points;
  }

