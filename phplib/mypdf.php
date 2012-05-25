<?php

define('FPDF_FONTPATH', 'font/');
require_once('fpdf.php');

  // do pdf stuff
class MYPDF extends FPDF
{

  //Page footer
  function Footer()
  {
    //Position at 1 cm from bottom
    $this->SetY(-10);
    //Arial italic 6
    $this->SetFont('Arial','I',6);
    //Page number
    $this->Cell(0,5,'Copyright (c) 2004,2005,2006,2007, Dominic Amann',0,0,'C');
  }
  
    function RoundedRect($x, $y, $w, $h, $r, $style = '', $angle = '1234')
    {
        $k = $this->k;
        $hp = $this->h;
        if($style=='F')
            $op='f';
        elseif($style=='FD' or $style=='DF')
            $op='B';
        else
            $op='S';
        $MyArc = 4/3 * (sqrt(2) - 1);
        $this->_out(sprintf('%.2f %.2f m',($x+$r)*$k,($hp-$y)*$k ));

        $xc = $x+$w-$r;
        $yc = $y+$r;
        $this->_out(sprintf('%.2f %.2f l', $xc*$k,($hp-$y)*$k ));
        if (strpos($angle, '2')===false)
            $this->_out(sprintf('%.2f %.2f l', ($x+$w)*$k,($hp-$y)*$k ));
        else
            $this->_Arc($xc + $r*$MyArc, $yc - $r, $xc + $r, $yc - $r*$MyArc, $xc + $r, $yc);

        $xc = $x+$w-$r;
        $yc = $y+$h-$r;
        $this->_out(sprintf('%.2f %.2f l',($x+$w)*$k,($hp-$yc)*$k));
        if (strpos($angle, '3')===false)
            $this->_out(sprintf('%.2f %.2f l',($x+$w)*$k,($hp-($y+$h))*$k));
        else
            $this->_Arc($xc + $r, $yc + $r*$MyArc, $xc + $r*$MyArc, $yc + $r, $xc, $yc + $r);

        $xc = $x+$r;
        $yc = $y+$h-$r;
        $this->_out(sprintf('%.2f %.2f l',$xc*$k,($hp-($y+$h))*$k));
        if (strpos($angle, '4')===false)
            $this->_out(sprintf('%.2f %.2f l',($x)*$k,($hp-($y+$h))*$k));
        else
            $this->_Arc($xc - $r*$MyArc, $yc + $r, $xc - $r, $yc + $r*$MyArc, $xc - $r, $yc);

        $xc = $x+$r ;
        $yc = $y+$r;
        $this->_out(sprintf('%.2f %.2f l',($x)*$k,($hp-$yc)*$k ));
        if (strpos($angle, '1')===false)
        {
            $this->_out(sprintf('%.2f %.2f l',($x)*$k,($hp-$y)*$k ));
            $this->_out(sprintf('%.2f %.2f l',($x+$r)*$k,($hp-$y)*$k ));
        }
        else
            $this->_Arc($xc - $r, $yc - $r*$MyArc, $xc - $r*$MyArc, $yc - $r, $xc, $yc - $r);
        $this->_out($op);
    }


  function _Arc($x1, $y1, $x2, $y2, $x3, $y3)
  {
    $h = $this->h;
    $this->_out(sprintf('%.2f %.2f %.2f %.2f %.2f %.2f c ', $x1*$this->k, ($h-$y1)*$this->k,
                $x2*$this->k, ($h-$y2)*$this->k, $x3*$this->k, ($h-$y3)*$this->k));
  }

  function blue_box_l_text($text, $p, $x, $y, $w, $h)
  {
    $this->SetXY($x, $y);
    $this->SetFont('Arial', 'B', "$p");
    $this->SetFillColor(175, 175, 175);
    //    $this->SetFillColor(164, 198, 194);
    $this->SetTextColor(0, 0, 0);
    $this->SetLineWidth(.2);
    $this->Cell($w, $h, $text, 1, 0, 'L', 1);
  }
  
  function blue_box_text($text, $p, $x, $y, $w, $h)
  {
    $this->SetFillColor(175, 175, 175);
    $this->SetLineWidth(.2);
    $this->RoundedRect($x, $y, $w, $h, 2, 'DF');
    $this->SetXY($x, $y);
    $this->SetFont('Arial', 'B', "$p");
//    $this->SetFillColor(164, 198, 194);
    $this->SetTextColor(0, 0, 0);
    $this->Cell($w, $h, $text, 0, 0, 'C');
  }

  function blue_box_text_tr($text, $p, $x, $y, $w, $h)
  {
    $this->SetFillColor(175, 175, 175);
    $this->SetLineWidth(.2);
    $this->RoundedRect($x, $y, $w, $h, 2, 'DF', '12');
    $this->SetXY($x, $y);
    $this->SetFont('Arial', 'B', "$p");
//    $this->SetFillColor(164, 198, 194);
    $this->SetTextColor(0, 0, 0);
    $this->Cell($w, $h, $text, 0, 0, 'C');
  }

  function blue_box_text_2($small_text, $text, $p, $x, $y, $w, $h)
  {
    $this->SetFillColor(175, 175, 175);
    $this->SetLineWidth(.2);
//    $this->SetDrawColor(0);
    $this->RoundedRect($x, $y, $w, $h, 2, 'DF');

    $this->SetFont('Arial', 'B', $p - 10);
//    $this->SetFillColor(164, 198, 194);
    $this->SetTextColor(0, 0, 0);
    $this->SetXY($x + 1.5, $y + .5);
    $this->Cell($w - 3, $h - 6, $small_text, 0, 0, 'C', 1);
    $this->SetXY($x, $y + ($h - 6));
    $this->SetFont('Arial', 'B', $p);
    $this->Cell($w, $h - ($h - 6), $text, 0, 0, 'C');
  }

  function clear_box_text($text, $p, $x, $y, $w, $h)
  {
    $this->SetXY($x, $y);
    $this->SetFont('Arial', 'B', "$p");
    $this->SetFillColor(0, 0, 0);
    $this->SetTextColor(255, 255, 255);
    $this->Cell($w, $h, $text);
  }

  function black_box_text($text, $p, $x, $y, $w, $h)
  {
    $this->SetXY($x, $y);
    $this->SetFont('Arial', 'B', "$p");
    $this->SetFillColor(0, 0, 0);
    $this->SetTextColor(255, 255, 255);
    $this->Cell($w, $h, $text, 0, 0, 'C', 1);
  }

  function black_box_text_2($small_text, $text, $p, $x, $y, $w, $h)
  {
    $this->SetXY($x, $y);
    $this->SetFont('Arial', 'B', $p - 10);
    $this->SetFillColor(0, 0, 0);
    $this->SetTextColor(255, 255, 255);
    $this->Cell($w, $h - 6, $small_text, 0, 0, 'C', 1);
    $this->SetXY($x, $y + ($h - 6));
    $this->SetFont('Arial', 'B', $p);
    $this->Cell($w, $h - ($h - 6), $text, 0, 0, 'C', 1);
  }

  function line_and_label($text, $x, $y, $w)
  {
    $this->SetXY($x, $y);
    $this->SetFont('Arial', '', 6);
    $this->SetTextColor(0);
    $this->Cell($w, 4, $text, 'T');
  }

  function label($text, $x, $y)
  {
    $this->SetXY($x, $y);
    $this->SetFont('Arial', '', 4.5);
    $this->SetTextColor(0);
    $this->Cell(0, 0, $text);
  }

  function label_2($text, $x, $y)
  {
    $this->SetXY($x, $y - 2);
    $this->SetFont('Arial', '', 4.5);
    $this->SetTextColor(0);
    $this->MultiCell(10, 2, $text, 0, 'C');
  }

  function text_box($text, $p, $x, $y, $w, $h)
  {
    $this->SetXY($x, $y);
    $this->SetFont('Arial', '', $p);
    $this->SetTextColor(0);
    $this->SetLineWidth(.2);
    $this->Cell($w, $h, $text, 1, 1, 'C');
  }

  function text_box_l($text, $p, $x, $y, $w, $h)
  {
    $this->SetXY($x, $y);
    $this->SetFont('Arial', '', $p);
    $this->SetTextColor(0);
    $this->SetLineWidth(.2);
    $this->Cell($w, $h, $text, 1, 1, 'L');
  }

  function text_c($text, $p, $x, $y, $w, $h)
  {
    $this->SetXY($x, $y);
    $this->SetFont('Arial', '', $p);
    $this->SetTextColor(0);
    $wid = $this->GetStringWidth($text);
    $this->Cell($w, $h, $text, 0, 0, 'C');
    return $wid;
  }

  function box_value($text, $p, $x, $y, $w, $h)
  {
    $this->Rect($x, $y, $w, $h, 3);
    return $this->text_cc($text, $p, $x, $y, $w, $h);
  }

  function lbox_value($text, $p, $x, $y, $w, $h)
  {
    $this->Rect($x, $y, $w, $h, 3);
    return $this->text_cl($text, $p, $x, $y + $h / 2);
  }

  function rbox_value($text, $p, $x, $y, $w, $h)
  {
    $this->Rect($x, $y, $w, $h, 3);
    return $this->text_cr($text, $p, $x, $y + $h / 2);
  }


  function roundbox_value($text, $p, $x, $y, $w, $h, $s = '1234')
  {
    $this->RoundedRect($x, $y, $w, $h, 3);
    return $this->text_cc($text, $p, $x, $y, $w, $h, $s);
  }

  function text_($text, $p, $x, $y, $w, $h, $f = 'Arial', $a = 'L')
  {
    $this->SetXY($x, $y);
    $this->SetFont($f, '', $p);
    $this->SetTextColor(0);
    $wid = $this->GetStringWidth($text);
    $this->Cell($w, $h, $text, 0, 0, $a);
    return $wid;
  }
  
  function text_cc($text, $p, $x, $y, $w, $h)
  {
    return $this->text_($text, $p, $x, $y, $w, $h, 'Comic', 'C');
  }

  function text_cr($text, $p, $x, $y, $w, $h = 0)
  {
    return $this->text_($text, $p, $x, $y, $w, $h, 'Comic', 'R');
  }


  function text_cl($text, $p, $x, $y)
  {
    return $this->text_($text, $p, $x, $y, $w, $h, 'Comic', 'L');
  }
  

  function text_l($text, $p, $x, $y)
  {
    return $this->text_($text, $p, $x, $y, $w, $h, 'Arial', 'L');
  }

  function text_bl($text, $p, $x, $y)
  {
    $this->SetXY($x, $y);
    $this->SetFont('Arial', 'B', $p);
    $this->SetTextColor(0);
    $wid = $this->GetStringWidth($text);
    $this->Cell($w, $h, $text, 0, 0, 'L');
    return $wid;
  }
}
?>
