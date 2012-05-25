<?php
  // connect DB stuff
  require_once('DB.php');
  require_once('../phplib/metabase.lib.php');
  define('FPDF_FONTPATH', '../phplib/font/');
  require_once('../phplib/fpdf.php');
  require_once('../phplib/mypdf.php');

  // do pdf stuff
class PDF extends MYPDF
{

  function header()
  {
    $this->SetMargins(0, 0, 0);
  }

  function draw_card($row, $level, $card_pos, $cclass)
  {
    global $left_margin;
    global $top_margin;

    $w = 135;
    $h = 67;
    switch ($card_pos % 6) {
      case 0:
        $this->AddPage();
	$x = $left_margin;
	$y = $top_margin;
	break;
      case 1:
        $x = $left_margin + $w;
	$y = $top_margin;
	break;
      case 2:
        $x = $left_margin;
	$y = $top_margin + $h;
	break;
      case 3:
        $x = $left_margin + $w;
	$y = $top_margin + $h;
	break;
      case 4:
        $x = $left_margin;
	$y = $top_margin + $h * 2;
	break;
      case 5:
        $x = $left_margin + $w;
	$y = $top_margin + $h * 2;
	break;
    }
    $this->Rect($x, $y, $w, $h);
    $this->blue_box_l_text("$row[name]", 10, $x, $y, $w / 3, 5);
    $this->text_l("$level", 10, $x + $w / 3 - 5, $y + 2.5);
    $this->text_bl("School:", 9, $x, $y + 8);
    $this->text_l("$row[school]", 8, $x + 23, $y + 8);
    $this->text_bl("Casting Time:", 9, $x, $y + 13);
    $this->text_l("$row[time]", 8, $x + 23, $y + 13);
    $this->text_bl("Range:", 9, $x, $y + 18);
    $this->text_l("$row[range]", 8, $x + 23, $y + 18);
    $this->text_bl("Target:", 9, $x, $y + 23);
    $oldy = $y;
    $this->SetXY($x + 23, $y + 21);
    $this->SetFont('Arial', '', 8);
    $this->MultiCell(23, 3, "$row[target]", 0);
    $y = $this->GetY() - 1;
    $this->text_bl("Duration:", 9, $x, $y + 5);
    $this->text_l("$row[duration]", 8, $x + 23, $y + 5);
    $this->text_bl("Saving Throw:", 9, $x, $y + 10);
    $this->text_l("$row[save]", 8, $x + 23, $y + 10);
    $this->text_bl("Spell Resist.:", 9, $x, $y + 15);
    $this->text_l("$row[spell_resistance]", 8, $x + 23, $y + 15);
    $this->SetXY($x + $w / 3, $oldy);
    $desc = substr(strip_tags($row[full_description]), 0, 1000);
    $this->MultiCell($w * 2 / 3, 3, $desc, 0);
  }

}

  //Instantiation of inherited class
  $pdf = new PDF('L', 'mm', 'letter');
  $pdf->AliasNbPages();
  $pdf->SetAutoPageBreak(0);

  $left_margin = 5;
  $top_margin = 5;

  db_connect("dnd");

  $post = $_POST;
  $cclass = $post[cclass];

  $domain_filter = stripslashes($post['domain_filter']);
  $sanctified_filter = stripslashes($post['sanctified_filter']);

  // create  query
  if ($cclass == "cleric") {
    $domain1 = $post[domain1];
    $domain2 = $post[domain2];
    $domain3 = $post[domain3];
  }

  $source_select = stripcslashes($post[sources]);

  if ($title == "Wizard") {
    $special = $post[special];
    if ($post[prohibited1] != "") {
      $schools = " AND NOT INSTR('$post[prohibited1], $post[prohibited2]', school) ";
    }
  }

  $sql_query = "SELECT * FROM spell WHERE $cclass >= '$post[from_level]' AND $cclass <= '$post[to_level]' AND $source_select $schools ORDER BY $cclass, name";
//  echo "<pre>$sql_query</pre>\n";
  $query_result = issue_query($sql_query);

  $level = $post['from_level'];
  if ($level == 0 && ! stristr("bard blighter cleric sorc_wiz druid sacred_fist witch",  $cclass)) {
    $level = 1;
  }
  $spell_num = 0;
  $level_sequence = 1;

  // generate body of table
  while ($cclass_row = $query_result->fetchRow(DB_FETCHMODE_ASSOC)) {
    if (DB::isError($cclass_row)) {
      die($cclass_row->getMessage());
    }
    if ($cclass_row[$cclass] != $level) {
      $level = $cclass_row[$cclass];
      $level_sequence = 1;
      $adjust = 0;

      if (! stristr("bard sorcerer", $cclass)) {
        $found_spell = false;
        $level_sanctified_filter = str_replace('$level', "$level", $sanctified_filter);
	$sanctified_query = "SELECT * FROM spell WHERE $level_sanctified_filter AND $source_select ORDER BY name";
        $sanctified_result = issue_query($sanctified_query);
        while ($san_row = $sanctified_result->fetchRow(DB_FETCHMODE_ASSOC)) {
          if (DB::isError($san_row)) {
	    die($san_row->getMessage());
	  }
	  $s = "level_san_{$level}_{$level_sequence}";
	  if ($post[$s] == "on") {
	    if (! $found_spell) {
	      $found_spell = true;
	    }
	    $pdf->draw_card($san_row, $level, $spell_num++, $cclass);
	  } else {
	    $adjust++;
	  }
	  $level_sequence++;
	}
	$level_sequence = 1;
	$adjust = 0;
      }

      if ($title != "Wizard" && $domain1 != "") {
        $level_domain_filter = str_replace('$level', "$level", $domain_filter);
        $domain_query = "SELECT * FROM spell WHERE $level_domain_filter AND INSTR('$sources', source) ORDER BY name";
        $domain_result = issue_query($domain_query);
        while ($dom_row = $domain_result->fetchRow(DB_FETCHMODE_ASSOC)) {
          if (DB::isError($dom_row)) {
	    die($dom_row->getMessage());
	  }
	  $s = "level_dom_{$level}_{$level_sequence}";
	  if ($post[$s] == "on") {
	    $pdf->draw_card($dom_row, $level, $spell_num++, $cclass);
	  } else {
	    $adjust++;
	  }
	  $level_sequence++;
	}
	$level_sequence = 1;
	$adjust = 0;
      }
    }
    $s = "level_{$level}_{$level_sequence}";
    if ($post[$s] == "on") {
      $pdf->draw_card($cclass_row, $level, $spell_numm++, $cclass);
    } else {
      $adjust++;
    }
    $level_sequence++;
  }

  
$pdf->output();

?>
