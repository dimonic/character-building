<?php 
  // connect
  // echo "<pre>About to connect</pre>\n";
  require_once('../phplib/connect.inc.php');
  require_once('../phplib/lib.inc.php');

  // echo "<pre>Choice is $_POST['submit']</pre>\n";
  $title = $_POST['title'];
  $cclass = $_POST['cclass'];
  $domain_filter = stripslashes($_POST['domain_filter']);
  $sanctified_filter = stripslashes($_POST['sanctified_filter']);
  // create  query
  if ($cclass == "cleric") {
    $domain1 = $_POST[domain1];
    $domain2 = $_POST[domain2];
    $domain3 = $_POST[domain3];
  }
  $source_select = stripcslashes($_POST[sources]);
  if ($title == "Wizard") {
    $special = $_POST[special];
    if ($_POST[prohibited1] != "") {
      $schools = " AND NOT INSTR('$_POST[prohibited1], $_POST[prohibited2]', school) ";
    }
  }
  if ($cclass == 'wu_jen') {
    $sql_query = "SELECT * FROM spell WHERE $cclass >= '$_POST[from_level]' AND $cclass <= '$_POST[to_level]' AND $source_select $schools ORDER BY $cclass, element, name";
  } else {
    $sql_query = "SELECT * FROM spell WHERE $cclass >= '$_POST[from_level]' AND $cclass <= '$_POST[to_level]' AND $source_select $schools ORDER BY $cclass, name";
  }
//  echo "<pre>$sql_query</pre>\n";
  $query_result = issue_query($sql_query);
  // classes that have 0 level spells
  $level = $_POST['from_level'];
  if ($level == 0 && ! stristr("bard blighter cleric sorc_wiz druid sacred_fist witch wu_jen",  $cclass)) {
    $level = 1;
  }
  $spell_num = 1;
  // Spell sheet output
  if ($_POST['submit'] == 'Make Spell Sheets') {
   require_once('latex_output_funcs.php');
   setPDFHeaders("spell-sheet.pdf");
   $latex_doc = "";
   latex_preamble($title);
   if ($_POST[DCTable] == "yes") {
     switch($title) {
       case 'Hospitaler':
       case 'Cleric':
       case 'Master of Shrouds':
         latex_cleric_DC_tables("$domain1", "$domain2", "$domain3", "$domain4");
	 break;
       case 'Wizard':
         latex_wizard_DC_tables("$special", "$prohibited1", "$prohibited2");
	 break;
       default:    
         latex_other_DC_tables();
	 break;
     }
   }
   latex_start_table($cclass);
   latex_level_header("LEVEL $level", $cclass);
  } else {
    // use pdf class to create spell cards
    require_once("../phplib/pdfcards.php");

    //Instantiation of inherited class
    $pdf = new PDF('L', 'mm', 'letter');
    $pdf->AliasNbPages();
    $pdf->SetAutoPageBreak(0);

    $left_margin = 5;
    $top_margin = 5;
  }

  // function to show the spell either as a row (latex) or a card (mypdf)
  function show_row($row_data, $level, $spell_num, $class)
  {
    global $pdf;

    if ($_POST['submit'] == 'Make Spell Sheets') {
      latex_row($row_data, $spell_num, $class);
    } else {
      $pdf->draw_card($row_data, $level, $spell_num, $class);
    }
  }

  // generate body of table
  while ($spell_row = $query_result->fetchRow(DB_FETCHMODE_ASSOC)) {
    if (DB::isError($spell_row)) {
      echo "<pre>fetching row for $sql_query</pre>\n";
      die($spell_row->getMessage());
    }
    if ($spell_row[$cclass] != $level) {
      $level = $spell_row[$cclass];
      $spell_num = 1;
      $adjust = 0;

      if (! stristr("bard sorcerer", $cclass)) {  // only preparered can cast sanctified
        $found_spell = false;
        $level_sanctified_filter = str_replace('$level', "$level", $sanctified_filter);
	$sanctified_query = "SELECT * FROM spell WHERE $level_sanctified_filter AND $source_select ORDER BY name";
	//	echo "<pre>$sanctified_query</pre>\n";
        while ($san_row = $sanctified_result->fetchRow(DB_FETCHMODE_ASSOC)) {
          if (DB::isError($san_row)) {
	    echo "<pre>Fetching row for $sanctified_query</pre>\n";
	    die($san_row->getMessage());
	  }
	  $s = "level_san_{$level}_{$spell_num}";
	  if ($_POST[$s] == "on") {
	    if (! $found_spell) {
              if ($_POST['submit'] == 'Make Spell Sheets') {
                latex_level_header("SANCTIFIED LEVEL $level", $cclass);
	      }
	      $found_spell = true;
	    }
	    show_row($san_row, $spell_num - $adjust, $cclass);
	  } else {
	    $adjust++;
	  }
	  $spell_num++;
	}
	$spell_num = 1;
	$adjust = 0;
      }
      if ($title != "Wizard" && $domain1 != "") {
        if ($_POST['submit'] == 'Make Spell Sheets') {
          latex_level_header("DOMAIN LEVEL $level", $cclass);
	}
        $level_domain_filter = str_replace('$level', "$level", $domain_filter);
        $domain_query = "SELECT * FROM spell WHERE $level_domain_filter AND $source_select ORDER BY name";
	//	echo "<pre>$domain_query</pre>\n";
        $domain_result = issue_query($domain_query);
        while ($dom_row = $domain_result->fetchRow(DB_FETCHMODE_ASSOC)) {
          if (DB::isError($dom_row)) {
	    echo "<pre>Fetching row for $domain_query</pre>\n";
	    die($dom_row->getMessage());
	  }
	  $s = "level_dom_{$level}_{$spell_num}";
	  if ($_POST[$s] == "on") {
	    show_row($dom_row, $level, $spell_num - $adjust, $cclass);
	  } else {
	    $adjust++;
	  }
	  $spell_num++;
	}
	$spell_num = 1;
	$adjust = 0;
      }
      if ($_POST['submit'] == 'Make Spell Sheets') {
        latex_level_header("LEVEL $level", $cclass);
      }
    }
    $s = "level_{$level}_{$spell_num}";
    if ($_POST[$s] == "on") {
      show_row($spell_row, $level, $spell_num - $adjust, $cclass);
    } else {
      $adjust++;
    }
    $spell_num++;
  }
  if ($_POST['submit'] == 'Make Spell Sheets') {
    latex_end_table();
    latex_postamble();
    $fname = tempnam("/tmp", "spell-sheet");
    $latex_file = fopen("$fname.ltx", "w");
    fwrite($latex_file, $latex_doc);
    fclose($latex_file);

    system("/usr/local/bin/latex2pdf $fname.ltx > /dev/null /2> /dev/null");

    if (file_exists("$fname.pdf")) {
      // unlink("$fname.ltx");
      // unlink("$fname.log");
      // unlink("$fname.aux");
      // unlink("$fname.dvi");
      // unlink("$fname.ps");

      $pdf_file = fopen("$fname.pdf", "r+");
      fpassthru($pdf_file);

      // unlink("$fname.pdf");
      // unlink("$fname");
    }
  } else {
    $pdf->output();
  }
?>
