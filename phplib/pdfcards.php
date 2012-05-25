<?php
// Spell card output
define('FPDF_FONTPATH', 'font/');
require_once('fpdf.php');
require_once('mypdf.php');
// declare pdf stuff
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
?>