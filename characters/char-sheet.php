<?php
  // TODO:
  // print knowledge with specifiers properly (at all)

  // connect DB stuff
  require_once('DB.php');
  require_once('../phplib/lib.inc.php');
  require_once('../phplib/dnd.lib.php');
  require_once('../phplib/connect.inc.php');

  require_once('get_bonuses.php');


define('FPDF_FONTPATH', '../phplib/font/');
require('../phplib/fpdf.php');
require('../phplib/mypdf.php');

class PDF extends MYPDF
{
  function header()
  {
    $this->SetMargins(0, 0, 0);
  }

  function name_block($xoff, $line)
  {
    global $character;
    global $user_info;

    $this->Image("../images/weapons/milanese_rapier.png", $xoff + 106, $line - 4, 100, 25);
    $this->text_cl($character["name"], 12, $xoff, $line - 2);
    $this->line_and_label("Character Name", $xoff, $line, 70);
    $this->text_cl($character["race"], 10, $xoff + 72, $line -2);
    $this->line_and_label("Race", $xoff + 72, $line, 32);
    $this->line_and_label("ECL", $xoff + 106, $line, 10);
    $this->text_cl($user_info["fullname"], 10, $xoff + 118, $line -2);
    $this->line_and_label("Player", $xoff + 118, $line, 70);
  }

  function class_block($xoff, $line)
  {
    global $character;
    
    for ($c = 1; $c < 5; $c++) {
      if ($character["class$c"] != "None" && $character["class$c"] != "") {
        $class_list .= $character["class$c"] . "(" . $character["level$c"] . ")";
        $d = $c + 1;
        if ($character["class$d"] != "None" && ! empty($character["class$d"])) {
          $class_list .= "/";
	}
      }
    }
    $this->text_cl($class_list, 10, $xoff, $line - 2);
    $this->line_and_label("Class", $xoff + 0, $line, 114);
    $this->text_cl($character["alignment"], 10, $xoff + 118, $line -2);
    $this->line_and_label("Alignment", $xoff + 118, $line, 18);
    $this->text_cl($character["deity"], 10, $xoff + 138, $line - 2);
    $this->line_and_label("Patron Deity", $xoff + 138, $line, 50);
  }

  function size_block($xoff, $line)
  {
    global $size;
    global $character;

    $this->line_and_label("Size", $xoff + 0, $line, 10);
    $this->text_cl($size, 9, $xoff + 0, $line - 2);
    $this->line_and_label("Age", $xoff + 12, $line, 10);
    $this->line_and_label("Gender", $xoff + 24, $line, 10);
    $this->text_cl($character[gender], 9, $xoff + 24, $line - 2);
    $this->line_and_label("Height", $xoff + 36, $line, 10);
    $this->line_and_label("Weight", $xoff + 48, $line, 10);
    $this->line_and_label("Eyes", $xoff + 60, $line, 10);
    $this->line_and_label("Hair", $xoff + 72, $line, 10);
    $this->line_and_label("Skin", $xoff + 84, $line, 10);
    $this->line_and_label("Homeland", $xoff + 96, $line, 50);
    $this->text_cl($character[region], 9, $xoff + 96, $line - 2);
    $this->line_and_label("Campaign", $xoff + 148, $line, 55);
    $this->text_cl($character[campaign], 9, $xoff + 148, $line - 2);
  }

  function ability_block($xoff, $line)
  {

    $this->ability_labels($xoff, $line - 1.5);

    $this->ability_line("STR", $xoff, $line, 'str');

    $line += 7;
    $this->ability_line("DEX", $xoff, $line, 'dex');

    $line += 7;
    $this->ability_line("CON", $xoff, $line, 'con');

    $line += 7;
    $this->ability_line("INT", $xoff, $line, 'intel');

    $line += 7;
    $this->ability_line("WIS", $xoff, $line, 'wis');

    $line += 7;
    $this->ability_line("CHA", $xoff, $line, 'cha');
  }

  function ability_labels($xoff, $line)
  {
    $this->label("ABILITY", $xoff + 2, $line);
    $this->label("SCORE", $xoff + 14, $line);
    $this->label("MODIFIER", $xoff + 23, $line);
    $this->label("TEMP.", $xoff + 35, $line);
    $this->label("MODIFIER", $xoff + 43, $line);
  }


  function save_labels($xoff, $line)
  {
    $this->text_l("TOTAL", 6, $xoff + 15, $line);
    $this->label_2("BASE SAVE", $xoff + 25, $line);
    $this->label_2("ABILITY MODIFIER", $xoff + 35, $line);
    $this->label_2("MAGIC MODIFIER", $xoff + 45, $line);
    $this->label_2("MISC MODIFIER", $xoff + 55, $line);
    $this->label_2("TEMP. MODIFIER", $xoff + 65, $line);
    $this->text_l("Conditional Modifiers", 6, $xoff + 75, $line);
    $this->label_2("TEMP. TOTAL", $xoff + 97, $line);
  }


  function save_block($xoff, $line)
  {
    global $fort;
    global $ref;
    global $will;
    global $fort_misc;
    global $ref_misc;
    global $will_misc;
    global $bonus_by_name;


    $total_bonus['Saves'] = bonus_total($bonus_by_name['Saves']);
    $total_bonus['Fort'] = bonus_total($bonus_by_name['Fort']);
    $total_bonus['Ref'] = bonus_total($bonus_by_name['Ref']);
    $total_bonus['Will'] = bonus_total($bonus_by_name['Will']);

    // echo "</pre>\n";
    $this->save_labels($xoff, $line - 2);
    $this->save_line("FORT", $xoff, $line, $fort, 'con', $total_bonus[Saves] + $total_bonus[Fort], $fort_misc);
    $line += 7;
    $this->save_line("REF", $xoff, $line, $ref, 'dex', $total_bonus[Saves] + $total_bonus[Ref], $ref_misc);
    $line += 7;
    $this->save_line("WILL", $xoff, $line, $will, 'wis', $total_bonus[Saves] + $total_bonus[Will], $will_misc);
  }

  function init_block($xoff, $line)
  {
    global $bonus_by_name;

    $this->blue_box_text("INIT", 12, $xoff, $line, 16, 9);
    $this->SetLineWidth(.4);
    $this->RoundedRect($xoff + 16, $line, 12, 9, 4);
    $this->SetLineWidth(.2);
    $this->text_l("=", 6, $xoff + 27.5, $line + 6);
    $this->label_2("DEX MODIFIER", $xoff + 29, $line + 1);
    $this->roundbox_value(att_bonus('dex'), 11, $xoff + 30, $line + 3, 7, 6);
    $this->text_l("+", 6, $xoff + 36.5, $line + 6);
    $this->label_2("MISC MODIFIER", $xoff + 37.5, $line + 1);

    $init_total = bonus_total($bonus_by_name['Initiative']);
    $this->roundbox_value($init_total, 11, $xoff + 39, $line + 3, 7, 6);
  }

  function ammo_block($title, $xoff, $line)
  {
    $this->label($title, $xoff + 5, $line);
    for ($c = 0; $c < 5; $c++) {
      $this->Rect($xoff + 33 + $c * 2, $line, 1.5, 1.5);
    }
    for ($c = 0; $c < 5; $c++) {
      $this->Rect($xoff + 44 + $c * 2, $line, 1.5, 1.5);
    }
    for ($c = 0; $c < 5; $c++) {
      $this->Rect($xoff + 33 + $c * 2, $line + 2, 1.5, 1.5);
    }
    for ($c = 0; $c < 5; $c++) {
      $this->Rect($xoff + 44 + $c * 2, $line + 2, 1.5, 1.5);
    }
    for ($c = 0; $c < 5; $c++) {
      $this->Rect($xoff + 33 + $c * 2, $line + 4, 1.5, 1.5);
    }
    for ($c = 0; $c < 5; $c++) {
      $this->Rect($xoff + 44 + $c * 2, $line + 4, 1.5, 1.5);
    }


    for ($c = 0; $c < 5; $c++) {
      $this->Rect($xoff + 86.5 + $c * 2, $line, 1.5, 1.5);
    }
    for ($c = 0; $c < 5; $c++) {
      $this->Rect($xoff + 97.5 + $c * 2, $line, 1.5, 1.5);
    }
    for ($c = 0; $c < 5; $c++) {
      $this->Rect($xoff + 86.5 + $c * 2, $line + 2, 1.5, 1.5);
    }
    for ($c = 0; $c < 5; $c++) {
      $this->Rect($xoff + 97.5 + $c * 2, $line + 2, 1.5, 1.5);
    }
    for ($c = 0; $c < 5; $c++) {
      $this->Rect($xoff + 86.5 + $c * 2, $line + 4, 1.5, 1.5);
    }
    for ($c = 0; $c < 5; $c++) {
      $this->Rect($xoff + 97.5 + $c * 2, $line + 4, 1.5, 1.5);
    }

    $line += 6;
    $this->line($xoff + 0, $line, $xoff + 32, $line); $this->line($xoff + 54, $line, $xoff + 85.5, $line);
  }

  function weapon_block($title, $xoff, $line, $num)
  {
    global $bab;
    global $character;

    $this->blue_box_text_tr($title, 10, $xoff + 0, $line, 38, 4);
    $line += 2;
    $this->black_box_text("TOTAL ATTACK BONUS", 4, $xoff + 38, $line, 30, 2);
    $this->black_box_text("DAMAGE", 4, $xoff + 68, $line, 24, 2);
    $this->black_box_text("CRITICAL", 4, $xoff + 92, $line, 15, 2);
    $line += 2;

    $this->SetDrawColor(0);
    $this->SetLineWidth(.2);

    if (!empty($character["weapon_$num"])) {
      $this->lbox_value($character["weapon_$num"] . " " . show_sign($character["weapon_{$num}_bonus"]), 10, $xoff + 0, $line, 38, 6);
    } else {
      $this->Rect($xoff + 0, $line, 38, 6);
    }
    $this->box_value($character["weapon_{$num}_attacks"], 9, $xoff + 38, $line, 30, 6);
    $this->box_value($character["weapon_{$num}_damage"], 9, $xoff + 68, $line, 24, 6);
    $this->box_value($character["weapon_{$num}_crit"], 9, $xoff + 92, $line, 15, 6);

    $line += 6;

    $this->black_box_text("RANGE", 4, $xoff + 0, $line, 10, 2);
    $this->black_box_text("WEIGHT", 4, $xoff + 10, $line, 10, 2);
    $this->black_box_text("TYPE", 4, $xoff + 20, $line, 10, 2);
    $this->black_box_text("SIZE", 4, $xoff + 30, $line, 10, 2);
    $this->black_box_text("SPECIAL PROPERTIES", 4, $xoff + 40, $line, 67, 2);

    $line += 2;

    $this->box_value($character["weapon_{$num}_range"] > 0 ? $character["weapon_{$num}_range"] : '', 8, $xoff + 0, $line, 10, 6);
    $this->box_value($character["weapon_{$num}_weight"] > 0 ? $character["weapon_{$num}_weight"] : '', 8, $xoff + 10, $line, 10, 6);
    $this->box_value($character["weapon_{$num}_type"], 8, $xoff + 20, $line, 10, 6);
    $this->box_value(substr($character["weapon_{$num}_size"], 0, 1), 8, $xoff + 30, $line, 10, 6);
    $this->lbox_value($character["weapon_{$num}_special"], 8, $xoff + 40, $line, 67, 6);
  }

  function armor_block($title, $xoff, $line)
  {
    global $character;

    $this->blue_box_text_tr($title, 10, $xoff + 0, $line, 47, 4);
    $line += 2;
    $this->black_box_text("TYPE", 4, $xoff + 47, $line, 10, 2);
    $this->black_box_text("BONUS", 4, $xoff + 57, $line, 10, 2);
    $this->black_box_text("MAX DEX", 4, $xoff + 67, $line, 10, 2);
    $this->black_box_text("CHECK PEN", 4, $xoff + 77, $line, 10, 2);
    $this->black_box_text("SPELL FAIL", 4, $xoff + 87, $line, 10, 2);
    $this->black_box_text("SPEED", 4, $xoff + 97, $line, 10, 2);

    $line += 2;

    $title = strtolower($title);
    $this->lbox_value($character["{$title}"], 10, $xoff + 0, $line, 47, 6);
    $this->box_value($character["{$title}_type"], 8, $xoff + 47, $line, 10, 6);
    $this->box_value(show_sign($character["{$title}_bonus"] + $character["{$title}_magic"]), 8, $xoff + 57, $line, 10, 6);
    $this->box_value($character["{$title}_max_dex"], 8, $xoff + 67, $line, 10, 6);
    $this->box_value($character["{$title}_check_pen"], 8, $xoff + 77, $line, 10, 6);
    $this->box_value($character["{$title}_spell_fail"], 8, $xoff + 87, $line, 10, 6);
    $this->Rect($xoff + 97, $line, 10, 6);
    $line += 6;
    $this->lbox_value($character["${title}_special"], 8, $xoff + 0, $line, 107, 6);
    $this->label("SPECIAL PROPERTIES", $xoff + 0, $line + 1);
  }


  function ability_line($title, $xoff, $line, $ability)
  {
    global $character;
    global $bonus_by_name;

    $this->blue_box_text($title, 12, $xoff + 0, $line, 14, 6);
    $this->SetLineWidth(.4);
    $this->SetDrawColor(0);
    $this->roundbox_value($character["$ability"], 11, $xoff + 14, $line, 9, 6);
    $prefix = (intval(($character["$ability"] - 10) / 2) > 0) ? '+' : '';
    $bonus = "$prefix" . intval(($character["$ability"] - 10) / 2);
    $this->roundbox_value($bonus, 11, $xoff + 23, $line, 9, 6);
    $this->SetDrawColor(175);
    $this->SetLineWidth(.6);
    $att_bonus = get_att_bonus($ability);
    if ($character["cur_$ability"] > 0 && $character["cur_$ability"] != $character["$ability"]) {
	$this->text_cc($character["cur_$ability"], 11, $xoff + 34, $line, 9, 6);
	$this->text_cc($att_bonus, 11, $xoff + 43, $line, 9, 6);
    } elseif ($bonus != $att_bonus) {
	$this->text_cc($character["$ability"] + bonus_by_name("$ability"), 11, $xoff + 34, $line, 9, 6);
	$this->text_cc($att_bonus, 11, $xoff + 43, $line, 9, 6);
    }
    $this->Rect($xoff + 34, $line, 9, 6);
    $this->Rect($xoff + 43, $line, 9, 6);
    $this->SetDrawColor(0);
  }

  function save_line($title, $xoff, $line, $save, $ability, $magic, $misc)
  {
    $bonus = att_bonus($ability);


    $this->blue_box_text($title, 12, $xoff + 0, $line, 14, 6);
    $this->SetDrawColor(0);
    $this->SetLineWidth(.4);
    $this->Rect($xoff + 15, $line, 9, 6);
    $this->text_l("=", 6, $xoff + 23.5, $line + 4);
    $this->SetLineWidth(.2);
    $this->roundbox_value("" . $save, 12, $xoff + 26, $line, 9, 6);
    $this->text_l("+", 6, $xoff + 34, $line + 4);
    $this->roundbox_value($bonus, 11, $xoff + 36, $line, 9, 6);
    $this->text_l("+", 6, $xoff + 44, $line + 4);
    // magic
    $this->box_value($magic, 10, $xoff + 46, $line, 9, 6);
    $this->text_l("+", 6, $xoff + 54, $line + 4);
    // misc
    $this->box_value($misc, 10, $xoff + 56, $line, 9, 6);
    $this->text_l("+", 6, $xoff + 64, $line + 4);
    $this->SetLineWidth(.6);
    $this->SetDrawColor(175);
    $this->Rect($xoff + 66, $line, 9, 6);
    $this->text_l("+", 6, $xoff + 74, $line + 4);
    $this->SetLineWidth(.2);
    $this->SetDrawColor(0);
    $this->Rect($xoff + 76, $line, 20, 3);
    $this->Rect($xoff + 76, $line + 3, 20, 3);
    $this->text_l("=", 6, $xoff + 95.5, $line + 4);
    $this->SetLineWidth(.6);
    $this->SetDrawColor(175);
    $this->Rect($xoff + 98, $line, 9, 6);
    $this->SetDrawColor(0);
  }

  function attack_block($title, $xoff, $line, $ability)
  {
    global $attacks;
    global $size;

    $this->blue_box_text($title, 12, $xoff + 0, $line, 20, 6);
    $this->SetDrawColor(0);
    $this->SetLineWidth(.4);
    $this->Rect($xoff + 21, $line, 20, 6);
    $this->text_l("=", 6, $xoff + 40.5, $line + 4);
    $this->SetLineWidth(.2);
    $this->roundbox_value($attacks, 10, $xoff + 43, $line, 20, 6);
    $this->text_l("+", 6, $xoff + 62.5, $line + 4);
    $bonus = att_bonus($ability);
    $this->roundbox_value($bonus, 10, $xoff + 65, $line, 9, 6);
    $this->text_l("+", 6, $xoff + 73.5, $line + 4);
    // size modifier
    switch ($size) {
      case 'Tiny':  $size_mod = -8; break;
      case 'Small': $size_mod = -4; break;
      case 'Large': $size_mod = '+4'; break;
    }
    $this->roundbox_value($size_mod, 10, $xoff + 76, $line, 9, 6);
//    $this->Rect($xoff + 76, $line, 9, 6);
    $this->text_l("+", 6, $xoff + 84.5, $line + 4);
    $this->Rect($xoff + 87, $line, 9, 6);
    $this->text_l("+", 6, $xoff + 95.5, $line + 4);
    $this->SetLineWidth(.6);
    $this->SetDrawColor(175);
    $this->Rect($xoff + 98, $line, 9, 6);
    $this->SetDrawColor(0);
  }

  function hp_block($xoff, $line)
  {
    global $hd;
    global $hd_calc;
    global $speed;
    global $bonus_by_name;
    global $character;

    $this->label("TMP. HP", $xoff + 29, $line - 1.5);
    $this->label("DAMAGE", $xoff + 40, $line - 1.5);
    $this->label("NON-LETHAL DAMAGE", $xoff + 81, $line - 1.5);

    $this->blue_box_text("HP", 18, $xoff, $line, 14, 10);
    $this->SetDrawColor(0);
    $this->SetLineWidth(.4);
    $this->roundbox_value($hd_calc, 14, $xoff + 14, $line, 12, 10);
    $this->SetDrawColor(175);
    $this->SetLineWidth(.6);    
    $this->RoundedRect($xoff + 28, $line, 11, 10, 3);
    $this->SetDrawColor(0);
    $this->SetLineWidth(.4);
    $this->Rect($xoff + 40, $line, 40, 10);
    $this->Rect($xoff + 81, $line, 32, 10);
    $this->blue_box_text_tr("HIT DICE", 5, $xoff + 114, $line, 20, 2.5);
    $this->black_box_text("1", 5, $xoff + 114, $line + 3, 4.5, 2);
    $this->black_box_text("2", 5, $xoff + 119.17, $line + 3, 4.5, 2);
    $this->black_box_text("3", 5, $xoff + 124.33, $line + 3, 4.5, 2);
    $this->black_box_text("4", 5, $xoff + 129.5, $line + 3, 4.5, 2);
    $this->SetLineWidth(.2);
    $this->box_value($hd[0], 8, $xoff + 114, $line + 5, 5, 5);
    $this->box_value($hd[1], 8, $xoff + 119, $line + 5, 5, 5);
    $this->box_value($hd[2], 8, $xoff + 124, $line + 5, 5, 5);
    $this->box_value($hd[3], 8, $xoff + 129, $line + 5, 5, 5);
    $this->blue_box_text_tr("SPEED", 5, $xoff + 135, $line, 15, 2.5);
    if ($character['race'] != 'Dwarf') {
	switch ($character['armor_type']) {
	    case 'H';
	    case 'M':
		$speed = ($speed == 30) ? 20 : 15;
	        break;
	}
    }
    $bonus = bonus_total($bonus_by_name['Speed']);
    $this->box_value($speed . (empty($bonus) ? '' : ' +' . $bonus), 10, $xoff + 135, $line + 3, 15, 7);
  }  

  function ac_block($xoff, $line)
  {
    global $size;
    global $character;
    global $bonus_by_name;

    // scan bonuses from items and feats
    if (is_array($bonus_by_name) && !empty($bonus_by_name['AC'])) {
      foreach($bonus_by_name['AC'] as $type => $value) {
        switch ($type) {
          case 'armor':
	    $armor = max($armor, $value);
            break;
          case 'deflection':
	    $deflection = max($deflection, $value);
	    break;
          case 'natural armor':
	    $nat_arm = max($nat_arm, $value);
	    break;
          case 'shield':
	    $shield = max($shield, $value);
	    break;
          case 'size':
	    $size += $value;
	    break;
          default:
	    $misc += $value;
    	    break;
        }
      }
    }
    $this->blue_box_text("AC", 18, $xoff + 56, $line, 14, 10);
    $this->SetDrawColor(0);
    $this->SetLineWidth(.4);
    $this->RoundedRect($xoff + 70, $line, 12, 10, 3);
    $this->SetDrawColor(175);
    $this->SetLineWidth(.6);
    $this->RoundedRect($xoff + 84, $line, 11, 10, 3);
    $this->SetDrawColor(0);
    $this->SetLineWidth(.2);
    $this->text_l("=", 6, $xoff + 94.5, $line +6);
    $this->label_2("ARMOR BONUS", $xoff + 96, $line + 1.5);
    $armor_bonus = max($character[armor_bonus] + $character[armor_magic], $armor);
    $this->box_value($armor_bonus, 8, $xoff + 97, $line + 3.5, 7, 6);
    $this->text_l("+", 6, $xoff + 103.5, $line +6.5);
    $this->label_2("SHIELD BONUS", $xoff + 105, $line + 1.5);
    $shield_bonus = max($character[shield_bonus] + $character[shield_magic], $shield);
    $this->box_value($shield_bonus, 8, $xoff + 106, $line + 3.5, 7, 6);
    $this->text_l("+", 6, $xoff + 112.5, $line +6.5);
    $this->label_2("DEX MODIFIER", $xoff + 114, $line + 1.5);
    if (!empty($character["armor_max_dex"]) || !empty($character["shield_max_dex"]))
      $max_dex = $character["armor_max_dex"] + $character["shield_max_dex"];
    else
      $max_dex = 99;
    $dex_bonus = min($max_dex, att_bonus('dex'));
    $this->box_value($dex_bonus, 8, $xoff + 115, $line + 3.5, 7, 6);
    $this->text_l("+", 6, $xoff + 121.5, $line +6.5);
    $this->label_2("DEFLECT. MODIFIER", $xoff + 123, $line + 1.5);
    $this->box_value($deflection, 8, $xoff + 124, $line + 3.5, 7, 6);
    $this->text_l("+", 6, $xoff + 130.5, $line +6.5);
    $this->label_2("SIZE MODIFIER", $xoff + 132, $line + 1.5);
    $size_bonus = ($size == 'Small' ? 1 : $size == 'Large' -1);
    $this->box_value($size_bonus, 8, $xoff + 133, $line + 3.5, 7, 6);
    $this->text_l("+", 6, $xoff + 139.5, $line +6.5);
    $this->label_2("NAT. ARMOR", $xoff + 141, $line + 1.5);
    $this->box_value($nat_arm, 8, $xoff + 142, $line + 3.5, 7, 6);
    $this->text_l("+", 6, $xoff + 148.5, $line +6.5);
    $this->label_2("MISC. MODIFIER", $xoff + 150, $line + 1.5);
    $this->box_value($misc, 8, $xoff + 151, $line + 3.5, 7, 6);
    $this->text_l(10 + $armor_bonus + $shield_bonus + $dex_bonus + $deflection + $size_bonus + $nat_arm + $misc, 14, $xoff + 72, $line + 5.5);
    $this->SetXY($xoff + 157.5, $line + 4);
    $this->SetFont('Arial', 'B', 10);
    $this->Cell(6, 6, "+10", 0);

    $this->label_2("DAMAGE REDUCT.", $xoff + 164.5, $line + 1.5);
    $this->Rect($xoff + 166, $line + 3.5, 8, 6);
    $this->label_2("MISS CHANCE", $xoff + 173.5, $line + 1.5);
    $this->Rect($xoff + 175, $line + 3.5, 7, 6);
    $this->label_2("SPELL FAILURE", $xoff + 181.5, $line + 1.5);
    $this->Rect($xoff + 183, $line + 3.5, 7, 6);
    $this->label_2("CHECK PENALTY", $xoff + 189.5, $line + 1.5);
    $this->Rect($xoff + 191, $line + 3.5, 7, 6);
    $this->label_2("SPELL RESIST.", $xoff + 197.5, $line + 1.5);
    $this->Rect($xoff + 199, $line + 3.5, 7, 6);
  }

  function skill_block($xoff, $line)
  {
    global $sp;

    $this->blue_box_text_tr("SKILLS", 9, $xoff + 0, $line, 53, 3.5);
    $this->text_box("/", 8, $xoff + 53, $line, 10, 3.5);
    $line += 3.5;

    $this->black_box_text("1", 6, $xoff + 0, $line, 2, 3);
    $this->black_box_text("2", 6, $xoff + 2, $line, 2, 3);
    $this->black_box_text("3", 6, $xoff + 4, $line, 2, 3);
    $this->black_box_text("4", 6, $xoff + 6, $line, 2, 3);

    $this->text_cl($sp[0], 6, $xoff - 1, $line + 4.5);
    $this->text_cl($sp[1], 6, $xoff + 1, $line + 4.5);
    $this->text_cl($sp[2], 6, $xoff + 3, $line + 4.5);
    $this->text_cl($sp[3], 6, $xoff + 5, $line + 4.5);

    $this->text_l("SKILL NAME", 6, $xoff + 8, $line + 3);
    $this->Rect($xoff + 37, $line, 6, 6);
    $this->label_2("TOTAL", $xoff + 35, $line + 4);
    $this->Rect($xoff + 43, $line, 7, 6);
    $this->label_2("ABILITY MOD", $xoff + 41, $line + 3);
    $this->Rect($xoff + 50, $line, 7, 6);
    $this->label_2("RANKS", $xoff + 48.5, $line + 4);
    $this->Rect($xoff + 57, $line, 6, 6);
    $this->label_2("MISC MOD", $xoff + 55, $line + 3);
    $this->SetLineWidth(.4);
    $this->Line($xoff, $line + 6, $xoff + 63, $line + 6);
    $this->SetLineWidth(.2);
  }

  function dingBat($char, $xoff, $line)
  {
    $this->SetFont('ZapfDingbats', '', 6);
    $this->SetXY($xoff, $line);
    $this->Cell(2, 0, $char);
    $this->SetFont('Arial');
  }

  function skill_item($skill_row, $specifier, $ranks, $xoff, $line)
  {
    global $skill_array;
    global $bonus_array;

    $skill = $skill_row[name];

    if ($skill_row[optional] == 'Yes' && $ranks == 0) {
      return 0;
    }    
    $cando = false;
    for ($c = 0; $c < 4; $c++) {
      $x = $xoff + $c * 2;
      $this->Rect($x, $line, 2, 2);
      $n = 0;
      while ($skill_array[$c][$n]) {
        if (strncasecmp($skill, $skill_array[$c][$n], strlen($skill_array[$c][$n])) == 0) {
	  $this->dingBat("3", $x - 1, $line + 1);
	  $cando = true;
	  break;
	}
	$n++;
      }
    }
    if ($skill_row[skill_specifier] == 'Yes') {
	if ($specifier == '') {
	    $skill_print = $skill . ' (________)';
	} else {
	    $skill_print = $skill . " ($specifier)";
	}
    } else {
	$skill_print = $skill;
    }
    $wid = $this->text_l($skill_print, 5, $xoff + 8, $line + 1);
    
    $this->SetFillColor(0);
    if ($skill_row[untrained] == 'Yes') {
      $this->Rect($xoff + 8 + $wid + 2, $line + .5, .75, .75, 'F');
      $cando = true;
    }
    $this->text_c($skill_row[key_ability], 6, $xoff + 30.5, $line + 1, 7, 0);
    if ($skill_row[armor_check_penalty] == 'Yes') {
      $this->dingBat("L", $xoff + 35, $line + .5);
    }
    $this->Rect($xoff + 37.5, $line - 1, 5, 3.5);
    $this->text_l("=", 6, $xoff + 42, $line + 1.25);
    if ($cando || $ranks) {
      $ability = strtolower($skill_row[key_ability]); 
      if ($ability == 'int') $ability = 'intel';
      $bonus = att_bonus($ability);
      $this->text_cl($bonus + $ranks + $bonus_array[$skill], 6, $xoff + 37.5, $line + 1.25);
      $this->text_cl($bonus, 6, $xoff + 44, $line + 1.25);
    }
    $this->Line($xoff + 44, $line +3, $xoff + 49, $line + 3);
    $this->text_l("+", 6, $xoff + 48.5, $line + 1.25);
    if ($ranks > 0) {
      $this->text_cl($ranks, 6, $xoff + 51, $line + 1.25);
    }
    $this->Line($xoff + 51, $line +3, $xoff + 56, $line + 3);
    $this->text_l("+", 6, $xoff + 55.5, $line + 1.25);
    // $skill = ereg_replace(' ', '_', $skill);
    // echo "<pre>$skill $bonus_array[$skill]</pre>\n";
    if ($cando) {
      $this->text_l($bonus_array[$skill], 6, $xoff + 57, $line + 1.25);
    }
    $this->Line($xoff + 58, $line +3, $xoff + 63, $line + 3);
    return 1;
  }

  // (skill_name, untrained, ability, armor_check_pen, x-off, y-off)
  function skill_list($xoff, $line)
  {
      global $source_select;
      global $bonus_array;
      global $conditional_bonus;
      global $bonus_by_name;

      $skills_bonus = bonus_total($bonus_by_name[Skills]);
      $query = "SELECT * FROM `skills` WHERE $source_select ORDER BY `name`";
      $skill_num = 1;
      $query_result = issue_query($query);
      while($skill_row = $query_result->fetchRow(DB_FETCHMODE_ASSOC)) {
	  if (DB::isError($skill_row)) {
	      die($skill_row->getMessage());
	  }
	  $skill_id = $skill_row[skill_id];
	  $name = $skill_row[name];
	  $new_bonus_array = $bonus_array[$name];
	  $total_bonus = 0;
	  
	  $total_bonus = bonus_total($bonus_by_name[$name]) + $skills_bonus;
	  // add synergy bonus(es) here
	  // query for which skills would benefit current skill_id
	  $query = "SELECT * FROM `synergies` WHERE `synergy_skill_id` = '$skill_id'";
	  $synergy_result = issue_query($query);
	  while($synergy = $synergy_result->fetchRow(DB_FETCHMODE_ASSOC)) {
	      if (DB::isError($skill_row)) {
		  die($skill_row->getMessage());
	      }
	      $query = "SELECT * FROM `character_skills` WHERE `character_id` = '$_POST[character_id]' AND `skill_id` = '$synergy[skill_id]'";
	      $cs_result = issue_query($query);
	      while($cs_row = $cs_result->fetchRow(DB_FETCHMODE_ASSOC)) {
		  if ($cs_row[class_1_ranks] + $cs_row[class_2_ranks] + $cs_row[class_3_ranks] + $cs_row[class_4_ranks] >= 5) {
		      if (empty($synergy[condition])) {
			  $total_bonus += 2;
		      } else {
			  $conditional_bonus[$name] .= "+2 $synergy[condition]\n";
		      }
		  }
	      }
	  }
	  // echo "<pre>$name += $total_bonus</pre>\n";
	  $bonus_array[$name] += $total_bonus;
	  $query = "SELECT * FROM `character_skills` WHERE `character_id` = '$_POST[character_id]' AND `skill_id` = '$skill_id'";
	  $cs_result = issue_query($query);
	  while ($cs_row = $cs_result->fetchRow(DB_FETCHMODE_ASSOC)) {
	      if ($this->skill_item($skill_row, $cs_row[skill_specifier], $cs_row[class_1_ranks] + $cs_row[class_2_ranks] + $cs_row[class_3_ranks] + $cs_row[class_4_ranks], $xoff, $line, $skill_array)) {
		  $skill_num++;
		  $line += 3.5;
	      }
	  }
      }
      $skill_row = array('name' => "________________", 'optional' => 'No', 'skill_specifier' => 'No');
      for ($c = $skill_num; $c < 59; $c++) {
	  $this->skill_item($skill_row, '', 0, $xoff, $line, $skill_array);
	  $line += 3.5;
      }
      $this->Rect($xoff, $line + 1, 1, 1, 'F');
      $this->label("Denotes a skill that can be used untrained", $xoff + 1, $line + 2);
      $line += 2;
      $this->dingBat("L", $xoff - 1.5, $line + 1.5);
      $this->label("Armor check penalty applies (double penalty for swim)", $xoff + 1, $line + 2);
  }

  function protective_items_block($xoff, $line)
  {
    global $character;
    global $character_item_row;

    $this->blue_box_text_tr("PROTECTIVE ITEMS", 10, $xoff + 0, $line, 47, 4);
    $line += 2;
    $this->black_box_text("BONUS", 4, $xoff + 47, $line, 10, 2);
    $this->black_box_text("TYPE", 4, $xoff + 57, $line, 10, 2);
    $this->black_box_text("MISCELLANEOUS", 4, $xoff + 67, $line, 40, 2);

    $line += 2;
    $items_found = 0;
    for ($c = 0; $character_item_row[$c]; $c++) {
      if (ereg('AC', $character_item_row[$c][properties])) {
        parse_str($character_item_row[$c][properties], $bonuses);
	foreach ($bonuses as $property => $type) {
	  if ($property == 'AC') {
	    ereg('([^(]*)(\(([^)]*)\))*', $type, $bonus);
	    // echo "<pre>item = " . $character_item_row[$c][name] . ", bonus = $bonus[1], type = $bonus[3]</pre>\n";
	    $name = $character_item_row[$c]['name'];
	    switch ($character_item_row[$c]['type']) {
	      case 'ring':
	      case 'rod':
	        $name = $character_item_row[$c]['type'] . ' of ' . $character_item_row[$c]['name'];
	      case 'armor':
	      case 'shield':
	      case 'weapon':
	      case 'wondrous':
	        $this->lbox_value($name, 8, $xoff + 0, $line, 47, 6);
		$this->box_value(blank_zero($bonus[1]), 8, $xoff + 47, $line, 10, 6);
		$this->box_value($bonus[3], 8, $xoff + 57, $line, 18, 6);
		$this->lbox_value($character_item_row['brief_description'], 8, $xoff + 75, $line, 32, 6);
		$line += 6;
		$items_found++;
		break;
	      case 'mundane':
	      case 'potion':
	      case 'scroll':
	      case 'staff':
	      default:
	        next;
		break;
	    } // endswitch
	    if ($items_found > 4) {
	      break;
	    }
	  } //endif
	} // endforeach
      } // endif
      if ($items_found > 4) {
	break;
      }
    }
    for ($c = $items_found; $c < 4; $c++) {
      $this->lbox_value('', 8, $xoff + 0, $line, 47, 6);
      $this->box_value('', 8, $xoff + 47, $line, 10, 6);
      $this->box_value('', 8, $xoff + 57, $line, 18, 6);
      $this->lbox_value('', 8, $xoff + 75, $line, 32, 6);
      $line += 6;
    }
  }

  function exp_block($xoff, $line)
  {
    global $character;
    $val = 0;

    $this->Rect($xoff, $line, 80, 6);
    for ($c = 0; $c <= ($character[level1] + $character[level2] + $character[level3] + $character[level4]); $c++) {
      $val += $c * 1000;
    }
    $this->roundbox_value($val, 10, $xoff + 80, $line, 20, 6);
    $line += 8;
    $this->text_l("Experience", 6, $xoff, $line);
    $this->text_l("Experience needed", 6, $xoff + 80, $line);
  }

  function gear_block($xoff, $line)
  {
    global $character;
    $count = 0;

    $this->blue_box_text_tr("GEAR", 12, $xoff, $line, 100, 6);
    $line += 6;
    $this->SetLineWidth(.4);
    $this->Rect($xoff, $line, 100, 99);
    $this->Line($xoff + 50, $line, $xoff + 50, $line + 99);
    $this->SetLineWidth(.2);
    $this->Line($xoff + 12, $line, $xoff + 12, $line + 99);
    $this->Line($xoff + 42, $line, $xoff + 42, $line + 99);
    $this->Line($xoff + 62, $line, $xoff + 62, $line + 99);
    $this->Line($xoff + 92, $line, $xoff + 92, $line + 99);
    $line += 2;
    $this->text_l("Cost", 6, $xoff, $line);
    $this->text_l("Item", 6, $xoff + 12, $line);
    $this->text_l("WT.", 6, $xoff + 42, $line);
    $this->text_l("Cost", 6,$xoff + 50, $line);
    $this->text_l("Item", 6, $xoff + 62, $line);
    $this->text_l("WT.", 6, $xoff + 92, $line);
    $line += 1;
    $this->Line($xoff, $line, $xoff + 100, $line);
    $line += 4;
    for ($c = 1; $c <= 5; $c++) {
      if (!empty($character["weapon_{$c}"]) && $character["weapon_{$c}_include"] && $character["weapon_{$c}_bonus"] == 0) {
        $this->text_cr($character["weapon_{$c}_cost"], 7, $xoff + 4, $line + $count * 4 - 2, 9);
	$total_price += $character["weapon_{$c}_cost"];
        $this->text_cl($character["weapon_{$c}"], 7, $xoff + 12, $line + $count * 4 - 2);
        $this->text_cr($character["weapon_{$c}_weight"], 7, $xoff + 42, $line + $count * 4 - 2, 8);
	$total_weight += $character["weapon_{$c}_weight"];
        $this->Line($xoff, $line + $count * 4, $xoff + 100, $line + $count * 4);
	$count++;
      }
    }
    if (!empty($character["armor"]) && $character["armor_magic"] == 0) {
      $this->text_cr($character["armor_cost"], 7, $xoff + 4, $line + $count * 4 - 2, 9);
      $total_price += $character["armor_cost"];
      $this->text_cl("Armor, " . $character["armor"], 7, $xoff + 12, $line + $count * 4 - 2);
      $this->text_cr($character["armor_weight"], 7, $xoff + 42, $line + $count * 4 - 2, 8);
      $total_weight += $character["armor_weight"];
      $this->Line($xoff, $line + $count * 4, $xoff + 100, $line + $count * 4);
      $count++;
    }
    if (!empty($character["shield"]) && $character["shield_magic"] == 0) {
      $this->text_cr($character["shield_cost"], 7, $xoff + 4, $line + $count * 4 - 2, 9);
      $total_price += $character["shield_cost"];
      $this->text_cl("Shield, " . $character["shield"], 7, $xoff + 12, $line + $count * 4 - 2);
      $this->text_cr($character["shield_weight"], 7, $xoff + 42, $line + $count * 4 - 2, 8);
      $total_weight += $character["shield_weight"];
      $this->Line($xoff, $line + $count * 4, $xoff + 100, $line + $count * 4);
      $count++;
    }
    $query = "SELECT * FROM `character_equipments` WHERE `character_id` = '$_POST[character_id]' ORDER BY `location`, `character_equipment_id`";
    $query_result = issue_query($query);
    $equip_done = false;
    for (; $count <= 22; $count++) {
      if ($equipment_row = $query_result->fetchRow(DB_FETCHMODE_ASSOC)) {
        $this->text_cr($equipment_row["price"], 7, $xoff + 4, $line + $count * 4 - 2, 9);
	$total_price += $equipment_row["price"];
	$this->text_cl($equipment_row["name"] . " " . $equipment_row["description"], 7, $xoff + 12, $line + $count *4 - 2);
	$this->text_cr($equipment_row["weight"], 7, $xoff + 42, $line + $count * 4 - 2, 8);
	$total_weight += $equipment_row["weight"];
        $this->Line($xoff, $line + $count * 4, $xoff + 100, $line + $count * 4);
      } else {
        $equip_done = true;
        break;
      }
    }
    if (!$equip_done) {
      // print totals if rows were full
      $this->text_cr(sprintf("%.2f", $total_price), 7, $xoff + 4, $line + $count * 4 - 2, 9);
      $this->text_cr(sprintf("%.2f", $total_weight), 7, $xoff + 42, $line + $count * 4 - 2, 8);
      // then start second column
      for ($c = 0; $c <= 22; $c++) {
        if ($equipment_row = $query_result->fetchRow(DB_FETCHMODE_ASSOC)) {
          $this->text_cr($equipment_row["price"], 7, $xoff + 54, $line + $c * 4 - 2, 9);
	  $this->text_cl($equipment_row["name"] . " " . $equipment_row["description"], 7, $xoff + 62, $line + $c *4 - 2);
          $this->text_cr($equipment_row["weight"], 7, $xoff + 92, $line + $c * 4 - 2, 8);
        } else {
          break;
        }
      }
      // for now, we don't print totals on unfinished column so we can hand-write more stuff
    }
    for ($c = $count; $c < 23; $c++) {
      $this->Line($xoff, $line + $c * 4, $xoff + 100, $line + $c * 4);
    }
    $this->Line($xoff, $line +87, $xoff + 100, $line +87);
    $this->text_l("TOTALS", 10,$xoff + 18, $line + 90);
    $this->text_l("TOTALS", 10,$xoff + 68, $line + 90);
  }

  function load_block($xoff, $line)
  {
    global $character;
    global $size;

    $load_array = array(0, 10, 20, 30, 40, 50, 60,  70,  80,  90, 100,
                          115,130,150,175,200,230, 260, 300, 350, 400,
			  460,520,600,700,800,920,1040,1200,1400);

    $this->blue_box_text("ENCUMBRANCE", 10, $xoff, $line, 49, 6);
    $line += 8;

    $this->text_c("LIGHT LOAD", 6, $xoff + 7, $line, 1, 0);
    $this->text_c("MED. LOAD", 6, $xoff + 24, $line, 1, 0); 
    $this->text_c("HEAVY LOAD", 6, $xoff + 41, $line, 1, 0); 

    $line += 3;

    $str = ($character[cur_str] > 0) ? $character[cur_str] : $character[str];
    $this->SetLineWidth(.4);
    $this->roundbox_value(intval($load_array[$str] * ($size == 'Small' ? .75 : ($size == 'Large' ? 2 : 1)) / 3), 10, $xoff, $line, 15, 6);
    $this->roundbox_value(intval($load_array[$str]  * 2 * ($size == 'Small' ? .75 : ($size == 'Large' ? 2 : 1)) / 3), 10, $xoff + 17, $line, 15, 6);
    $this->roundbox_value(intval($load_array[$str] * ($size == 'Small' ? .75 : ($size == 'Large' ? 2 : 1))), 10, $xoff + 34, $line, 15, 6);
    $this->SetLineWidth(.2);
    
    $line += 10;

    $this->label_2("LIFT OVER HEAD", $xoff + 1, $line, 1, 0);
    $this->label_2("LIFT OFF GROUND", $xoff + 18, $line, 1, 0);
    $this->text_c("DRAG", 6, $xoff + 41, $line, 1, 0); 

    $line += 4;

    $this->SetLineWidth(.4);
    $this->roundbox_value($load_array[$str] * ($size == 'Small' ? .75 : ($size == 'Large' ? 2 : 1)), 10, $xoff, $line, 15, 6);
    $this->roundbox_value($load_array[$str] * 2 * ($size == 'Small' ? .75 : ($size == 'Large' ? 2 : 1)), 10, $xoff + 17, $line, 15, 6);
    $this->roundbox_value($load_array[$str] * 5 * ($size == 'Small' ? .75 : ($size == 'Large' ? 2 : 1)), 10, $xoff + 34, $line, 15, 6);
    $this->SetLineWidth(.2);     
  }

  function notes($title, $n, $xoff, $line)
  {
    $this->blue_box_text($title, 10, $xoff, $line, 49, 6);
    $line += 12;
    for ($c = 0; $c < $n; $c++) {
      $y = $line + $c * 5;
      $this->Line($xoff, $y, $xoff + 49, $y);
    }
  }

  function languages($xoff, $line)
  {
    global $character;

    $this->blue_box_text("LANGUAGES", 10, $xoff, $line, 49, 6);
    $line += 12;
    for ($c = 0; $c <= 8; $c++) {
      $y = $line + $c * 5;
      $this->text_cl($character["language_{$c}"], 9, $xoff, $y - 7);
      $this->Line($xoff, $y, $xoff + 49, $y);
    }
  }

  function special_abilities($n, $xoff, $line)
  {
    global $character;
    global $separate_ability;
    global $feat_name;
    global $feat_info;
    global $bonus_array;
    global $character_feat;
    $this_parts = array();
    $other_parts = array();
    $max = array();

    $this->blue_box_text("SPECIAL ABILITIES", 10, $xoff, $line, 49, 6);
    $line += 12;
    $line_count = 0;
    // now we scan for common abilities, we're concerned only with highest in each class
    for ($c = 0; $c < 5; $c++) {
      for ($d = 0; $d < 40; $d++) {
        // now we need to compare this ability with other abilities in this class
	// echo "<pre>Scanning " . $separate_ability[$c][$d] . "</pre>\n";
	// first we check for a number in the special
        if (preg_match('/^([^0-9]*)([0-9]+)(.*)$/', $separate_ability[$c][$d], $this_parts)) {
	  // then we scan all the others for the same string, another number
	  // echo "<pre>Scanning for '$this_parts[1]', '$this_parts[2]', '$this_parts[3]'</pre>\n";
          for ($n = 0; $n < 40; $n++) {
	    if ($n == $d) {
	      continue;
	    }
	    // check for matching special, strip its number
	    $this_parts[1] = preg_replace('/^\+/', '\\\+', $this_parts[1]);
	    $this_parts[1] = preg_replace('/([( ])\+/', '\1\\\+', $this_parts[1]);
	    // echo "<pre>$this_parts[1]</pre>\n";
	    $match = "^$this_parts[1]([0-9]+)$this_parts[3]\$";
	    // echo "<pre>$match -- $sep</pre>\n";
	    if (preg_match("#$match#i", $separate_ability[$c][$n], $other_parts)) {
	      // echo "<pre>Found $other_parts[0]</pre>\n";
	      if ($other_parts[1] > $this_parts[2]) {
		$separate_ability[$c][$d] = '';
	      } else {
		$separate_ability[$c][$n] = '';
	      }
	    }
	  }
	  // so now we have the highest of this ability in this class
	  // we need to add the different classes same abilties together
	}
      }
    }

    $this->text_cl($character[race], 8, $xoff, $line + $line_count * 4 - 2);
    $line_count++;
    for ($d = 0; $d < 40; $d++) {
      if (!empty($separate_ability[0][$d])) {
        $this->text_cl($separate_ability[0][$d], 7, $xoff + 2, $line + $line_count * 4 - 2);
	$line_count++;
      }
    }
    
    for ($c = 1; $c < 4; $c++) {
      $class_index = "class$c";
      if ($character[$class_index] != 'None') {
        $this->text_cl("$character[$class_index]", 8, $xoff, $line + $line_count * 4 - 2);
	$line_count++;
	for ($d = 0; $d < 40; $d++) {
	  $name = $separate_ability[$c][$d];
	  if (!empty($name)) {
            $query = "SELECT * FROM `special_abilities` WHERE `name` = '" . addslashes($name) . "'";
            $ability_result = issue_query($query);
            if ($ability_row = $ability_result->fetchRow(DB_FETCHMODE_ASSOC)) {
               // add any skill mods here
               if ($ability_row[modifiers] != "") {
                 assign_bonuses($ability_row[modifiers]);
               }
            }
	    $this->text_cl($name, 7, $xoff + 2, $line + $line_count * 4 - 2);
	    $line_count++;
	  }
	}
      }
    }
    if ($line_count > 1) {
      $this->blue_box_text("FEATS", 10, $xoff, $line + $line_count * 4 - 4, 49, 5);
      $line += 6;
    }
    for ($c = 0; $c <= 20; $c++) {
      if (!empty($character_feat[$c][name])) {
        if (!empty($character_feat[$c][info])) {
          $this->text_cl(stripslashes($character_feat[$c][name]) . " (" . $character_feat[$c][info] . ")", 8, $xoff, $line + $line_count * 4 -2);
	} else {
          $this->text_cl(stripslashes($character_feat[$c][name]), 8, $xoff, $line + $line_count * 4 -2);
	}
        $line_count++;
      } else {
        break;
      }
    }
    for ($c = $line_count; $c < $n; $c++) {
      $y = $line + $c * 4;
      $this->Line($xoff, $y, $xoff + 49, $y);
    }
  }

  function spell_block($xoff, $line)
  {
    global $spells_per_day;
    global $spells_known;
    global $spell_ability;
    global $dc_ability;
    global $character;
    global $bonus_by_name;
    $caster_index = -1;
    $num_known = 0;

    // choose which spells to show: prefer "spontaneous caster" type, use most known,
    // presuming others would be on separate spell sheet
    for ($c = 0; $c < 4; $c++) {
      if (strlen($spells_known[$c]) > $num_known) {
        $caster_index = $c;
	$num_known = strlen($spells_known[$c]);
      } else {
        if (!empty($spells_per_day[$c]) && $caster_index == -1) {
	  $caster_index = $c;
	}
      }
    }
    // so now $caster_index is which class we are showing in the spells block
    $class_index = 'class' . ($caster_index + 1);
    $this->blue_box_text(($caster_index >= 0)? "$character[$class_index]" : "" . " spells", 12, $xoff, $line, 39, 6);
    $this->roundbox_value(strtoupper($spell_ability[$caster_index]), 9, $xoff + 40, $line, 9, 6);
    $bonus_ability = substr(strtoupper("$spell_ability[$caster_index]"), 0, 1) .substr("$spell_ability[$caster_index]", 1, 2);
    $spell_ability_bonus = bonus_total($bonus_by_name[$bonus_ability]);

    if ($spell_ability[$caster_index] == 'int') {
      $spell_ability[$caster_index] = 'intel';
    }
    $spell_ability_stat = ($character["cur_$spell_ability[$caster_index]"] > 0) ? $character["cur_$spell_ability[$caster_index]"] : $character["$spell_ability[$caster_index]"] + $spell_ability_bonus;

    //    echo "<pre>dc_ability = " . $dc_ability[$caster_index] . ", bonus = " . att_bonus("$dc_ability[$caster_index]") . "</pre>\n";
    $dc_ability_bonus = att_bonus("$dc_ability[$caster_index]");
    $line += 9;
    $this->label_2("CAST TODAY", $xoff - 2, $line);
    $this->label_2("SPELL SAVE DC", $xoff + 8, $line);
    $this->label_2("SPELLS PER DAY", $xoff + 28, $line);
    $this->label_2("BONUS SPELLS", $xoff + 38, $line);
    $line +=3;

    for ($c = 0; $c < 10; $c ++) {
      $y = $line + $c * 7;
      $this->Rect($xoff, $y, 8, 6);
      $spells = substr($spells_per_day[$caster_index], $c, 1);
      $this->roundbox_value(($spells == '' || $spells == '-') ? '' : $dc_ability_bonus + 10 + $c, 10, $xoff + 9, $y, 8, 6);
      $this->text_c("$c", 8, $xoff + 20, $y + 3, 8, 0);
      $this->roundbox_value($spells, 10, $xoff + 31, $y, 8, 6);
      // bonus spells
      if ($spells != '' && $c > 0) {
        $this->text_cc(floor(($spell_ability_stat - 2 - (2 * $c)) / 8), 10, $xoff + 40, $y, 8, 6);
      }
      $this->Rect($xoff + 40, $y, 8, 6);
    }
    $line += 70;
    $this->blue_box_text("$character[$class_index] spells known", 10, $xoff, $line, 49, 4);
    $line += 9;
    for ($l = 0; $l < 5; $l++) {
      $x = $xoff - 1 + $l * 10;
      $this->text_l("$l)", 8, $x, $line - 2);
      $this->text_cl(substr($spells_known[$caster_index], $l, 1), 10, $x + 4, $line - 2);
      $this->Line($x + 3, $line, $x + 9, $line);
    }
    $line += 6;
    for ($l = 5; $l < 10; $l++) {
      $x = $xoff - 1 + ($l - 5) * 10;
      $this->text_l("$l)", 8, $x, $line - 2);
      $this->text_cl(substr($spells_known[$caster_index], $l, 1), 10, $x + 4, $line - 2);
      $this->Line($x + 3, $line, $x + 9, $line);
    }
  }

  function magic_item_block($xoff, $line)
  {
    global $character;
    global $character_item_row;

    $this->blue_box_text_tr("MAGIC ITEMS", 12, $xoff, $line, 100, 6);
    $line += 6;
    $this->SetLineWidth(.4);
    $this->Rect($xoff, $line, 100, 76);
    $this->SetLineWidth(.2);
    $this->Line($xoff + 12, $line, $xoff + 12, $line + 76);
    $this->Line($xoff + 74, $line, $xoff + 74, $line + 76);
    $this->Line($xoff + 92, $line, $xoff + 92, $line + 76);
    $line += 2;
    $this->text_l("Cost", 6, $xoff, $line);
    $this->text_l("Item", 6, $xoff + 12, $line);
    $this->text_l("Location", 6, $xoff + 74, $line);
    $this->text_l("WT.", 6, $xoff + 92, $line);
    $line += 1;
    for ($c = 1; $c <= 5; $c++) {
      if (!empty($character["weapon_{$c}"]) && $character["weapon_{$c}_include"] && $character["weapon_{$c}_bonus"] > 0) {
        $this->Line($xoff, $line + $count * 4, $xoff + 100, $line + $count * 4);
	$count++;
        $this->text_cr($character["weapon_{$c}_cost"], 7, $xoff + 4, $line + $count * 4 - 2, 9);
	$total_price += $character["weapon_{$c}_cost"];
        $this->text_cl(show_sign($character["weapon_{$c}_bonus"]) . " " . $character["weapon_{$c}"] . ($character["weapon_{$c}_special"] ? (' (' . $character["weapon_{$c}_special"] . ')') : ''), 7, $xoff + 12, $line + $count * 4 - 2);
        $this->text_cr($character["weapon_{$c}_weight"], 7, $xoff + 92, $line + $count * 4 - 2, 8);
      }
    }
    if (!empty($character["armor"]) && $character["armor_magic"] > 0) {
      $this->Line($xoff, $line + $count * 4, $xoff + 100, $line + $count * 4);
      $count++;
      $this->text_cr($character["armor_cost"], 7, $xoff + 4, $line + $count * 4 - 2, 9);
      $total_price += $character["armor_{$c}_cost"];
      $this->text_cl("Armor, " . show_sign($character["armor_magic"]) . " " . $character["armor"] . ($character["armor_special"] ? (' (' . $character["armor_special"] . ')') : ''), 7, $xoff + 12, $line + $count * 4 - 2);
      $this->text_cr($character["armor_weight"], 7, $xoff + 92, $line + $count * 4 - 2, 8);
    }
    if (!empty($character["shield"]) && $character["shield_magic"] > 0) {
      $this->Line($xoff, $line + $count * 4, $xoff + 100, $line + $count * 4);
      $count++;
      $this->text_cr($character["shield_cost"], 7, $xoff + 4, $line + $count * 4 - 2, 9);
      $total_price += $character["shield_{$c}_cost"];
      $this->text_cl("Shield, " . show_sign($character["shield_magic"]) . " " . $character["shield"], 7, $xoff + 12, $line + $count * 4 - 2);
      $this->text_cr($character["shield_weight"], 7, $xoff + 92, $line + $count * 4 - 2, 8);
    }
    // echo "<pre>About to iterate through items</pre>\n";
    for ($c = 0; $character_item_row[$c]; $c++) {
      // echo "<pre>Checking $character_item_row[$c][name]</pre>\n";
      $this->Line($xoff, $line + $count * 4, $xoff + 100, $line + $count * 4);
      $count++;
      $this->text_cr($character_item_row[$c]["price"], 7, $xoff + 4, $line + $count * 4 - 2, 9);
      $total_price += $character_item_row[$c]["price"];
      switch ($character_item_row[$c]['type']) {
        case 'potion':
	case 'ring':
	case 'rod':
	case 'staff':
	case 'scroll':
	  $desc = $character_item_row[$c]['type'] . " of " . $character_item_row[$c]["name"];
	  break;
	case 'armor':
	case 'shield':
	case 'weapon':
	case 'wondrous':
	case 'mundane':
	default:
	  $desc = $character_item_row[$c]["name"];
	  break;
      }
      $desc .= " " . $character_item_row[$c]["brief_description"];
      $desc = substr($desc, 0, 50);
      $this->text_cl($desc, 7, $xoff + 12, $line + $count * 4 - 2);
      $this->text_cr($character_item_row[$c]["weight"], 7, $xoff + 92, $line + $count * 4 -2, 8);
      $total_weight += $character_item_row[$c]["weight"];
    }
    for ($c = $count; $c < 18; $c++) {
      $this->Line($xoff, $line + $c * 4, $xoff + 100, $line + $c * 4);
    }
    $this->Line($xoff, $line + 69, $xoff + 100, $line + 69);
    $this->text_cr(sprintf("%.2f", $total_price), 7, $xoff + 4, $line + 71, 9);
    $this->text_cr(sprintf("%.2f", $total_weight), 7, $xoff + 92, $line + 71, 8);
  }

  function treasure_block($xoff, $line)
  {
    $this->blue_box_text_tr("TREASURE", 12, $xoff, $line, 100, 6);
    $line += 6;
    $this->SetLineWidth(.4);
    $this->Rect($xoff, $line, 100, 55);
    $this->Line($xoff + 50, $line, $xoff + 50, $line + 55);
    $this->SetLineWidth(.2);
    $this->Line($xoff + 8, $line, $xoff + 8, $line + 55);
    $this->Line($xoff + 42, $line, $xoff + 42, $line + 55);
    $this->Line($xoff + 58, $line, $xoff + 58, $line + 55);
    $this->Line($xoff + 92, $line, $xoff + 92, $line + 55);
    $line += 2;
    $this->text_l("Value", 6, $xoff, $line);
    $this->text_l("Item", 6, $xoff + 8, $line);
    $this->text_l("WT.", 6, $xoff + 42, $line);
    $this->text_l("Value", 6,$xoff + 50, $line);
    $this->text_l("Item", 6, $xoff + 58, $line);
    $this->text_l("WT.", 6, $xoff + 92, $line);
    $line += 1;
    for ($c = 0; $c < 10; $c++) {
      $this->Line($xoff, $line + $c * 5, $xoff + 100, $line + $c * 5);
    }
    $this->Line($xoff, $line + 46, $xoff + 100, $line + 46);
  }

}

function class_stuff()
{
  global $hd;
  global $sp;
  global $skill_array;
  global $hd_calc;
  global $hd_bonus;
  global $fort;
  global $ref;
  global $will;
  global $attacks;
  global $special_ability;
  global $spells_per_day;
  global $spells_known;
  global $spell_advancement;
  global $spell_ability;
  global $dc_ability;
  global $bab;
  global $bonus_array;
  global $character;
  global $character_all_bonus;
  global $character_feat;
  global $caster_level;
  $char_level = 0;
  $ability_num = 0;
  $total_hd;

  for ($c = 1; $c < 5; $c++) {
    $cclass = $character["class$c"];
    if ($cclass == "None") {
      break;
    }
    $char_level += $level = $character["level$c"];
    $query = "SELECT * FROM cclasses WHERE name = \"$cclass\"";
    $query_result = issue_query($query);
    $class_info = $query_result->fetchRow(DB_FETCHMODE_ASSOC);
    if (DB::isError($class_info)) {
      die($class_info->getMessage());
    }
    $class_num[$c - 1] = $class_info[id];


    // get spell-casting ability
    $spell_ability[$c - 1] = $class_info[spell_ability];
    $dc_ability[$c - 1] = $class_info[dc_ability];

    // get class skills
    $d = 0;
    $x = 1;
    if ($class_num[$c - 1] != '') {
      $query = "SELECT skills.name FROM skill_lists LEFT JOIN skills ON skill_lists.skill_id = skills.skill_id WHERE skill_lists.class_id = " . $class_num[$c - 1];
      $query_result = issue_query($query);
      while ($skill_row = $query_result->fetchRow(DB_FETCHMODE_ASSOC)) {
        if (DB::isError($skill_row)) {
          die($cclass_row->getMessage());
        }
        $skill_array[$c - $x][$d] = $skill_row[name];
	$d++;
      }

      $hd_level = 0;
      // grab special abilities if there are any
      $query = "SELECT * FROM `class_levels` WHERE `class_id` = '" . $class_num[$c - 1] . "' AND `level` <= '" . $level . "'";
      $query_result = issue_query($query);
      if ($query_result->numRows() == 0) {  // check for simple class that has no special abs
        $hd_level = 1;
      } else {
        while ($level_row = $query_result->fetchRow(DB_FETCHMODE_ASSOC)) {
          if (DB::isError($level_row)) {
	    die($cclass_row->getMessage());
          }
          // accumulate HD gained through class (for racial progressions)
	  if ($level_row[hd_advance] == 'Yes') {
	    $hd_level++;
          }

	  // put aside special abilities
	  $level = $level_row[level];
	  $special_ability[$c][$level] = $level_row[special_abilities];
	  
	  // deal with skills
	  if ($level_row[skill_array] != "") {
            parse_str($level_row[skill_array], $new_bonus_array);
	    foreach($new_bonus_array as $k => $v) {
              // echo "<pre>$k += $v</pre>\n";
	      $x = ereg_replace('_', ' ', $k);
	      $bonus_array["{$x}"] += $v;
	    }
	  }
 
	  // get spells per day and known.
	  // echo "<pre>$level_row[spell_advancement]</pre>\n";
	  if ($level_row[spell_advancement] != 'None') {
	    $spell_advancement[$level_row[spell_advancement]]++;
	    // echo "<pre>Spell advancement $level_row[spell_advancement] = " . $spell_advancement[$level_row[spell_advancement]] . "</pre>\n";
	  } else {
            $spells_per_day[$c - 1] = $level_row[spells_per_day];
            $spells_known[$c - 1] = $level_row[spells_known];
	  }
        } // endwhile
      } // endelse

      //
      // only get added when HD are added.
      //
      // calculate hit points

      $bonus = att_bonus('con');
      $hd[$c - 1] = $class_info[HD];
      if ($character['hp'] == 0) {
	  if ($c == 1) {
	      $hd_calc += $class_info[HD] + floor(($class_info[HD] + 1) / 2 * ($hd_level - 1));
	  } else {
	      $hd_calc += floor(($class_info[HD] + 1) / 2) * $hd_level;
	  }
      }
      $hd_calc += $bonus * $hd_level;

      $sp[$c - 1] = $class_info[skills];

      // compute base attack bonus
      $bab += floor($hd_level * (($class_info[BAB] == 'Good') ? 1 : (($class_info[BAB] == 'Average') ? .75 : .5)));
  
      // compute class saves
      $fort += floor($class_info[FORT] == 'Good' ? $hd_level / 2 + 2 : $hd_level / 3 );
      $ref += floor($class_info[REF] == 'Good' ? $hd_level / 2 + 2 : $hd_level / 3 );
      $will += floor($class_info[WILL] == 'Good' ? $hd_level / 2 + 2 : $hd_level / 3 );

      $skill_array[$c - $x][$d] = false;
    } // endif
    $total_hd += $hd_level;
  } // endfor
  if ($spell_advancement["Arcane"] || $spell_advancement["Divine"] || $spell_advancement["Both"] || $spell_advancement["Any"]) {
    for ($c = 1; $c < 5; $c++) {
      // if class has spells
      if ($spells_per_day[$c - 1] != '') {
        // echo "<pre>Checking for class $c, level " . $character["level{$c}"] . ", spell ability: " . $spell_ability[$c - 1] . "</pre>\n";
        // echo "<pre>We have Arcane: $spell_advancement[Arcane], Divine: $spell_advancement[Divine], Both = $spell_advancement[Both], Any = $spell_advancement[Any]</pre>\n";
        switch ($spell_ability[$c - 1]) {
          case 'cha':
	  case 'int':
	    if ($spell_advancement["Arcane"] || $spell_advancement["Both"] || $spell_advancement["Any"]) {
              $caster_level[Arcane] = $character["level{$c}"] + $spell_advancement["Arcane"] + $spell_advancement["Both"] + $spell_advancement["Any"];
              // echo "<pre>We have arcane caster level: $caster_level[Arcane]</pre>\n";
	      $query = "SELECT * FROM `class_levels` WHERE `class_id` = '" . $class_num[$c - 1] . "' AND `level` = '$caster_level[Arcane]'";
	      // echo "<pre>$query</pre>\n";
	      $query_result = issue_query($query);
	      $level_row = $query_result->fetchRow(DB_FETCHMODE_ASSOC);
              if (DB::isError($level_row)) {
	        die($cclass_row->getMessage());
              }
              $spells_per_day[$c - 1] = $level_row[spells_per_day];
              $spells_known[$c - 1] = $level_row[spells_known];
	    }
	    break;
	  case 'wis':
	    if ($spell_advancement["Divine"] || $spell_advancement["Both"] || $spell_advancement["Any"]) {
	      $caster_level[Divine] = $character["level{$c}"] + $spell_advancement["Divine"] + $spell_advancement["Both"] + $spell_advancement["Any"];
	      // echo "<pre>We have divine caster level: $caster_level[Divine]</pre>\n";
	      $query = "SELECT * FROM `class_levels` WHERE `class_id` = '" . $class_num[$c - 1] . "' AND `level` = '$caster_level[Divine]'";
	      // echo "<pre>$query</pre>\n";
	      $query_result = issue_query($query);
	      $level_row = $query_result->fetchRow(DB_FETCHMODE_ASSOC);
              if (DB::isError($level_row)) {
	        die($cclass_row->getMessage());
              }
              $spells_per_day[$c - 1] = $level_row[spells_per_day];
              $spells_known[$c - 1] = $level_row[spells_known];
	      break;
	  }
        }
      }
    }
  }
  
  $hd_calc += $character['hp'];
    
  // check for feats (for hit points)
  // echo "<pre>";
  for ($c = 0; $character_all_bonus[$c]; $c++) {
    // print_r($character_all_bonus[$c]);
    if ($character_all_bonus[$c][subject] == 'HP') {
      // echo "Found HP=" . $character_all_bonus[$value] . "\n";
      switch ($character_all_bonus[$c][value]) {
        case 'HD':
          $hd_bonus += $total_hd;
	  break;
	case 'Int-Con+METAMAGIC_FEATS':
	  $hd_bonus += att_bonus('init_intel') - att_bonus('con');
	  for ($m = 0; $character_feat[$m]; $m++) {
	    // echo "<pre>" . $character_feat[$m][name] . " type " . $character_feat[$m][type] . "</pre>\n";
	    if ($character_feat[$m][type] == 'Metamagic') {
	      $hd_bonus++;
	    }
	  }
	  break;
	case 'Wis-Con+METAMAGIC_FEATS':
	  $hd_bonus += att_bonus('wis') - att_bonus('con');
	  for ($m = 0; $character_feat[$m]; $m++) {
	    if ($character_feat[$m][type] == 'Metamagic') {
	      $hd_bonus++;
	    }
	  }
	  break;
	case 'METAMAGIC_FEATS':
	  for ($m = 0; $character_feat[$m]; $m++) {
	    if ($character_feat[$m][type] == 'Metamagic') {
	      $hd_bonus++;
	    }
	  }
	  break;
        default:
          $hd_bonus += $character_all_bonus[$c][value];
	  break;
      }
    }
  }
  // echo "HD_calc = $hd_calc + $hd_bonus</pre>\n";
  $hd_calc += $hd_bonus;
  $attacks = iterative_attacks($bab);  
}

function iterative_attacks($bab)
{
  // compute iterative attacks
  $attacks = "+$bab";
  if ($bab > 5) {
    $attacks .= ",+" . ($bab - 5);
    if ($bab > 10) {
      $attacks .= ",+" . ($bab - 10);
      if ($bab > 15) {
        $attacks .= ",+" . ($bab - 15);
      }
    }
  }
  return $attacks;
}



function show_sign($number)
{
  if (intval($number) > 0)
   return "+" . $number;
  else
    if (intval($number) == 0)
      return '';
    else
      return $number;
}

// figure out attack bonus for specific weapon
function total_attacks($weapon, $bonus, $bab, $stat)
{
  global $feat_name;

  if (!empty($weapon)) {
    $total = $bab + $bonus;

    $total += att_bonus($stat); 

    // search through feats
    for ($c == 0; $c <= 20; $c++) {
      switch ($character_feat[$c][name]) {
        case "Weapon focus ($weapon)" :
          $total++;
  	  break;
        case "Greater weapon focus ($weapon)" :
          $total++;
          break;
        }
    }
    $attacks = iterative_attacks($total);
    return $attacks;
  } else {
    return '';
  }
}

function total_damage($weapon, $bonus)
{
  global $feat_name;

  if (!empty($weapon)) {
    $damage = $bonus;
    for ($c = 0; $c <= 20; $c++) {
      switch ($character_feat[$c][name]) {
        case "Weapon specialization ($weapon)" :
          $total++;
  	  break;
        case "Greater weapon specialization ($weapon)" :
          $total++;
          break;
        }
    }
    $damage += att_bonus('str'); 
    return $damage;
  }
  return '';
}


function race_stuff()
{
  global $special_ability;
  global $bonus_array;
  global $skill_array;
  global $size;
  global $bab;
  global $fort_misc;
  global $ref_misc;
  global $will_misc;
  global $speed;
  global $character;

  $query = "SELECT * FROM races WHERE name = '$character[race]'";
  // echo "<pre>$query</pre>\n";
  $query_result = issue_query($query);
  $race_info = $query_result->fetchRow(DB_FETCHMODE_ASSOC);
  if (DB::isError($race_info)) {
    die($race_info->getMessage());
  }
  // echo "<pre>$race_info[skill_mods]</pre>\n";
  $d = 0;
  parse_str($race_info[skill_mods], $new_bonus_array);
  foreach ($new_bonus_array as $k => $v) {
    $x = ereg_replace('_', ' ', $k);
    $bonus_array[$x] += $v;
    $skill_array[0][$d] = $x;
    $d++;
  }
  $special_ability[0][0] = $race_info[special_abilities];
  $size = $race_info[size];
  if ($size == 'Small') {
    $bonus_array[Hide] = +4;
  }
  $bab = $race_info[bab];
  $fort_misc = $race_info[fort];
  $ref_misc = $race_info[ref];
  $will_misc = $race_info[will];
  $speed = $race_info[speed];
  if ($race_info[skill_id] != '') {
    $query = "SELECT skills.name FROM skill_lists LEFT JOIN skills ON skill_lists.skill_id = skills.skill_id WHERE skill_lists.class_id = $race_info[skill_id]";
    $query_result = issue_query($query);
    while ($skill_row = $query_result->fetchRow(DB_FETCHMODE_ASSOC)) {
      if (DB::isError($skill_row)) {
        die($cclass_row->getMessage());
      }
      $skill_array[0][$d] = $skill_row[name];
      $d++;
    }
  }
}

$hp = array();
$hd = array();
$hd_calc = 0;
$hd_bonus = 0;
$sp = array();
$skill_array = array();
$bonus_array = array();
$conditional_bonus = array();
$character_all_bonus = array();
$character_item_row = array();
$character_feat = array();
$special_ability = array();
$spells_per_day = array();
$spells_known = array();
$spell_advancement = array();
$spell_ability = array();
$dc_ability = array();
$caster_level = array();
$bab = 0;
$size = '';
$attacks = "";
$fort = 0;
$ref = 0;
$will = 0;
$fort_misc = 0;
$ref_misc = 0;
$will_misc = 0;
$speed;

// initial function (race condition: need special abs before get_bonuses)
// class_stuff wants HP modifiers from get_bonuses
race_stuff();
get_bonuses();
class_stuff();
bonuses_from_abilities();

//Instantiation of inherited class
$pdf = new PDF('P', 'mm', 'letter');
$pdf->AddFont('Comic', '', 'comic.php');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetAutoPageBreak(0);

$globx = 5;
$line = 8;

// stuff to actually print character sheet starts here.

$pdf->name_block($globx, $line);

$line += 8;

$pdf->class_block($globx, $line);

$line += 8;

$pdf->size_block($globx, $line);

$line += 8;

$pdf->ability_block($globx, $line);

$pdf->hp_block($globx + 56, $line);

$line += 11;

$pdf->ac_block($globx, $line);

$line += 11;
$pdf->blue_box_text_2("Flat Footed", "AC", 16, $globx + 56, $line, 14, 9);
$pdf->SetDrawColor(0);
$pdf->SetLineWidth(.4);
$pdf->RoundedRect($globx + 70, $line, 12, 9, 3);

$pdf->init_block($globx + 84, $line);

$pdf->skill_block($globx + 143, $line);

$line += 10;

$pdf->blue_box_text_2("TOUCH", "AC", 16, $globx + 56, $line, 14, 9);
$pdf->SetDrawColor(0);
$pdf->SetLineWidth(.4);
$pdf->RoundedRect($globx + 70, $line, 12, 9, 3);


$pdf->blue_box_text("BAB", 12, $globx + 84, $line, 16, 9);
$pdf->SetDrawColor(0);
$pdf->SetLineWidth(.4);
$pdf->roundbox_value($attacks, 12, $globx + 100, $line, 25, 9);

$skill_start = $line + .5;

$line += 14;

$save_start = $line - 2;

$pdf->save_block($globx, $line);

$line += 23;

$pdf->text_l("TOTAL", 6, $globx + 21, $line);
$pdf->label("BASE ATTACK BONUS", $globx + 43, $line + 1);
$pdf->label_2("ABILITY MODIFIER", $globx + 64, $line);
$pdf->label_2("SIZE MODIFIER", $globx + 75, $line);
$pdf->label_2("MISC. MODIFIER", $globx + 86, $line);
$pdf->label_2("TEMP. MODIFIER", $globx + 97, $line);
$line += 2;

//$pdf->attack_block("MELEE", $globx, $line, 'str');

//$line += 7;

// $pdf->attack_block("RANGED", $globx, $line, 'dex');

// $line += 7;

$pdf->attack_block("GRAPPLE", $globx, $line, 'str');

$line += 8;

for ($c = 1; $c <= 3; $c++) {
  $pdf->weapon_block("WEAPON", $globx, $line, $c);
  $line += 20;
}

$pdf->ammo_block("Ammunition", $globx, $line);

$line += 7;

$pdf->weapon_block("WEAPON", $globx, $line, 4);
$line += 20;

$pdf->ammo_block("Ammunition", $globx, $line);

$line += 7;

$pdf->armor_block("ARMOR", $globx, $line);

$line += 18;

$pdf->armor_block("SHIELD", $globx, $line);

$line += 18;

$pdf->protective_items_block($globx, $line);

$line = $save_start;

$pdf->text_l("Character Sketch", 6, $globx + 108, $line);
// if (!empty($character["client_portrait"])) {
//   $pdf->Image($character["uploaded_portrait"], $globx + 108, $line + 1, 34, 40);
// } else {
  if (!empty($character["portrait"])) {
    $pdf->Image($character["portrait"], $globx + 108, $line + 1, 34, 40);
  } else {
    $pdf->SetLineWidth(.4);
    $pdf->SetDrawColor(0);
    $pdf->Rect($globx + 108, $line + 2, 34, 40);
  }
// }

$line += 44;

$pdf->text_l("Sign, Sigil or Coat of Arms", 6, $globx + 108, $line);
// insert chosen holy symbol here?
if (!empty($character[client_symbol])) {
  $symbol = $character[client_symbol];
} else {
  if (!empty($character[symbol])) {
    $symbol = $character[symbol];
  } else {
    $symbol = "../images/shields/blank1.png";
  }
}
$pdf->Image($symbol, $globx + 108, $line + 1, 34, 40);

// $pdf->SetDrawColor(0);
// $pdf->Rect($globx + 108, $line + 2, 34, 40);

$line += 43;

$pdf->blue_box_text_tr("DURATION TRACKER", 8, $globx + 108, $line, 34, 3.5);
$line += 3.5;
$pdf->SetLineWidth(.2);
for ($h = 0; $h < 4; $h ++) {
  $pdf->Rect($globx + 108, $line, 34, 6);
  $pdf->text_l("Effect", 6, $globx + 108, $line + 1.5);
  $line += 6;
  for ($c = 0; $c < 17; $c++) {
    $x = $globx + 108 + 2 * $c;
    $pdf->Rect($x, $line, 2, 2);
  }
  $line += 2;
}

$line += 1.5;
$pdf->blue_box_text_tr("NOTES", 8, $globx + 108, $line, 34,  3.5);
$line += 3.5;
$text_index = 0;
$max_len = 28;
for ($c = 0; $c < 65; $c += 5) {
  $break = 0;
  $text = substr($character[notes], $text_index, $max_len);
  if (strlen($text) > $max_len - 1) {
    for ($p = $max_len - 1; $p > 0; $p--) {
      if (ereg('[^[:graph:]]', $text[$p])) {
        $break = $p + 1;
        break;
      }
    }
  } else {
    $break = strlen($text);
  }
  if ($break == 0) {
    $break = strlen($text);
  }
  $pdf->text_l(substr($text, 0, $break), 7.5, $globx + 107.5, $c + $line + 3.5);
  $text_index += $break;
  $pdf->Rect($globx + 108, $c + $line, 34, 5);
}

$pdf->skill_list($globx + 143, $skill_start);

for ($c = 1; $c <= 4; $c++) {
  $sp[$c - 1] += intval(($character[intel] - 10) / 2) + ($character[race] == 'Human');
  $sp[$c - 1] = $sp[$c - 1] * ($character["level$c"] + ($c == 1 ? 3 : 0));
}

$pdf->text_l("$sp[0], $sp[1], $sp[2], $sp[3]", 6, $globx + 143, $line + 69);

$pdf->AddPage();

$globx = 5;
$line = 8;

$pdf->exp_block($globx, $line);

$line += 10;

$pdf->gear_block($globx, $line);

$line += 106;

$pdf->magic_item_block($globx, $line);

$line += 83;

$pdf->treasure_block($globx, $line);

$line = 8;

$pdf->special_abilities(40, $globx + 101, $line);

$line += 176;

$pdf->load_block($globx + 101, $line);

$line += 32;

$pdf->languages($globx + 101, $line);

$line = 8;

$pdf->notes("SPELLS/NOTES", 30, $globx + 151, $line);
$line += 162;

$pdf->spell_block($globx + 151, $line);

$pdf->Output();
?>
